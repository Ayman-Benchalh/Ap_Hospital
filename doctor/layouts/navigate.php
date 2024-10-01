<div id="preloader">
    <div class="loader"></div>
</div>
<!-- Barre de navigation verticale -->
<div class="navbar-sidebar">
    <div class="vertical-nav bg-white sidebar-shadow" id="sidebar">
        <div class="sidebar-header">
            <a href="#" data-toggle="tooltip" data-placement="bottom" title="" class="logo-src" data-original-title="Clinique"><?php echo $BRAND_NAME?></a>
        </div>
        <!-- Contenu de la barre latérale -->
        <div class="sidebabr-inner">
            <ul class="nav flex-column bg-white mb-0" id="metismenu">
                <!-- Haut -->
                <p class="sidebar-heading px-3 pb-1 mb-0">Principal</p>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'index.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="index.php" class="nav-link"><i class="fas fa-tachometer-alt mr-3 fa-fw"></i>Tableau de bord</a>
                </li>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'doctor.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="doctor.php" class="nav-link"><i class="fas fa-stethoscope mr-3 fa-fw"></i>Profil</a>
                </li>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'patient-list.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="patient-list.php" class="nav-link"><i class="fas fa-user-injured mr-3 fa-fw"></i>Patients</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'appointment.php') ? 'mm-active' : ''; ?>">
                    <a href="appointment.php" class="nav-link"><i class="fas fa-calendar-check mr-3 fa-fw"></i>Rendez-vous</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'all-appointment.php') ? 'mm-active' : ''; ?>">
                    <a href="all-appointment.php" class="nav-link"><i class="fas fa-calendar-alt mr-3 fa-fw"></i>Tous les rendez-vous</a>
                </li>

                <li class="nav-item <?php if (preg_match('/(schedule)/',$_SERVER["REQUEST_URI"]) == TRUE) {echo 'mm-active';} ?>">
                    <a href="#" class="nav-link has-arrow" aria-expanded="false"><i class="fa fa-user-clock mr-3 fa-fw"></i>Horaires</a>
                    <ul class="side-collapse">
                        <a href="sch-list.php" class="nav-link"><i class="far fa-calendar mr-3 fa-fw"></i>Gérer les horaires</a>
                    </ul>
                </li>

                <!-- Facture -->
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'facture.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="facture.php" class="nav-link"><i class="fas fa-file-invoice-dollar mr-3 fa-fw"></i>Facture</a>
                </li>

                <!-- Devis -->
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'devis.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="devis.php" class="nav-link"><i class="fas fa-file-alt mr-3 fa-fw"></i>Devis</a>
                </li>

                <!-- Service -->
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'service.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="service.php" class="nav-link"><i class="fas fa-cogs mr-3 fa-fw"></i>Service</a>
                </li>

                <!-- Fin Haut -->
                
                <!-- <p class="sidebar-heading px-3 pb-1 mb-0">Autres</p>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'treatment.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="treatment.php" class="nav-link"><i class="fas fa-stream mr-3 fa-fw"></i>Type de traitement</a>
                </li>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'review.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="review.php" class="nav-link"><i class="fas fa-star mr-3 fa-fw"></i>Avis</a>
                </li>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'report.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="report.php" class="nav-link"><i class="fas fa-chart-area mr-3 fa-fw"></i>Rapport</a>
                </li> -->
            </ul>
        </div>
        <!-- Contenu de la barre latérale -->
    </div>
</div>
<!-- Fin barre de navigation verticale -->
