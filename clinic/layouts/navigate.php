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
                <!-- Partie supérieure -->
                <p class="sidebar-heading px-3 pb-1 mb-0">Principal</p>
                <li class="nav-item <?php echo (stripos($_SERVER['REQUEST_URI'], 'index.php') !== FALSE) ? 'mm-active' : ''; ?>">
                    <a href="index.php" class="nav-link"><i class="fas fa-tachometer-alt mr-3 fa-fw"></i>Tableau de bord</a>
                </li>
                <li class="nav-item <?php echo (preg_match('/profile/', $_SERVER["REQUEST_URI"]) == TRUE) ? 'mm-active' : ''; ?>">
                    <a href="profile.php" class="nav-link"><i class="fas fa-clinic-medical mr-3 fa-fw"></i>Profil de la clinique</a>
                </li>
                <?php if ($clinic_row["clinic_status"] == 1): ?>
                    <li class="nav-item <?php echo (preg_match('/doctor/', $_SERVER["REQUEST_URI"]) == TRUE) ? 'mm-active' : ''; ?>">
                        <a href="#" class="nav-link has-arrow" aria-expanded="false"><i class="fas fa-stethoscope mr-3 fa-fw"></i>Médecins</a>
                        <ul class="side-collapse">
                            <a href="doctor-list.php" class="nav-link"><i class="fas fa-list-ol mr-3 fa-fw"></i>Liste des médecins</a>
                            <!-- <a href="doctor-add.php" class="nav-link"><i class="fa fa-user-plus mr-3 fa-fw"></i>Ajouter un médecin</a> -->
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item <?php echo (preg_match('/patient/', $_SERVER["REQUEST_URI"]) == TRUE) ? 'mm-active' : ''; ?>">
                    <a href="#" class="nav-link has-arrow" aria-expanded="false"><i class="fa fa-user-injured mr-3 fa-fw"></i>Patients</a>
                    <ul class="side-collapse">
                        <a href="patient-list.php" class="nav-link"><i class="fas fa-list-ol mr-3 fa-fw"></i>Liste des patients</a>
                        <!-- <a href="patient-add.php" class="nav-link"><i class="fas fa-user-plus mr-3 fa-fw"></i>Ajouter un patient</a> -->
                    </ul>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'appointment.php') ? 'mm-active' : ''; ?>">
                    <a href="appointment.php" class="nav-link"><i class="fas fa-calendar-check mr-3 fa-fw"></i>Rendez-vous</a>
                </li>
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'all-appointment.php') ? 'mm-active' : ''; ?>">
                    <a href="all-appointment.php" class="nav-link"><i class="fas fa-calendar-alt mr-3 fa-fw"></i>Tous les rendez-vous</a>
                </li>
                <!-- New Appointment Page -->
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'add_appointment.php') ? 'mm-active' : ''; ?>">
                    <a href="add_appointment.php" class="nav-link"><i class="fas fa-plus mr-3 fa-fw"></i>Ajouter un rendez-vous</a>
                </li>
                <!-- Facture Page -->
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'Facture.php') ? 'mm-active' : ''; ?>">
                    <a href="Facture.php" class="nav-link"><i class="fas fa-file-invoice mr-3 fa-fw"></i>Facture</a>
                </li>
                <!-- Devis Page -->
                <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'Devis.php') ? 'mm-active' : ''; ?>">
                    <a href="Devis.php" class="nav-link"><i class="fas fa-file-contract mr-3 fa-fw"></i>Devis</a>
                </li>
                <li class="nav-item <?php if (stripos($_SERVER['REQUEST_URI'],'Seances.php') !== FALSE) {echo 'mm-active';} ?>">
                    <a href="Seances.php" class="nav-link"><i class="fas fa-calendar-day mr-3 fa-fw"></i>Seances</a>
                </li>
                <!-- Fin de la partie supérieure -->
            </ul>
        </div>
        <!-- Contenu de la barre latérale -->
    </div>
</div>
<!-- Fin barre de navigation verticale -->
