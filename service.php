<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Klinik - Clinic Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
   
    <!-- Favicon -->
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/img/icon/logoCAbi.ico" type="image/x-icon">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <small>Derrière l'hôpital Dalia et devant Café Paris TIFLET 15400</small>
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
                <a href="index.php" class="nav-item nav-link ">Accueil</a>
                <a href="about.php" class="nav-item nav-link">À propos</a>
                <!-- <a href="service.php" class="nav-item nav-link active">Service</a> -->
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Service</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="feature.php" class="dropdown-item">Rééducation post-opératoire</a>
                        <a href="team.php" class="dropdown-item"> Traitement des blessures sportives</a>
                        <a href="appointment.php" class="dropdown-item">Thérapie manuelle</a>
                        <a href="./admin/login.php" class="dropdown-item">Rééducation neurologique</a>
                        <a href="./clinic/login.php" class="dropdown-item">Rééducation respiratoire</a>
                        <a href="./doctor/login.php" class="dropdown-item">Rééducation périnéale</a>
                        <a href="testimonial.php" class="dropdown-item">Traitement des douleurs chroniques</a>
                        <a href="404.php" class="dropdown-item">Prévention des blessures</a>
                    </div>
                </div>
                <!-- <a href="contact.php" class="nav-item nav-link">Contact</a> -->
            </div>
            <a href="appointment.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Rendez-vous<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
</nav>

    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


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


    <!-- Appointment Start -->
    


    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Témoignage</p>
                <h1>Que disent nos patients !</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                   
                    <div class="testimonial-text rounded text-center p-4">
                        <p>“Je suis extrêmement reconnaissante envers le Cabinet Chaibi pour leur expertise en kinésithérapie. Grâce à leur approche attentionnée et personnalisée, j’ai pu récupérer de ma blessure plus rapidement que prévu. Les thérapeutes sont compétents et à l’écoute. Je recommande vivement leurs services !”</p>
                        <h5 class="mb-1">Fatima belqadi</h5>
                        
                    </div>
                </div>
                <div class="testimonial-item text-center">
                   
                    <div class="testimonial-text rounded text-center p-4">
                        <p>“Le Cabinet Chaibi est le meilleur endroit pour des soins de kinésithérapie de qualité. J’ai été impressionné par leur professionnalisme et leur engagement envers ma guérison. Les séances de traitement étaient efficaces et les conseils prodigués étaient très utiles. Je me sens tellement mieux maintenant, merci au Cabinet Chaibi !”</p>
                        <h5 class="mb-1">Ahmed bourzik</h5>
                        
                    </div>
                </div>
                <div class="testimonial-item text-center">
                  
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>