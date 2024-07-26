<?php
include('conexion.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nro_doc = $_POST["nro_doc"];
    $contra = $_POST["contraseña"];

    // Consulta para obtener el hash de la contraseña
    $stmt = $con->prepare("SELECT nombres, contrasena FROM usuario WHERE nro_doc = ?");
    if ($stmt === false) {
        echo "<script>console.log('Error en la preparación de la consulta');</script>"; 
        exit;
    }

    $stmt->bind_param("s", $nro_doc);

    if (!$stmt->execute()) {
        echo "<script>console.log('Error en la ejecución de la consulta');</script>";
        exit;
    }

    $stmt->bind_result($nombres, $contrasena);

    if (!$stmt->fetch()) {
        echo "<script>console.log('No se encontraron resultados');</script>";
        header("Location: ../client/login.html");
        exit;
    }

    $stmt->close();

    // Verificar que se obtuvo un hash
    if (!$contrasena) {
        echo "<script>console.log('Usuario no encontrado');</script>";
        exit;
    }

    // Verificación de la contraseña
    if (password_verify($contra, $contrasena)) {
        $_SESSION["doc"] = $nro_doc;
        $_SESSION["nombres"] = $nombres;
        header("Location: ../client/index.php");
        exit;
    } else {
        echo "<script>console.log('Contraseña incorrecta');</script>";
        exit;
    }
} else {
    echo "<script>console.log('Solicitud no es POST');</script>";
    exit;
}

$con->close();
?>
