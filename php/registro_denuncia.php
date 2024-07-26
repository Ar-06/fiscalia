<?php
session_start();
include("./conexion.php");

$tipoDenuncia = $_POST['tipoDenuncia'];
$conoceAutor = $_POST['conoceAutor'];
$nombreAutor = isset($_POST['nombreAutor']) ? $_POST['nombreAutor'] : null;
$dniAutor = isset($_POST['dniAutor']) ? $_POST['dniAutor'] : null;
$descripcion = $_POST['txtvinculo'];
$tieneMedios = $_POST['cboindmedprob'];
$enlace = isset($_POST['enlace']) ? $_POST['enlace'] : null;

//Manejo de archivos

$archivoDireccion = null;

if (isset($_FILES['txtImage'])) {
    if ($_FILES['txtImage']['error'] == UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . "/evidencias/";
        
        // Ensure the target directory exists and is writable
        if (!is_dir($target_dir) && !mkdir($target_dir, 0777, true)) {
            die("Error creando el directorio de destino.");
        }

        // Ensure the target directory is writable
        if (!is_writable($target_dir)) {
            die("El directorio de destino no tiene permisos de escritura.");
        }

        $archivoDireccion = $target_dir . basename($_FILES["txtImage"]["name"]);

        if ($_FILES["txtImage"]["size"] > 10000000) { // Limit file size to 5MB
            die("El archivo es demasiado grande. El tamaño máximo permitido es de 10MB.");
        }

        if (!move_uploaded_file($_FILES["txtImage"]["tmp_name"], $archivoDireccion)) {
            die("Error subiendo el archivo.");
        }
        
        echo "Archivo subido con éxito.";
    } else {
        die("Error en la carga del archivo. Código de error: " . $_FILES['txtImage']['error']);
    }
} else {
    die("No se ha enviado ningún archivo.");
}



$nro_doc=$_SESSION["doc"];

// Inserción en la base de datos
$stmt = $con->prepare("INSERT INTO denuncia (tipo_denuncia, conoce_autor, nombres_imputado, dni_imputado, descripcion_hechos, medios_probatorios, direccion_archivo, enlace, fk_num_doc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $tipoDenuncia, $conoceAutor, $nombreAutor, $dniAutor, $descripcion, $tieneMedios, $archivoDireccion, $enlace, $nro_doc);

if ($stmt->execute()) {
    echo "Denuncia enviada exitosamente.";
    header("Location: ../client/index.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$con->close();










?>