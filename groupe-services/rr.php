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
                    <small>Lun - Ven : 09.00 - 18.00</small>
                    <small class="ms-3">Sam : 09.00 - 13.00</small>
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
                        <a href="rn.php" class="dropdown-item">Rééducation neurologique</a>
                        <a href="rr.php" class="dropdown-item active">Rééducation respiratoire</a>
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Rééducation respiratoire</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" href="#">Services</li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Rééducation respiratoire</li>
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
                <a class="nav-link link-dark   py-3 " href="tm.php">
                    <i class="fas fa-hands"></i> Thérapie Manuelle
                </a>
                <a class="nav-link link-dark py-3" href="rn.php">
                    <i class="fas fa-brain"></i> Rééducation Neurologique
                </a>
                <a class="nav-link link-light py-3 active bg-primary rounded" href="rr.php">
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
                    <img src="../assets/img/widget/rr_img.jpg" class="img-fluid service-image rounded " alt="Service Image">
                    <h1 >QU’EST-CE QUE LA KINÉSITHÉRAPIE RESPIRATOIRE ?</h1>
                    <p>La kinésithérapie respiratoire désigne un ensemble de techniques visant à désobstruer le nez et désencombrer les bronches. En pratique, il s’agit de manœuvres externes, généralement manuelles, qui ont pour principal effet d’augmenter l’élimination des sécrétions ; ce qui permet d’améliorer la respiration en libérant les voies.

Surtout connue pour le traitement de la bronchiolite du nourrisson, cette technique est employée aussi bien sur des enfants que sur des adultes, pour une grande variété de troubles respiratoires.
                        </p>

                   
          
                
                   
                
                </div>
        
               
                <div class="content-header d-flex flex-column gap-2 py-4 px-3">
                    <div class="content-section">
                        <h2 class="w-100">
                            <button class="btn  w-100 text-start bg-primary text-light py-3 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent" aria-expanded="true" aria-controls="collapseContent">
                            QUELLES SONT LES INDICATIONS DE LA KINÉSITHÉRAPIE RESPIRATOIRE ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent">
                            <div class="card card-body py-3"  style="background-color: #eeee; border: none;">
                            La kiné respiratoire est indiquée pour le traitement des pathologies respiratoires obstructives de l’enfant et de l’adulte. Concrètement, cela signifie qu’elle améliore des symptômes tels que la toux, l’encombrement ou encore les difficultés à l’effort. Ses principales indications sont : La bronchite ou la bronchiolite du nourrisson La broncho-pneumopathie chronique obstructive (BPCO) L’asthm L’insuffisance respiratoire L’emphysème pulmonaire La pleurésie Le pneumothorax La pneumonie La dilatation bronchique La kinésithérapie respiratoire pour le désencombrement des bronches chez le nourrisson est bien connue. Toutefois, depuis fin 2019, elle n’est plus recommandée par la Haute Autorité de Santé. En effet, la littérature scientifique manque de preuves en faveur de cette technique, même si empiriquement, les enfants se sentent mieux après les séances.
                            </div>
                        </div>
                    </div>
                    <div class="content-section">
                        <h2>
                            <button class="btn btn-link w-100  text-start bg-primary text-light py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent2" aria-expanded="false" aria-controls="collapseContent2">
                            QUELS SONT LES BIENFAITS DE LA KINÉSITHÉRAPIE RESPIRATOIRE ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent2">
                            <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                            Si vous souffrez d’une maladie respiratoire, les séances de kinésithérapie peuvent vous apporter de solides améliorations en termes de qualité de vie. L’intérêt de technique est multiple, puisqu’elle permet notamment : De faciliter l’expectoration D’améliorer la fonction respiratoire De repérer les éventuels signes d’une aggravation Selon votre motif de consultation, vous pouvez aussi avoir besoin d’une rééducation respiratoire. L’objectif de cette rééducation est de vous apprendre les bons mouvements pour obtenir la respiration la plus efficace et la moins fatigante possible. En effet, quand on souffre d’insuffisance respiratoire, la synchronisation des mouvements est altérée, ce qui entraîne divers problèmes comme une respiration haute, l’utilisation de muscles respiratoires accessoires, un rythme de respiration accéléré…avec au final un retentissement important sur tous les efforts de la vie quotidienne. La rééducation respiratoire permet de conscientiser ces problèmes, puis d’automatiser progressivement leur correction. Dans la continuité de ces améliorations, la réhabilitation à l’effort fait le lien avec vos activités quotidiennes ; il s’agit d’une rééducation visant des efforts spécifiques, comme par exemple la marche et les escaliers. L’idée est de vous apprendre à coordonner votre respiration et trouver votre rythme idéal, pour augmenter peu à peu vos capacités et votre autonomie. En somme, au-delà du seul traitement des symptômes, la kinésithérapie respiratoire vous permet de mieux vivre votre pathologie au quotidien.
                            </div>
                        </div>
                    </div>
                    <div class="content-section">
                        <h2>
                            <button class="btn btn-link  w-100 text-start bg-primary text-light  py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent3" aria-expanded="false" aria-controls="collapseContent3">
                            COMMENT SE DÉROULENT LES SÉANCES DE KINÉ RESPIRATOIRE ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent3">
                                <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                                Les séances de kinésithérapie respiratoire peuvent beaucoup varier selon la pathologie traitée, et l’âge du patient. Dans tous les cas, un bilan diagnostic est effectué au début de votre prise en charge, pour savoir si les soins sont faisables, quelles techniques sont les plus appropriées, et quels objectifs peuvent être atteints. En effet, selon votre état de santé et vos capacités, toutes les techniques et tous les exercices ne sont pas appropriés ! C’est seulement après ce bilan initial que la prise en charge peut commencer. Les manipulations sont généralement manuelles, mais certains thérapeutes utilisent aussi des appareils ; pendant que vous recevez le soin, vous pouvez être assis, semi-allongé ou totalement allongé. Il est difficile d’évaluer la durée moyenne d’une séance de kiné respiratoire. En effet, d’un patient à l’autre, celle-ci peut beaucoup varier : l’importance de l’encombrement bronchique, et votre état de fatigue, peuvent notamment augmenter la durée des soins.
                        </div>
                    </div>

                </div>
                <div class="content-section">
                        <h2>
                            <button class="btn btn-link  w-100 text-start bg-primary text-light  py-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContent3" aria-expanded="false" aria-controls="collapseContent3">
                            A QUI M’ADRESSER POUR DES SÉANCES DE KINÉ RESPIRATOIRE ?
                            </button>
                        </h2>
                        <div class="collapse" id="collapseContent3">
                                <div class="card card-body py-3" style="background-color: #eeee; border: none;">
                                Comme tous les actes de kinésithérapie, cette technique est soumise à prescription médicale. En général, c’est votre médecin traitant ou votre pneumologue qui vous prépare une ordonnance, avec un nombre défini de séances. Tous les kinésithérapeutes sont formés aux techniques de kinésithérapie respiratoire ; mais certains d’entre eux ont suivi une formation complémentaire plus spécialisée.
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