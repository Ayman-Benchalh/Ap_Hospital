<?php
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

// Get the passed data from the previous form
if (isset($_GET['data'])) {
    $serviceData = unserialize(base64_decode($_GET['data']));
    $services = $serviceData['services'];
    $Seance = $serviceData['Seance'];
    $prix = $serviceData['prix'];
    $Total = $serviceData['Total'];
    $FTotal = $serviceData['FTotal'];
    $tva = $serviceData['tva'];
    $netAmount = $serviceData['netAmount'];
} else {
    echo "No data received!";
    exit();
}

// Filter out any unwanted values like "Select Service"
$filteredServices = [];
for ($i = 0; $i < count($services); $i++) {
    if ($services[$i] !== "Select Service") {
        $filteredServices[] = [
            'service' => $services[$i],
            'Seance' => $Seance[$i],
            'prix' => $prix[$i],
            'Total' => $Total[$i]
        ];
    }
}

// Fetch clinic data from the session or database (replace as needed)
$clinic_id = $clinic_row['clinic_id'];
$dataClinic = "SELECT * FROM clinics WHERE clinic_id = ?";
$stmtClinic = $conn->prepare($dataClinic);
$stmtClinic->bind_param("s", $clinic_id);
$stmtClinic->execute();
$clinicResult = $stmtClinic->get_result();
$ClinicData = $clinicResult->fetch_assoc();

// Get today's date
$currentDate = date("d/m/Y");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include html2pdf.js for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <style>
        .text-right {
            text-align: right;
        }
        .text-uppercase {
            text-transform: uppercase;
        }
    </style>
</head>

<body>

<div class="container mt-5" id="invoice">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-uppercase">Devis <br> 
                    <span style="font-size: 20px;">ID <?= uniqid() ?></span> <br>
                    <p style="font-size: 15px;"><?= $currentDate ?></p>
                </h2>
                <img src="../assets/img/widget/logo.png" alt="Logo" class="img-fluid" style="max-width: 200px;">
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h4>Info</h4>
                    <address>
                        <strong><?= $ClinicData['clinic_name'] ?></strong><br>
                        <?= $ClinicData['clinic_url'] ?><br>
                        <?= $ClinicData['clinic_city'] ?><br>
                        Téléphone : <?= $ClinicData['clinic_contact'] ?><br>
                        Email : <?= $ClinicData['clinic_email'] ?><br>
                        Adresse : <?= $ClinicData['clinic_address'] ?>
                    </address>
                </div>
                
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>Service</th>
                            <th>Seance</th>
                            <th class="text-right">Prix Unitaire</th>
                            <th class="text-right">Montant</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Display the filtered service data
                        $totalAmount = 0;
                        foreach ($filteredServices as $entry) {
                            $service = htmlspecialchars($entry['service']);
                            $quantity = htmlspecialchars($entry['Seance']);
                            $rate = htmlspecialchars($entry['prix']);
                            $amount = htmlspecialchars($entry['Total']);

                            $totalAmount += $amount;
                            echo "<tr>
                                    <td>{$service}</td>
                                    <td>{$quantity}</td>
                                    <td class='text-right'>" . number_format($rate, 2) . "</td>
                                    <td class='text-right'>" . number_format($amount, 2) . "</td>
                                  </tr>";
                        }
                        ?>
                        <tr>
                            <th colspan="3" class="text-right">Prix Total</th>
                            <th class="text-right"><?= number_format($totalAmount, 2) ?></th>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">TVA (<?= $tva ?>%)</td>
                            <td class="text-right"><?= number_format(($totalAmount * $tva) / 100, 2) ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right">Montant Total TTC</td>
                            <td class="text-right"><?= number_format($netAmount, 2) ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="text-center mb-5">
    <button id="download-pdf" class="btn btn-primary">Télécharger la Dives en PDF</button>
</div>

<!-- JavaScript to handle PDF generation -->
<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        const invoice = document.getElementById('invoice');
        const invoiceId = '<?= uniqid() ?>'; // Generate a unique invoice ID
        html2pdf().from(invoice).set({
            margin: 1,
            filename: 'Devis_' + invoiceId + '.pdf', // Use invoice ID in the filename
            html2canvas: { scale: 2 },
            jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' }
        }).save();
    });
</script>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
