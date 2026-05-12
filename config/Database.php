<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'dulce_regionales';
    private $user = 'root';
    private $pass = '';
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass);
        
        if ($this->conn->connect_error) {
            die('Error de conexión: ' . $this->conn->connect_error);
        }

        // Crear base de datos si no existe
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->db_name;
        if ($this->conn->query($sql) === FALSE) {
            die('Error al crear la BD: ' . $this->conn->error);
        }

        // Seleccionar la base de datos
        $this->conn->select_db($this->db_name);
        $this->conn->set_charset("utf8mb4");
        
        return $this->conn;
    }

    public function createTables() {
        $conn = $this->connect();

        // Tabla usuario
        $sql_usuario = "CREATE TABLE IF NOT EXISTS usuario (
            id_usuario INT AUTO_INCREMENT PRIMARY KEY,
            nombre_usuario VARCHAR(100) NOT NULL UNIQUE,
            correo VARCHAR(100) NOT NULL UNIQUE,
            contraseña VARCHAR(255) NOT NULL,
            rol VARCHAR(50) DEFAULT 'vendedor',
            estado VARCHAR(20) DEFAULT 'activo',
            fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // Tabla cliente
        $sql_cliente = "CREATE TABLE IF NOT EXISTS cliente (
            id_cliente INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            apellido VARCHAR(100) NOT NULL,
            dni VARCHAR(20) UNIQUE,
            telefono VARCHAR(20),
            direccion VARCHAR(200),
            correo VARCHAR(100),
            fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // Tabla producto_regional
        $sql_producto = "CREATE TABLE IF NOT EXISTS producto_regional (
            id_producto INT AUTO_INCREMENT PRIMARY KEY,
            nombre_producto VARCHAR(150) NOT NULL,
            categoria VARCHAR(100),
            region_origen VARCHAR(100),
            precio DECIMAL(10, 2) NOT NULL,
            stock INT DEFAULT 0,
            descripcion TEXT,
            fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        // Tabla pedido
        $sql_pedido = "CREATE TABLE IF NOT EXISTS pedido (
            id_pedido INT AUTO_INCREMENT PRIMARY KEY,
            id_cliente INT NOT NULL,
            id_producto INT NOT NULL,
            fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            cantidad INT NOT NULL,
            total DECIMAL(10, 2) NOT NULL,
            estado_pedido VARCHAR(50) DEFAULT 'pendiente',
            FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
            FOREIGN KEY (id_producto) REFERENCES producto_regional(id_producto)
        )";

        $conn->query($sql_usuario);
        $conn->query($sql_cliente);
        $conn->query($sql_producto);
        $conn->query($sql_pedido);

        return true;
    }
}
?>