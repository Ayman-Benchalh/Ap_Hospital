<?php
include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');

// Initialiser les variables d'erreur
$errName = "";
$errPrice = "";
$className = "";
$priceClassName = "";

// Vérifier que clinic_id et la connexion existent
if (!isset($doctor_row['clinic_id']) || !isset($conn)) {
    die('Les données requises ne sont pas définies.');
}

$clinic_id = $doctor_row['clinic_id'];

if (isset($_POST['submitbtn'])) {


    $name = escape_input($_POST['inputTreatment']);
    $price = escape_input($_POST['inputPrice']); // Updated variable name

    // Valider le nom du service
    if (empty($name)) {
        $errName = '<div class="invalid-feedback">Ce champ est requis</div>';
        $className = 'is-invalid';
    } elseif (!preg_match("/^[\p{L} '-]+$/u", $name)) {
        $errName = '<div class="invalid-feedback">Entrée non valide</div>';
        $className = 'is-invalid';
    }
    

    // Valider le prix
    if (empty($price)) {
        $errPrice = '<div class="invalid-feedback">Le prix est requis</div>';
        $priceClassName = 'is-invalid';
    } elseif (!is_numeric($price)) {
        $errPrice = '<div class="invalid-feedback">Le prix doit être un nombre valide</div>';
        $priceClassName = 'is-invalid';
    }

    // Insérer dans la base de données s'il n'y a pas d'erreurs
    if ($errName == "" && $errPrice == "") {
        $treatstmt = $conn->prepare("INSERT INTO clinic_service (Nom_Servic, clinic_id, Price) VALUES (?, ?, ?)");
        $treatstmt->bind_param("ssi", $name, $clinic_id, $price); // 's' for string, 'i' for integer
        $treatstmt->execute();
        $treatstmt->close();
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

// Initialiser les variables d'erreur du modal
$modalerrName = "";
$modalerrPrice = "";
$modalclassName = "";
$modalPriceClassName = "";

// Modifier le service
if (isset($_POST['editbtn'])) {
    $newName = escape_input($_POST['inputNewService']);
    $newPrice = escape_input($_POST['inputNewPrice']); // Updated variable name
    $tid = escape_input($_POST['ServiceID']);

    // Valider le nouveau nom de service
    if (empty($name)) {
        $errName = '<div class="invalid-feedback">Ce champ est requis</div>';
        $className = 'is-invalid';
    } elseif (!preg_match("/^[\p{L} '-]+$/u", $name)) {
        $errName = '<div class="invalid-feedback">Entrée non valide</div>';
        $className = 'is-invalid';
    }

    // Valider le nouveau prix
    if (empty($newPrice)) {
        $modalerrPrice = '<div class="invalid-feedback">Le prix est requis</div>';
        $modalPriceClassName = 'is-invalid';
    } elseif (!is_numeric($newPrice)) {
        $modalerrPrice = '<div class="invalid-feedback">Le prix doit être un nombre valide</div>';
        $modalPriceClassName = 'is-invalid';
    }

    // Mettre à jour le nom du service et le prix dans la base de données
    if ($modalerrName == "" && $modalerrPrice == "") {
        $treatstmt = $conn->prepare("UPDATE clinic_service SET Nom_Servic= ?, Price = ? WHERE id = ?");
        $treatstmt->bind_param("sdi", $newName, $newPrice, $tid); // 'd' for decimal/numeric data
        $treatstmt->execute();
        $treatstmt->close();
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

// Supprimer le service
if (isset($_POST['deletebtn'])) {
    $tid = escape_input($_POST['ServiceID']);
    $treatstmt = $conn->prepare("DELETE FROM clinic_service WHERE id = ?");
    $treatstmt->bind_param("i", $tid); // 'i' for integer
    $treatstmt->execute();
    $treatstmt->close();
    header('Location: ' . $_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include CSS_PATH; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmSubmission(event) {
            const btnsubmt = document.getElementById('btnsubmt');
            event.preventDefault(); // Empêche la soumission immédiate
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, ajoutez-le !"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Succès !",
                        text: "Vos données ont été ajoutées.",
                        icon: "success"
                    }).then(() => {
                        btnsubmt.click();
                    });
                }
            });
        }
    </script>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Contenu de la page -->
        <div class="row">
            <!-- Ajouter un nouveau service -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="inline-form" id="formadd" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <div class="form-group row">
                                <label for="inputTreatment" class="col-sm-3 col-form-label text-right">Nom du service</label>
                                <div class="col-sm-6">
                                    <input type="text" name="inputTreatment" id="inputTreatment" class="form-control form-control-sm <?= $className ?>">
                                    <?= $errName ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPrice" class="col-sm-3 col-form-label text-right">Prix</label>
                                <div class="col-sm-6">
                                    <input type="number" name="inputPrice" id="inputPrice" class="form-control form-control-sm <?= $priceClassName ?>">
                                    <?= $errPrice ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-md-center pt-2">
                                <button type="reset" class="btn btn-light btn-sm px-5 mr-2" name="clearbtn">Effacer</button>
                                <button class="btn btn-primary btn-sm px-5" onclick="confirmSubmission(event)">Ajouter</button>
                                <button type="submit" id="btnsubmt" style='display:none' class="btn btn-primary btn-sm px-5" name="submitbtn">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Afficher les services -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Service</th>
                                <th>Prix</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                $tresult = $conn->query("SELECT * FROM clinic_service WHERE clinic_id = $clinic_id");
                                if ($tresult->num_rows == 0) {
                                    echo '<tr><td colspan="3">Aucun enregistrement trouvé</td></tr>';
                                } else {
                                    while ($trow = $tresult->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?= $trow['Nom_Servic'] ?></td>
                                            <td> <?= $trow['Price'] ?> Dh</td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-success" data-toggle="modal" href="#edit<?= $trow['id'] ?>">Modifier</a>
                                                <a class="btn btn-sm btn-outline-danger" data-toggle="modal" href="#delete<?= $trow['id'] ?>">Supprimer</a>
                                            </td>
                                        </tr>

                                        <!-- Modal Modifier -->
                                        <div class="modal fade" id="edit<?= $trow['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="border:none;">
                                                        <h5 class="modal-title">Modifier</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="ServiceID" value="<?= $trow['id'] ?>">
                                                            <div class="form-group">
                                                                <label for="inputNewService">Modifier le service</label>
                                                                <input type="text" name="inputNewService" id="inputNewService" class="form-control <?= $modalclassName ?>" value="<?= $trow['Nom_Servic'] ?>">
                                                                <?= $modalerrName ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputNewPrice">Modifier le prix</label>
                                                                <input type="text" name="inputNewPrice" id="inputNewPrice" class="form-control <?= $modalPriceClassName ?>" value="<?= $trow['Price'] ?>">
                                                                <?= $modalerrPrice ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" style="border:none;">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" name="editbtn" class="btn btn-sm btn-primary">Sauvegarder</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Supprimer -->
                                        <div class="modal fade" id="delete<?= $trow['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="border:none;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="ServiceID" value="<?= $trow['id'] ?>">
                                                            Êtes-vous sûr de vouloir supprimer <strong><?= $trow['Nom_Servic'] ?></strong> ?
                                                        </div>
                                                        <div class="modal-footer" style="border:none;">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" name="deletebtn" class="btn btn-sm btn-danger">Supprimer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin du contenu de la page -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>
