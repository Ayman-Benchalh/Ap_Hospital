<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cabinet Chaibi</title>
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
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/img/icon/logoCAbi.ico" type="image/x-icon">
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
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
                    <small>Derrière Restaurant Soto Marina et Station Shell,Tiflet 15400</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center py-3">
                    <small class="far fa-clock text-primary me-2"></small>
                    <small>Mon - Fri : 09.00  - 18.00 </small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+212 666 74 16 66</small>
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
        <a href="../index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <!-- <h1 class="m-0 text-primary"><i class="far fa-hospital me-3"></i>Cabinet Chaibi</h1> -->
            <h1 class="m-0 text-primary">
                <img src="../assets/img/widget/logo.png"  style="width: 80px;">
                    Cabinet Chaibi
            </h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="../index.php" class="nav-item nav-link ">Accueil</a>
                <a href="../about.php" class="nav-item nav-link">À propos</a>
                <!-- <a href="service.php" class="nav-item nav-link active">Service</a> -->
                <div class="nav-item dropdown">
                    <a  class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Service</a>
                    <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                        <a href="rpd.php" class="dropdown-item ">Rééducation post-opératoire</a>
                        <a href="tbs.php" class="dropdown-item active"> Traitement des blessures sportives</a>
                        <a href="tm.php" class="dropdown-item">Thérapie manuelle</a>
                        <a href="rn.php" class="dropdown-item">Rééducation neurologique</a>
                        <a href="rr.php" class="dropdown-item">Rééducation respiratoire</a>
                        <a href="rp.php" class="dropdown-item">Rééducation périnéale</a>
                        <a href="tdc.php" class="dropdown-item">Traitement des douleurs chroniques</a>
                        <a href="pb.php" class="dropdown-item">Prévention des blessures</a>
                    </div>
                </div>
                <!-- <a href="contact.php" class="nav-item nav-link">Contact</a> -->
            </div>
            <a href="../appointment.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Rendez-vous<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
</nav>


    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Traitement des blessures sportives</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" href="#">Services</li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Traitement des blessures sportives</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 sidebar rounded" style="background-color: #eeee;">
            <nav class="nav flex-column text-light w-100">
            <a class="nav-link link-dark py-3" href="rpd.php">
               
                    <i class="fas fa-user-md"></i> Rééducation Post-Opératoire
                </a>
                <a class="nav-link link-light py-3 active bg-primary rounded" href="tbs.php">
                    <i class="fas fa-running"></i> Traitement Des Blessures Sportives
                </a>
                <a class="nav-link link-dark  py-3 " href="tm.php">
                    <i class="fas fa-hands"></i> Thérapie Manuelle
                </a>
                <a class="nav-link link-dark py-3" href="rn.php">
                    <i class="fas fa-brain"></i> Rééducation Neurologique
                </a>
                <a class="nav-link link-dark py-3" href="rr.php">
                    <i class="fas fa-lungs"></i> Rééducation Respiratoire
                </a>
                <a class="nav-link link-dark py-3" href="rp.php">
                    <i class="fas fa-female"></i> Rééducation Périnéale
                </a>
                <a class="nav-link link-dark py-3" href="tdc.php">
                    <i class="fas fa-hand-holding-medical"></i> Traitement Des Douleurs Chroniques
                </a>
                <a class="nav-link link-dark py-3" href="pb.php">
                    <i class="fas fa-shield-alt"></i> Prévention Des Blessures
                </a>
            </nav>
        </div>
            <!-- Main Content -->
        <div class="col-md-8">
                <div class="content-header d-flex flex-column gap-3 py-4 px-3">
                    <img src="../assets/img/widget/tbs_img.jpg" class="img-fluid service-image rounded " alt="Service Image">
                    <h1 >En Quoi Consiste Le Traitement des blessures sportives ?</h1>
                    <p>Les blessures sportives sont fréquentes, et peuvent entraîner un arrêt prolongé de l’activité pratiquée. Claquage, entorse, luxation, fracture…ces lésions concernent les sportifs de tous niveaux, du débutant au professionnel ; heureusement, elles ne sont jamais une fatalité. Pour éviter les blessures liées au sport, la meilleure chose à faire est d’être encadré par un professionnel compétent, comme le kinésithérapeute du sport.
                        </p>

                   
          
                
                   
                
                </div>
        
               
                <div class="content-header d-flex flex-column gap-2 py-4 px-3">
                    <div class="content-section">
                        <h2 class="w-100">
                            <button class="btn  w-100 text-start bg-primary text-light py-3 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent" aria-expanded="true" aria-controls="collapseContent">
                            QUELLE EST LA PARTICULARITÉ DE LA KINÉSITHÉRAPIE DU SPORT ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent">
                            <div class="card card-body py-3"  style="background-color: #eeee; border: none;">
                            Comme son nom l’indique, le kinésithérapeute du sport est un kinésithérapeute spécialisé dans la prise en charge des sportifs, et dans le traitement des pathologies liées à l’activité physique. Sa formation est la même que celle d’un kinésithérapeute classique, souvent complétée par un ou plusieurs cursus complémentaires. La patientèle du kinésithérapeute du sport se compose uniquement de personnes qui pratiquent une activité sportive, quel que soit leur niveau. Souvent sportif lui-même, ce professionnel a développé une expertise sur les pathologies liées au sport, que celles-ci soient musculaires, articulaires, osseuses ou encore tendineuses. Il est également spécialisé dans les problématiques de nutrition, de préparation physique et mentale ou encore de physiologie de l’effort, ce qui lui permet d’accompagner les sportifs de haut niveau sur tous les aspects de leur activité. Cela dit, cette spécialité n’est pas réservée aux athlètes professionnels ou de haut niveau. Tous les sportifs peuvent se faire accompagner par un kiné du sport, y compris les débutants ou ceux qui reprennent après un long arrêt.
                            </div>
                        </div>
                    </div>
                    <div class="content-section">
                        <h2>
                            <button class="btn btn-link w-100  text-start bg-primary text-light py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent2" aria-expanded="false" aria-controls="collapseContent2">
                            QUEL EST LE RÔLE DU KINÉ DU SPORT DANS L’ACCOMPAGNEMENT SUITE À UNE BLESSURE SPORTIVE ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent2">
                            <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                            Après une blessure sportive, l’accompagnement du kiné du sport se fait en plusieurs étapes. Tout d’abord, comme un kinésithérapeute classique, il met en place un programme de soins et de rééducation personnalisé pour traiter la douleur et les autres symptômes : massages, techniques de physiothérapie, libération des tensions, étirements…L’autre partie de la rééducation consiste à retrouver la mobilité du membre blessé, grâce à des mobilisations et exercices adaptés. La particularité de la kinésithérapie du sport est l’accompagnement spécifique du sportif vers la reprise de son activité. Cela en passe par une préparation physique générale, mais aussi spécifique à l’activité pratiquée. Cet accompagnement implique des exercices ciblés de renforcement musculaire, de gainage ou encore de mobilité articulaire, dans un double objectif : retrouver progressivement les performances d’avant la blessure, tout en prévenant les récidives. Tout au long de cette prise en charge, le kinésithérapeute travaille de concert avec le médecin du patient, mais aussi avec l’entraîneur et le coach sportif.
                            </div>
                        </div>
                    </div>
                    <div class="content-section">
                        <h2>
                            <button class="btn btn-link  w-100 text-start bg-primary text-light  py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent3" aria-expanded="false" aria-controls="collapseContent3">
                            POURQUOI SE FAIRE SUIVRE RÉGULIÈREMENT PAR UN KINÉ DU SPORT QUAND ON EST SPORTIF ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent3">
                                <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                                Le suivi par un kinésithérapeute du sport présente de nombreux avantages, même pour les sportifs de niveau débutant ou intermédiaire. Tout d’abord, cet accompagnement permet de réduire le risque de blessure, grâce aux exercices pratiqués lors des séances et en dehors, et grâce également aux conseils du kinésithérapeute. Ces conseils sont toujours personnalisés, adaptés aussi bien au patient qu’à sa discipline de prédilection. Ensuite, le suivi après une blessure permet de récupérer plus rapidement, et surtout avec un risque réduit de récidive. En effet, le kiné du sport est avant tout un professionnel de santé, expert en traumatologie du sport. Son accompagnement vise notamment l’identification et la correction des déséquilibres à l’origine de la blessure. Enfin, ce suivi permet aussi d’atteindre plus facilement vos objectifs, qu’il s’agisse de performance sportive, de remise en forme ou encore de perte de poids. En effet, le kiné du sport vous accompagne également sur le geste sportif, la mesure des performances, et d’autres variables comme la nutrition et la chronobiologie. Tout est mis en œuvre pour atteindre vos objectifs, en préservant ou en améliorant votre capital santé.
                        </div>
                    </div>

                </div>
                
            </div>


   
               
            </div>
        </div>
    </div>

    <!-- Service End -->

    


 
        

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
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
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
                        &copy; <a class="border-bottom" href="#">Nom de Votre Site</a>, Tous droits réservés.
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
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/counterup/counterup.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
</body>

</html>