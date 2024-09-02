<?php
include('../config/autoload.php');

$date = $_POST["date"];


$query = "SELECT * FROM schedule_list 
          WHERE start_datetime <= ? AND end_datetime >= ? 
          ORDER BY start_datetime";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $date, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo '<span>No Time Added</span>';
} else {
    while ($row = $result->fetch_assoc()) {
        echo print_r($row);
        $start_datetime = $row["start_datetime"];
        $end_datetime = $row["end_datetime"];
        
        // Format the date to get the day of the week
        $dayofweek = date("l", strtotime($date));
        $day = date("l", strtotime($start_datetime)); // Assuming you need to check the day

        if ($dayofweek == $day) {
            $timeslot = date("H:i", strtotime($start_datetime)) . ' - ' . date("H:i", strtotime($end_datetime));
            ?>
            <button type="button" class="btn btn-sm btn-outline-primary" 
                    data-toggle="button" aria-pressed="false" autocomplete="off" 
                    onclick="return getTime('<?= htmlspecialchars($timeslot, ENT_QUOTES, 'UTF-8') ?>');">
                <?= htmlspecialchars($timeslot, ENT_QUOTES, 'UTF-8') ?>
            </button>
            <?php
        }
    }
}

$stmt->close();
$conn->close();
?>
