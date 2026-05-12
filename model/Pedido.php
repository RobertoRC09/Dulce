<?php
class Pedido {
    private $conn;
    private $table = 'pedido';

    public $id_pedido;
    public $id_cliente;
    public $id_producto;
    public $fecha_pedido;
    public $cantidad;
    public $total;
    public $estado_pedido;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAll() {
        $sql = "SELECT p.*, c.nombre, c.apellido, pr.nombre_producto, pr.precio 
                FROM " . $this->table . " p
                JOIN cliente c ON p.id_cliente = c.id_cliente
                JOIN producto_regional pr ON p.id_producto = pr.id_producto
                ORDER BY p.fecha_pedido DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM " . $this->table . " WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($id_cliente, $id_producto, $cantidad, $total) {
        $sql = "INSERT INTO " . $this->table . " SET
                id_cliente = ?,
                id_producto = ?,
                cantidad = ?,
                total = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $id_cliente, $id_producto, $cantidad, $total);
        return $stmt->execute();
    }

    public function updateStatus($id, $estado) {
        $sql = "UPDATE " . $this->table . " SET estado_pedido = ? WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $estado, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id_pedido = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function countTotal() {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM " . $this->table);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function getTotalIncome() {
        $result = $this->conn->query("SELECT SUM(total) as ingreso FROM " . $this->table);
        $data = $result->fetch_assoc();
        return $data['ingreso'] ?? 0;
    }

    public function getClientePedidos($id_cliente) {
        $sql = "SELECT p.*, pr.nombre_producto FROM " . $this->table . " p
                JOIN producto_regional pr ON p.id_producto = pr.id_producto
                WHERE p.id_cliente = ?
                ORDER BY p.fecha_pedido DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_cliente);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
?>
