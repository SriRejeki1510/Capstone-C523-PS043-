<?php
session_start();

$title = 'Chart';
$conn = mysqli_connect('localhost', 'root', '', 'capstone');
require 'layout_header.php';

// Fetch data from the database for all users
$query = "SELECT day_of_week, SUM(activity_duration) AS total_duration FROM user_data GROUP BY day_of_week ORDER BY FIELD(day_of_week, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')";
$stmt = mysqli_prepare($conn, $query);

// Check if the preparation was successful
if ($stmt) {
    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    $dataPoints = array();

    // Fetch data and organize it for the chart
    while ($row = mysqli_fetch_assoc($result)) {
        $dataPoints[] = array("y" => (int) $row['total_duration'], "label" => $row['day_of_week']);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
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
            var chart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Rekap data aktivitas"
                },
                axisY: {
                    title: "Activity Duration"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
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
                    <!-- Chart Container -->
                    <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
require 'layout_footer.php';
?>
