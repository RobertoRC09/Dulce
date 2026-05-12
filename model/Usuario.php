<?php
class Usuario {
    private $conn;
    private $table = 'usuario';

    public $id_usuario;
    public $nombre_usuario;
    public $correo;
    public $contraseña;
    public $rol;
    public $estado;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($nombre_usuario, $contraseña) {
        $sql = "SELECT * FROM " . $this->table . " WHERE (nombre_usuario = ? OR correo = ?) AND contraseña = ? AND estado = 'activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre_usuario, $nombre_usuario, $contraseña);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function create($nombre_usuario, $correo, $contraseña, $rol = 'vendedor') {
        $sql = "INSERT INTO " . $this->table . " SET
                nombre_usuario = ?,
                correo = ?,
                contraseña = ?,
                rol = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre_usuario, $correo, $contraseña, $rol);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getUserById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
