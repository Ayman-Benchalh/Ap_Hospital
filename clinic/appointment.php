<?php

require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

$doctor_id = $clinic_row['clinic_id'];
$patients = $conn->query("SELECT * FROM patients ORDER BY patient_firstname ASC");

$stmt = $conn->prepare("
   SELECT appointment.*, patients.patient_firstname, patients.patient_Seance, doctors.doctor_firstname, doctors.doctor_lastname 
   FROM appointment 
   JOIN patients ON appointment.patient_id = patients.patient_id 
   JOIN doctors ON appointment.doctor_id = doctors.doctor_id 
   WHERE appointment.clinic_id = ?
");
$stmt->bind_param("i", $doctor_id);

$sched_res = [];
if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $row['sdate'] = date("Y-m-d H:i:s", strtotime($row['app_date'] . ' ' . $row['app_time']));
        $row['edate'] = $row['sdate'];

        $dayOfWeek = date('N', strtotime($row['sdate']));
        $hour = date('H', strtotime($row['sdate']));
        $color = '#906BD4';

        // if ($dayOfWeek == 1 && $hour >= 9 && $hour <= 12) {
        //     $color = '#FF0000';
        // } elseif ($dayOfWeek == 5 && $hour >= 14 && $hour <= 18) {
        //     $color = '#00FF00';
        // }
        if($row['arrive_status']){
            $color = '#00e600'; 
        }else{
            $color = '#906BD4';
        }


        $sched_res[] = [
            'id' => $row['app_id'],
            'patient_id' => $row['patient_id'],
            'title' => $row['patient_firstname'],
            'Nom_Complet' => $row['doctor_firstname'] . ' ' . $row['doctor_lastname'],
            'start' => $row['sdate'],
            'end' => $row['edate'],
            'color' => $color,
            'description' => $row['patient_id'],
            'Seance' => $row['patient_Seance'],
            'status' => $row['status'],
            'consult_status' => $row['consult_status'],
            'arrive_status' => $row['arrive_status'],
            'urlshow' => encrypt_url($row['patient_id']),
        ];
    }
} else {
    echo "Erreur : " . $stmt->error;
}


// Handle the form submission for creating an appointment
if (isset($_POST['appointmentbtn'])) {

    echo "data is here";
    $date = escape_input($_POST['date']);
    $time = escape_input($_POST['time']);
    $status = 1;
    $consult_status = 0;
    $arrive_status = 0;
    $patient_id = null;  // Initialize patient_id

    // Check if the user has selected an existing patient
    if (isset($_POST['patient_id']) && !empty($_POST['patient_id'])) {
        // Existing patient selected
        $patient_id = $_POST['patient_id'];
    } 
    // Otherwise, check if new patient details are provided
    elseif (!empty($_POST['Nom_Patient']) && !empty($_POST['Age']) && !empty($_POST['Telephone']) && !empty($_POST['Identity'])) {
        // New patient data
        $patient_firstname = $conn->real_escape_string($_POST['Nom_Patient']);
        $patient_identity = $conn->real_escape_string($_POST['Identity']);
        $patient_age = intval($_POST['Age']);
        $patient_telephone = $conn->real_escape_string($_POST['Telephone']);
        $patient_Seance = 0;
        $patient_idp= $conn->real_escape_string($_POST['Identity']);;
        $date_created = date('Y-m-d H:i:s');

        // Insert new patient into the database
        $new_patient_stmt = $conn->prepare("INSERT INTO patients (patient_id ,patient_identity, patient_firstname, patient_Seance, patient_age, patient_contact, date_created) VALUES (?,?, ?, ?, ?, ?, ?)");
        $new_patient_stmt->bind_param("sssisss",$patient_idp, $patient_identity, $patient_firstname, $patient_Seance, $patient_age, $patient_telephone, $date_created);

        if ($new_patient_stmt->execute()) {
            // Get the new patient ID
            $patient_id = $new_patient_stmt->insert_id;
        } else {
            array_push($apperrors, "Erreur lors de l'ajout du nouveau patient.");
        }
        
        $new_patient_stmt->close();
    } else {
        // Error: No patient selected or input provided
        array_push($apperrors, "Veuillez sélectionner un patient ou fournir les détails du nouveau patient.");
    }

    // Continue if patient ID is set and there's no error
    if ($patient_id && count($apperrors) == 0) {
        // Validation of date and time
        if (!isset($date) || trim($date) === '') {
            array_push($apperrors, "La date est requise");
        }
        if (!isset($time) || trim($time) === '') {
            array_push($apperrors, "L'heure est requise");
        }

        // Check if there is already an appointment at the same time
        $check_appointment = $conn->prepare("SELECT * FROM appointment WHERE app_date = ? AND app_time = ? AND doctor_id = ?");
        $check_appointment->bind_param("ssi", $date, $time, $doctor_row['doctor_id']);
        $check_appointment->execute();
        $check_appointment->store_result();

        if ($check_appointment->num_rows > 0) {
            array_push($apperrors, "Il y a déjà un rendez-vous à cette heure. Veuillez choisir une autre heure.");
        }
        $check_appointment->close();

        // If no errors, insert the new appointment
        if (count($apperrors) == 0) {
            $appstmt = $conn->prepare("INSERT INTO appointment (app_date, app_time, patient_id, doctor_id, clinic_id, status, consult_status, arrive_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $appstmt->bind_param("ssiiiiii", $date, $time, $patient_id, $doctor_row['doctor_id'], $doctor_row['clinic_id'], $status, $consult_status, $arrive_status);

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
                array_push($apperrors, "Erreur lors de l'ajout du rendez-vous.");
            }
            $appstmt->close();
        }
    }
}



$stmt->close();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
</head>
<body id="body">
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <div class="row">

            <div class="col-md-12 pt-3">
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Modal for Event Details -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Détails du rendez-vous</h5>
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Date et heure du rendez-vous</dt>
                            <dd id="event-start"></dd>
                            <dt class="text-muted">Séance du patient</dt>
                            <dd id="event-seance"></dd>
                            <dt class="text-muted">Nom du patient</dt>
                            <dd id="event-title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">ID du patient</dt>
                            <dd id="event-description"></dd>
                            <dt class="text-muted">Statut du dossier</dt>
                            <dd id="event-Case"></dd>
                            <dt class="text-muted">Statut de l'arrivée</dt>
                            <dd id="event-Arrive"></dd>
                            <dt class="text-muted">Statut global</dt>
                            <dd id="event-Status"></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="col-12 d-flex justify-content-end">
                        <div id="arrive_status" class="me-auto"></div>
                        <a class="btn btn-sm btn-success mx-2 me-2" id="show" href="patient-view?cid=" data-id="">Voir</a>
                        <button type="button" class="btn btn-sm mx-2 btn-danger me-2" id="delete" data-id="">Supprimer</button>
                        <button type="button" class="btn btn-sm mx-2 btn-secondary" data-bs-dismiss="modal" id="modal-close2">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include JS_PATH; ?>
    <script>
    const scheds = <?= json_encode($sched_res) ?>;
    document.addEventListener('DOMContentLoaded', function() {
        var calendar;
        var Calendar = FullCalendar.Calendar;
        var events2 = [];

        if (scheds) {
            scheds.forEach(row => {
                events2.push({
                    id: row.id,
                    patient: row.patient_id,
                    title: row.title,
                    start: row.start,
                    end: row.end,
                    display: '906BD4',
                    backgroundColor: row.color,
                    borderColor: row.color,
                    description: row.description,
                    Seance: row.Seance,
                    Case: row.consult_status,
                    Arrive: row.arrive_status,
                    Status: row.status,
                    urlshow: row.urlshow,
                });
            });
        }

        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,dayGridWeek,list',
                center: 'title',
            },
            selectable: true,
            themeSystem: 'bootstrap',
            events: events2,
            timeFormat: 'H(:mm)t',
            eventClick: function(info) {
                var id = info.event.id;
                var eventData = scheds.find(event => event.id == id);

                if (eventData) {
                    document.getElementById('event-title').textContent = eventData.title;
                    document.getElementById('event-description').textContent = eventData.description;
                    document.getElementById('event-seance').textContent = eventData.Seance;
                    document.getElementById('event-start').textContent = new Date(eventData.start).toLocaleString();
                    document.getElementById('show').setAttribute('href', `patient-view.php?cid=${eventData.urlshow}`);
                    document.getElementById('delete').setAttribute('data-id', id);

                    document.getElementById('event-Case').innerHTML = eventData.consult_status
                        ? `<span class="badge badge-success px-3 py-1">Terminé</span>`
                        : `<span class="badge badge-warning px-3 py-1">Non terminé</span>`;

                    document.getElementById('arrive_status').innerHTML = eventData.arrive_status
                        ? `<button type="button" class="btn btn-sm btn-secondary mx-2">Assis</button>`
                        : `<button type="button" name="checkbtn" onclick="updateId(${id}, '${eventData.patient_id}')" class="btn btn-sm btn-primary mx-2">Arrivé</button>`;

                    document.getElementById('event-Arrive').innerHTML = eventData.arrive_status
                        ? `<span class="badge badge-success px-3 py-1">Arrivé</span>`
                        : `<span class="badge badge-warning px-3 py-1">En route</span>`;

                    document.getElementById('event-Status').innerHTML = eventData.status
                        ? `<span class="badge badge-success px-3 py-1">Confirmé</span>`
                        : `<span class="badge badge-warning px-3 py-1">En attente</span>`;

                    var modalInstance = new bootstrap.Modal(document.getElementById('event-details-modal'));
                    modalInstance.show();
                } else {
                    alert("Événement indéfini");
                }
            },
            editable: true
        });

        calendar.render();

        // AJAX Function to update the arrival status
        window.updateId = function(id, Pid) {
            console.log('Appointment ID:', id);
            console.log('Patient ID:', Pid);
            $.ajax({
                type: "POST",
                data: {
                    id: id,
                    patient_Seance: Pid
                },
                url: 'updateArrive.php',
                success: function(data) {
                    console.log(data);
                    location.reload(); // Reload the page after success
                },
                error: function(data) {
                    console.log(data);
                }
            });
        };

    });

    document.getElementById('modal-close').addEventListener('click', function() {
        var _details = document.getElementById('event-details-modal');
        var modelbk = document.querySelector('.modal-backdrop');
        var bodyOpen = document.querySelector('.modal-open');

        _details.style.display='none';
        bodyOpen.className='';
        modelbk.className='';
    });

    document.getElementById('modal-close2').addEventListener('click', function() {
        var _details = document.getElementById('event-details-modal');
        var modelbk = document.querySelector('.modal-backdrop');
        var bodyOpen = document.querySelector('.modal-open');

        _details.style.display='none';
        bodyOpen.className='';
        modelbk.className='';
    });

    document.getElementById('delete').addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        var eventData = scheds.find(event => event.id == id);
        
        if (eventData) {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce rendez-vous ?");
            if (confirmation === true) {
                window.location.href = "./App_delete_event.php?id=" + id;
            }
        } else {
            alert("Événement indéfini");
        }
    });


    </script>


</body>
</html>
