-- Todos los productos del inventario con fecha de vencimiento el lunes:
SELECT *
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-01-01';


SELECT nombre_producto, cantidad, precio_unitario
FROM inventario_farmacia
WHERE proveedor = 'Farmacias ABC''Distribuidora XYZ';

-- Todos los productos del inventario con fecha de vencimiento el lunes, mostrando solo ciertas columnas:
SELECT nombre_producto, cantidad, precio_unitario, fecha_vencimiento, proveedor, ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-01-01';

-- Todos los productos del inventario con fecha de vencimiento el martes:
SELECT *
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-01-02';

-- Todos los productos del inventario con fecha de vencimiento el martes, mostrando solo ciertas columnas:
SELECT nombre_producto, cantidad, precio_unitario, fecha_vencimiento, proveedor, ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-01-02';

-- Todos los productos del inventario con fecha de vencimiento el martes y el miércoles:
SELECT *
FROM inventario_farmacia
WHERE fecha_vencimiento IN ('2024-01-02', '2024-01-03');

-- Todos los productos del inventario con fecha de vencimiento el martes y el miércoles, mostrando solo ciertas columnas:
SELECT nombre_producto, cantidad, precio_unitario, fecha_vencimiento, proveedor, ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento IN ('2024-01-02', '2024-01-03');

-- Todos los productos del inventario con fecha de vencimiento el lunes con alias de columnas:
SELECT nombre_producto AS producto, cantidad AS cantidad_disponible, precio_unitario AS precio, fecha_vencimiento AS vencimiento, proveedor AS proveedor, ubicacion AS ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-01-01';

-- Todos los productos del inventario con fecha de vencimiento el martes con alias de columnas:
SELECT nombre_producto AS producto, cantidad AS cantidad_disponible, precio_unitario AS precio, fecha_vencimiento AS vencimiento, proveedor AS proveedor, ubicacion AS ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-12-31';

-- Combinar los resultados de las consultas anteriores con UNION:
SELECT nombre_producto AS producto, cantidad AS cantidad_disponible, precio_unitario AS precio, fecha_vencimiento AS vencimiento, proveedor AS proveedor, ubicacion AS ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-12-31'
UNION
SELECT nombre_producto AS producto, cantidad AS cantidad_disponible, precio_unitario AS precio, fecha_vencimiento AS vencimiento, proveedor AS proveedor, ubicacion AS ubicacion
FROM inventario_farmacia
WHERE fecha_vencimiento = '2024-11-30';
