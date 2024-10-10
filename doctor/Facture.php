<?php
// Include necessary files for database connection, session handling, etc.
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

// Initialize success message and error variables
$success_message = "";
$errCustomerName = $errPhone = $errInvoiceDate = $errAddress = $errCity = "";
$classCustomerName = $classPhone = $classInvoiceDate = $classAddress = $classCity = "";

$clinic_id = $doctor_row['clinic_id'];
$query = "SELECT id, Nom_Servic, Price FROM clinic_service WHERE clinic_id = $clinic_id";
$result = mysqli_query($conn, $query);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form inputs
    $customer_name = mysqli_real_escape_string($conn, trim($_POST['customer_name']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['numro']));
    $invoice_date = mysqli_real_escape_string($conn, trim($_POST['invoice_date']));
    $address = mysqli_real_escape_string($conn, trim($_POST['address']));
    $city = mysqli_real_escape_string($conn, trim($_POST['city']));
    $services = $_POST['service_id'];  // Array of service IDs
    $seances = $_POST['seance'];       // Array of seances
    $prices = $_POST['price'];         // Array of prices
    $total = mysqli_real_escape_string($conn, trim($_POST['total']));
    $net_amount = mysqli_real_escape_string($conn, trim($_POST['net_amount']));
    $tva = mysqli_real_escape_string($conn, trim($_POST['Tve']));
    $clinic_id = $doctor_row['clinic_id'];
    $doctor_id = $doctor_row['doctor_id'];

    // Validation
    if (empty($customer_name)) {
        $errCustomerName = 'Full Name is required.';
        $classCustomerName = 'is-invalid';
    }
    if (empty($phone)) {
        $errPhone = 'Contact Number is required.';
        $classPhone = 'is-invalid';
    } elseif (!preg_match('/^[\d\s\-\+\(\)]+$/', $phone)) {
        $errPhone = 'Invalid contact number.';
        $classPhone = 'is-invalid';
    }
    if (empty($invoice_date)) {
        $errInvoiceDate = 'Invoice date is required.';
        $classInvoiceDate = 'is-invalid';
    }
    if (empty($address)) {
        $errAddress = 'Address is required.';
        $classAddress = 'is-invalid';
    }
    if (empty($city)) {
        $errCity = 'City is required.';
        $classCity = 'is-invalid';
    }

    // If no validation errors, proceed with invoice creation
    if (empty($errCustomerName) && empty($errPhone) && empty($errInvoiceDate) && empty($errAddress) && empty($errCity)) {
        // Generate a unique invoice ID
        $prefix = 'INV';
        $date_part = date('Ymd');
        $random_part = mt_rand(1000, 9999);
        $invoice_id = $prefix . $date_part . $random_part;

        // Start a transaction
        mysqli_begin_transaction($conn);

        try {
            // Insert the invoice into the `invoices` table
            $query_invoice = "INSERT INTO invoices (id, clinic_id, doctor_id, customer_name, phone, invoice_date, address, city, total, net_amount, tva) 
                              VALUES ('$invoice_id', '$clinic_id', '$doctor_id', '$customer_name', '$phone', '$invoice_date', '$address', '$city', '$total', '$net_amount', '$tva')";

            if (!mysqli_query($conn, $query_invoice)) {
                throw new Exception('Erreur lors de la création de la facture: ' . mysqli_error($conn));
            }

            // Insert each service into the `invoice_details` table
            foreach ($services as $index => $service_id) {
                $seance = mysqli_real_escape_string($conn, $seances[$index]);
                $price = mysqli_real_escape_string($conn, $prices[$index]);
               
                // $querySer = "SELECT * FROM clinic_service WHERE clinic_id = $clinic_id";
                // $resultSer = mysqli_query($conn, $querySer);
                // echo  $seance ;
                $querySerGet = "SELECT Nom_Servic FROM clinic_service WHERE clinic_id = $clinic_id AND id = $seance ";
                $resultSerGet = mysqli_query($conn, $querySerGet);
                $row = mysqli_fetch_assoc($resultSerGet); 
                $service_name=$row['Nom_Servic'];

               
                // echo print_r( $row) ;

                $query_details = "INSERT INTO invoice_details (invoice_id, service_nom, seance, price) 
                                  VALUES ('$invoice_id', '$service_name', '$seance', '$price')";

                if (!mysqli_query($conn, $query_details)) {
                    throw new Exception('Erreur lors de l\'insertion des détails de la facture: ' . mysqli_error($conn));
                }
            }
            
            // Commit the transaction
            mysqli_commit($conn);
           

            header("Location:templetFact.php?idFac=".$invoice_id);

            // Trigger SweetAlert success
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: 'Facture créée avec succès avec l\'ID: $invoice_id',
                    confirmButtonClass: 'btn btn-success'
                }).then(() => {
                    window.location.reload(); // Reload the page after confirmation
                });
            </script>";

        } catch (Exception $e) {
            // Rollback the transaction if any error occurs
            mysqli_rollback($conn);

            // Trigger SweetAlert error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Erreur lors de la création de la facture: {$e->getMessage()}',
                    confirmButtonClass: 'btn btn-danger'
                });
            </script>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include CSS_PATH; ?>
    <title>Facture</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>

        <div class="container mt-4">
            <h2 class="text-start py-4">FACTURE</h2>

            <!-- Display Success Message if Available -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message; ?>
                    <button type="button" onclick="handlClosebtn()" id="btn_close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Form for Invoice -->
            <form method="post" id="fromsumbt" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="customer" class="form-label">Client</label>
                        <input type="text" class="form-control <?php echo $classCustomerName; ?>" id="customer" name="customer_name" oninput="handlname(this.value)" placeholder="Entrer le nom du client">
                        <div class="invalid-feedback"><?php echo $errCustomerName; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label for="numro" class="form-label">Telephone</label>
                        <input type="text" class="form-control <?php echo $classPhone; ?>" id="numro" name="numro" placeholder="+2120 000 000 00" maxlength="10">
                        <div class="invalid-feedback"><?php echo $errPhone; ?></div>
                    </div>
                    <div class="col-md-3">
                        <label for="inv_date" class="form-label">Date de Facture</label>
                        <input type="date" class="form-control <?php echo $classInvoiceDate; ?>" id="inv_date" name="invoice_date" value="<?php echo date('Y-m-d'); ?>">
                        <div class="invalid-feedback"><?php echo $errInvoiceDate; ?></div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" class="form-control <?php echo $classAddress; ?>" id="address" name="address" placeholder="Adresse complète">
                        <div class="invalid-feedback"><?php echo $errAddress; ?></div>
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control <?php echo $classCity; ?>" id="city" name="city" placeholder="Nom de la ville">
                        <div class="invalid-feedback"><?php echo $errCity; ?></div>
                    </div>
                </div>

                <!-- Table for Invoice Details -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>#</th>
                            <th>Nom Client</th>
                            <th>Pathologie</th>
                            <th>Nomber de séances</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="form-control" id="item_name" name="item_name[]" value="Client Nom"></td>
                            <td>
                                <select class="form-control service-select" id="service_id" name="service_id[]">
                                    <option>Select Service</option>
                                    <?php
                                    // Populate the dropdown with service data from the database
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['Price']}' data-price='{$row['Price']}'>{$row['Nom_Servic']}</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td><input type="number" class="form-control seance-input" onchange="handlSeance(this.value)" name="seance[]" min="1" value="1"></td>
                            <td><input type="text" class="form-control price-input" oninput="handlprice(this.value)" id="price" name="price[]" value="0"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>Total</td>
                                <td><input type="number" class="form-control" id="total" onchange="handlSeanceMontantNet()" name="total" value="0" readonly></td>
                            </tr>
                            <tr>
                                <td>TVA</td>
                                <td>
                                    <select name="Tve" id="tva" class="form-control" onchange="handlselectTV()">
                                        <option value="20">20%</option>
                                        <option value="10">10%</option>
                                        <option value="5">5%</option>
                                        <option value="0" selected>0%</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Taxe</td>
                                <td><input type="number" class="form-control" id="net_amount" name="net_amount" value="0" readonly></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <button type="button" class="btn btn-primary col-12" onclick="confirmInsert()">Confirme</button>
            </form>
        </div>
    </div>

    <?php include JS_PATH; ?>

    <script>
        // Function to calculate total amount and update fields
        document.querySelectorAll('.service-select').forEach(function(selectElement) {
            selectElement.addEventListener('change', function() {
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                var price = selectedOption.getAttribute('data-price');
                var priceInput = selectElement.closest('tr').querySelector('.price-input');
                priceInput.value = price;

                const inputtotle = document.getElementById('total');
                inputtotle.value = priceInput.value;
                handlSeanceMontantNet();
            });
        });

        function handlSeance(datainput) {
            const dataselect = document.getElementById('service_id');
            const inputName = document.getElementById('price');
            const inputtotle = document.getElementById('total');
            inputName.value = dataselect.value * datainput;
            inputtotle.value = inputName.value;
            handlSeanceMontantNet();
        }

        function handlSeanceMontantNet() {
            const inputtotle = document.getElementById('total');
            const input_net_amount = document.getElementById('net_amount');
            const selectTv = document.getElementById('tva');
            if (selectTv.value == '20') {
                handlTv('20');
            } else if (selectTv.value == '10') {
                handlTv('10');
            }else if (selectTv.value == '5') {
                handlTv('5');
            } else {
                handlTv('0');
            }
        }

        function handlselectTV(datainput) {
            handlSeanceMontantNet();
        }
        function handlname(datainput) {
            const item_name = document.getElementById('item_name');
            item_name.value=datainput;
            console.log(item_name.value ,datainput)
            
        }

        function handlTv(datainput) {
            const inputtotle = document.getElementById('total');
            const input_net_amount = document.getElementById('net_amount');
            let calcultotal;
            if (datainput == '20') {
                calcultotal = (inputtotle.value / 120) * 20;
                input_net_amount.value = calcultotal.toFixed(2);
            } else if (datainput == '10') {
                calcultotal = (inputtotle.value / 110) * 10;
                input_net_amount.value = calcultotal.toFixed(2);
            } else if (datainput == '5') {
                calcultotal = (inputtotle.value / 105.5) * 5.5;
                input_net_amount.value = calcultotal.toFixed(2);
            }
        }

    function handlClosebtn(datainput) {
        location.reload();
    }


    </script>

<script>
        function confirmInsert() {
            // Trigger confirmation SweetAlert before form submission
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Voulez-vous vraiment créer cette facture?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, créez-la!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    document.getElementById('fromsumbt').submit();
                }
            });
        }
    </script>
</body>

</html>
