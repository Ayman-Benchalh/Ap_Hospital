<?php
// Include necessary files for database connection, session handling, etc.
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

// Initialize success message and error variables
$success_message = "";


// Fetch clinic services
$clinic_id = $doctor_row['clinic_id'];
$query = "SELECT id, Nom_Servic, Price FROM clinic_service WHERE clinic_id = $clinic_id";
$result = mysqli_query($conn, $query);

// Create a service list to use for the dropdowns
$serviceOptions = "";
while ($row = mysqli_fetch_assoc($result)) {
    $serviceOptions .= "<option value='{$row['Nom_Servic']}' data-price='{$row['Price']}'>{$row['Nom_Servic']}</option>";
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $services = $_POST['service_nom'];
    $Seance = $_POST['Seance'];
    $prix = $_POST['prix'];
    $Total = $_POST['Total'];
    $FTotal = $_POST['FTotal'];
    $tva = $_POST['tva'];
    $netAmount = $_POST['FNet'];

    // Basic validation (ensure services and quantities are not empty)
    if (empty($services)) {
        $errCustomerName = "Please select a service.";
    }
    if (empty($Seance)) {
        $errPhone = "Please enter quantity.";
    }

    // If no errors, redirect to print page with the data
    if (empty($errCustomerName) && empty($errPhone)) {
        // Serialize the data to pass to the print page
        $serviceData = base64_encode(serialize(compact('services', 'Seance', 'prix', 'Total', 'FTotal', 'tva', 'netAmount')));
        header("Location: templetDevis.php?data=" . urlencode($serviceData));
        exit();
    }
}
?><!DOCTYPE html>
<html lang="fr">

<head>
    <?php include CSS_PATH; ?>
    <title>Devis</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>

        <div class="container mt-4">
            <h2 class="text-start py-4">Devis</h2>

            <!-- Display Success Message if Available -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message; ?>
                    <button type="button" onclick="handlClosebtn()" id="btn_close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" onsubmit="return validateForm()">
                <div class="row card-body">
                    <table class="table table-bordered col-12">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pathologie</th>
                                <th scope="col" class="text-end">Nomber de séances</th>
                                <th scope="col" class="text-end">Prix</th>
                                <th scope="col" class="text-end">Total</th>
                                <th scope="col" class="NoPrint">
                                    <button type="button" class="btn btn-sm btn-success " onclick="BtnAdd()">+</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="TBody">
                            <tr>
                                <th scope="row">1</th>
                                <td>
                                    <select class="form-control service-select" name="service_nom[]" onchange="UpdatePrice(this)" required>
                                        <option>Select Pathologie</option>
                                        <?php echo $serviceOptions; ?>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control text-end" name="Seance[]" value="1" min="1" onchange="Calc(this);" required></td>
                                <td><input type="number" class="form-control text-end" name="prix[]" onchange="Calc(this);" value="0" required></td>
                                <td><input type="number" class="form-control text-end" name="Total[]" value="0" readonly></td>
                                <td class="NoPrint"><button type="button" class="btn btn-sm btn-danger" onclick="BtnDel(this)">X</button></td>
                            </tr>
                            <tr id="TRow" class="d-none">
                                <th scope="row"></th>
                                <td>
                                    <select class="form-control service-select" name="service_nom[]" onchange="UpdatePrice(this)" required>
                                        <option>Select Service</option>
                                        <?php echo $serviceOptions; ?>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control text-end" name="Seance[]" value="1" min="1" onchange="Calc(this);" required></td>
                                <td><input type="number" class="form-control text-end" name="prix[]" value="0" onchange="Calc(this);" required></td>
                                <td><input type="number" class="form-control text-end" name="Total[]" value="0" readonly></td>
                                <td class="NoPrint"><button type="button" class="btn btn-sm btn-danger" onclick="BtnDel(this)">X</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="col-12 row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Total</span>
                                <input type="number" class="form-control text-end" id="FTotal" name="FTotal" readonly required>
                                <input type="hidden" id="FTotalHidden" name="FTotalHidden">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">TVA</span>
                                <select id="FGST" name="tva" class="form-control text-end" onchange="GetTotal()" required>
                                    <option value="20">20%</option>
                                    <option value="10">10%</option>
                                    <option value="5">5%</option>
                                    <option value="0" selected>0%</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Taxe</span>
                                <input type="number" class="form-control text-end" id="FNet" name="FNet" readonly required>
                                <input type="hidden" id="FNetHidden" name="FNetHidden">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary col-12">Confirme</button>
                </div>
            </form>
        </div>
    </div>

    <?php include JS_PATH; ?>

    <script>
        function BtnAdd() {
            var v = $("#TRow").clone().appendTo("#TBody");
            $(v).removeClass("d-none").find("input").val('1');
            $(v).find("th").first().html($('#TBody tr').length - 1);
        }

        function BtnDel(v) {
            $(v).parent().parent().remove();
            GetTotal();
            $("#TBody").find("tr").each(function(index) {
                $(this).find("th").first().html(index);
            });
        }

        function Calc(v) {
            var index = $(v).closest('tr').index();
            var qty = document.getElementsByName("Seance[]")[index].value;
            var rate = document.getElementsByName("prix[]")[index].value;
            var amt = qty * rate;
            document.getElementsByName("Total[]")[index].value = amt.toFixed(2);
            GetTotal();
        }

        function UpdatePrice(serviceSelect) {
            var selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            var price = selectedOption.getAttribute('data-price');
            var row = serviceSelect.closest('tr');
            row.querySelector('input[name="prix[]"]').value = price;
            Calc(serviceSelect);
        }

        function GetTotal() {
            var sum = 0;
            var amts = document.getElementsByName("Total[]");
            for (var i = 0; i < amts.length; i++) {
                sum += parseFloat(amts[i].value) || 0;
            }
            document.getElementById("FTotal").value = sum.toFixed(2);
            document.getElementById("FTotalHidden").value = sum.toFixed(2);

            var gst = parseFloat(document.getElementById("FGST").value) || 0;
            var calcultotal = 0;

            if (gst == 20) {
                calcultotal = (sum / 120) * 20;
            } else if (gst == 10) {
                calcultotal = (sum / 110) * 10;
            } else if (gst == 5) {
                calcultotal = (sum / 105.5) * 5.5;
            }else if (gst == 0) {
                calcultotal = (sum / 105.5) * 0;
            }

            document.getElementById("FNet").value = calcultotal.toFixed(2);
            document.getElementById("FNetHidden").value = calcultotal.toFixed(2);
        }

        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll("input[required], select[required]");

            inputs.forEach(function(input) {
                if (input.value.trim() === "") {
                    isValid = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Champ obligatoire',
                        text: 'Veuillez remplir tous les champs obligatoires.',
                    });
                    input.focus();
                    return false; // Stop further validation once an empty field is found
                }
            });

            return isValid;
        }
    </script>
</body>

</html>
