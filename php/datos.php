<?php
    include('./conexion.php');
    session_start();
    $nro_doc=$_SESSION["doc"];
    $sql = "SELECT nombres, contrasena FROM usuario WHERE nro_doc = '$nro_doc'";
    $res=mysqli_query($con,$sql);
    $fila=mysqli_fetch_assoc($res);
    $p_hash=$fila["contrasena"];
    $_SESSION["nombres"] = $fila["nombres"];
    echo json_encode(['nombre' => $_SESSION["nombres"]]);
    

?>