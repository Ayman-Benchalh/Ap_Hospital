<?php
header('Content-Type: text/html; charset=UTF-8');
include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

 
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="../fullcalendar//lib/main.min.css">
    <!-- <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script> -->
    <script src="../fullcalendar/lib/main.min.js"></script>
    <!-- <style>


        table, tbody, td, tfoot, th, thead, tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }
    </style> -->
	<?php include CSS_PATH; ?>
</head>

<body >
<?php include NAVIGATION; ?>
    <div  class="page-content" id="content">
	<?php include HEADER; ?>
        <div class="row">
            <div class="col-md-6">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Start</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="end_datetime" class="control-label">End</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Schedule Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description"></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start"></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end"></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $schedules = $conn->query("SELECT * FROM `schedule_list`");
    $sched_res = [];
    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
        $sched_res[$row['id_schedule']] = $row; // Adjusted to match `id_schedule`
    }
    if (isset($conn)) $conn->close();
    ?>
    <script>
        var scheds = <?= json_encode($sched_res) ?>;
    </script>
    <script src="./js/script.js"></script>
	<script>
		const mycalnder = () =>{
			document.addEventListener('DOMContentLoaded', function() {
                var calendar;
                var Calendar = FullCalendar.Calendar;
                var events = [];

                if (scheds) {
                    Object.keys(scheds).forEach(k => {
                        var row = scheds[k];
                        events.push({
                            id: row.id_schedule, // Updated to match the field name
                            title: row.title,
                            start: row.start_datetime,
                            end: row.end_datetime
                        });
                    });
                }

                calendar = new Calendar(document.getElementById('calendar'), {
                    headerToolbar: {
                        left: 'prev,next today',
                        right: 'dayGridMonth,dayGridWeek,list',
                        center: 'title',
                    },
                    selectable: true,
                    themeSystem: 'bootstrap',
                    events: events,
                    eventClick: function(info) {
                        var _details = document.getElementById('event-details-modal');
                        var id = info.event.id;
                        if (scheds[id]) {
                            _details.querySelector('#title').textContent = scheds[id].title;
                            _details.querySelector('#description').textContent = scheds[id].description;
                            _details.querySelector('#start').textContent = scheds[id].sdate;
                            _details.querySelector('#end').textContent = scheds[id].edate;
                            _details.querySelector('#edit').setAttribute('data-id', id);
                            _details.querySelector('#delete').setAttribute('data-id', id);
                            new bootstrap.Modal(_details).show();
                        } else {
                            alert("Event is undefined");
                        }
                    },
                    editable: true
                });

                calendar.render();

                document.getElementById('schedule-form').addEventListener('reset', function() {
                    var form = this;
                    form.querySelectorAll('input[type="hidden"]').forEach(input => input.value = '');
                    form.querySelector('input:visible').focus();
                });

                document.getElementById('edit').addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    if (scheds[id]) {
                        var _form = document.getElementById('schedule-form');
                        _form.querySelector('[name="id"]').value = id;
                        _form.querySelector('[name="title"]').value = scheds[id].title;
                        _form.querySelector('[name="description"]').value = scheds[id].description;
                        _form.querySelector('[name="start_datetime"]').value = scheds[id].start_datetime.replace(" ", "T");
                        _form.querySelector('[name="end_datetime"]').value = scheds[id].end_datetime.replace(" ", "T");
                        bootstrap.Modal.getInstance(document.getElementById('event-details-modal')).hide();
                        _form.querySelector('[name="title"]').focus();
                    } else {
                        alert("Event is undefined");
                    }
                });

                document.getElementById('delete').addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    if (scheds[id]) {
                        var _conf = confirm("Are you sure to delete this scheduled event?");
                        if (_conf) {
                            window.location.href = "./delete_schedule.php?id=" + id;
                        }
                    } else {
                        alert("Event is undefined");
                    }
                });
            });

                    }
		mycalnder();
	</script>
</body>

</html>
