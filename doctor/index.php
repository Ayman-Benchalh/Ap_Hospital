<?php
require_once('../config/autoload.php');
include('includes/path.inc.php');
include('includes/session.inc.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include CSS_PATH; ?>
    <link rel="stylesheet" href="../assets/css/clinic/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>

<body>
    <?php include NAVIGATION; ?>
    <div class="page-content" id="content">
        <?php include HEADER; ?>
        <!-- Contenu de la page -->
        <?php include WIDGET; ?>
        <div class="row">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                        <script>
                            Chart.platform.disableCSSInjection = true;
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Août", "Sep", "Oct", "Nov", "Déc"],
                                    datasets: [{
                                        label: '# de Rendez-vous',
                                        data: [
                                            <?php
                                            $month_array = array("jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec");
                                            foreach ($month_array as $key => $month_value) {
                                                $result = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM appointment WHERE MONTH(app_date) = '" . ++$key . "' AND doctor_id = '" . $doctor_row['doctor_id'] . "' AND consult_status = 1 "));
                                                echo "$result,";
                                            }
                                            ?>
                                        ],
                                        backgroundColor: [
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Rendez-vous visités"
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                scaleIntegersOnly: true,
                                                stepSize: 1,
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="LineChart"></canvas>
                        <script>
                            Chart.platform.disableCSSInjection = true;
                            var ctx = document.getElementById('LineChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: [
                                        <?php
                                        $idquery = array();
                                        $result = mysqli_query($conn,"SELECT DISTINCT app_time FROM appointment WHERE doctor_id = ".$doctor_row['doctor_id']." ORDER BY app_time DESC");
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo '"'.$row['app_time'].'",';
                                            $idquery[] = $row["app_time"];
                                        }
                                        ?>
                                    ],
                                    datasets: [{
                                        label: '# de Rendez-vous',
                                        data: [
                                            <?php
                                            foreach ($idquery as $arrvalue) {
                                                $newsql = "SELECT * FROM appointment WHERE app_time = '$arrvalue' AND consult_status = 1 ";
                                                $idnum = mysqli_num_rows(mysqli_query($conn,$newsql));
                                                echo $idnum.',';
                                            }
                                            ?>
                                        ],
                                        fill: false,
                                        borderColor: 'rgba(255, 206, 86, 1)',
                                        backgroundColor: 'rgba(255, 206, 86, 1)',
                                        borderWidth: 3
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: 'Analyse des horaires de rendez-vous visités',
                                    },
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Fin du contenu de la page -->
    </div>
    <?php include JS_PATH; ?>
</body>

</html>
