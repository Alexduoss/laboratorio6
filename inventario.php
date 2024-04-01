<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de productos por día de vencimiento</title>
</head>
<body>
    <h1>Búsqueda de productos por día de vencimiento</h1>
    <form action="inventario.php" method="GET">
        Día de vencimiento a buscar:
        <input type="date" name="fecha_vencimiento">
        <input type="submit" value="Buscar">
    </form>

    <?php
    // Incluir archivo de conexión
    include "conexion.php";

    try {
        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar y mostrar todas las filas de la tabla inventario_farmacia antes de la consulta
        $consultaInicial = $conn->query("SELECT * FROM inventario_farmacia");
    ?>
    <h2>Tabla de inventario</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Fecha de Vencimiento</th>
            <th>Proveedor</th>
            <th>Ubicación</th>
        </tr>
        <?php
        while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["nombre_producto"]; ?></td>
            <td><?php echo $row["descripcion"]; ?></td>
            <td><?php echo $row["cantidad"]; ?></td>
            <td><?php echo $row["precio_unitario"]; ?></td>
            <td><?php echo $row["fecha_vencimiento"]; ?></td>
            <td><?php echo $row["proveedor"]; ?></td>
            <td><?php echo $row["ubicacion"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php

        if(isset($_GET["fecha_vencimiento"])){
            // Obtener y sanitizar la fecha de vencimiento
            $fecha_vencimiento = filter_input(INPUT_GET, 'fecha_vencimiento', FILTER_SANITIZE_STRING);
            echo "Búsqueda por día de vencimiento: $fecha_vencimiento";

            // Preparar y ejecutar la consulta
            $consultaSQL = $conn->prepare("SELECT * FROM inventario_farmacia WHERE fecha_vencimiento = :fecha_vencimiento");
            $consultaSQL->bindParam(':fecha_vencimiento', $fecha_vencimiento);
            $consultaSQL->execute();
    ?>
            <h2>Resultados de la búsqueda</h2>
            <table border="1">
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Proveedor</th>
                    <th>Ubicación</th>
                </tr>
                <?php
                // Mostrar los resultados de la consulta en forma de tabla
                while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><?php echo $row["nombre_producto"]; ?></td>
                    <td><?php echo $row["descripcion"]; ?></td>
                    <td><?php echo $row["cantidad"]; ?></td>
                    <td><?php echo $row["precio_unitario"]; ?></td>
                    <td><?php echo $row["fecha_vencimiento"]; ?></td>
                    <td><?php echo $row["proveedor"]; ?></td>
                    <td><?php echo $row["ubicacion"]; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
    <?php
        }
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
    ?>
</body>
</html>

