Hola ingeniero, aquí le explico cómo puede visualizar y entender mejor el sistema

Primero, debe clonar el repositorio o descargar los archivos del proyecto:
git clone https://github.com/Aeskexz/Desafio-2-DSS.git

Coloque la carpeta techstore_sv en su servidor local:

Servidor	Ruta
XAMPP	C:/xampp/htdocs/techstore_sv/
WAMP	C:/wamp64/www/techstore_sv/
Laragon	C:/laragon/www/techstore_sv/

Abra phpMyAdmin desde su navegador: http://localhost/phpmyadmin

Vaya a la pestaña SQL y ejecute el siguiente código:

sql
CREATE DATABASE IF NOT EXISTS techstore_sv;
USE techstore_sv;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0
);

INSERT INTO usuarios (username, password) VALUES ('admin', MD5('admin123'));

INSERT INTO productos (nombre, precio, stock) VALUES
('Laptop Dell Inspiron 15', 899.99, 10),
('Mouse Logitech MX Master', 79.99, 25),
('Teclado Mecánico Redragon', 49.99, 30),
('Monitor Samsung 24"', 229.99, 8),

Abra el archivo: app/config/database.php

Verifique o modifique las credenciales según su entorno:

php
define('DB_HOST', 'localhost');
define('DB_NAME', 'techstore_sv');
define('DB_USER', 'root');       // Su usuario de MySQL
define('DB_PASS', '');           // Su contraseña de MySQL

Ejecutar el Sistema
Inicie su servidor local (Apache y MySQL)

Abra su navegador y vaya a: http://localhost/techstore_sv/

Inicie sesión con:

Usuario: admin

Contraseña: admin123

Flujo del Sistema (Cómo funciona)
Al iniciar el sistema:
text
http://localhost/techstore_sv/
          │
          ▼
    index.php (punto de entrada único)
          │
          ▼
    routes/web.php (enrutador)
          │
          ▼
    ¿Hay sesión activa?
          │
    ┌─────┴─────┐
    │           │
    NO          SÍ
    │           │
    ▼           ▼
  Login     Lista de
            Productos
Cuando inicia sesión:
Ingresa usuario y contraseña

El sistema busca en la tabla usuarios

Verifica la contraseña

Si es correcta, crea una sesión

Lo redirige al panel de productos

Cuando gestiona productos:
Acción	URL	Controlador	Método
Ver productos	?ruta=productos	ProductoController	index()
Crear producto	?ruta=productos.crear	ProductoController	crear()
Editar producto	?ruta=productos.editar&id=1	ProductoController	editar()
Eliminar producto	?ruta=productos.eliminar&id=1	ProductoController	eliminar()
Estructura del Proyecto (MVC)
text
techstore_sv/
│
├── index.php              ← Punto de entrada (Front Controller)
│
├── routes/
│   └── web.php            ← Enrutador (mapea URLs a controladores)
│
├── app/
│   ├── config/
│   │   └── database.php   ← Conexión a BD (Patrón Singleton)
│   │
│   ├── controllers/
│   │   ├── AuthController.php     ← Login/Logout
│   │   └── ProductoController.php ← CRUD productos
│   │
│   ├── models/
│   │   ├── Usuario.php    ← Consultas de usuarios
│   │   └── Producto.php   ← Consultas de productos
│   │
│   └── views/             ← Interfaces de usuario
│       ├── auth/
│       │   └── login.php
│       ├── layout/
│       │   ├── header.php
│       │   └── footer.php
│       └── productos/
│           ├── index.php
│           ├── crear.php
│           └── editar.php
│
└── public/
    └── css/
        └── style.css       ← Estilos profesionales
Seguridad Implementada
Medida	Dónde se aplica
Hash de contraseñas	Modelo Usuario.php (bcrypt/MD5)
Prevención SQL Injection	Todos los modelos (PDO + Prepared Statements)
Protección XSS	Todas las vistas (htmlspecialchars())
Control de sesiones	proteger() en ProductoController
Validación de datos	Controladores (antes de insertar/actualizar)
('Audífonos Sony WH-1000XM5', 349.99, 15);
Verifique que la base de datos techstore_sv aparezca en el panel izquierdo
