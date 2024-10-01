<?php

include('../config/autoload.php');
include('./includes/path.inc.php');
include('./includes/session.inc.php');

?>
<!DOCTYPE html>
<html lang="fr">

<head>
<link rel="stylesheet" href="../fullcalendar/lib/main.min.css">
<?php include CSS_PATH; ?>
<script src="../fullcalendar/lib/main.min.js"></script>
<!-- Bootstrap 5 -->


<style>
    #calendar {
        width: 100%;
        height: 80%;
    }
</style>
</head>

<body id="body">
<?php include NAVIGATION; ?>
<div class="page-content" id="content">
    <?php include HEADER; ?>
    <div class="row">
        <div class="col-md-12 pt-3">
            <div class="card rounded-0 shadow">
                <div class="card-header bg-gradient text-light" style="background-color: var(--primary-color);">
                    <h5 class="card-title">Formulaire d'horaire</h5>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <form action="save_schedule.php" method="post" id="schedule-form">
                            <input type="hidden" name="id" value="">
                            <div class="row g-2">
                                <div class="col-md-3 mb-2">
                                    <label for="title" class="control-label">Titre</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="description" class="control-label">Description</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="description" id="description" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="start_datetime" class="control-label">Début</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="end_datetime" class="control-label">Fin</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-primary col-md-2 btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 pt-3">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Modal pour les détails de l'événement -->
<div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-0">
            <div class="modal-header rounded-0">
                <h5 class="modal-title">Détails de l'événement</h5>
                <button type="button"  id="modal-close" class="modal-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body rounded-0">
                <div class="container-fluid">
                    <dl>
                        <dt class="text-muted">Titre</dt>
                        <dd id="event-title" class="fw-bold fs-4"></dd>
                        <dt class="text-muted">Description</dt>
                        <dd id="event-description"></dd>
                        <dt class="text-muted">Début</dt>
                        <dd id="event-start"></dd>
                        <dt class="text-muted">Fin</dt>
                        <dd id="event-end"></dd>
                    </dl>
                </div>
            </div>
            <div class="modal-footer rounded-0">
                <div class="text-end">
                    <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Modifier</button>
                    <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Supprimer</button>
                    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal" id="modal-close2">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include JS_PATH; ?>
<?php
$schedules = $conn->query("SELECT * FROM `schedule_list`");
$sched_res = [];
foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
    $row['sdate'] = date("d F, Y h:i A", strtotime($row['start_datetime']));
    $row['edate'] = date("d F, Y h:i A", strtotime($row['end_datetime']));
    $sched_res[$row['id']] = $row;
}
if (isset($conn)) $conn->close();
?>
<script>
    var scheds = <?= json_encode($sched_res) ?>;
console.log(scheds);

document.addEventListener('DOMContentLoaded', function() {
    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];

    if (scheds) {
        Object.keys(scheds).forEach(k => {
            var row = scheds[k];
            events.push({
                id: row.id,
                title: row.title,
                start: row.start_datetime,
                end: row.end_datetime,
                display:"color",
                color: '#906BD4' ,// Couleur de l'événement
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
                document.getElementById('event-title').textContent = scheds[id].title;
                document.getElementById('event-description').textContent = scheds[id].description;
                document.getElementById('event-start').textContent = scheds[id].sdate;
                document.getElementById('event-end').textContent = scheds[id].edate;
                document.getElementById('edit').setAttribute('data-id', id);
                document.getElementById('delete').setAttribute('data-id', id);
                var modalInstance = new bootstrap.Modal(_details);
                modalInstance.show();
            } else {
                alert("L'événement est indéfini");
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

    document.getElementById('edit').addEventListener('click', function(event) {
        event.preventDefault(); // Empêche toute action par défaut

        var id = this.getAttribute('data-id');
        if (scheds[id]) {
            var _form = document.getElementById('schedule-form');
            _form.querySelector('[name="id"]').value = id;
            _form.querySelector('[name="title"]').value = scheds[id].title;
            _form.querySelector('[name="description"]').value = scheds[id].description;
            _form.querySelector('[name="start_datetime"]').value = scheds[id].start_datetime.replace(" ", "T");
            _form.querySelector('[name="end_datetime"]').value = scheds[id].end_datetime.replace(" ", "T");

            // Fermer le modal Détails de l'événement
            var _details = document.getElementById('event-details-modal');
            var modelbk = document.querySelector('.modal-backdrop');
            var bodyOpen = document.getElementById('body');
      
            _details.style.display='none';
            bodyOpen.className='';
            modelbk.className='';
            
            // Mise au point sur le champ titre pour modification
            _form.querySelector('[name="title"]').focus();
        } else {
            alert("L'événement est indéfini");
        }
    });

    document.getElementById('delete').addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        if (scheds[id]) {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet événement?");
            if (confirmation === true) {
                window.location.href = "./delete_schedule.php?id=" + id;
            }
        } else {
            alert("L'événement est indéfini");
        }
    });

    document.getElementById('modal-close').addEventListener('click', function() {
        var _details = document.getElementById('event-details-modal');
        var modelbk = document.querySelector('.modal-backdrop');
        var bodyOpen = document.querySelector('.modal-open');
           
        _details.style.display='none';
        bodyOpen.className='';
        modelbk.className='';
    });

    document.getElementById('modal-close2').addEventListener('click', function() {
        var _details = document.getElementById('event-details-modal');
        var modelbk = document.querySelector('.modal-backdrop');
        var bodyOpen = document.querySelector('.modal-open');
           
        _details.style.display='none';
        bodyOpen.className='';
        modelbk.className='';
    });
});


</script>

</body>
</html>
