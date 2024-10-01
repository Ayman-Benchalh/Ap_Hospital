<?php

require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

$clinic_id = $clinic_row['clinic_id']; // Assuming you have $clinic_row defined

// Fetch patients for the dropdown
$patients = $conn->query("SELECT * FROM patients ORDER BY patient_firstname ASC");

// Fetch doctor based on the clinic_id
$doctor_stmt = $conn->prepare("SELECT * FROM doctors WHERE clinic_id = ?");
$doctor_stmt->bind_param("i", $clinic_id);
$doctor_stmt->execute();
$doctor_result = $doctor_stmt->get_result();

$doctor = $doctor_result->fetch_assoc(); // Fetch the first doctor (if multiple, handle accordingly)
$doctor_id = $doctor['doctor_id']; // Now you have the doctor_id

// Handle the form submission for creating an appointment
if (isset($_POST['appointmentbtn'])) {
    // Capture form data
    $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $status = 1; // Assuming status is 1 for active
    $consult_status = 0; // Assuming consult_status is 0 for pending
    $arrive_status = 0; // Assuming arrive_status is 0 for not arrived
    $treatment_type = isset($_POST['treatment_type']) ? $_POST['treatment_type'] : null;

    // Check if it's a new patient
    $is_new_patient = isset($_POST['Nom_Patient']) && !empty($_POST['Nom_Patient']);

    if ($is_new_patient) {
        $Nom_Patient = $_POST['Nom_Patient'];
        $Identity = $_POST['Identity'];
        $Age = intval($_POST['Age']);
        $patient_Seance = 0;
        $Telephone = $_POST['Telephone'];
        $date_created = date('Y-m-d H:i:s');

        // Try to insert the new patient and catch errors
        try {
            $new_patient_stmt = $conn->prepare("INSERT INTO patients (patient_id,patient_firstname, patient_identity, patient_Seance, patient_contact, patient_age, date_created) 
                                                VALUES (?,?, ?, ?, ?, ?, ?)");
            $new_patient_stmt->bind_param("sssssis",$Identity, $Nom_Patient, $Identity, $patient_Seance, $Telephone, $Age, $date_created);

            if ($new_patient_stmt->execute()) {
                // Successfully added a new patient
                // $patient_id = $conn->insert_id; 
                $appstmt = $conn->prepare("INSERT INTO appointment (app_date, app_time, treatment_type, patient_id, doctor_id, clinic_id, status, consult_status, arrive_status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $appstmt->bind_param("ssssiiiii", $date, $time, $treatment_type, $Identity, $doctor_id, $clinic_id, $status, $consult_status, $arrive_status);

                        if ($appstmt->execute()) {
                        echo '<script>
                            Swal.fire({
                                title: "Succès!",
                                text: "Le rendez-vous a été ajouté avec succès.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "appointment.php";
                                }
                            });
                        </script>';
                        } else {
                        throw new mysqli_sql_exception("Erreur lors de l'ajout du rendez-vous.");
                        }
                // Get the newly inserted patient ID
            } else {
                throw new mysqli_sql_exception("Erreur lors de l'insertion du patient.");
            }

            $new_patient_stmt->close();
        } catch (mysqli_sql_exception $e) {
            // Handle duplicate entry or other SQL errors with Swal.fire
            if ($e->getCode() === 1062) {
                echo '<script>
                        Swal.fire({
                            title: "Erreur!",
                            text: "Ce patient existe déjà. Veuillez vérifier les informations du patient.",
                            icon: "error"
                        });
                      </script>';
            } else {
                echo '<script>
                        Swal.fire({
                            title: "Erreur!",
                            text: "Une erreur s\'est produite lors de l\'ajout du patient. Veuillez réessayer.",
                            icon: "error"
                        });
                      </script>';
            }
            return;
        }
    }

    if (!empty($patient_id) && !empty($date) && !empty($time)) {
        try {
            // Check if an appointment already exists at the same time
            $check_appointment = $conn->prepare("SELECT * FROM appointment WHERE app_date = ? AND app_time = ? AND doctor_id = ?");
            $check_appointment->bind_param("ssi", $date, $time, $doctor_id);
            $check_appointment->execute();
            $check_appointment->store_result();

            if ($check_appointment->num_rows > 0) {
                echo '<script>
                        Swal.fire({
                            title: "Erreur!",
                            text: "Il y a déjà un rendez-vous à cette heure. Veuillez choisir une autre heure.",
                            icon: "error"
                        });
                      </script>';
            } else {
                // Insert the appointment
                $check_appointment = $conn->prepare("SELECT * FROM appointment WHERE app_date = ? AND app_time = ? AND doctor_id = ?");
                $check_appointment->bind_param("ssi", $date, $time, $doctor_id);
                $check_appointment->execute();
                $check_appointment->store_result();
        
                if ($check_appointment->num_rows > 0) {
                    array_push($apperrors, "Il y a déjà un rendez-vous à cette heure. Veuillez choisir une autre heure.");
                }else{

                    $appstmt = $conn->prepare("INSERT INTO appointment (app_date, app_time, treatment_type, patient_id, doctor_id, clinic_id, status, consult_status, arrive_status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $appstmt->bind_param("ssssiiiii", $date, $time, $treatment_type, $patient_id, $doctor_id, $clinic_id, $status, $consult_status, $arrive_status);

                        if ($appstmt->execute()) {
                        echo '<script>
                            Swal.fire({
                                title: "Succès!",
                                text: "Le rendez-vous a été ajouté avec succès.",
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "add_appointment.php";
                                }
                            });
                        </script>';
                        } else {
                        throw new mysqli_sql_exception("Erreur lors de l'ajout du rendez-vous.");
                        }
                }


           

                $appstmt->close();
            }

            $check_appointment->close();
        } catch (mysqli_sql_exception $e) {
            // Handle SQL errors
            echo '<script>
                    Swal.fire({
                        title: "Erreur!",
                        text: "Une erreur s\'est produite lors de l\'ajout du rendez-vous. Veuillez réessayer.",
                        icon: "error"
                    });
                  </script>';
        }
    } else {
        echo '<script>
                Swal.fire({
                    title: "Erreur!",
                    text: "Veuillez remplir tous les champs obligatoires.",
                    icon: "error"
                });
              </script>';
    }
}

$doctor_stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../fullcalendar/lib/main.min.css">
    <?php include CSS_PATH; ?>
    <script src="../fullcalendar/lib/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">

    <style>
        #calendar {
            width: 100%;
            height: 80%;
        }
        .patient-status-bar .d-flex .flex-fill {
            border-right: 1px solid #ddd;
            padding: .5rem !important;
            margin: 0 10px 0 0;
        }
        .patient-status-bar .d-flex .flex-fill:last-child {
            border-right: 0;
        }
    </style>
     <script>
        function confirmSubmission(event) {
            const btnsubmt = document.getElementById('btnsubmt');
            event.preventDefault(); // Empêche la soumission immédiate
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, ajoutez-le !"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Succès !",
                        text: "Vos données ont été ajoutées.",
                        icon: "success"
                    }).then(() => {
                        btnsubmt.click();
                    });
                }
            });
        }
    </script>
</head>
<body id="body">
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <div class="row">
            <div class="col-md-12 pt-3">
                <div class="card rounded-0 shadow">
                    <div class="card-header bg-gradient text-light" style="background-color: var(--primary-color);">
                        <h5 class="card-title">Ajoute Rendez-Vous</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="post">
                                <input type="hidden" name="id" value="">
                                <div class="row g-3">
                                    <!-- Patient Select -->
                                    <div class="col-md-8 mb-3" id="div_Select">
                                        <label for="patient_id" class="control-label">Patient</label>
                                        <select class="form-control form-control-sm rounded-0" name="patient_id" id="patient_id" required>
                                            <option value="">-- Sélectionner un patient --</option>
                                            <?php while($row = $patients->fetch_assoc()): ?>
                                                <option value="<?= $row['patient_id'] ?>"><?= $row['patient_firstname'] ?> &nbsp; : &nbsp;&nbsp;&nbsp;<?= $row['patient_id'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <!-- Add Patient Button -->
                                    <div class="col-md-4 mb-3 d-flex justify-content-center align-items-end" id="div_btn">
                                        <button type="button" class="btn btn-success rounded-0" id="addbntpatient" onclick="addpatient()">Ajouter un nouveau patient</button>
                                    </div>

                                    <!-- Nom Patient Field -->
                                    <div class="col-md-4 mb-3 d-none" id="div_Nom_Patient">
                                        <label for="Nom_Patient" class="control-label">Nom Patient</label>
                                        <input type="text" name="Nom_Patient" placeholder="Nom complet" class="form-control form-control-sm rounded-0" id="Nom_Patient">
                                    </div>

                                    <!-- Identity Field -->
                                    <div class="col-md-4 mb-3 d-none" id="div_Identity">
                                        <label for="Identity" class="control-label">Identity</label>
                                        <input type="text" name="Identity" placeholder="Patient Identity" class="form-control form-control-sm rounded-0" id="Identity">
                                    </div>

                                    <!-- Age Field -->
                                    <div class="col-md-3 mb-3 d-none" id="div_Age">
                                        <label for="Age" class="control-label">Age</label>
                                        <input type="number" name="Age" placeholder="Patient Age" class="form-control form-control-sm rounded-0" id="Age">
                                    </div>

                                    <!-- Telephone Field -->
                                    <div class="col-md-4 mb-3 d-none" id="div_Telephone">
                                        <label for="Telephone" class="control-label">Telephone</label>
                                        <input type="number" name="Telephone" placeholder="Patient Telephone" class="form-control form-control-sm rounded-0" id="Telephone">
                                    </div>

                                    <!-- Date Picker -->
                                    <div class="col-md-3 mb-3">
                                        <label for="start_datetime" class="control-label">Date</label>
                                        <div class="date" id="date" data-target-input="nearest">
                                            <input type="date" onchange="getdataD(this.value)" id="datepicker" class="my-calendar form-control rounded-0" placeholder="Choisissez la Date" name="date" style="background-color: #fff;">
                                        </div>
                                    </div>

                                    <!-- Time Picker -->
                                    <div class="col-md-3 mb-3">
                                        <label for="start_datetime" class="control-label">Time</label>
                                        <div class="time" id="time" data-target-input="nearest">
                                            <select name="time" id="time2" class="my-calendar form-control rounded-0" style="background-color: #fff;">
                                                <option>Sélectionnez la Date d'abord</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center mt-4">
                                    <button class="btn btn-primary col-md-2 btn-sm rounded-0" onclick="confirmSubmission(event)" type="submit" >
                                        <i class="fa fa-save"></i> Enregistrer
                                    </button>
                                    <button type="submit" id="btnsubmt" style='display:none' class="btn btn-primary btn-sm px-5" name="appointmentbtn">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include JS_PATH; ?>

    <script>
    function addpatient() {
        const div_Select = document.getElementById('div_Select');
        const div_btn = document.getElementById('div_btn');
        const div_Nom_Patient = document.getElementById('div_Nom_Patient');
        const div_Identity = document.getElementById('div_Identity');
        const div_Age = document.getElementById('div_Age');
        const div_Telephone = document.getElementById('div_Telephone');

        // Hide the select and button, show new patient fields
        div_btn.classList.replace("d-flex", "d-none");
        div_Select.classList.add("d-none");
        div_Nom_Patient.classList.remove("d-none");
        div_Identity.classList.remove("d-none");
        div_Age.classList.remove("d-none");
        div_Telephone.classList.remove("d-none");

        // Remove 'required' attribute from patient_id and add required for new patient fields
        document.getElementById('patient_id').removeAttribute('required');
        document.getElementById('Nom_Patient').setAttribute('required', 'required');
        document.getElementById('Identity').setAttribute('required', 'required');
        document.getElementById('Age').setAttribute('required', 'required');
        document.getElementById('Telephone').setAttribute('required', 'required');
    }
    </script>

    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 6); // Désactiver les week-ends
                }
            ]
        });

        const printdata = (data) => {
            const timevalid = ['09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 PM','12:30 PM','1:00 PM','1:30 PM','3:00 PM','3:30 PM','4:00 PM','4:30 PM','5:00 PM','5:30 PM','6:00 PM'];
            const select = document.getElementById('time2');

            if (data) {
                const datatime = data.map(v => v.app_time);
                const filteredArray2 = timevalid.filter(element => !datatime.includes(element));

                select.innerHTML = timevalid.map(timava => {
                    if (filteredArray2.includes(timava)) {
                        return `<option value='${timava}' style=' background-color: #8B93FF;'>${timava}</option>`;
                    } else {
                        return `<option disabled style=' background-color: rgba(250, 52, 91, 0.764);'>${timava} invalide</option>`;
                    }
                });
            } else {
                select.innerHTML = timevalid.map(timava => {
                    return `<option value='${timava}' style=' background-color: #8B93FF;'>${timava}</option>`;
                });
            }
        };

        const getdataD = (date) => {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../fetchdate.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 202) {
                        printdata(response.data);
                    } else if (response.status === 'no_data') {
                        printdata(null);
                    } else {
                        console.error('Unexpected response status:', response.status);
                    }
                } else {
                    console.error('Request failed. Returned status:', xhr.status);
                }
            };

            xhr.send('ajax_check_date=true&date=' + encodeURIComponent(date));
        };
    </script>
</body>
</html>
