<?php
// Database connection
include_once("./config/database.php");

function escape_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error_html = [
    'errClinic' => 'Clinic is required.',
    'errNomComplet' => 'Full Name is required.',
    'errCin' => 'CIN is required.',
    'errAge' => 'Age is required.',
    'errdate' => 'Date is required.',
    'errtime' => 'Time is required.',
    'errContact' => 'Contact Number is required.',
    'errClass' => 'is-invalid',
    'invalidText' => 'Invalid input. Only letters and spaces are allowed.',
    'invalidContact' => 'Invalid contact number.'
];

$errNomComplet = $errCin = $errTele = $errAge = $errdata = $errtime = "";
$classNomComplet = $classCin = $classTele = $classAge = $classdata = $classtime = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NomComplet = isset($_POST['NomComplet']) ? escape_input($_POST['NomComplet']) : '';
    $Cin = isset($_POST['Cin']) ? escape_input($_POST['Cin']) : '';
    $date = isset($_POST['date']) ? escape_input($_POST['date']) : '';
    $time = isset($_POST['time']) ? escape_input($_POST['time']) : '';
    $Age = isset($_POST['Age']) ? escape_input($_POST['Age']) : '';
    $Tele = isset($_POST['Tele']) ? escape_input($_POST['Tele']) : '';

    // Validation
    if (empty($NomComplet)) {
        $errNomComplet = $error_html['errNomComplet'];
        $classNomComplet = $error_html['errClass'];
    }

    if (empty($Cin)) {
        $errCin = $error_html['errCin'];
        $classCin = $error_html['errClass'];
    }

    $regrex['contact'] = '/^[\d\s\-\+\(\)]+$/';
    if (empty($Tele)) {
        $errTele = $error_html['errContact'];
        $classTele = $error_html['errClass'];
    } else if (!preg_match($regrex['contact'], $Tele)) {
        $errTele = $error_html['invalidContact'];
        $classTele = $error_html['errClass'];
    }

    if (empty($Age)) {
        $errAge = $error_html['errAge'];
        $classAge = $error_html['errClass'];
    }

    if (empty($date)) {
        $errdata = $error_html['errdate'];
        $classdata = $error_html['errClass'];
    }

    if (empty($time)) {
        $errtime = $error_html['errtime'];
        $classtime = $error_html['errClass'];
    }

    // if (empty($errNomComplet) && empty($errCin) && empty($errTele) && empty($errAge) && empty($errdata) && empty($errtime)) {
    //     // Form is valid
    //     echo "Form is valid. Values: $NomComplet, $Cin, $Tele, $Age, $date, $time";
    // }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Klinik - Clinic Website Template</title>
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->
    <!-- <link rel="stylesheet" href="./css/hjsCalendar.min.css">
    <script src="./js/hjsCalendar.min.js"></script> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css">

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
            /* height: 55px;
            width: 100%;
            background-color: #EFF5FF;
            outline: none; */
            /* background-color: #8B93FF;
            background-color: rgba(250, 52, 91, 0.764); */
            height: 55px;
            color: #EFF5FF;
            font-size: 20px;
            padding: 15px;
            font-weight: 600;
            transition: all .5s ease;
        
        }
        #time2 option:hover{
            /* height: 55px;
            width: 100%;
            background-color: #EFF5FF;
            outline: none; */
            background-color: #6770f3c3;
            /* background-color: rgba(250, 52, 91, 0.764); */

        
        }
     
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-map-marker-alt text-primary me-2"></small>
                    <small>123 Street, New York, USA</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>Clinic</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link">Home</a>
                <a href="about.php" class="nav-item nav-link">About</a>
                <a href="service.php" class="nav-item nav-link">Service</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="feature.php" class="dropdown-item">Feature</a>
                        <a href="team.php" class="dropdown-item">Our Doctor</a>
                        <a href="appointment.php" class="dropdown-item active">Appointment</a>
                        <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                        <a href="404.php" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link">Contact</a>
            </div>
            <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Appointment<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Appointment</p>
                    <h1 class="mb-4">Make An Appointment To Visit Our Doctor</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Call Us Now</p>
                            <h5 class="mb-0">+012 345 6789</h5>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Mail Us Now</p>
                            <h5 class="mb-0">info@example.com</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded  h-auto d-flex align-items-center p-5">
                        <form name="Appointment_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="NomComplet"<?php echo $classNomComplet?> class="form-control border-0" placeholder="Entre Nom Complet " style="height: 55px;">
                                    <?php echo $errNomComplet; ?>
                                </div>
                                <div class="col-12">
                                    <input type="text" name="Cin" class="form-control border-0" <?php echo $classCin?> placeholder="Entre CIN " style="height: 55px;">
                                    <?php echo $errCin; ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" maxlength="10" name="Tele" <?php echo $classTele?> class="form-control border-0" placeholder="Entre Numero de Telephone" style="height: 55px;">
                                    <?php echo $errTele; ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" name="Age" <?php echo $classAge?> placeholder="Entre Age" style="height: 55px;">
                                    <?php echo $errAge; ?>
                                </div>
                         
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="time" onchange="getdataD(this.value)" id="datepicker" class="my-calendar form-control"
                                        placeholder="Choose Date" name="date"  <?php echo $classdata?>  style="height: 55px;background-color: #ffff;">
                                       
                                     <?php echo $errdata; ?>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                <div class="time" id="time" data-target-input="nearest">

                                    <select name="time" id="time2" class=" my-calendar form-control" style="height: 55px;background-color: #ffff;">
                                       <option >Select Date first</option>
                                    </select>
                                    <?php echo $errtime; ?> 
                                    
                                </div>
                                   
                                </div>
                               
                                
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" name="btnform" type="submit">Book Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
        

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Address</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Services</h5>
                    <a class="btn btn-link" href="">Cardiology</a>
                    <a class="btn btn-link" href="">Pulmonary</a>
                    <a class="btn btn-link" href="">Neurology</a>
                    <a class="btn btn-link" href="">Orthopedics</a>
                    <a class="btn btn-link" href="">Laboratory</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Quick Links</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Our Services</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
            minDate: "today",
            disable: [
                function(date) {
                 
                    return (date.getDay() === 0 || date.getDay() === 6);
                 }
            ]
        });
      
     
  
    const printdata = (data)=>{
        const timevalid=['09:00 AM','10:00 AM','11:00 AM','12:00 AM','13:00 PM','15:00 PM','16:00 PM'];
        const select =document.getElementById('time2');



     if(data){
         datatime=data.map(v=>v.app_time)
 

        const filteredArray2 = timevalid.filter(element => !datatime.includes(element));

      
        
        // timevalid.filter(timava=>timava);

        select.innerHTML=timevalid.map(timava=>{

            if(filteredArray2.includes(timava)){
                   return `<option value='${timava}' style=' background-color: #8B93FF;'>${timava}</option>`
            }else{
                   return `<option disabled  style=' background-color: rgba(250, 52, 91, 0.764);'>${timava} invalid</option>`
            }
         })
     }else{
        select.innerHTML=timevalid.map(timava=>{

              return `<option value='${timava}'  style=' background-color: #8B93FF;'>${timava}</option>`
       
         })
      
        
     }
      }
</script>
<script>
    const getdataD=(date)=>{
       

  
        var xhr = new XMLHttpRequest();
            xhr.open('POST', './fetchdate.php', true); // Sending request to the same page
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    var feedback = document.getElementById('date-feedback');

                    if (response.status === 202) {
                            // console.log("data is here", JSON.stringify(response.data));
                            printdata(response.data);
                        } else if (response.status === 'no_data') {
                         
                            printdata(null);
                            // console.log("data is not here", JSON.stringify(response));
                        } else {
                            console.error('Unexpected response status:', response.status);
                        }
                } else {
                        console.error('Request failed. Returned status:', xhr.status);
                }
            };

            xhr.send('ajax_check_date=true&date=' + encodeURIComponent(date));
      
}

       

</script>

</body>

</html>



<?php

if (isset($_POST['btnform'])) {
   
     if (empty($errNomComplet) && empty($errCin) && empty($errTele) && empty($errAge) && empty($errdata) && empty($errtime)) {
        // echo "good form : " ,  $NomComplet, $Cin, $Tele, $Age, $date, $time;
        $stmt = $conn->prepare("SELECT COUNT(*) FROM appointment WHERE app_date = ? AND app_time = ?");
        $stmt->bind_param("ss", $date, $time);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "
            <script>
                Swal.fire({ 
                title: 'Error!',
                text: 'You cannot select this time. The selected time slot is invalid.!',
                type: 'error' })
                </script>
            ";
            exit();
           
        } else {
            $date_created = $date . " " . $time;
            $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_identity  = ? ");
            $stmt->bind_param("s", $Cin);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            $docter_id=3;
            $clini_id=5;
            $status=1;
            $consult_status=0;
            $arrive_status=0;
            if($row){
               
                $patient_id=$Cin ;
                $stmt = $conn->prepare("INSERT INTO appointment (app_date, app_time ,patient_id, doctor_id, clinic_id,status, consult_status,arrive_status) VALUES (?, ?, ?, ?, ?,?,?,?)");
                $stmt->bind_param("sssiiiii", $date, $time, $patient_id , $docter_id , $clini_id, $status, $consult_status,$arrive_status);
                if(  $stmt->execute()){
                    echo " <script>Swal.fire({
                    title: 'Appointment success!',
                    text: 'Appointment has been successfully booked!',
                    icon: 'success'
                    }) </script>;";
                    $stmt->close();
                }else{
                    echo  " <script>Swal.fire({
                        title: 'Appointment Error  !',
                        text: 'Appointment has not been successfully booked.!',
                        icon: 'error'
                        }) </script>;";
                    exit();
                }
            }else{
                $patient_id=$Cin;
                $date_createdNom= date('Y-m-d H:m:s');
                $stmt = $conn->prepare("INSERT INTO patients (patient_id,patient_firstname, patient_identity ,patient_contact, patient_age, date_created) VALUES (?,?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss",$patient_id, $NomComplet, $Cin, $Tele, $Age, $date_createdNom);
                if($stmt->execute()){
                    $stmt = $conn->prepare("INSERT INTO appointment (app_date, app_time ,patient_id, doctor_id, clinic_id,status, consult_status,arrive_status) VALUES (?, ?, ?, ?, ?,?,?,?)");
                    $stmt->bind_param("sssiiiii", $date, $time, $patient_id , $docter_id , $clini_id, $status, $consult_status,$arrive_status);
                   if($stmt->execute()){
                        echo " <script>Swal.fire({
                        title: 'Appointment success !',
                        text: 'Appointment has been successfully booked !',
                        icon: 'success'
                        }) </script>;";
                        
                   }else{
                    echo " <script>Swal.fire({
                        title: 'Appointment Error  !',
                        text: 'Appointment has not been successfully booked.!',
                        icon: 'error'
                        }) </script>;";
                        exit();
                   }
                  
                 }else{
                    echo " <script>Swal.fire({
                        title: ''Appointment Error  !',
                        text: 'Appointment has not been successfully booked.!',
                        icon: 'error'
                        }) </script>;";
                    exit();
                }
                
              
            }    
        
            
            
}}}
$conn->close()
?>