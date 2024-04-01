```
CREATE TABLE datos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255),
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    contrasena VARCHAR(255),
    fecha DATE
);

```


```
INSERT INTO datos (nombre, email, direccion, telefono, contrasena, fecha) 
VALUES 
('Usuario Generico', 'usuario@example.com', 'Calle Falsa 123', '123-456-7890', 'contrasena123', '1990-01-01');

```

