<?php
include('../config/autoload.php');

$date = $_POST['date'];
$id = $_POST['id'];

$query = "SELECT * FROM appointment, patients, clinics WHERE
appointment.patient_id = patients.patient_id AND
appointment.clinic_id = clinics.clinic_id AND
appointment.clinic_id = $id AND appointment.app_date = '$date' AND appointment.status = 1
ORDER BY SUBSTRING_INDEX(appointment.app_time, ' ', -1), SUBSTRING_INDEX(appointment.app_time, ' ', 1)
";

$tlist = $conn->query($query);

while ($trow = $tlist->fetch_assoc()) {
    if ($tlist->num_rows < 1) {
        echo '<tr><td>No Appointment</td></tr>';
    } else {
    ?>
    <tr>
        <td><?= $trow['app_id'] ?></td>
        <td><?= $trow['patient_firstname'] ?></td>
        <td><?= $trow['app_date'] ?></td>
        <td><?= $trow['app_time'] ?></td>
        <td><?= $trow['patient_Seance'] ?></td>
        <td><?= $trow['treatment_type'] ?></td>
        <td>
            <?php if ($trow['status'] == 1) { ?>
                <span class="badge badge-success px-3 py-1">Confirmed</span>
            <?php } else { ?>
                <span class="badge badge-warning px-3 py-1">Pending</span>
            <?php } ?>
        </td>
        <td>
            <?php if ($trow['arrive_status'] == 1) { ?>
                <button type="button" name="checkbtn" class="btn btn-sm btn-secondary" disabled>
                    <i class="fas fa-chair mr-3"></i>Seated
                </button>
            <?php } else { ?>
                <button type="button" name="checkbtn" class="btn btn-sm btn-primary" 
                    onclick="updateId(<?= $trow['app_id'] ?>, '<?= $trow['patient_id'] ?>')">
                    <i class="fas fa-plane-arrival mr-3"></i>Arrive
                </button>
            <?php } ?>
        </td>
    </tr>
<?php
    }
}
?>
