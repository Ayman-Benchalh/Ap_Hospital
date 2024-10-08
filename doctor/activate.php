<?php
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');

$errors = array();

if (ctype_xdigit($_GET["selector"]) !== false && ctype_xdigit($_GET["validator"]) !== false) {
	$selector = $_GET["selector"];
	$validator = $_GET["validator"];
	
	$check = $conn->prepare("SELECT * FROM doctor_reset WHERE reset_selector = ?");
    $check->bind_param("s", $selector);
    $check->execute();
    $q = $check->get_result();
    $r = $q->fetch_assoc();
    if (mysqli_num_rows($q) < 1) {
		header('Location: login.php');
	} else {
        $checkemail = $r["reset_email"];
    }
} else {
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
	<?php include CSS_PATH; ?>
	<link rel="stylesheet" href="../assets/css/clinic/login.css">
</head>

<body>
<?php
if (isset($_POST['resetbtn'])) {
	$selector = $_POST["selector"];
	$validator = $_POST["validator"];
    $token = escape_input($_POST["inputToken"]);
	$password = escape_input($_POST["inputPassword"]);
    $con_pass = escape_input($_POST["inputConfirmPassword"]);

    if (empty($token)) {
        array_push($errors, "6 Digit Code is required");
    }

	if (empty($password) || empty($con_pass)) {
		array_push($errors, "Password is required");
	} elseif ($password != $con_pass) {
		array_push($errors, "Password do not match");
	} else {
		password_validation($password);
	}

	if (count($errors) == 0) {
		$currenDate = date("U");
		$stmt = $conn->prepare("SELECT * FROM doctor_reset WHERE reset_selector = ? AND reset_expires >= ?");
		$stmt->bind_param("ss", $selector, $currenDate);
		$stmt->execute();
		$result = $stmt->get_result();
		if (!$row = $result->fetch_assoc()) {
			echo '<script>Swal.fire({title: "Error", text: "Need to Resubmit the Reset Request, Have been Expired!", type: "error"}).then((result) => {
				if (result.value) { window.location.href = "forgot.php"; }
			});</script>';
			exit();
		} else {
			$tokenBin = hex2bin($validator);
			$tokenCheck = password_verify($tokenBin, $row['reset_token']);

			if ($tokenCheck === false) {
				echo '<script>Swal.fire({title: "Error", text: "Resubmit Reset Request!", type: "error"}).then((result) => {
					if (result.value) { window.location.href = "forgot.php"; }
				});</script>';
				exit();
			} elseif ($tokenCheck === true) {
				$tokenEmail = $row['reset_email'];
				$stmt = $conn->prepare("SELECT * FROM doctors WHERE doctor_email = ?");
				$stmt->bind_param("s", $tokenEmail);
				$stmt->execute();
				$result = $stmt->get_result();
				if (!$row = $result->fetch_assoc()) {
					echo '<script>Swal.fire({title: "Error", text: "Resubmit Reset Request!", type: "error"}).then((result) => {
						if (result.value) { window.location.href = "forgot.php"; }
					});</script>';
					exit();
				} else { 
					$token = generateCode(22);
					$en_pass = encrypt(md5($password), $token);
					$updatestmt = $conn->prepare("UPDATE doctors SET doctor_password = ?, doctor_token = ? WHERE doctor_email = ?");
					$updatestmt->bind_param("sss", $en_pass, $token, $tokenEmail);

					$delstmt = $conn->prepare("DELETE FROM doctor_reset WHERE reset_email = ?");
					$delstmt->bind_param("s", $tokenEmail);
					if ($updatestmt->execute() && $delstmt->execute()) {
						echo '<script>
							Swal.fire({ title: "Great!", text: "Password Reset Successfully!", type: "success" }).then((result) => {
								if (result.value) { window.location.href = "login.php"; }
							});
							</script>';
					}
				}
			}
		}
	}
}
	?>
	<div class="container">
		<div class="login-wrap mx-auto">
			<div class="login-head">
				<h4><?php echo $BRAND_NAME; ?></h4>
				<p>Reset your password</p>
			</div>
			<div class="login-body">
				<form name="forgot_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>">
				<input type="hidden" name="selector" value="<?= $selector ?>">
				<input type="hidden" name="validator" value="<?= $validator ?>">
				<div class="form-group">
						<p>Please Set Your Password for Activate your Account <strong><?=$checkemail?></strong></p>
					</div>
                    <?= display_error(); ?>
                    <div class="form-group">
						<label for="inputToken">6 Digit Code</label>
						<input type="text" name="inputToken" class="form-control" id="inputToken" placeholder="Enter 6 Digit Number">
					</div>
					<div class="form-group">
						<label for="inputPassword">Password</label>
						<input type="password" name="inputPassword" class="form-control" id="inputPassword" placeholder="New Password">
					</div>
					<div class="form-group">
						<label for="inputConfirmPassword">Confirm Password</label>
						<input type="password" name="inputConfirmPassword" class="form-control" id="inputConfirmPassword" placeholder="Retype New Password">
					</div>
					<button type="submit" name="resetbtn" class="btn btn-primary btn-block button">Reset Password</button>
				</form>
			</div>
		</div>
	</div>
	<?php include JS_PATH; ?>
</body>

</html>