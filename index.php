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
    'errDoctor_ext' => 'médecin is required.',
    'errContact' => 'Contact Number is required.',
    'errClass' => 'is-invalid',
    'invalidText' => 'Invalid input. Only letters and spaces are allowed.',
    'invalidContact' => 'Invalid contact number.'
];

$errNomComplet = $errCin = $errTele = $errAge =$errDoctor_ext = $errdata = $errtime = "";
$classNomComplet = $classCin = $classTele = $classAge= $classDoctor_ext = $classNomComplet = $classdata = $classtime = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NomComplet = isset($_POST['NomComplet']) ? escape_input($_POST['NomComplet']) : '';
    $date = isset($_POST['date']) ? escape_input($_POST['date']) : '';
    $time = isset($_POST['time']) ? escape_input($_POST['time']) : '';
    $Age = isset($_POST['Age']) ? escape_input($_POST['Age']) : '';
    $Tele = isset($_POST['Tele']) ? escape_input($_POST['Tele']) : '';
    // strtoupper
    $Cinlower = isset($_POST['Cin']) ? escape_input($_POST['Cin']) : '';
    $Cin =strtoupper($Cinlower);
    $Doctor_ext = isset($_POST['Doctorext']) ? escape_input($_POST['Doctorext']) : '';

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
    if (empty($Doctor_ext)) {
        $errDoctor_ext = $error_html['errDoctor_ext'];
        $classDoctor_ext = $error_html['errClass'];
    }


}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Cabinet Chaibi</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <!-- <link rel="shortcut icon" href="./img/logoCAbi.ico" type="image/x-icon"> -->
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
                    <small>Derrière Restaurant Soto Marina et Station Shell,Tiflet 15400</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Lun - Ven : 09.00  - 18.00 </small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+212 666 74 16 66</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href="https://wa.me/+212666741666"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href="https://wa.me/+212666741666"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href="https://wa.me/+212666741666"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href="https://wa.me/+212666741666"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <!-- <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>Cabinet Chaibi</h1> -->
            <h1 class="m-0 text-primary">
                <img src="./assets/img/widget/logo.png"  style="width: 80px;">
                    Cabinet Chaibi
            </h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.php" class="nav-item nav-link active">Accueil</a>
                <a href="about.php" class="nav-item nav-link">À propos</a>
                <!-- <a href="service.php" class="nav-item nav-link">Service</a> -->
                <div class="nav-item dropdown">
                    <a  class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Service</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="./groupe-services/rpd.php" class="dropdown-item">Rééducation post-opératoire</a>
                        <a href="./groupe-services/tbs.php" class="dropdown-item"> Traitement des blessures sportives</a>
                        <a href="./groupe-services/tm.php" class="dropdown-item">Thérapie manuelle</a>
                        <a href="./groupe-services/rn.php" class="dropdown-item">Rééducation neurologique</a>
                        <a href="./groupe-services/rr.php" class="dropdown-item">Rééducation respiratoire</a>
                        <a href="./groupe-services/rp.php" class="dropdown-item">Rééducation périnéale</a>
                        <a href="./groupe-services/rpd.php" class="dropdown-item">Traitement des douleurs chroniques</a>
                        <a href="./groupe-services/rpd.php" class="dropdown-item">Prévention des blessures</a>
                    </div>
                </div>
                <!-- <a href="contact.php" class="nav-item nav-link">Contact</a> -->
            </div>
            <a href="appointment.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Rendez-vous<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
</nav>

    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid header bg-primary p-0 mb-5" >
    <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
        <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
            <h1 class="display-4 text-white mb-5">Une bonne santé est la racine de tout bonheur</h1>
            <div class="row g-4">
                <div class="col-sm-4">
                    <div class="border-start border-light ps-4">
                        <h2 class="text-white mb-1" data-toggle="counter-up">5</h2>
                        <p class="text-light mb-0">Expérience</p>
                    </div>
                </div>
                <!-- <div class="col-sm-4">
                    <div class="border-start border-light ps-4">
                        <h2 class="text-white mb-1" data-toggle="counter-up">1234</h2>
                        <p class="text-light mb-0">Personnel Médical</p>
                    </div>
                </div> -->
                <div class="col-sm-4">
                    <div class="border-start border-light ps-4">
                        <h2 class="text-white mb-1" data-toggle="counter-up">100</h2>
                        <p class="text-light mb-0">Nombre Total de Patients</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
            <div class="owl-carousel header-carousel">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid"  style="width: 760px;height:760px; object-fit: cover; " src="./assets/img/widget/carousel1.jpeg" alt="">
                    <div class="owl-carousel-text">
                        <h1 class="display-1 text-white mb-0">
                        Rééducation Post-Opératoire</h1>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid"style="width: 760px;height:760px; object-fit: cover; " src="./assets/img/widget/carousel2.jpg"  alt="">
                    <div class="owl-carousel-text">
                        <h1 class="display-1 text-white mb-0">Traitement Des Blessures Sportives</h1>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid"style="width: 760px;height:760px; object-fit: cover; " src="./assets/img/widget/caroussel3.jpg">
                    <div class="owl-carousel-text">
                        <h1 class="display-1 text-white mb-0">Thérapie Manuelle</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid rounded w-100 align-self-end" src="./img/keni9.jpg" alt="">
                    <img class="img-fluid rounded w-75 bg-white pt-3 pe-3" src="./img/keni7.jpg" alt="" style="margin-top: -25%;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="d-inline-block border rounded-pill py-1 px-4">À Propos de Nous</p>
                <h1 class="mb-4">Pourquoi devriez-vous nous faire confiance ? Apprenez à nous connaître !</h1>
                <p>
                Nos services s'adressent à toute personne cherchant à soulager ses douleurs. Depuis l'établissement du centre, il est devenu un lieu où le bien-être et la santé sont prioritaires. Nous offrons des traitements de kinésithérapie et de physiothérapie. Chaque individu est unique à nos yeux et notre objectif est de trouver la prise en charge la plus adaptée afin de vous débarrasser de vos douleurs.</p>
                <p class="mb-4"></p>
                <p><i class="far fa-check-circle text-primary me-3"></i>Soins de santé de qualité</p>
                <p><i class="far fa-check-circle text-primary me-3"></i>Seulement des Médecins Qualifiés</p>
                <p><i class="far fa-check-circle text-primary me-3"></i>Professionnels de la Recherche Médicale</p>
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="service.php">En savoir plus</a>
            </div>
        </div>
    </div>
</div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Services</p>
            <h1>Solutions de Soins de Santé</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-user-md text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Rééducation Post-Opératoire</h4>
                    <p class="mb-4">
                        La rééducation post-opératoire est essentielle pour retrouver mobilité et force après une intervention chirurgicale.
                    </p>
                    <a class="btn" href="groupe-services/rpd.php"><i class="fa fa-plus text-primary me-3"></i>Lire la suite</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-running text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Traitement Des Blessures Sportives</h4>
                    <p class="mb-4">
                        Les blessures sportives nécessitent un traitement spécialisé pour permettre un retour rapide à l'activité.
                    </p>
                    <a class="btn" href="groupe-services/tbs.php"><i class="fa fa-plus text-primary me-3"></i>Lire la suite</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-hands text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Thérapie Manuelle</h4>
                    <p class="mb-4">
                        La thérapie manuelle est utilisée pour traiter les douleurs et dysfonctionnements musculosquelettiques.
                    </p>
                    <a class="btn" href="groupe-services/tm.php"><i class="fa fa-plus text-primary me-3"></i>Lire la suite</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-brain text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Rééducation Neurologique</h4>
                    <p class="mb-4">
                        La rééducation neurologique vise à améliorer les fonctions motrices et cognitives chez les patients atteints de troubles neurologiques.
                    </p>
                    <a class="btn" href="groupe-services/rn.php"><i class="fa fa-plus text-primary me-3"></i>Lire la suite</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-lungs text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Rééducation Respiratoire</h4>
                    <p class="mb-4">
                        La rééducation respiratoire aide à améliorer la fonction pulmonaire et à dégager les voies respiratoires.
                    </p>
                    <a class="btn" href="groupe-services/rr.php"><i class="fa fa-plus text-primary me-3"></i>Lire la suite</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item bg-light rounded h-100 p-5">
                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-band-aid text-primary fs-4"></i>
                    </div>
                    <h4 class="mb-3">Traitement Des Douleurs Chroniques</h4>
                    <p class="mb-4">
                        Les douleurs chroniques nécessitent un traitement continu pour améliorer la qualité de vie des patients.
                    </p>
                    <a class="btn" href="groupe-services/tdc.php"><i class="fa fa-plus text-primary me-3"></i>Lire la suite</a>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-primary overflow-hidden my-5 px-lg-0">
    <div class="container feature px-lg-0">
        <div class="row g-0 mx-lg-0">
            <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="p-lg-5 ps-lg-0">
                    <p class="d-inline-block border rounded-pill text-light py-1 px-4">Caractéristiques</p>
                    <h1 class="text-white mb-4">Pourquoi Nous Choisir</h1>
                    <p class="text-white mb-4 pb-2">
                    Choisissez-nous pour des soins personnalisés qui mettent votre bien-être en priorité. Notre centre offre des traitements de kinésithérapie et de physiothérapie adaptés à chaque individu, assurant un soulagement efficace et durable de vos douleurs. Votre santé est notre priorité</p>
                    <div class="row g-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-user-md text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">Expérience</p>
                                    <h5 class="text-white mb-0">5 ANS</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-check text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">Qualité</p>
                                    <h5 class="text-white mb-0">Services</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-comment-medical text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">Positive</p>
                                    <h5 class="text-white mb-0">Consultation</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                    <i class="fa fa-headphones text-primary"></i>
                                </div>
                                <div class="ms-4">
                                    <p class="text-white mb-2">24 Heures</p>
                                    <h5 class="text-white mb-0">Assistance</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100" src="./assets/img/widget/keni3.jpg" style="object-fit: cover;" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Feature End -->


  
    <!-- Appointment Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded-pill py-1 px-4">Rendez-vous</p>
                <h1 class="mb-4">Prenez Rendez-vous Pour Consulter Mr. Soufiyan Chaibi</h1>
                <!-- <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                -->
                <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-phone-alt text-primary"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Appelez-nous Maintenant</p>
                        <h5 class="mb-0">+212 6 66 74 16 66</h5>
                    </div>
                </div>
                <div class="bg-light rounded d-flex align-items-center p-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-envelope-open text-primary"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Envoyez-nous un Email</p>
                        <h5 class="mb-0">chaibikine@gmail.com</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="bg-light rounded h-auto d-flex align-items-center p-5">
                    <form name="Appointment_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <div class="row g-3">
                            <div class="col-12 ">
                                <input type="text" name="NomComplet"<?php echo $classNomComplet?> class="form-control border-0" placeholder="Entrez Nom Complet" style="height: 55px;">
                                <?php echo $errNomComplet; ?>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" name="Doctorext"<?php echo $classDoctor_ext?> class="form-control border-0" placeholder="Entrez le Nom de docteur" style="height: 55px;">
                                <?php echo $errDoctor_ext; ?>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" name="Cin" class="form-control border-0" <?php echo $classCin?> placeholder="Entrez CIN" style="height: 55px;">
                                <?php echo $errCin; ?>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" maxlength="10" name="Tele" <?php echo $classTele?> class="form-control border-0" placeholder="Entrez Numéro de Téléphone" style="height: 55px;">
                                <?php echo $errTele; ?>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" name="Age" <?php echo $classAge?> placeholder="Entrez Âge" style="height: 55px;">
                                <?php echo $errAge; ?>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="date" id="date" data-target-input="nearest">
                                    <input type="time" onchange="getdataD(this.value)" id="datepicker" class="my-calendar form-control"
                                    placeholder="Choisissez la Date" name="date"  <?php echo $classdata?>  style="height: 55px;background-color: #ffff;">
                                    <?php echo $errdata; ?>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="time" id="time" data-target-input="nearest">
                                    <select name="time" id="time2" class="my-calendar form-control" style="height: 55px;background-color: #ffff;">
                                       <option>Sélectionnez la Date d'abord</option>
                                    </select>
                                    <?php echo $errtime; ?> 
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="btnform" type="submit">Prendre Rendez-vous</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 

    <!-- Appointment End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Témoignage</p>
                <h1>Que disent nos patients !</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="./assets/img/widget/woman2.jpeg" style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>“Je suis extrêmement reconnaissante envers le Cabinet Chaibi pour leur expertise en kinésithérapie. Grâce à leur approche attentionnée et personnalisée, j’ai pu récupérer de ma blessure plus rapidement que prévu. Les thérapeutes sont compétents et à l’écoute. Je recommande vivement leurs services !”</p>
                        <h5 class="mb-1">Fatima belqadi</h5>
                        
                    </div>
                </div>
                <div class="testimonial-item text-center">
                <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="./assets/img/widget/man1.jpeg" style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>“Le Cabinet Chaibi est le meilleur endroit pour des soins de kinésithérapie de qualité. J’ai été impressionné par leur professionnalisme et leur engagement envers ma guérison. Les séances de traitement étaient efficaces et les conseils prodigués étaient très utiles. Je me sens tellement mieux maintenant, merci au Cabinet Chaibi !”</p>
                        <h5 class="mb-1">Ahmed bourzik</h5>
                        
                    </div>
                </div>
                <div class="testimonial-item text-center">
                <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="./assets/img/widget/woman1.jpeg" style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>“Je ne peux que recommander le Cabinet Chaibi pour leurs services de kinésithérapie exceptionnels. J’ai été agréablement surprise par l’attention particulière que j’ai reçue dès mon premier rendez-vous. Les kinésithérapeutes étaient très compétents, patients et dévoués à mon rétablissement. Je suis ravie des résultats obtenus et je leur suis reconnaissante.”</p>
                        <h5 class="mb-1">Sara aalami</h5>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Adresse</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Derrière Restaurant Soto Marina et Station Shell,Tiflet 15400</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+212 6 66 74 16 66</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>chaibikine@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://wa.me/+212666741666"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://wa.me/+212666741666"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://wa.me/+212666741666"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href="https://wa.me/+212666741666"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Services</h5>
                    <a class="btn btn-link" href="">Cardiologie</a>
                    <a class="btn btn-link" href="">Pneumologie</a>
                    <a class="btn btn-link" href="">Neurologie</a>
                    <a class="btn btn-link" href="">Orthopédie</a>
                    <a class="btn btn-link" href="">Laboratoire</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Liens Rapides</h5>
                    <a class="btn btn-link" href="">À Propos</a>
                    <a class="btn btn-link" href="">Contactez-nous</a>
                    <a class="btn btn-link" href="">Nos Services</a>
                    <a class="btn btn-link" href="">Termes & Conditions</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">S'inscrire</button>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="https://ritechco.ma/">Ritechco</a>, Tous droits réservés.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Conçu par <a class="border-bottom" href="https://ritechco.ma/">Ritechco</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
    <a href="https://wa.me/0666741666" class="btn  rounded-circle " id="btnwpts" ><i class="fa-brands fa-whatsapp"></i></a>


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
        const timevalid=['09:00 AM','09:30 AM','10:00 AM','10:30 AM','11:00 AM','11:30 AM','12:00 AM','12:30 AM','1:00 PM','1:30 PM','3:00 PM','3:30 PM','4:00 PM','4:30 PM','5:00 PM','5:30 PM','6:00 PM'];
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


   
     if (empty($errNomComplet) && empty($errCin) && empty($errTele) && empty($errAge) && empty($errdata) && empty($errtime)&& empty($errDoctor_ext)) {
        // echo "good form : " ,  $NomComplet, $Cin, $Tele, $Age, $date, $time;
        $nameclinc = "CabinetChaibi";
        $sql = $conn->prepare("SELECT * FROM clinics WHERE clinic_name = ?");
        $sql->bind_param("s", $nameclinc);
        $sql->execute();
        $result2 = $sql->get_result();
        $row2 = $result2->fetch_assoc();

        $clinic_id= $row2['clinic_id'];

        $sql2 = $conn->prepare("SELECT * FROM doctors WHERE clinic_id = ?");
        $sql2->bind_param("s", $clinic_id);
        $sql2->execute();
        $result3 = $sql2->get_result();
        $row3 = $result3->fetch_assoc();
        $docter_idF= $row3['doctor_id'];



        $stmt = $conn->prepare("SELECT COUNT(*) FROM appointment WHERE app_date = ? AND app_time = ? AND doctor_id = ? AND clinic_id = ? ");
        $stmt->bind_param("ssii", $date, $time,$docter_idF,$clinic_id);
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


          
            


            $docter_id=$docter_idF;
            $clini_id=$clinic_id;
            $status=1;
            $consult_status=0;
            $arrive_status=0;
            if($row){
               
                $patient_id=$Cin ;
                $stmt = $conn->prepare("INSERT INTO appointment (app_date, app_time ,patient_id, doctor_id, clinic_id,doctor_ext,status, consult_status,arrive_status) VALUES (?, ?, ?, ?, ?,?,?,?,?)");
                $stmt->bind_param("sssiisiii", $date, $time, $patient_id , $docter_id , $clini_id,$Doctor_ext, $status, $consult_status,$arrive_status);
                if(  $stmt->execute()){
                    echo " <script>Swal.fire({
                    title: 'Appointment success!',
                    text: 'Appointment has been successfully booked!',
                    icon: 'success'
                    }) </script>;";
                 
                }else{
                    echo  " <script>Swal.fire({
                        title: 'Appointment Error  !',
                        text: 'Appointment has not been successfully booked.!',
                        icon: 'error'
                        }) </script>;";
                   
                }
            }else{
                $patient_id=$Cin;
               $patient_Seance=0;
               $date_createdNom= date('Y-m-d H:m:s');
               $stmt = $conn->prepare("INSERT INTO patients (patient_id,patient_firstname, patient_identity ,patient_Seance,patient_contact, patient_age, date_created) VALUES (?,?, ?, ?, ?,?, ?)");
               $stmt->bind_param("sssisss",$patient_id, $NomComplet, $Cin,$patient_Seance, $Tele, $Age, $date_createdNom);
                if($stmt->execute()){
                    $stmt = $conn->prepare("INSERT INTO appointment (app_date, app_time ,patient_id, doctor_id, clinic_id,doctor_ext,status, consult_status,arrive_status) VALUES (?, ?, ?, ?, ?,?,?,?,?)");
                    $stmt->bind_param("sssiisiii", $date, $time, $patient_id , $docter_id , $clini_id,$Doctor_ext, $status, $consult_status,$arrive_status);
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
                       
                   }
                  
                 }else{
                    echo " <script>Swal.fire({
                        title: ''Appointment Error  !',
                        text: 'Appointment has not been successfully booked.!',
                        icon: 'error'
                        }) </script>;";
                  
                }
                
              
            }    
        
            
            
}}}
$conn->close()
?>