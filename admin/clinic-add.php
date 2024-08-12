<?php
require_once('../config/autoload.php');
require_once('../config/database.php');
include('includes/path.inc.php');
include('includes/session.inc.php');
include(SELECT_HELPER);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include CSS_PATH; ?>
</head>

<body>
	<?php include NAVIGATION; ?>
	<div class="page-content" id="content">
		<?php include HEADER; ?>
		<?php
			$errName = $errContact = $errEmail = $errURL  = $errAddress = $errCity = $errState = $errZipcode = "";
			$className = $classContact = $classEmail = $classURL = $classAddress = $classCity = $classState = $classZipcode = "";

			if (isset($_POST["savebtn"])) {
				$clinic_name = escape_input($_POST["inputClinicName"]);
				$contact = escape_input($_POST["inputContact"]);
				$email = escape_input($_POST["inputEmailAddress"]);
				$url = escape_input($_POST["inputURL"]);
				
				$opensweek = escape_input($_POST["inputOpensHourWeek"]);
				$closeweek = escape_input($_POST["inputCloseHourWeek"]);

				$openssat = escape_input($_POST["inputOpensHourSat"]);
				$closesat = escape_input($_POST["inputCloseHourSat"]);

				$openssun = escape_input($_POST["inputOpensHourSun"]);
				$closesun = escape_input($_POST["inputCloseHourSun"]);

				$address = escape_input($_POST["inputAddress"]);
				$city = escape_input($_POST["inputCity"]);
				$state = isset($_POST['inputState']) ? escape_input($_POST['inputState']) : "";
				$zipcode = escape_input($_POST["inputZipCode"]);
				// $clinic_name , $contact,$email,$url,$opensweek ,$closeweek,$openssat,$closesat,$openssun,$address,$city,$state,$zipcode
				// Validate inputs
				
				if (empty($clinic_name)) {
					
					$errName = $error_html['errFirstName'];
					$className = $error_html['errClass'];
				} else if (!preg_match($regrex['text'], $clinic_name)) {
					
					$errName = $error_html['invalidText'];
					$className = $error_html['errClass'];
				}

				if (empty($url)) {
					$errURL = $error_html['errURL'];
					$classURL = $error_html['errClass'];
				} else if (!filter_var($url, FILTER_VALIDATE_URL)) {
					$errURL =  $error_html['invalidURL'];
					$classURL = $error_html['errClass'];
				}

				if (empty($email)) {
					$errEmail = $error_html['errEmail'];
					$classEmail = $error_html['errClass'];
				} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$errEmail =  $error_html['invalidEmail'];
					$classEmail = $error_html['errClass'];
				}
				$regrex['contact'] = '/^[\d\s\-\+\(\)]+$/';
				if (empty($contact)) {
					$errContact = $error_html['errContact'];
					$classContact = $error_html['errClass'];
				} else if (!preg_match($regrex['contact'], $contact)) {
					$errContact = $error_html['invalidContact'];
					$classContact = $error_html['errClass'];
				}

				$regrex['text'] = '/^[a-zA-Z0-9\s,.-]+$/';

				if (empty($address)) {
					$errAddress = $error_html['errAddress'];
					$classAddress = $error_html['errClass'];
				} else if (!preg_match($regrex['text'], $address)) {
					$errAddress = $error_html['invalidText'];
					$classAddress = $error_html['errClass'];
				}

				if (empty($city)) {
					$errCity = $error_html['errCity'];
					$classCity = $error_html['errClass'];
				} else if (!preg_match($regrex['text'], $city)) {
					$errCity = $error_html['invalidText'];
					$classCity = $error_html['errClass'];
				}

				if (empty($zipcode)) {
					$errZipcode = $error_html['errZipcode'];
					$classZipcode = $error_html['errClass'];
				} else if (!ctype_digit($zipcode)) { // Using ctype_digit to validate integer in string format
					$errZipcode = $error_html['invalidInt'];
					$classZipcode = $error_html['errClass'];
				}

				if (empty($state)) {
					$errState = $error_html['errState'];
					$classState = $error_html['errClass'];
				}

				// If there are no validation errors, proceed with inserting data
				if (multi_empty($errName, $errContact, $errURL, $errEmail, $errAddress, $errCity, $errState, $errZipcode)) {
					// echo " good data :".$clinic_name , $contact,$email,$url,$opensweek ,$closeweek,$openssat,$closesat,$openssun,$address,$city,$state,$zipcode;
					
					// $clinicstmt = $conn->prepare("INSERT INTO clinics (clinic_name, clinic_email, clinic_url, clinic_contact, clinic_address, clinic_city, clinic_state, clinic_zipcode) VALUES (?,?,?,?,?,?,?,?)");
					// $clinicstmt->bind_param("ssssssss", $clinic_name, $email, $url, $contact, $address, $city, $state, $zipcode);

					// if ($clinicstmt->execute()) {
					// 	$last_id = $conn->insert_id; // Get the last inserted ID
					// 	$hourstmt = $conn->prepare("INSERT INTO business_hour (open_week, close_week, open_sat, close_sat, open_sun, close_sun, clinic_id) VALUES (?,?,?,?,?,?,?)");
					// 	$hourstmt->bind_param("sssssss", $opensweek, $closeweek, $openssat, $closesat, $openssun, $closesun, $last_id);

					// 	if ($hourstmt->execute()) {
					// 		echo '<script>
					// 			Swal.fire({ title: "Great!", text: "Record Updated!", icon: "success" }).then((result) => {
					// 				if (result.value) { window.location.href = "clinic-list.php"; }
					// 			});
					// 		</script>';
					// 	} else {
					// 		echo '<script>Swal.fire({ title: "Oops...!", text: "Business Hour Error!", icon: "error" });</script>';
					// 	}
					// } else {
					// 	echo '<script>Swal.fire({ title: "Oops...!", text: "Something Happened!", icon: "error" });</script>';
					// }
					$clinicstmt = $conn->prepare("INSERT INTO clinics (clinic_name, clinic_email, clinic_url, clinic_contact, clinic_address, clinic_city, clinic_state, clinic_zipcode, date_created) VALUES (?,?,?,?,?,?,?,?,?)");
					$date_created = date('Y-m-d H:i:s');
					if ($clinicstmt === false) {
						echo '<script>Swal.fire({ title: "Oops...!", text: "Clinic Statement Preparation Error!", icon: "error" });</script>';
					} else {
						$clinicstmt->bind_param("sssssssss", $clinic_name, $email, $url, $contact, $address, $city, $state, $zipcode, $date_created);

						if ($clinicstmt->execute()) {
							$last_id = $conn->insert_id; // Get the last inserted ID
							$hourstmt = $conn->prepare("INSERT INTO business_hour (open_week, close_week, open_sat, close_sat, open_sun, close_sun, clinic_id) VALUES (?,?,?,?,?,?,?)");

							if ($hourstmt === false) {
								echo '<script>Swal.fire({ title: "Oops...!", text: "Business Hour Statement Preparation Error!", icon: "error" });</script>';
							} else {
								$hourstmt->bind_param("sssssss", $opensweek, $closeweek, $openssat, $closesat, $openssun, $closesun, $last_id);

								if ($hourstmt->execute()) {
									echo '<script>
										Swal.fire({ title: "Great!", text: "Record Updated!", icon: "success" }).then((result) => {
											if (result.value) { window.location.href = "clinic-list.php"; }
										});
									</script>';
								} else {
									echo '<script>Swal.fire({ title: "Oops...!", text: "Business Hour Error!", icon: "error" });</script>';
								}

								$hourstmt->close(); // Close the statement
							}
						} else {
							echo '<script>Swal.fire({ title: "Oops...!", text: "Something Happened!", icon: "error" });</script>';
						}

						$clinicstmt->close(); // Close the statement
					}

				}
			}
		?>
		<!-- Page content -->
		<div class="row">
			<div class="col-12">
				<form name="regform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<h5 class="card-title mt-3">
						Clinic Profile Info
					</h5>
					<div class="card">
						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputClinicName">Clinic Name</label>
									<input type="text" name="inputClinicName" class="form-control <?= $className ?>" id="inputClinicName" placeholder="">
									<?= $errName; ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputContact">Contact Number</label>
									<input type="text" name="inputContact" class="form-control <?= $classContact ?>" id="inputContact" placeholder="">
									<?= $errContact; ?>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmailAddress">Email Address</label>
									<input type="text" name="inputEmailAddress" class="form-control <?= $classEmail ?>" id="inputEmailAddress" placeholder="example@address.com">
									<?= $errEmail; ?>
								</div>
								<div class="form-group col-md-6">
									<label for="inputURL">URL</label>
									<input type="text" name="inputURL" class="form-control <?= $classURL ?>" id="inputURL" placeholder="www.example.com">
									<?= $errURL; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<span class="card-title">Business Hour</span>
							<div class="mb-2">
								<small class="text-muted">When you're closed on a certain day, just leave the hours blank.</small>
								<small class="text-muted">Remember: 12PM is midday, 12AM is midnight</small>
							</div>
							<div class="form-group row">
								<label for="inputBusinessHourWeek" class="col-sm-2 col-form-label">Monday - Friday</label>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control timepicker" name="inputOpensHourWeek" id="inputOpensHourWeek" placeholder="Opens">
								</div>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control timepicker" name="inputCloseHourWeek" id="inputCloseHourWeek" placeholder="Closes">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputBusinessHourSat" class="col-sm-2 col-form-label">Saturday</label>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control timepicker" name="inputOpensHourSat" id="inputOpensHourSat" placeholder="Opens">
								</div>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control timepicker" name="inputCloseHourSat" id="inputCloseHourSat" placeholder="Closes">
								</div>
							</div>
							<div class="form-group row">
								<label for="inputBusinessHourSun" class="col-sm-2 col-form-label">Sunday</label>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control timepicker" name="inputOpensHourSun" id="inputOpensHourSun" placeholder="Opens">
								</div>
								<div class="col-sm-3">
									<input type="text" class="form-control form-control timepicker" name="inputCloseHourSun" id="inputCloseHourSun" placeholder="Closes">
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Address</h5>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputAddress">Address</label>
									<input type="text" name="inputAddress" class="form-control <?= $classAddress ?>" id="inputAddress" placeholder="">
									<?= $errAddress; ?>
								</div>
								<div class="form-group col-md-4">
									<label for="inputCity">City</label>
									<input type="text" name="inputCity" class="form-control <?= $classCity ?>" id="inputCity">
									<?= $errCity; ?>
								</div>
								<div class="form-group col-md-2">
									<label for="inputState">State</label>
									<select name="inputState" id="inputState" class="form-control <?= $classState ?>">
										<option value="" selected>Choose...</option>
										<option value="AL">Alabama</option>
										<!-- Add other states as needed -->
									</select>
									<?= $errState; ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="inputZipCode">Zip Code</label>
									<input type="text" name="inputZipCode" class="form-control <?= $classZipcode ?>" id="inputZipCode">
									<?= $errZipcode; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<button type="submit" name="savebtn" class="btn btn-primary">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include JS_PATH; ?>
	<script>
		$(function() {
			$('.timepicker').datetimepicker({
				format: 'LT'
			});
		});
	</script>
</body>

</html>
