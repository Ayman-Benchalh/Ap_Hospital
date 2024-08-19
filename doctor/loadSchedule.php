<?php
include('../config/autoload.php');

$date = $_POST["date"];

// Prepare and execute the query using prepared statements
$query = "SELECT * FROM schedule s
          LEFT JOIN schedule_detail sd ON s.schedule_id = sd.schedule_id 
          WHERE s.date_from <= ? AND s.date_to >= ? 
          ORDER BY sd.time_slot";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $date, $date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo '<span>No Time Added</span>';
} else {
    while ($row = $result->fetch_assoc()) {
        $day = $row['schedule_week'];
        $dayofweek = date("l", strtotime($date));

        if ($dayofweek == $day) {
            $timeslot = $row["time_slot"];
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
