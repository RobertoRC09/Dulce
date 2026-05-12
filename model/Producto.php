<?php
class Producto {
    private $conn;
    private $table = 'producto_regional';

    public $id_producto;
    public $nombre_producto;
    public $categoria;
    public $region_origen;
    public $precio;
    public $stock;
    public $descripcion;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY nombre_producto ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nombre, $categoria, $region, $precio, $stock, $descripcion) {
        $sql = "INSERT INTO " . $this->table . " SET
                nombre_producto = ?,
                categoria = ?,
                region_origen = ?,
                precio = ?,
                stock = ?,
                descripcion = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssdis", $nombre, $categoria, $region, $precio, $stock, $descripcion);
        return $stmt->execute();
    }

    public function update($id, $nombre, $categoria, $region, $precio, $stock, $descripcion) {
        $sql = "UPDATE " . $this->table . " SET
                nombre_producto = ?,
                categoria = ?,
                region_origen = ?,
                precio = ?,
                stock = ?,
                descripcion = ?
                WHERE id_producto = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssdisi", $nombre, $categoria, $region, $precio, $stock, $descripcion, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id_producto = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function countTotal() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function getTotalValue() {
        $result = $this->conn->query("SELECT SUM(precio * stock) as total_value FROM " . $this->table);
        $data = $result->fetch_assoc();
        return $data['total_value'] ?? 0;
    }
}
?>
