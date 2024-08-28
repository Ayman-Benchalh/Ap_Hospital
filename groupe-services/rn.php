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
                    <small>Derrière l'hôpital Dalia et devant Café Paris TIFLET 15400</small>
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
                        <a href="tbs.php" class="dropdown-item"> Traitement des blessures sportives</a>
                        <a href="tm.php" class="dropdown-item">Thérapie manuelle</a>
                        <a href="rn.php" class="dropdown-item active">Rééducation neurologique</a>
                        <a href="rr.php" class="dropdown-item">Rééducation respiratoire</a>
                        <a href="rp.php" class="dropdown-item">Rééducation périnéale</a>
                        <a href="tdc.php" class="dropdown-item">Traitement des douleurs chroniques</a>
                        <a href="pb.php" class="dropdown-item">Prévention des blessures</a>
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Rééducation neurologique</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" href="#">Services</li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Rééducation neurologique</li>
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
                <a class="nav-link link-dark py-3" href="tbs.php">
                    <i class="fas fa-running"></i> Traitement Des Blessures Sportives
                </a>
                <a class="nav-link link-light active bg-primary py-3 rounded" href="tm.php">
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
                    <img src="../assets/img/widget/rdp_img.jpg" class="img-fluid service-image rounded " alt="Service Image">
                    <h1 >Qu’est-ce que la kinésithérapie neurologique ?</h1>
                    <p>La kinésithérapie,également appelée « physiothérapie », est une discipline qui se base sur l’emploi des mouvements actifs (gymnastiques, exercices…)ou passifs (massothérapie, le port d’orthèse, l’usage d’ultrasons, de la chaleur, du froid, etc.).

Elle a pour objectif de renforcer, entretenir, soigner ou corriger les anomalies et les problèmes d’ordre fonctionnel.

Plusieurs techniques de la kiné sont aussi utilisées en vue d’établir un diagnostic, de traiter ou de prévenir certaines pathologies.
                        </p>

                   
          
                
                   
                
                </div>
        
               
                <div class="content-header d-flex flex-column gap-2 py-4 px-3">
                    <div class="content-section">
                        <h2 class="w-100">
                            <button class="btn  w-100 text-start bg-primary text-light py-3 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent" aria-expanded="true" aria-controls="collapseContent">
                            Kinésithérapie neurologique: qu’est-ce qu’il en est ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent">
                            <div class="card card-body py-3"  style="background-color: #eeee; border: none;">
                            La kinésithérapie neurologique se réfère à l’utilisation de cette thérapie pour évaluer et soigner les problèmes liés au système nerveux: les pathologies et les troubles neurologiques.
                            </div>
                        </div>
                    </div>
                    <div class="content-section">
                        <h2>
                            <button class="btn btn-link w-100  text-start bg-primary text-light py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent2" aria-expanded="false" aria-controls="collapseContent2">
                            Dans quelle pathologie lakinésithérapie est-elle indiquée ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent2">
                            <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                            En général, le kinésithérapeute professionnel peut prendre en charge tout type de pathologies du système nerveux que ce soit central ou périphérique. Voici toutefois une petite liste des troubles neurologiques couramment traités avec la kiné. Atteinte du système nerveux central (cerveau ou moelle épinière) On peut citer: les accidents vasculaires cérébraux (AVC) et les syndromes qui s’en suivent ; la sclérose en plaques ; la maladie de Parkinson ; la maladie d’Alzheimer ; la syringomyélie ; les lésions d’origine dégénérative (myélopathie cervicarthrosique) ; l’hémiplégie ; la paraplégie… Atteinte du système périphérique (ganglions et nerfs) Voici les maladies qui nécessitent souvent l’aide d’un kiné: les polyneuropathies d’origine alcoolique, infectieuse et même métabolique ; les maladies neuromusculaires ; les divers types de névralgies (cervico-brachiales, crurale, sciatiques). La kinésithérapie intervient aussi pour rétablir: les séquelles d’une intervention chirurgicale ; les traumatismes (suite à des chutes, des chocs, des accidents de voiture, etc.). Les signes évoquant des troubles neurologiques Voici quelques symptômes qui font suspecter un trouble d’ordre neurologique: Maux de tête fréquents. Nausées et vomissements. Troubles psychologiques. Troubles de la personnalité.
                            </div>
                        </div>
                    </div>
                    <div class="content-section">
                        <h2>
                            <button class="btn btn-link  w-100 text-start bg-primary text-light  py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent3" aria-expanded="false" aria-controls="collapseContent3">
                            La kinésithérapie neurologique: pour qui ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent3">
                                <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                                La kinéneurologique est faite pour toute personne souffrant d’un trouble en rapport avec le système nerveux. La pratique est indiquée aussi bien pour les grands que les petits. Pour ces derniers, la neurokinésithérapie contribue à développer et à exploiter au maximum leurs capacités fonctionnelles et cognitives. Cette spécialité de la physiothérapie est aussi indiquée pour les personnes qui souhaitent prévenir les conséquences d’une lésion neurologique.
                        </div>
                    </div>

                </div>
                <div class="content-section">
                        <h2>
                            <button class="btn btn-link  w-100 text-start bg-primary text-light  py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent3" aria-expanded="false" aria-controls="collapseContent3">
                            Comment la kinésithérapie agit sur la neurologie ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent3">
                                <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                                La kinésithérapie par ses diverses méthodes et techniques agit directement sur la zone ciblée. Elletravaille précisément sur les tissus musculaires, les tissus cardiaques et aussi les tissus nerveux. La véritable action dépend de l’approche et de la technique utilisée par le professionnel. Par exemple, l’électrothérapie a un effet direct sur les terminaisons nerveuses. Elle stimule la sécrétion de certaines hormones (enképhaline et endomorphine) qui inhibent surtout les symptômes douloureux. Les ultrasons, quant à eux, mobilisent et inhibent le durcissement des tissus (comme dans le cas de la sclérose). Le traitement par la chaleur ou le froid favorise le bien-être tout en ayant un effet antalgique. Les massages et les exercices de kinéneurologie aident le patient à avoir plus d’aisances dans les mouvements problématiques. Ces techniques ont généralement une action stimulante (sur les organes de sens et les récepteurs)qui revivifie les nerfs. C’est ce qui explique leur efficacité dans le traitement, le soulagement des symptômes et la rééducation neurologique.
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
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Derrière l'hôpital Dalia et devant Café Paris TIFLET 15400</p>
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
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">S'inscrire</button>
                    </div>
                </div>
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