<?php
    include('./conexion.php');

    $nombres=$_POST["nombres"];
    $fecha=$_POST["fecha"];
    $celular=$_POST["celular"];
    $direccion=$_POST["direccion"];

    $sql = "UPDATE usuario
    SET nombres = '$nombres', fecha_nac = '$fecha', celular = '$celular', direccion = '$direccion'
    WHERE nro_doc = '$num'";

    if(mysqli_query($con, $sql)===TRUE){
        header("location: ../client/index.html");
    }else{
        exit;
    }
?>