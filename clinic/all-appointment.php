
<?php
require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

// Ensure $clinic_row and $conn are properly initialized in session.inc.php
if (!isset($clinic_row['clinic_id']) || !isset($conn)) {
    die('Required data not set.');
}

$clinic_id = $clinic_row['clinic_id'];
$rows_per_page = 15; // Number of rows to display per page

// Get the current page from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page < 1) {
    $current_page = 1;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $rows_per_page;

// Calculate the total number of rows in the table
$total_rows_query = $conn->prepare("
    SELECT COUNT(*) as total
    FROM appointment a
    WHERE a.clinic_id = ?
");
$total_rows_query->bind_param("i", $clinic_id);
$total_rows_query->execute();
$total_rows_result = $total_rows_query->get_result();
$total_rows = $total_rows_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $rows_per_page);
$total_rows_query->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include CSS_PATH; ?>
    <title>All Appointments | <?php echo htmlspecialchars($BRAND_NAME, ENT_QUOTES, 'UTF-8'); ?></title>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Page content -->
        <div class="container mt-4">
            <?php
            if ($clinic_id > 0) {
                // Prepare and execute the query
                $stmt = $conn->prepare("
                    SELECT a.*, 
                           p.patient_firstname AS patient_name, 
                           p.patient_contact AS patient_email,  
                           p.patient_Seance AS patient_seance,  
                           CONCAT(d.doctor_firstname, ' ', d.doctor_lastname) AS doctor_name  
                    FROM appointment a
                    JOIN patients p ON a.patient_id = p.patient_id
                    JOIN doctors d ON a.doctor_id = d.doctor_id
                    WHERE a.clinic_id = ?
                    LIMIT ? OFFSET ?
                ");
                if ($stmt) {
                    $stmt->bind_param("iii", $clinic_id, $rows_per_page, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Date</th>';
                        echo '<th>Time</th>';
                        echo '<th>Treatment</th>';
                        echo '<th>Patient</th>';
                        echo '<th>Patient Contact</th>';
                        echo '<th>Doctor</th>';
                        echo '<th>Status</th>';
                        echo '<th>Patient Seance</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';

                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['app_id'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['app_date'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['app_time'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['treatment_type'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['patient_name'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['patient_email'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['doctor_name'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '<td>' . htmlspecialchars($row['patient_seance'], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '</tr>';
                        }

                        echo '</tbody>';
                        echo '</table>';
                    } else {
                        echo '<p>No appointments found.</p>';
                    }

                    $stmt->close();
                } else {
                    echo '<p>Failed to prepare the statement.</p>';
                }
            } else {
                echo '<p>Invalid clinic ID.</p>';
            }
            ?>
        </div>
        <!-- Pagination Links -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($current_page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a></li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($i === $current_page) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- End Page Content -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>
