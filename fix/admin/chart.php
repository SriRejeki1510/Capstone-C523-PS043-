<?php
session_start();

$title = 'Chart';
require 'functions.php';
require 'layout_header.php';

// Fetch data from the database for all users
$queryAllUsers = "SELECT day_of_week, SUM(activity_duration) AS total_duration, COUNT(*) AS duration_count 
                  FROM user_data 
                  GROUP BY day_of_week
                  ORDER BY FIELD(day_of_week, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";
$stmtAllUsers = mysqli_prepare($conn, $queryAllUsers);

if ($stmtAllUsers) {
    mysqli_stmt_execute($stmtAllUsers);
    mysqli_stmt_bind_result($stmtAllUsers, $dayOfWeekAll, $totalDurationAll, $durationCountAll);

    $dataPointsAllUsers = array();

    while (mysqli_stmt_fetch($stmtAllUsers)) {
        $labelAll = $dayOfWeekAll . ' (' . $totalDurationAll . ' hours)';
        $dataPointsAllUsers[] = array("label" => $labelAll, "y" => (int)$durationCountAll);
    }

    mysqli_stmt_close($stmtAllUsers);
}

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Activity Duration Chart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include the combined JavaScript code here -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script>
        window.onload = function () {
            var chartAllUsers = new CanvasJS.Chart("chartContainerAllUsers", {
                title: {
                    text: "Rekap data aktivitas untuk Semua Pengguna"
                },
                axisY: {
                    title: "Activity Duration"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPointsAllUsers, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chartAllUsers.render();
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title"></h4>
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#"></a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="white-box">
                    <!-- Chart Container for All Users -->
                    <div id="chartContainerAllUsers" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
require 'layout_footer.php';
?>
