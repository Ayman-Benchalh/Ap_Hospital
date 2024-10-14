<?php
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

// Check if data is passed via GET request
if (isset($_GET['data'])) {
    $serviceData = unserialize(base64_decode($_GET['data']));
    $filteredServices = [];

    // Prepare the data for display
    foreach ($serviceData as $service) {
        $filteredServices[] = [
            'id' => $service['id'],
            'date' => $service['date'],
        ];
    }
} else {
    echo "No data received!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seances</title>
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
        .custom-bordered-table td, .custom-bordered-table th {
            border: 2px solid black;
            height: 40px;
            width: 50%;
        }
    </style>
</head>

<body>

<div class="container mt-5" id="invoice">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center align-items-center mb-4">
                <img src="../assets/img/widget/logo.png" alt="Logo" class="img-fluid" style="max-width: 200px;">
            </div>

            <div class="row mb-4" style="min-height: 75vh;">
                <div class="col-md-12">
                    <h4 class="text-center mb-3 p-3">Calendrier des séances</h4>
                    <table class="table custom-bordered-table">
                            <tr>
                                <th class="text-center">Nº</th>
                                <th class="text-center">Date</th>
                            </tr>
                        <tbody>
                        <?php
                        foreach ($filteredServices as $index => $service) {
                            // Create a new page after printing 14 rows
                            if ($index  == 14) {
                                echo "</tbody></table>
                                <div class='page-break my-5'></div>
                            
                                <table class='table custom-bordered-table' ><tbody>";
                            }

                            echo "<tr>
                                    <td class='text-center'style='height: 40px;' >{$service['id']}</td>
                                    <td class='text-center'style='height: 40px;' >{$service['date']}</td>
                                  </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="text-center col-12 pt-5 mt-5 d-none" id="footer">
        <div class="col-12 m-auto fw-bolder">Derrière Station Shell, Rue de Sebta Hay EL Farah 02, Tiflet 15400, Tél: 0666741666</div>
        <div class="col-12 m-auto fw-bolder">ICE: 003251390000089 - IF: 53667670 - Patente: 29506551 - RC: 1537<br> www.cabinetchaibi.ma</div>
    </div>

</div>

<div class="text-center my-5">
    <button id="download-pdf" class="btn btn-primary">Télécharger la Facture en PDF</button>
</div>

<script>
    document.getElementById('download-pdf').addEventListener('click', function () {
        // Show the footer for the PDF
        // document.getElementById('footer').classList.remove('d-none');

        // Generate the PDF
        const invoice = document.getElementById('invoice');
        html2pdf().from(invoice).set({
            margin: 1,
            filename: 'Seances.pdf',
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
