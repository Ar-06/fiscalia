<?php
    session_start();
    if (!isset($_SESSION["nombres"])) {
        /* header("location: ../client/login.html"); */
        echo "Sesión no iniciada";
        exit;
    }
    $nombre_usuario = $_SESSION["nombres"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="welcome">
        <h1 id="user">Bienvenido(a), <?php echo htmlspecialchars ($nombre_usuario); ?></h1>
    </div>
    <div class="container2">
        <a class="form_denuncia" href="./formulario_denuncia.html">
            <div class="section registrar">
                <img src="https://cdn.icon-icons.com/icons2/2596/PNG/512/log_icon_155172.png" alt="Icono Registrar">
                <p>Realiza tu denuncia</p>
            </div>
        </a>
        <a class="form_seguimiento" href="./seguimiento.html">
            <div class="section seguimiento">
                <img src="https://cdn-icons-png.flaticon.com/512/4829/4829845.png" alt="Icono Seguimiento">
                <p>Sigue tus denuncias</p>
            </div>
        </a>
        <a class="form_logout" href="../php/logout.php">
            <div class="section cerrar">
                <img src="https://cdn4.iconfinder.com/data/icons/starup-business-3/120/logout_exit_sign_out_leave_quit-512.png" alt="Icono Cerrar">
                <p>Cerrar sesión</p>
            </div>
        </a>
    </div>
</body>
</html>
