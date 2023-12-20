<?php
session_start();
$servername = "localhost";
$database = "kelasmm3_capstonemm3";
$username = "kelasmm3_capstonemm3";
$db_password = "A{x4Ne[^0t@x";
$conn = mysqli_connect($servername, $username, $db_password, $database);

$email = stripslashes($_POST['email']);
$password = md5($_POST['password']);

// Check "users" table
$user_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$user_count = mysqli_num_rows($user_result);

// Check "admin" table
$admin_query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
$admin_result = mysqli_query($conn, $admin_query);
$admin_data = mysqli_fetch_assoc($admin_result);
$admin_count = mysqli_num_rows($admin_result);

if ($user_count > 0) {
    $_SESSION['role'] = 'member';
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['id'] = $user_data['id'];
    $_SESSION['first_name'] = $user_data['first_name'];
    header('location:kegiatan.php');
} elseif ($admin_count > 0) {
    $_SESSION['role'] = 'admin';
    $_SESSION['email'] = $admin_data['email'];
    $_SESSION['id'] = $admin_data['id'];
    header('location:admin/pengguna.php');
} else {
    $msg = 'Username atau Password Salah';
    header('location:index.php?msg=' . $msg);
}
