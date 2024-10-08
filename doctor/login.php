<?php
include('../config/autoload.php');
include('../config/database.php');
include('./includes/path.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include CSS_PATH; ?>
	<link rel="stylesheet" href="../assets/css/clinic/login.css">
    <style>
    body{
        
  background: #0575e6; 
  background: -webkit-linear-gradient(to right, #0575e6, #021b79);
  background: linear-gradient(to right, #0575e6, #021b79);
    }
 </style>
</head>
<body>
	<div class="container">
		<div class="login-wrap mx-auto">
			<div class="login-head" style="background-color:#0463FA !important;">
				<h4><?php echo $BRAND_NAME;?></h4>
				<p>Hello there, Sign into your Account!</p>
			</div>
			<div class="login-body">
				<form name="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
					</div>
					<!-- <div class="mb-3">
						<a href="forgot.php">Forgot Password?</a>
					</div> -->
					<button type="submit" name="loginbtn" class="btn btn-primary btn-block button">Log In</button>
				</form>
			</div>
			<div class="login-footer">
				<!-- <a class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p> -->
			</div>
		</div>
	</div>
	<?php include JS_PATH; ?>
</body>

</html>
<?php
if (isset($_POST['loginbtn'])) {
    $inputEmail = $conn->real_escape_string($_POST['email']);

    if (empty($inputEmail)) {
        echo "<script>Swal.fire({title: 'Error!', text: 'Please Enter an Email', type: 'error'}).then(function() { $('#inputEmail').focus(); });</script>";
        exit();
    }

    if (empty($_POST['password'])) {
        echo "<script>Swal.fire({title: 'Error!', text: 'Please Enter a Password', type: 'error'}).then(function() { $('#inputPassword').focus(); });</script>";
        exit();
    }

    $check = $conn->prepare("SELECT * FROM doctors WHERE doctor_email = ?");
    $check->bind_param("s", $inputEmail);
    $check->execute();
    $q = $check->get_result();
    $r = $q->fetch_assoc();

    if (!$r) {
        echo "<script>Swal.fire({title: 'Error!', text: 'Email & Password Do Not Exist', type: 'error', confirmButtonText: 'Try Again'})</script>";
        exit();
    }

    $token = $r["doctor_token"];
    $Password = $r["doctor_password"];
    $inputPassword = $_POST['password'];

    if (password_verify($inputPassword, $Password)) {
        // Password is correct
        // echo "Login successful!";
        $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctor_email = ? AND doctor_password = ?");
            $stmt->bind_param("ss", $inputEmail, $Password);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            $_SESSION['DoctorRoleID'] = $row['doctor_id'];
            $_SESSION['DoctorRoleEmail'] = $row['doctor_email'];
            $_SESSION['DoctorRoleLoggedIn'] = 1;
            header("Location: index.php");

            $stmt->close();
            $conn->close();
        
    } else {
        // Password is incorrect
        // echo "Invalid credentials.";
        //     exit();
         echo "<script>Swal.fire({title: 'Error!', text: 'Email & Password Do Not Exist', type: 'error', confirmButtonText: 'Try Again'})</script>";
      
    }    
    // $inputPassword = $conn->real_escape_string(encrypt(md5($_POST['password']), $token));

    // try {
    //     $stmt = $conn->prepare("SELECT * FROM doctors WHERE doctor_email = ? AND doctor_password = ?");
    //     $stmt->bind_param("ss", $inputEmail, $Password);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $row = $result->fetch_assoc();

    //     if (!$row) {
    //         echo "<script>Swal.fire({title: 'Error!', text: 'Email & Password Do Not Exist', type: 'error', confirmButtonText: 'Try Again'})</script>";
    //         exit();
    //     } else {
    //         $_SESSION['DoctorRoleID'] = $row['doctor_id'];
    //         $_SESSION['DoctorRoleEmail'] = $row['doctor_email'];
    //         $_SESSION['DoctorRoleLoggedIn'] = 1;
    //         header("Location: index.php");
    //     }
    // } catch (Exception $error) {
    //     die('There was an error running the query [' . $conn->error . ']');
    // }


}
?>