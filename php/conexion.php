<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'fiscalia';
    $con = mysqli_connect($host,$user,$pass,$db);
    if($con){
        echo "<script>console.log('Conexión establecida con la base de datos.')</script>";
    }
    else{
        echo "<script>console.log('Conexión fallida.')</script>";
        exit;
    }
?>