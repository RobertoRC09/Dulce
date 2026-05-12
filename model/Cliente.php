<?php
class Cliente {
    private $conn;
    private $table = 'cliente';

    public $id_cliente;
    public $nombre;
    public $apellido;
    public $dni;
    public $telefono;
    public $direccion;
    public $correo;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY nombre ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nombre, $apellido, $dni, $telefono, $direccion, $correo) {
        $sql = "INSERT INTO " . $this->table . " SET
                nombre = ?,
                apellido = ?,
                dni = ?,
                telefono = ?,
                direccion = ?,
                correo = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $nombre, $apellido, $dni, $telefono, $direccion, $correo);
        return $stmt->execute();
    }

    public function update($id, $nombre, $apellido, $dni, $telefono, $direccion, $correo) {
        $sql = "UPDATE " . $this->table . " SET
                nombre = ?,
                apellido = ?,
                dni = ?,
                telefono = ?,
                direccion = ?,
                correo = ?
                WHERE id_cliente = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nombre, $apellido, $dni, $telefono, $direccion, $correo, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function countTotal() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table);
        $data = $result->fetch_assoc();
        return $data['total'];
    }
}
?>
