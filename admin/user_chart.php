<?php
session_start();

$title = 'Rekap Durasi Aktivitas';
require 'functions.php';
require 'layout_header.php';

$selected_first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';

$query = "SELECT day_of_week, activity_duration, COUNT(*) AS duration_count 
          FROM user_data 
          WHERE first_name = ? 
          GROUP BY day_of_week, activity_duration";
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $selected_first_name);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_bind_result($stmt, $dayOfWeek, $activityDuration, $durationCount);

    $dataPoints = array();

    while (mysqli_stmt_fetch($stmt)) {
        $label = $dayOfWeek . ' (' . $activityDuration . ' hours)';
        $dataPoints[] = array("label" => $label, "y" => (int)$durationCount);
    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Rekap Durasi Aktivitas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light2",
                animationEnabled: true,
                title: {
                    text: "Rekap Durasi Aktivitas"
                },
                data: [{
                    type: "pie",
                    indexLabel: "{y}",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabelPlacement: "inside",
                    indexLabelFontColor: "#36454F",
                    indexLabelFontSize: 18,
                    indexLabelFontWeight: "bolder",
                    legendText: "{label}",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        });
    </script>
</head>

<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row bg-title">
            <!-- Your header content -->
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <!-- Chart Container -->
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php require 'layout_footer.php'; ?>
