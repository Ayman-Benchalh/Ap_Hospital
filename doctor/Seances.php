<?php
// Include necessary files for database connection, session handling, etc.
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

// Initialize success message and error variables
$success_message = "";
$error_message = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seanceIds = $_POST['seanceid'];
    $seanceDates = $_POST['seanceDate'];

    // Basic validation (ensure dates are not empty)
    if (empty($seanceDates) || empty($seanceIds)) {
        $error_message = "Veuillez entrer au moins une séance avec une date.";
    } else {
        // Serialize the data to pass to the next page
        $seanceData = [];
        foreach ($seanceDates as $index => $date) {
            $seanceData[] = [
                'id' => $seanceIds[$index],
                'date' => $date,
            ];
        }
        $serializedData = base64_encode(serialize($seanceData));
        header("Location: templetTableSeances.php?data=" . urlencode($serializedData));
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include CSS_PATH; ?>
    <title>Seances</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>

        <div class="container mt-4">
            <h2 class="text-start py-4">Seances</h2>

            <!-- Display Success or Error Message if Available -->
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $success_message; ?>
                    <button type="button" onclick="handlClosebtn()" id="btn_close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif (!empty($error_message)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $error_message; ?>
                    <button type="button" onclick="handlClosebtn()" id="btn_close" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
                <div class="row card-body">
                    <table class="table table-bordered col-12">
                        <thead class="table-success">
                            <tr>
                                <th scope="col" >#</th>
                                <th scope="col">Date</th>
                                <th scope="col" class="NoPrint">
                                    <button type="button" class="btn btn-sm btn-success" onclick="BtnAdd()">+</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="TBody">
                            <tr id="TRow">
                                <th  scope="row" class="text-center">
                                    <input type="number" class="form-control" name="seanceid[]" value="1" readonly required>
                                </th>
                                <td>
                                    <input type="date" class="form-control" name="seanceDate[]" >
                                </td>
                                <td class="NoPrint"><button type="button" class="btn btn-sm btn-danger" onclick="BtnDel(this)">X</button></td>
                            </tr>
                            
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary col-12">Confirmer</button>
                </div>
            </form>
        </div>
    </div>

    <?php include JS_PATH; ?>

    <script>
        function BtnAdd() {
            var v = $("#TRow").clone().appendTo("#TBody");
            $(v).removeClass("d-none");
            $(v).find("input").val(''); // Clear all input values in the cloned row
            var rowCount = $("#TBody tr").length; // Get the current number of rows in the table
            $(v).find("input[name='seanceid[]']").val(rowCount); // Set the first input's value to the current row number
        }

        function BtnDel(v) {
            $(v).closest("tr").remove();
            updateRowNumbers();
        }

        function updateRowNumbers() {
            $("#TBody tr").each(function(index) {
                $(this).find("input[name='seanceid[]']").val(index + 1);
            });
        }

        function validateForm() {
            var isValid = true;
            var inputs = document.querySelectorAll("#TBody tr:not(.d-none) input[required]");

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
