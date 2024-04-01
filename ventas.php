<!DOCTYPE html>
<html>
<head>
    <title>Búsqueda de ventas por nombre de producto</title>
</head>
<body>
    <h1>Búsqueda de ventas</h1>
    <form action="ventas.php" method="GET">
        Nombre del producto:
        <input type="text" name="nombre_producto">
        <input type="submit" value="Buscar">
    </form>
    <?php
        // Incluir archivo de conexión
        include "conexion.php";

        try {
            // Establecer conexión a la base de datos
            $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consultar y mostrar todas las filas de la tabla ventas antes de la consulta
            $consultaInicial = $conn->query("SELECT * FROM ventas");
    ?>
    <h2>Tabla de ventas</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad Vendida</th>
            <th>Precio Total</th>
            <th>Fecha de Venta</th>
        </tr>
        <?php
        while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td>
                    <?php
                    // Obtener el nombre del producto utilizando el ID del producto
                    $id_producto = $row["id_producto"];
                    $consulta_producto = $conn->prepare("SELECT nombre_producto FROM inventario_farmacia WHERE id = :id_producto");
                    $consulta_producto->bindParam(':id_producto', $id_producto);
                    $consulta_producto->execute();
                    $producto = $consulta_producto->fetch(PDO::FETCH_ASSOC);
                    echo $producto["nombre_producto"];
                    ?>
                </td>
                <td><?php echo $row["cantidad_vendida"]; ?></td>
                <td><?php echo $row["precio_total"]; ?></td>
                <td><?php echo $row["fecha_venta"]; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php

    if(isset($_GET["nombre_producto"])){
        // Obtener y sanitizar el nombre del producto
        $nombre_producto = filter_input(INPUT_GET, 'nombre_producto', FILTER_SANITIZE_STRING);
        echo "Búsqueda por nombre de producto: $nombre_producto";

        // Preparar y ejecutar la consulta
        $consultaSQL = $conn->prepare("SELECT * FROM ventas WHERE id_producto = (SELECT id FROM inventario_farmacia WHERE nombre_producto = :nombre_producto)");
        $consultaSQL->bindParam(':nombre_producto', $nombre_producto);
        $consultaSQL->execute();
    ?>
    <h2>Resultados de la búsqueda</h2>
    <table border="1">
        <tr>
            <th>Nombre del Producto</th>
            <th>Cantidad Vendida</th>
            <th>Precio Total</th>
            <th>Fecha de Venta</th>
        </tr>
        <?php
        // Mostrar los resultados de la consulta en forma de tabla
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td>
                    <?php
                    // Obtener el nombre del producto utilizando el ID del producto
                    $id_producto = $row["id_producto"];
                    $consulta_producto = $conn->prepare("SELECT nombre_producto FROM inventario_farmacia WHERE id = :id_producto");
                    $consulta_producto->bindParam(':id_producto', $id_producto);
                    $consulta_producto->execute();
                    $producto = $consulta_producto->fetch(PDO::FETCH_ASSOC);
                    echo $producto["nombre_producto"];
                    ?>
                </td>
                <td><?php echo $row["cantidad_vendida"]; ?></td>
                <td><?php echo $row["precio_total"]; ?></td>
                <td><?php echo $row["fecha_venta"]; ?></td>
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


