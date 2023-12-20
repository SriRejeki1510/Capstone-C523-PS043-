<?php
session_start();
require 'ceklogin.php';

if (isset($_POST['btn-simpan'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = 'member';

    // Check if email already exists
    $check_query = "SELECT COUNT(*) FROM `users` WHERE `email` = ?";
    $check_stmt = $db_connection->prepare($check_query);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();

    if ($count > 0) {
        $msg = 'email sudah digunakan';
        $check_stmt->close();  // Close the statement before redirect
        header('location:register.php?msg='.$msg);
        exit;
    }

    // Close the statement after use
    $check_stmt->close();

    // Inserting the new user into the database
    $query_template = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $db_connection->prepare($query_template);

    // Adjust the number of parameters to match the number of placeholders
    $insert_stmt->bind_param("sssss", $first_name, $last_name, $email, $password, $role);

    if (!$insert_stmt->execute()) {
        echo "Gagal menambahkan pengguna.";
        exit;
    }
} else {
    // User already exists, retrieve the role
    $check_email->bind_result($email);
    $check_email->fetch();
}

$_SESSION['user_role'] = $role;
$_SESSION['first_name'] =  $first_name;


header('Location: kegiatan.php');
exit;

// Close database connection
$db_connection->close();
?>
