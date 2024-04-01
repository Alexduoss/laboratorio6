<?php
include("conexion.php");

$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $contrasena = trim($_POST['contrasena']);

    if (empty($email) || empty($contrasena)) {
        $mensaje = "Por favor, ingresa tu correo electrónico y contraseña.";
        $claseMensaje = "error";
    } else {
        try {
            $consulta = "SELECT * FROM datos WHERE email = ?";
            $stmt = $conn->prepare($consulta);
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['email'] = $usuario['email'];
                $_SESSION['nombre'] = $usuario['nombre'];
                header("Location: main.php"); // Redirige al archivo principal
                exit;
            } else {
                $mensaje = "Correo electrónico o contraseña incorrectos.";
                $claseMensaje = "error";
            }
        } catch (PDOException $e) {
            $mensaje = "Error al iniciar sesión: " . $e->getMessage();
            $claseMensaje = "error";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form method="POST" action="login.php">

        <h2>Iniciar Sesión</h2>

        <div class="input-wrapper">
            <input type="email" name="email" placeholder="Email">
            <img class="input-icon" src="images/email.svg" alt="Icono de Email">
        </div>

        <div class="input-wrapper">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <img class="input-icon" src="images/password.svg" alt="Icono de Contraseña"><br>
        </div>

        <input class="btn" type="submit" name="login" value="Iniciar Sesión"><br>  

        <!-- Sección para mostrar el mensaje -->
        <?php if(isset($mensaje)): ?>
            <div class="<?php echo $claseMensaje; ?>"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <a href="registro.php" class="link-button">Registrarse</a> 
        <a href="contrasena.php" class="link-button">¿olvido su contraseña?</a> 
    </form>     
</body>
</html>




