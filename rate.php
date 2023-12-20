<?php
session_start();

$title = 'rate';

$conn = mysqli_connect('localhost', 'root', '', 'kelasmm3_capstone');
if(isset($_SESSION['first_name'])) {
    $recommendation = mysqli_query($conn, "SELECT * FROM user_data WHERE first_name='$_SESSION[first_name]'");
    if ($recommendation) {
        $reg = mysqli_fetch_array($recommendation);
    } else {
        echo "Kueri SQL gagal dieksekusi.";
    }
} else {
    echo "'id' tidak terdefinisi dalam sesi.";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating with Popup</title>
    <link rel="stylesheet" href="css/rate.css">
    <script src="https://kit.fontawesome.com/68c473c657.js" crossorigin="anonymous"></script>
</head>
<style>
    .popup{
        width:400px;
        height:450px;
    }
    .popup .button-popup{
        width:100%;
        
    }
</style>
<body>
    <div class="container">
        <div class="start-widget">
            <div class="rating-text">Bagaimana hari Anda</div>
            <input type="radio" name="rate" id="rate-5">
            <label for="rate-5" class="fas fa-star"></label>

            <input type="radio" name="rate" id="rate-4">
            <label for="rate-4" class="fas fa-star"></label>

            <input type="radio" name="rate" id="rate-3">
            <label for="rate-3" class="fas fa-star"></label>

            <input type="radio" name="rate" id="rate-2">
            <label for="rate-2" class="fas fa-star"></label>

            <input type="radio" name="rate" id="rate-1">
            <label for="rate-1" class="fas fa-star"></label>

            <form action="#" id="ratingForm">
                <header></header>
                <div class="textarea">
                    <textarea cols="30" placeholder="Describe your day.."></textarea>
                </div>

                <div class="btn">
                    <button type="button" onclick="openPopup()">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <div class="popup" id="popup">
        <img src="img/correct.png">
        <h2 id="popupText"></h2>
        <button type="button" class= "button-popup" onclick="closePopup()">Ok</button>
        <button type="button" class= "button-popup"onclick="editPost()">Edit</button>
    </div>

    <script>
        const widget = document.querySelector(".start-widget");

        function openPopup() {
            // Additional code to submit the rating data or perform any other actions
            // ...

            // Ubah pesan pada pop-up
            document.getElementById("popupText").innerText = "Terimakasih <?=$reg['first_name']?> Untuk Rating nya!";
            // Open the popup
            popup.classList.add("open-popup");
            fetchRecommendation();
        }
        

        function closePopup() {
            // Redirect to another page (adjust the URL accordingly)
            window.location.href = "home-login.php"; // Ganti dengan URL halaman lain
        }

        function editPost() {
            // Hapus komentar pada baris berikut jika ada langkah tambahan yang diperlukan sebelum kembali ke textarea
            // ...

            // Kembali ke halaman textarea
            widget.style.display = "block";
            popup.classList.remove("open-popup");
        }
    </script>
</body>

</html>