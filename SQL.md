```
CREATE TABLE inventario_farmacia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255) NOT NULL,
    descripcion VARCHAR(1000),
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    fecha_vencimiento DATE,
    proveedor VARCHAR(255),CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    cantidad_vendida INT NOT NULL,
    precio_total DECIMAL(10, 2) NOT NULL,
    fecha_venta DATE NOT NULL,
    FOREIGN KEY (id_producto) REFERENCES inventario_farmacia(id)
);

    ubicacion VARCHAR(100)
);

```

INSERT INTO inventario_farmacia (nombre_producto, descripcion, cantidad, precio_unitario, fecha_vencimiento, proveedor, ubicacion) VALUES
('Aspirina', 'Analgésico, antipirético y antiinflamatorio utilizado para tratar el dolor leve a moderado y la fiebre.', 120, 4.99, '2024-10-31', 'Farmacias ABC', 'Estante A'),
('Loratadina', 'Antihistamínico utilizado para aliviar los síntomas de alergias estacionales como la congestión nasal y la picazón en los ojos.', 60, 8.49, '2024-09-30', 'Distribuidora XYZ', 'Estante B'),
('Sildenafil', 'Medicamento utilizado para tratar la disfunción eréctil.', 40, 15.99, '2025-01-15', 'Laboratorio Farmacéutico PQR', 'Estante C'),
('Insulina', 'Hormona utilizada para el tratamiento de la diabetes mellitus.', 30, 25.99, '2025-04-30', 'Farmacéutica ABC', 'Estante D');

INSERT INTO inventario_farmacia (nombre_producto, descripcion, cantidad, precio_unitario, fecha_vencimiento, proveedor, ubicacion) VALUES
('Paracetamol', 'Analgésico y antipirético comúnmente utilizado para tratar el dolor y la fiebre.', 100, 5.99, '2024-12-31', 'Farmacias ABC', 'Estante A'),
('Ibuprofeno', 'Antiinflamatorio no esteroideo utilizado para aliviar el dolor y reducir la fiebre.', 80, 7.49, '2024-11-30', 'Distribuidora XYZ', 'Estante B'),
('Amoxicilina', 'Antibiótico utilizado para tratar una variedad de infecciones bacterianas.', 50, 12.99, '2025-03-15', 'Laboratorio Farmacéutico PQR', 'Estante C'),
('Omeprazol', 'Inhibidor de la bomba de protones utilizado para tratar úlceras gástricas y enfermedades relacionadas con el ácido.', 60, 9.99, '2025-06-30', 'Farmacéutica ABC', 'Estante D');


**tabla ventas**

```
CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    cantidad_vendida INT NOT NULL,
    precio_total DECIMAL(10, 2) NOT NULL,
    fecha_venta DATE NOT NULL,
    FOREIGN KEY (id_producto) REFERENCES inventario_farmacia(id)
);

```
```
INSERT INTO ventas (id_producto, nombre_producto, cantidad_vendida, precio_total, fecha_venta)
VALUES
(1, 'Paracetamol', 10, 59.90, '2024-01-10'),
(2, 'Ibuprofeno', 5, 37.45, '2024-01-11'),
(3, 'Amoxicilina', 3, 38.97, '2024-01-12'),
(4, 'Omeprazol', 4, 39.96, '2024-01-13'),
(5, 'Aspirina', 15, 74.85, '2024-01-14'),
(6, 'Loratadina', 8, 67.92, '2024-01-15'),
(7, 'Sildenafil', 2, 31.98, '2024-01-16'),
(8, 'Insulina', 1, 25.99, '2024-01-17'),
(9, 'Pastillas para la gripe', 7, 48.93, '2024-01-18'),
(10, 'Vitaminas C', 4, 39.96, '2024-01-19');

```

**proveedores**

```
CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_empresa VARCHAR(255) NOT NULL,
    contacto_persona VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(255),
    direccion VARCHAR(255)
);

```

INSERT INTO proveedores (nombre_empresa, contacto_persona, telefono, email, direccion) VALUES
('Farmacias ABC', 'Juan Pérez', '123456789', 'info@farmaciasabc.com', 'Calle Principal #123'),
('Distribuidora XYZ', 'María López', '987654321', 'info@distribuidoraxyz.com', 'Avenida Central #456'),
('Laboratorio Farmacéutico PQR', 'Carlos Martínez', '456123789', 'info@labpqr.com', 'Carrera Secundaria #789'),
('Farmacéutica ABC', 'Ana Gómez', '789456123', 'info@farmaceuticaabc.com', 'Plaza Mayor #101');
