<?php

require_once('../config/autoload.php');
require_once('./includes/path.inc.php');
require_once('./includes/session.inc.php');

$doctor_id = $clinic_row['clinic_id'];

$stmt = $conn->prepare("
   SELECT appointment.*, patients.patient_firstname, patients.patient_Seance, doctors.doctor_firstname, doctors.doctor_lastname 
   FROM appointment 
   JOIN patients ON appointment.patient_id = patients.patient_id JOIN doctors ON appointment.doctor_id = doctors.doctor_id 
   WHERE appointment.clinic_id = ?
");
$stmt->bind_param("i", $doctor_id);

$sched_res = [];
if ($stmt->execute()) {
    $result = $stmt->get_result();
 
    while ($row = $result->fetch_assoc()) {
        $row['sdate'] = date("Y-m-d H:i:s", strtotime($row['app_date'] . ' ' . $row['app_time']));
        $row['edate'] = $row['sdate']; // En supposant que la date et l'heure de fin sont les mêmes que le début pour simplifier

        // Déterminer le jour de la semaine et l'heure
        $dayOfWeek = date('N', strtotime($row['sdate'])); // 1 (pour lundi) à 7 (pour dimanche)
        $hour = date('H', strtotime($row['sdate'])); // Heure au format 24 heures

        // Définir la couleur par défaut
        $color = '#906BD4';

        // Personnaliser la couleur en fonction du jour de la semaine et de l'heure
        if ($dayOfWeek == 1 && $hour >= 9 && $hour <= 12) {
            $color = '#FF0000'; // Exemple : rouge pour les matins du lundi
        } elseif ($dayOfWeek == 5 && $hour >= 14 && $hour <= 18) {
            $color = '#00FF00'; // Exemple : vert pour les après-midis du vendredi
        }

        $sched_res[] = [
            'id' => $row['app_id'],
            'title' => $row['patient_firstname'], // Nom du patient comme titre
            'Nom_Complet' => $row['doctor_firstname'].' '.$row['doctor_lastname'], // Nom complet du docteur
            'start' => $row['sdate'],
            'end' => $row['edate'],
            'color' => $color, // Utiliser la couleur personnalisée
            'description' => $row['patient_id'], // ID du patient
            'Seance' => $row['patient_Seance'], // Séance du patient
            'status' => $row['status'], // Statut
            'consult_status' => $row['consult_status'], // Statut de la consultation
            'arrive_status' => $row['arrive_status'], // Statut d'arrivée
            'urlshow' => encrypt_url($row['app_id']), // URL cryptée
        ];
    }
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../fullcalendar/lib/main.min.css">
    <?php include CSS_PATH; ?>
    <script src="../fullcalendar/lib/main.min.js"></script>
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
                <div id="calendar"></div>
            </div>
        </div>
    </div>

    <!-- Modal pour les détails de l'événement -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Détails du rendez-vous</h5>
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Date et heure du rendez-vous</dt>
                            <dd id="event-start"></dd>
                            <dt class="text-muted">Séance du patient</dt>
                            <dd id="event-seance"></dd>
                            <dt class="text-muted">Nom du patient</dt>
                            <dd id="event-title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">ID du patient</dt>
                            <dd id="event-description"></dd>
                            <dt class="text-muted">Statut du dossier</dt>
                            <dd id="event-Case"></dd>
                            <dt class="text-muted">Statut de l'arrivée</dt>
                            <dd id="event-Arrive"></dd>
                            <dt class="text-muted">Statut global</dt>
                            <dd id="event-Status"></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <a class="btn btn-success btn-sm rounded-0" id="show" href="appointment-view?id=" data-id="">Voir</a>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Supprimer</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal" id="modal-close2">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include JS_PATH; ?>
    <script>
    const scheds = <?= json_encode($sched_res) ?>;
    document.addEventListener('DOMContentLoaded', function() {
        var calendar;
        var Calendar = FullCalendar.Calendar;
        var events2 = [];
        
        if (scheds) {
            scheds.forEach(row => {
                events2.push({
                    id: row.id,
                    title: row.title,
                    start: row.start,
                    end: row.end,
                    display: '906BD4',
                    backgroundColor: row.color, // Définir la couleur de fond
                    borderColor: row.color, // Optionnellement, définir la couleur de bordure
                    description: row.description,
                    Seance: row.Seance,
                    Case: row.consult_status,
                    Arrive: row.arrive_status,
                    Status: row.status,
                    urlshow: row.urlshow,
                });
            });
        }
        console.log(events2);

        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,dayGridWeek,list',
                center: 'title',
            },
            selectable: true,
            themeSystem: 'bootstrap',
            events: events2,
            timeFormat: 'H(:mm)t',
            eventClick: function(info) {
                var _details = document.getElementById('event-details-modal');
                var id = info.event.id;

                var eventData = scheds.find(event => event.id == id);

                if (eventData) {
                    document.getElementById('event-title').textContent = eventData.title;
                    document.getElementById('event-description').textContent = eventData.description;
                    document.getElementById('event-seance').textContent = eventData.Seance;
                    document.getElementById('event-start').textContent = new Date(eventData.start).toLocaleString();
                    document.getElementById('show').setAttribute('href', `appointment-view.php?id=${eventData.urlshow}`);
                    document.getElementById('delete').setAttribute('data-id', id);

                    document.getElementById('event-Case').innerHTML = eventData.consult_status 
                        ? `<span class="badge badge-success px-3 py-1">Terminé</span>`
                        : `<span class="badge badge-warning px-3 py-1">Non terminé</span>`;

                    document.getElementById('event-Arrive').innerHTML = eventData.arrive_status 
                        ? `<span class="badge badge-success px-3 py-1">Arrivé</span>`
                        : `<span class="badge badge-warning px-3 py-1">En route</span>`;

                    document.getElementById('event-Status').innerHTML = eventData.status 
                        ? `<span class="badge badge-success px-3 py-1">Confirmé</span>`
                        : `<span class="badge badge-warning px-3 py-1">En attente</span>`;

                    var modalInstance = new bootstrap.Modal(_details);
                    modalInstance.show();
                } else {
                    alert("Événement indéfini");
                }
            },
            editable: true
        });

        calendar.render();

        document.getElementById('schedule-form').addEventListener('reset', function() {
            var form = this;
            form.querySelectorAll('input[type="hidden"]').forEach(input => input.value = '');
            var firstVisibleInput = Array.from(form.querySelectorAll('input')).find(input => input.offsetParent !== null);
            if (firstVisibleInput) {
                firstVisibleInput.focus();
            }
        });

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

    document.getElementById('delete').addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        var eventData = scheds.find(event => event.id == id);
        
        if (eventData) {
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce rendez-vous ?");
            if (confirmation === true) {
                // Rediriger vers l'URL de suppression (en supposant que vous gérez la suppression côté serveur)
                window.location.href = "./App_delete_event.php?id=" + id;
            }
        } else {
            alert("Événement indéfini");
        }
    });
</script>
</body>
</html>
