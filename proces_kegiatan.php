<?php
    session_start(); // Start the session
    require('ceklogin.php');
    
    function hari_ini()
    {
        $hari = date("D");

        switch ($hari) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return $hari_ini;
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the selected activity duration
        $activityDuration = $_POST['activity_duration'];

        

        // Get the current date and time
        $currentDateTime = date('Y-m-d H:i:s'); // Format: Year-Month-Day Hour:Minute:Second

        // Get the day of the week
        $dayOfWeek = hari_ini(); // Use the hari_ini function to get the day of the week

        // Get the username from the session
        $first_name = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';

        $recommendation = isset($_SESSION['recommendation']) ? $_SESSION['recommendation'] : '';
        // Set the initial recommendation message
        $recommendation = '';

        //get data recomendation
            // $hasil = mysql_query("SELECT * FROM user_data WHERE recommendation = 1") or die(mysql_error());

            // $row = mysql_fetch_array($hasil);

            // echo "recommendation : " .$row['recommendation'];

        // Check the activity duration and provide a recommendation
        if ($activityDuration > 12) {
            $recommendation = 'Anda sangat butuh istirahat.';
        } elseif ($activityDuration > 10) {
            $recommendation = 'Anda butuh istirahat.';
        } else {
            $recommendation = 'Cukup istirahat.';
        }

        // Insert the data into the database (replace with your database connection code)

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL query
        $query = "INSERT INTO user_data (first_name, activity_duration, input_date, is_lack_of_sleep, day_of_week, recommendation) 
                VALUES (?, ?, ?, 0, ?, ?)";

        // Check if the activity duration is greater than 12 hours and flag as 'is_lack_of_sleep'
        if ($activityDuration > 12) {
            $query = "INSERT INTO user_data (first_name, activity_duration, input_date, is_lack_of_sleep, day_of_week, recommendation) 
                    VALUES (?, ?, ?, 1, ?, ?)";
        }

        // Prepare and execute the statement
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            die("Preparation failed: " . mysqli_error($conn));
        }

        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "sisss", $first_name, $activityDuration, $currentDateTime, $dayOfWeek, $recommendation);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Close the connection
        mysqli_close($conn);

        header('Location: rate.php'); // Redirect to a success page or wherever you want
    } else {
        // Redirect to the form page if accessed directly without form submission
        header('Location: index.php');
    }
    ?>
