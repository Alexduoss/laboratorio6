<?php
include("conexion.php");

try {
    $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=$dbname", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

if (isset($_POST['reset_password'])) {
    $email = trim($_POST['email']);

    if (strlen($email) >= 1) {
        try {
            // Aquí necesitarías la lógica para restablecer la contraseña,
            // como enviar un correo electrónico con un enlace seguro o generar un código de restablecimiento.

            // Por ahora, simplemente mostrar un mensaje.
            echo "Se ha enviado un correo electrónico con instrucciones para restablecer la contraseña.";
        } catch (PDOException $e) {
            echo "Algo salió mal - error: " . $e->getMessage();
        }
    } else {
        echo "Por favor, ingresa tu correo electrónico.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form method="POST">

        <h2>Restablecer contraseña</h2>

        <div class="input-wrapper">
            <input type="email" name="email" placeholder="Email">
            <img class="input-icon" src="images/email.svg" alt="Icono de Email">
        </div>

        <input class="btn" type="submit" name="reset_password" value="Restablecer contraseña"><br>
        <a href="login.php" class="link-button">Iniciar Sesión</a>             
    </form>     
</body>
</html>
