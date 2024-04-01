<?php
include("conexion.php");

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

if (isset($_POST['registro'])) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $direccion = trim($_POST['direccion']);
    $telefono = trim($_POST['telefono']);
    $contrasena = trim($_POST['contrasena']);
    $fecha = date("Y-m-d"); // Formato de fecha compatible con MySQL

    // Validar que la contraseña contenga al menos una mayúscula, una minúscula y un número
    if (
        strlen($nombre) >= 1 &&
        strlen($email) >= 1 &&
        strlen($direccion) >= 1 &&
        strlen($telefono) >= 1 &&
        preg_match('/[A-Z]/', $contrasena) &&
        preg_match('/[a-z]/', $contrasena) &&
        preg_match('/\d/', $contrasena)
    ) {
        // Cifrar la contraseña
        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

        try {
            $consulta = "INSERT INTO datos (nombre, email, direccion, telefono, contrasena, fecha)
                         VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($consulta);
            $stmt->execute([$nombre, $email, $direccion, $telefono, $contrasena_cifrada, $fecha]);

            $mensaje = "Tu registro fue exitoso";
            $claseMensaje = "success";
        } catch (PDOException $e) {
            $mensaje = "Algo salió mal - error: " . $e->getMessage();
            $claseMensaje = "error";
        }
    } else {
        $mensaje = "La contraseña debe contener al menos una mayúscula, una minúscula y un número.";
        $claseMensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form method="POST">

        <h2>Hola</h2>
        <p>Inicia tu registro</p>

        <div class="input-wrapper">
            <input type="text" name="nombre" placeholder="Nombre">
            <img class="input-icon" src="images/name.svg" alt="Icono de Nombre">
        </div>

        <div class="input-wrapper">
            <input type="email" name="email" placeholder="Email">
            <img class="input-icon" src="images/email.svg" alt="Icono de Email">
        </div>

        <div class="input-wrapper">
            <input type="text" name="direccion" placeholder="Dirección">
            <img class="input-icon" src="images/direction.svg" alt="Icono de Dirección">
        </div>

        <div class="input-wrapper">
            <input type="text" name="telefono" placeholder="Teléfono">
            <img class="input-icon" src="images/phone.svg" alt="Icono de Teléfono">
        </div>

        <div class="input-wrapper">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <img class="input-icon" src="images/password.svg" alt="Icono de Contraseña"><br>
        </div>

        <input class="btn" type="submit" name="registro" value="Enviar"><br>  

        <!-- Sección para mostrar el mensaje -->
        <?php if(isset($mensaje)): ?>
            <div class="<?php echo $claseMensaje; ?>"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <a href="login.php" class="link-button">Iniciar Sesión</a> 
    </form>     
</body>
</html>