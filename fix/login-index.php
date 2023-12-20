<?php
session_start();
require('./vendor/autoload.php');

# Add your client ID and Secret
$client_id = "326511344097-fk47mtu148fm1sigdauqthvgvo8m97eu.apps.googleusercontent.com";
$client_secret = "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";

$client = new Google\Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);

# redirection location is the path to login.php
$redirect_uri = 'https://21102117.kelasmm3.cloud/21102117-mm3-pw2324/capstone-fix/login-index.php';
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
# the createAuthUrl() method generates the login URL.
$login_url = $client->createAuthUrl();
/* 
 * After obtaining permission from the user,
 * Google will redirect to the login.php with the "code" query parameter.
*/
if (isset($_GET['code'])):

  session_start();
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  if(isset($token['error'])){
    header('Location: index.php');
    exit;
  }
  $_SESSION['token'] = $token;

  /* -- Inserting the user data into the database -- */

  # Fetching the user data from the google account
  $client->setAccessToken($token);
  $google_oauth = new Google_Service_Oauth2($client);
  $user_info = $google_oauth->userinfo->get();

  $google_id = trim($user_info['id']);
  $f_name = trim($user_info['given_name']);
  $l_name = trim($user_info['family_name']);
  $email = trim($user_info['email']);
  $password = trim($user_info['password']);
  $gender = trim($user_info['gender']);
  $local = trim($user_info['local']);
  $picture = trim($user_info['picture']);
  $role = trim($user_info['role']);

  # Database connection
  require('ceklogin.php');

  # Checking whether the email already exists in our database.
  $check_email = $conn->prepare("SELECT `email` FROM `users` WHERE `email`=?");
  $check_email->bind_param("s", $email);
  $check_email->execute();
  $check_email->store_result();

  if($check_email->num_rows === 0){
    $default_role = 'member';
    # Inserting the new user into the database
    $query_template = "INSERT INTO `users` (`oauth_uid`, `first_name`, `last_name`, `email`,`password`, `gender`, `local`, `profile_pic`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($query_template);
    
    // Adjust the number of parameters to match the number of placeholders
    $insert_stmt->bind_param("sssssssss", $google_id, $f_name, $l_name, $email, $password, $gender, $local, $picture, $default_role);
    

if (!$insert_stmt->execute()) {
    echo "Failed to insert user.";
    exit;
}
  }
  else {
    # User already exists, retrieve the role
    $check_email->bind_result($email);
    $check_email->fetch();
}

$_SESSION['user_role'] = $role; // 
$_SESSION['first_name'] =  $f_name;

  header('Location: kegiatan.php');
  exit;

endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
    <title>Login_page</title>
</head>

<body>

    <!-- Main Container -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- Login Container -->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!-- Left Box with Carousel -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: linear-gradient(157deg, #190482 48%, rgba(25, 4, 130, 0) 100%);">
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/sleep-1.png" class="d-block w-100" alt="Image 1">
                        </div>
                        <div class="carousel-item">
                            <img src="img/sleep-2.png" class="d-block w-100" alt="Image 2">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be
                    Verified</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on
                    this platform.</small>
            </div>


            <!-- Right Box -->
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Hello, Again</h2>
                        <p>We are happy to have you back.</p>
                    </div>
                    <form action="kegiatan_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6"
                            name="email" placeholder="Email address">
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control form-control-lg bg-light fs-6"
                            name="password" placeholder="Password">
                    </div>
                    <?php if (isset($_GET['msg'])): ?>
						<small class="text-danger"><?= $_GET['msg'];  ?></small>
					<?php endif ?>
                    <div class="input-group mb-3 mt-3">
                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                    </div>
                    </form>
                    <div class="input-group mb-3">
                    <a href="<?= $login_url ?>" class="btn btn-lg btn-light w-100 fs-6"><img src="img/google.png" style="width:20px"
                                class="me-2"><small>Sign In with Google</small></a>
                    </div>
                    <div class="row">
                        <small>Don't have account? <a href="regist_kegiatan.php">Sign Up</a></small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS (tanpa atribut integrity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>



</body>
</html>