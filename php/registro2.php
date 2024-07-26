<?php
    include('./conexion.php');
    session_start();

    if (!isset($_SESSION["doc"])) {
        // Redirigir al usuario a la página de inicio de sesión si no hay sesión iniciada
        header("location: ../client/login.html");
        exit;
    }

    $numDoc = $_SESSION["doc"];
    $nombres = $_POST["nombres"];
    $fecha = $_POST["fecha"];
    $celular = $_POST["celular"];
    $direccion = $_POST["direccion"];

    // Usar declaraciones preparadas para prevenir inyecciones SQL
    $stmt = $con->prepare("UPDATE usuario SET nombres = ?, fecha_nac = ?, celular = ?, direccion = ? WHERE nro_doc = ?");
    $stmt->bind_param("ssssi", $nombres, $fecha, $celular, $direccion, $numDoc);

    if ($stmt->execute()) {
        $_SESSION["nombres"] = $nombres;
        header("location: ../client/login.html");
        exit;
    } else {
        // Manejar el error en la ejecución
        echo "Error: " . $stmt->error;
        exit;
    }

    $stmt->close();
    $con->close();
?>
