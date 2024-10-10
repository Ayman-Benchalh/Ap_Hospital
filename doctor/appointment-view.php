<?php
include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');

// Récupérer et décrypter l'ID du rendez-vous
$app_id = decrypt_url($_GET["id"]);

// Récupérer les détails du patient et du rendez-vous
$result = $conn->query("SELECT * FROM appointment LEFT JOIN patients ON appointment.patient_id = patients.patient_id WHERE appointment.app_id = $app_id");
$row = $result->fetch_assoc();

$patient_id = $row["patient_id"];
$patient_age = $row['patient_age'];

// Récupérer les dossiers médicaux
$medresult = $conn->query(
    "SELECT * FROM medical_record M 
    INNER JOIN clinics C ON M.clinic_id = C.clinic_id
    INNER JOIN patients P ON M.patient_id = P.patient_id
    WHERE M.patient_id = '".$patient_id."' ORDER BY M.med_id DESC"
);
$medrow = $medresult->fetch_assoc();

$errors = array();

if (isset($_POST['prescriptionbtn'])) {
    $sympton = escape_input($_POST['sympton']);
    $diagnosis = escape_input($_POST['diagnosis']);
    $advice = escape_input($_POST['advice']);

    if (empty($sympton)) {
        array_push($errors, "Les symptômes sont requis");
    }

    if (empty($diagnosis)) {
        array_push($errors, "Le diagnostic est requis");
    }

    if (empty($advice)) {
        array_push($errors, "Les conseils sont requis");
    }

    if (count($errors) == 0) {
        $stmt = $conn->prepare("INSERT INTO medical_record (med_sympton, med_diagnosis, med_advice, med_date, patient_id, clinic_id, doctor_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $sympton, $diagnosis, $advice, $date_created, $patient_id, $doctor_row['clinic_id'], $doctor_row['doctor_id']);
        $stmt->execute();
        $stmt->close();
        header('Location: '.$_SERVER['REQUEST_URI']);
    }
}

$apperrors = array();

// Gestion de la soumission du formulaire de rendez-vous
if (isset($_POST['appointmentbtn'])) {
    $date = escape_input($_POST['date']);
    $time = escape_input($_POST['time']);
    $treatment = $conn->real_escape_string($_POST['inputTreatment']);
    $status = 1;
    $consult_status = 0;
    $arrive_status = 0;

    // Validation des entrées
	if (!isset($date) || trim($date) === '') {
		array_push($apperrors, "La date est requise");
	}
	
	if (!isset($time) || trim($time) === '') {
		array_push($apperrors, "L'heure est requise");
	}
	
	if (!isset($treatment) || trim($treatment) === '') {
		array_push($apperrors, "Le traitement est requis");
	}
	
    // Vérifier s'il y a déjà un rendez-vous à la même heure
    $check_appointment = $conn->prepare("SELECT * FROM appointment WHERE app_date = ? AND app_time = ? AND doctor_id = ?");
    $check_appointment->bind_param("ssi", $date, $time, $doctor_row['doctor_id']);
    $check_appointment->execute();
    $check_appointment->store_result();

    if ($check_appointment->num_rows > 0) {
        array_push($apperrors, "Il y a déjà un rendez-vous à cette heure. Veuillez choisir une autre heure.");
    }
    $check_appointment->close();

    // Si aucune erreur, insérer le nouveau rendez-vous
    if (count($apperrors) == 0) {
        $appstmt = $conn->prepare("INSERT INTO appointment (app_date, app_time, treatment_type, patient_id, doctor_id, clinic_id, status, consult_status, arrive_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $appstmt->bind_param("ssssiiiii", $date, $time, $treatment, $patient_id , $doctor_row['doctor_id'], $doctor_row['clinic_id'], $status, $consult_status, $arrive_status);
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
        }
        $appstmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include CSS_PATH; ?>
	
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
  
    <!-- Styles personnalisés Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Feuille de style du template -->
    <link href="css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">
    <link rel="shortcut icon" href="./assets/img/icon/logoCAbi.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .my-calendar {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        #time2{
            height: 55px;
            width: 100%;
            background-color: #EFF5FF;
            outline: none;
        }
        #time2 option{
            height: 55px;
            color: #EFF5FF;
            font-size: 20px;
            padding: 15px;
            font-weight: 600;
            transition: all .5s ease;
        }
    </style>
</head>

<style>
	.patient-status-bar .d-flex .flex-fill {
		border-right: 1px solid #ddd;
		padding: .5rem !important;
		margin: 0 10px 0 0;
	}

	.patient-status-bar .d-flex .flex-fill:last-child {
		border-right: 0;
	}
</style>

<body>
<?php
if (isset($_POST["completebtn"])) {
	$id = escape_input($_POST['inputID']);
	$comstmt = $conn->prepare("UPDATE appointment SET consult_status = 1 WHERE app_id = ? ");
	$comstmt->bind_param("s", $id);
	
	if ($comstmt->execute()) {
		echo '<script>
			Swal.fire({ title: "Super!", text: "Mise à jour réussie!", type: "success" }).then((result) => {
				if (result.value) { window.location.href = "appointment.php"; }
			});
			</script>';
	}
	$comstmt->close();
}
?>
	<?php include NAVIGATION; ?>
	<!-- Contenu de la page -->
	<div class="page-content" id="content">
		<?php include HEADER; ?>
		<!-- Contenu de la page -->
		<div class="row">
			<div class="col-12">
				<div class="modal fade" id="followup" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h6 class="modal-title">Ajouter une nouvelle visite de suivi pour <strong><?= $row["patient_firstname"]  ?></strong></h6>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" class="h-100" method="POST">
								<?php
									if (count($apperrors) > 0) {
										echo '<div class="alert alert-warning" role="alert">';
										foreach ($apperrors as $err) {
											echo $err . '<br>';
										}
										echo '</div>';
									}
								?>
								<div class="modal-body">
									<div class="form-group">
										<label>Type de traitement</label>
										<select name="inputTreatment" id="inputTreatment" class="form-control">
											<?php
												$treatresult = mysqli_query($conn, "SELECT * FROM treatment_type WHERE doctor_id = '" . $doctor_row['doctor_id'] . "'");
												while($treatrow = mysqli_fetch_assoc($treatresult)) {
													echo '<option value='.$treatrow['treatment_name'].'>'.$treatrow['treatment_name'].'</option>';
												}
											?>
										</select>
									</div>
									
									<div class="form-row">
										<div class="form-group col-md-6">
											<label>Choisir la date</label>
											<div class="date" id="date" data-target-input="nearest">
												<input type="time" onchange="getdataD(this.value)" id="datepicker" class="my-calendar form-control" placeholder="Choisissez la Date" name="date" style="height: 55px;background-color: #ffff;">
											</div>
										</div>
										<div class="form-group">
											<label>Choisir l'heure : <small id="labelAppointmentTime"></small></label>
											<div class="time" id="time" data-target-input="nearest">
												<select name="time" id="time2" class="my-calendar form-control" style="height: 55px;background-color: #ffff;">
													<option>Sélectionnez la date d'abord</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
									<button type="submit" name="appointmentbtn" class="btn btn-primary">Enregistrer</button>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="modal fade" id="prescription" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h6 class="modal-title">Ajouter une nouvelle ordonnance</h6>
								<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="POST">
								<?= display_error();?>
								<div class="modal-body">
									<div class="form-group">
										<label>Symptômes</label>
										<textarea name="sympton" class="form-control" id="sympton" cols="30" rows="3"></textarea>
									</div>
									<div class="form-group">
										<label>Diagnostic</label>
										<input type="text" name="diagnosis" class="form-control" id="diagnosis">
									</div>
									<div class="form-group">
										<label>Conseils</label>
										<textarea name="advice" class="form-control" id="advice" cols="30" rows="3"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
									<button type="submit" name="prescriptionbtn" class="btn btn-primary">Enregistrer</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header" style="border:none;">
							<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
							<div class="modal-body">
								<input type="hidden" name="inputID" value="<?= $app_id ?>">
								Terminer le dossier pour <b><?= $row["patient_firstname"] ?></b>
							</div>
							<div class="modal-footer" style="border:none;">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
								<button type="submit" name="completebtn" class="btn btn-sm btn-success px-3">Oui</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<!-- Contenu de la carte -->
				<div class="card patient-status-bar">
					<div class="card-body">
						<div class="d-flex bd-highlight">
							<div class="flex-fill bd-highlight">
								<p class="text-muted">Infos du patient</p>
								<h5 class="font-weight-bold"><?php echo   $row["patient_firstname"] ?></h5>
								<p> Age : <?= $patient_age ?> </p>
							</div>
							<div class="flex-fill bd-highlight">
								<p class="text-muted">Dernière visite</p>
								<h5 class="font-weight-bold">
									<?php if ($medresult->num_rows == 0) {
										echo 'Nouveau patient';
									} else {
										echo date_format(new DateTime($medrow['med_date']), 'Y-m-d');
									}
									?>
								</h5>
							</div>
							<div class="flex-fill bd-highlight">
								<p class="text-muted">Diagnostic</p>
								<h5 class="font-weight-bold">
									<?php if ($medresult->num_rows == 0) {
										echo 'Nouveau patient';
									} else {
										echo $medrow['med_diagnosis'];
									}
									?>
								</h5>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 mb-3">
				<nav class="navbar px-0 mb-3">
					<div class="nav nav-pills mr-auto">
						<a class="nav-item text-sm-center nav-link active" data-toggle="pill" href="#tab1">Infos Prescription</a>
						<a class="nav-item text-sm-center nav-link" data-toggle="pill" href="#tab3">Historique des Rendez-vous</a>
					</div>
					<div class=" nav nav-pills ml-auto">
						<a class="nav-item btn btn-sm btn-link" data-toggle="modal" href="#prescription">Ajouter Prescription</a>
						<a class="nav-item btn btn-sm btn-link" data-toggle="modal" href="#followup">Ajouter Rendez-vous</a>
						<button class="nav-item btn btn-sm btn-success" data-toggle="modal" href="#complete">Terminer le dossier</button>
					</div>
				</nav>

				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
						<div class="card">
							<div class="card-body">
								<table class="table nowrap">
									<thead>
										<th>Symptômes</th>
										<th>Diagnostic</th>
										<th>Date d'enregistrement</th>
										<th>Action</th>
									</thead>
									<tbody>
										<?php
										$tresult = $conn->query("SELECT * FROM medical_record WHERE patient_id = '".$patient_id."'");
										if ($tresult->num_rows == 0) {
											echo '<td colspan="4">Aucun dossier trouvé</td>';
										} else {
											while ($trow = $tresult->fetch_assoc()) {
												?>
												<tr>
													<td><?= $trow['med_sympton'] ?></td>
													<td><?= $trow['med_diagnosis'] ?></td>
													<td><?= $trow['med_date'] ?></td>
													<td><button data-toggle="modal" data-target="#viewdiagnosis<?= $trow['med_id']?>" class="btn btn-sm btn-primary px-3">Voir</button></td>
												</tr>

												<div class="modal fade" id="viewdiagnosis<?= $trow['med_id']?>" tabindex="-1" role="dialog">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h6 class="modal-title">Voir Détails</h6>
																<button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<div class="row">
																	<p class="col-sm-3 text-right"><b>Symptômes</b></p>
																	<div class="col-sm-6">
																	<p><?= $trow['med_sympton'] ?></p>
																	</div>
																</div>
																<div class="row">
																	<p class="col-sm-3 text-right"><b>Diagnostic</b></p>
																	<div class="col-sm-6">
																	<p><?= $trow['med_diagnosis'] ?></p>
																	</div>
																</div>
																<div class="row">
																	<p class="col-sm-3 text-right"><b>Conseils</b></p>
																	<div class="col-sm-6">
																	<p><?= $trow['med_advice'] ?></p>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
															</div>
														</div>
													</div>
												</div>
										<?php
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3">
						<div class="card">
							<div class="card-body">
								<table class="table nowrap">
									<thead>
										<th>Date</th>
										<th>Traitement</th>
									</thead>
									<tbody>
										<?php
										$tresult = $conn->query("SELECT * FROM appointment WHERE patient_id ='".$patient_id."'ORDER BY app_date DESC");
										if ($tresult->num_rows == 0) {
											echo '<td colspan="2">Aucun dossier trouvé</td>';
										} else {
											while ($trow = $tresult->fetch_assoc()) {
												?>
												<tr>
													<td><?= $trow['app_date'] ?></td>
													<td><?= $trow['treatment_type'] ?></td>
												</tr>
										<?php
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
		<!-- Fin du contenu de la page -->
	</div>

	<?php include JS_PATH; ?>
	<script src="js/main.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script>
        flatpickr("#datepicker", {
            locale: "fr",
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: [
                function(date) {
                 
                    return (date.getDay() === 0 || date.getDay() === 7);
                 }
            ]
        });
      
     
  
 
        const printdata = (data, isSaturday) => {
            let timevalid = ['09:00 AM', '09:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '12:00 PM', '12:30 PM', '01:00 PM'];
            
            if (!isSaturday) {
                timevalid = ['09:00 AM', '09:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM', '12:00 PM', '12:30 PM', '01:00 PM', '01:30 PM', '03:00 PM', '03:30 PM', '04:00 PM', '04:30 PM', '05:00 PM', '05:30 PM', '06:00 PM'];
            }

            const select = document.getElementById('time2');

            if (data) {
                const datatime = data.map(v => v.app_time);
                const filteredArray = timevalid.filter(element => !datatime.includes(element));

                select.innerHTML = timevalid.map(timeSlot => {
                    if (filteredArray.includes(timeSlot)) {
                        return `<option value='${timeSlot}' style='background-color: #8B93FF;'>${timeSlot}</option>`;
                    } else {
                        return `<option disabled style='background-color: rgba(250, 52, 91, 0.764);'>${timeSlot} invalid</option>`;
                    }
                }).join('');
            } else {
                select.innerHTML = timevalid.map(timeSlot => {
                    return `<option value='${timeSlot}' style='background-color: #8B93FF;'>${timeSlot}</option>`;
                }).join('');
            }
        };

        const getdataD = (date) => {
            const selectedDate = new Date(date);
            const isSaturday = selectedDate.getDay() === 6;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../fetchdate.php', true); 
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.status === 202) {
                        printdata(response.data, isSaturday);
                    } else if (response.status === 'no_data') {
                        printdata(null, isSaturday);
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
