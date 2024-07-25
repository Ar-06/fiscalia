<?php
    include('conexion.php');
    $nro_doc = $_POST["nro-doc"];
    $contra = $_POST["contraseña"];
    $sql = "SELECT contrasena FROM usuario WHERE nro_doc = '$nro_doc'";
    $res=mysqli_query($con,$sql);
    $fila=mysqli_fetch_assoc($res);
    $p_hash=$fila["contrasena"];
    if(password_verify($contra,$p_hash) === TRUE){
        header("location: /index.html");
    }
    else{
        header("location: /login.html");
    }
?>
