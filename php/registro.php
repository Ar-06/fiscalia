<?php
include('./conexion.php');
session_start();

$tipo = mysqli_real_escape_string($con, $_POST["TipoDoc"]);
$num = mysqli_real_escape_string($con, $_POST["numDoc"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$contra = $_POST["contraseña"];
$contra2 = $_POST["contraseña2"];


if ($contra !== $contra2) {
    header("location: /registro_usuario.html");
    exit;
}

$pass = password_hash($contra, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (nro_doc, tipo_doc, correo, contrasena) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'ssss', $num, $tipo, $email, $pass);
$res = mysqli_stmt_execute($stmt);
$_SESSION["doc"] = $num;


if ($res) {
    header("location: ../client/registro_usuario2.html");
} else {
    header("location: ../client/registro_usuario.html");
}
    
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
