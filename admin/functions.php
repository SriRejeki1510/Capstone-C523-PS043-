<?php 

session_start();
$servername = "localhost";
$database = "kelasmm3_capstonemm3";
$username = "kelasmm3_capstonemm3";
$db_password = "A{x4Ne[^0t@x";
$conn = mysqli_connect($servername, $username, $db_password, $database);

function ambildata($conn,$query){
    $data = mysqli_query($conn,$query);
    if (mysqli_num_rows($data) > 0) {
        while($row = mysqli_fetch_assoc($data)){
        $hasil[] = $row;
    }

    return $hasil;
    }
}

function bisa($conn,$query){
    $db = mysqli_query($conn,$query);

    if($db){
        return 1;
    }else{
        return 0;
    }
}



function ambilsatubaris($conn,$query){
    $db = mysqli_query($conn,$query);
    return mysqli_fetch_assoc($db);
}

function hapus($where,$table,$redirect){
    $query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
    echo $query;
}

?>