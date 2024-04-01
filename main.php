<?php
include("conexion.php");

// Conectar con la base de datos
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

session_start();

// Obtener datos del usuario actual
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $consulta = "SELECT * FROM datos WHERE email = ?";
    $stmt = $conn->prepare($consulta);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Inicializar la variable de mensaje
$mensaje = '';

// Procesar el formulario de actualización
if(isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    // Validar que la contraseña cumple con los requisitos
    if (
        preg_match('/[A-Z]/', $contrasena) &&
        preg_match('/[a-z]/', $contrasena) &&
        preg_match('/\d/', $contrasena)
    ) {
        // Cifrar la contraseña
        $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);

        // Actualizar los datos en la base de datos
        $actualizar = "UPDATE datos SET nombre=?, direccion=?, telefono=?, contrasena=? WHERE email=?";
        $stmt = $conn->prepare($actualizar);
        $stmt->execute([$nombre, $direccion, $telefono, $contrasena_cifrada, $email]);

        // Actualizar los datos en la sesión también
        $_SESSION['nombre'] = $nombre;

        // Mensaje de actualización exitosa
        $mensaje = '¡Tus datos han sido actualizados correctamente!';
    } else {
        $mensaje = "La contraseña debe contener al menos una mayúscula, una minúscula y un número.";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 10px;
        }

        .input-wrapper {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px;
            border: none;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Farmacia D2</h1>
    <h2>Consultar</h2>
        <div class="top-right-buttons">
            <a href="inventario.php">Inventario</a>
            <a href="ventas.php">Ventas</a>
            <a href="proveedores.php">proveedores</a>
        </div>

        
    </div>
</body>
<body>
    <div class="container">
        <h2>Actualizar Perfil</h2>
        <!-- Mensaje de actualización exitosa -->
        <?php if (!empty($mensaje)): ?>
            <div class="message"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-wrapper">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" placeholder="Nombre">
            </div>
            <div class="input-wrapper">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $usuario['direccion']; ?>" placeholder="Dirección">
            </div>
            <div class="input-wrapper">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $usuario['telefono']; ?>" placeholder="Teléfono">
            </div>
            <div class="input-wrapper">
                <label for="contrasena">Nueva Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" value="<?php echo $usuario['contrasena']; ?>" placeholder="Nueva Contraseña">
            </div>
            <input class="btn" type="submit" name="actualizar" value="Actualizar">
            <a href="login.php" class="btn">Salir</a>
        </form>
    </div>
</body>
</html>

