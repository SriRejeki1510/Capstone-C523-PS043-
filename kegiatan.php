
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Question</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Style -->
    <link href="css/kegiatan.css" rel="stylesheet">

    <!-- Sertakan file JavaScript di sini -->
   
</head>

<body>
    <div class="container-fluid">
        <form class="mx-auto" method="POST" action="proces_kegiatan.php">
            <h1 class="mb-4">Berapa Lama Kesibukkan mu?</h1>
            <p class="mb-4">Pilih seberapa lama kesibukkan mu berlangsung</p>
            <div class="button-container">
                <button type="submit" class="btn btn-primary form-button" name="activity_duration" value="6">6 jam</button>
                <button type="submit" class="btn btn-primary form-button" name="activity_duration" value="8">8 jam</button>
                <button type="submit" class="btn btn-primary form-button" name="activity_duration" value="10 jam">10 jam</button>
            </div>
            <div class="button-container">
                <button type="submit" class="btn btn-primary form-button" name="activity_duration" value="12">12 jam</button>
                <button type="submit" class="btn btn-primary form-button" name="activity_duration" value="14">14 jam</button>
                <button type="submit" class="btn btn-primary form-button" name="activity_duration" value="18">18 jam</button>
            </div>
        </form>

        <!-- Display the recommendation message -->
        <?php if (!empty($recommendation)) : ?>
            <p class="mb-4"><?php echo $recommendation; ?></p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
