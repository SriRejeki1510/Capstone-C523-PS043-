<?php
session_start();

$title = 'Rekap Durasi Aktivitas';
$conn = mysqli_connect('localhost', 'root', '', 'kelasmm3_capstone');
require 'layout_header.php';

// Retrieve the first_name parameter from the URL
$selected_first_name = isset($_GET['first_name']) ? $_GET['first_name'] : '';

// Fetch data from the database based on the selected first_name
$query = "SELECT day_of_week, activity_duration, COUNT(*) AS duration_count 
          FROM user_data 
          WHERE first_name = ? 
          GROUP BY day_of_week, activity_duration";
$stmt = mysqli_prepare($conn, $query);

// Check if the preparation was successful
if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "s", $selected_first_name);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    $dataPoints = array();

    // Fetch data and organize it for the chart
    while ($row = mysqli_fetch_assoc($result)) {
        $label = $row['day_of_week'] . ' (' . $row['activity_duration'] . ' hours)';
        $dataPoints[] = array("label" => $label, "y" => (int)$row['duration_count']);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Rekap Durasi Aktivitas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include the combined JavaScript code here -->
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
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
require 'layout_footer.php';
?>
