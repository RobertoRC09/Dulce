<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Pedido.php';
require_once __DIR__ . '/../model/Cliente.php';
require_once __DIR__ . '/../model/Producto.php';

class PedidoController {
    private $db;
    private $pedido;
    private $cliente;
    private $producto;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php');
            exit;
        }
        $database = new Database();
        $this->db = $database->connect();
        $this->pedido = new Pedido($this->db);
        $this->cliente = new Cliente($this->db);
        $this->producto = new Producto($this->db);
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
            if ($_POST['accion'] === 'crear') {
                $prod = $this->producto->getById($_POST['id_producto']);
                $total = $prod['precio'] * $_POST['cantidad'];
                
                $this->pedido->create($_POST['id_cliente'], $_POST['id_producto'], $_POST['cantidad'], $total);

                $nuevo_stock = $prod['stock'] - $_POST['cantidad'];
                $this->producto->update($prod['id_producto'], $prod['nombre_producto'], $prod['categoria'], $prod['region_origen'], $prod['precio'], $nuevo_stock, $prod['descripcion']);
            } elseif ($_POST['accion'] === 'eliminar') {
                $this->pedido->delete($_POST['id_pedido']);
            }
            header('Location: index.php?view=pedidos');
            exit;
        }

        $pedidos = $this->pedido->getAll();
        $clientes = $this->cliente->getAll();
        $productos = $this->producto->getAll();
        include 'views/pedidos.php';
    }
}
?>
