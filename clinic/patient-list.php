<?php
include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include CSS_PATH; ?>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Contenu de la page -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Tableau de données -->
                        <?php
                        function headerTable()
                        {
                            $header = array("ID Patient", "Nom du Patient", "IC / Mot de Passe", "Séance", "Numéro de Contact", "Date d'ajout", "Action");
                            $arrlen = count($header);
                            for ($i = 0; $i < $arrlen; $i++) {
                                echo "<th>" . $header[$i] . "</th>" . PHP_EOL;
                            }
                        }
                        ?>
                        <div class="data-tables">
                            <table id="datatable" class="table" style="width:100%">
                                <thead>
                                    <tr>
                                        <?php headerTable(); ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $table_result = mysqli_query($conn, "SELECT DISTINCT patients.patient_id, patients.patient_firstname, patients.patient_identity, patients.patient_contact, patients.patient_Seance, patients.date_created FROM appointment, patients WHERE appointment.patient_id = patients.patient_id AND appointment.clinic_id = '".$clinic_row['clinic_id']."' AND appointment.status = 1 ");
                                    while ($table_row = mysqli_fetch_assoc($table_result)) {
                                        ?><tr>
                                            <td><?= $table_row["patient_id"]; ?></td>
                                            <td><?=  $table_row["patient_firstname"]; ?></td>
                                            <td><?= $table_row["patient_identity"]; ?></td>
                                            <td><?= $table_row["patient_Seance"]; ?></td>
                                            <td><?= $table_row["patient_contact"]; ?></td>
                                            <td><?= $table_row["date_created"]; ?></td>
                                            <td>
                                                <a href="patient-view.php?cid=<?= encrypt_url( $table_row["patient_id"]); ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Voir</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <?php headerTable(); ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- Fin du tableau de données -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin du contenu de la page -->
    </div>

    <?php include JS_PATH; ?>
</body>

</html>
