<?php
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

if (!isset($_GET['idFac'])) {
    die("Facture ID is not Here");
}

$idFac = $_GET['idFac'];

// Connect to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch invoice details
$invoiceQuery = "SELECT * FROM invoices WHERE id = ?";
$stmt = $conn->prepare($invoiceQuery);
$stmt->bind_param("s", $idFac);
$stmt->execute();
$invoiceResult = $stmt->get_result();
$invoiceData = $invoiceResult->fetch_assoc();

if (!$invoiceData) {
    die("Invoice not found");
}

// Fetch invoice details items
$detailsQuery = "SELECT * FROM invoice_details WHERE invoice_id = ?";
$stmtDetails = $conn->prepare($detailsQuery);
$stmtDetails->bind_param("s", $idFac);
$stmtDetails->execute();
$detailsResult = $stmtDetails->get_result();


$dataClinic = "SELECT * FROM clinics WHERE clinic_id  = ?";
$stmtClinic = $conn->prepare($dataClinic);
$stmtClinic->bind_param("s", $invoiceData['clinic_id']);
$stmtClinic->execute();
$clinicResult = $stmtClinic->get_result();
$ClinicData = $clinicResult->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include html2pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <style>
        .text-right {
            text-align: right;
        }
        .text-uppercase {
            text-transform: uppercase;
        }
        @media print {
            .page-break {
                page-break-before: always;
            }
        }
        .custom-bordered-table {
            border: 2px solid black;
        }

      
        .custom-bordered-table td {
            border: 2px solid black;
            height: 40px;
            width: 25%;
        }
        .custom-bordered-table th {
            border: 2px solid black;
            height: 40px;
            width: 25%;
        }
    </style>
</head>

<body>

<div class="container mt-5" id="invoice">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-uppercase">Facture <br> <span style="font-size: 20px;" >Id <?= $invoiceData['id'] ?></span></h2>
                <img src="../assets/img/widget/logo.png" alt="Logo" class="img-fluid" style="max-width: 200px;">
            </div>

            <div class="row mb-4">
            <div class="col-md-6">
                    <h4>De</h4>
                    <address>
                        <strong> <?= $ClinicData['clinic_name'] ?></strong><br>
                        
                       
                        Téléphone : <?= $ClinicData['clinic_contact'] ?><br>
                        Email : <?= $ClinicData['clinic_email'] ?><br>
                        Address  : <?= $ClinicData['clinic_address'] ?><br>
                        
                    </address>
                </div>
                <div class="col-md-6 text-right">
                    <h4>Facturé à</h4>
                    <address>
                        <strong><?= $invoiceData['customer_name'] ?></strong><br>
                        <?= $invoiceData['address'] ?><br>
                        <?= $invoiceData['city'] ?><br>
                        Téléphone : <?= $invoiceData['phone'] ?><br>
                        Email : email@client.com <!-- Update email as needed -->
                    </address>
                </div>
            </div>

            <div class="row mb-4" style="height: 45vh;">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Pathologie</th>
                            <th>Nomber de séances</th>
                            <th class="text-right">Prix Séances</th>
                            <th class="text-right">Prix Totel</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total = 0;
                        while ($detail = $detailsResult->fetch_assoc()) {
                            
                            echo "<tr>
                                <td>{$detail['seance']}</td>
                                <td>{$detail['service_nom']}</td> 
                                <td>{$detail['seance']}</td> 
                                <td class='text-right'>{$detail['price']}</td>
                                <td class='text-right'>" . number_format($invoiceData['total'], 2) . "</td>
                              </tr>";
                        }
                        ?>
                        <tr>
                            <th colspan="4" class="text-right"> Prix Total</th>
                            <th class="text-right"><?= number_format($invoiceData['total']) ?></th>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">TVA (<?= $invoiceData['tva'] ?>%)</td>
                            <td class="text-right"><?= $invoiceData['tva'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Montent TVA</td>
                            <td class="text-right"><?= number_format($invoiceData['net_amount'], 2) ?></td>
                        </tr>
          

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page-break"></div> <!-- Page break here -->


            <!-- <div class="row mx-5 d-none" id="divtable">
                <div class="col-6 m-auto py-3 mx-5">
                        <h4 class="text-center fw-bold text-rese">Calendrier des séances</h4>
                </div>
                <div class="col-md-12">
                        <table id="table2" class="table custom-bordered-table ">
                        <tr  class="text-center fw-bold">
                                        <th>Nº</th>
                                        <th>Date</th>
                                        <th>Nº</th>
                                        <th>Date</th>
                        </tr>
                        </table>
                </div>
            </div> -->
        </div>
        <div class="text-center  col-12 pt-5 mt-5 d-none" id="footer">
            <div class="col-12 m-auto fw-bolder ">Derrière Station Shell, Rue de Sebta Hay EL Farah 02، Tiflet 15400, Tél: 0666741666,</div>
            <div class="col-12  m-auto fw-bolder">ICE: 003251390000089 - IF: 53667670 - Patente: 29506551 - RC: 1537<br> www.cabinetchaibi.ma </div>
        </div>
    </div>
</div>
<div class="text-center mb-5">
    <button id="download-pdf" class="btn btn-primary">Télécharger la Facture en PDF</button>
</div>


<!-- JavaScript to handle PDF generation -->
<script>
      function printtable(){
        const table2 = document.getElementById('table2');
        for (let i = 1; i <= 15; i++) {
            table2.innerHTML += `   <tr>
                <td class="text-center " style="width: 25%;">${i}</td>
                <td style="width: 25%;"></td>
                <td class="text-center " style="width: 25%;">${15+i}</td>
                <td style="width: 25%;"></td>
            </tr>`;
        }
    }

    // Call the function to append rows to table2
    // printtable();
    document.getElementById('download-pdf').addEventListener('click', function () {
        // const table2 = document.getElementById('divtable');
        // table2.classList.remove('d-none')
        const footer = document.getElementById('footer');
        footer.classList.remove('d-none')
        const invoice = document.getElementById('invoice');
        const invoiceId = '<?= $invoiceData['id'] ?>'; // Get the invoice ID from PHP
        html2pdf().from(invoice).set({
            margin: 1,
            filename: 'Facture_' + invoiceId + '.pdf', // Use invoice ID in the filename
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
