<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Cliente.php';
require_once __DIR__ . '/../model/Producto.php';
require_once __DIR__ . '/../model/Pedido.php';

class HomeController {
    private $db;
    private $cliente;
    private $producto;
    private $pedido;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php');
            exit;
        }

        $database = new Database();
        $this->db = $database->connect();
        $this->cliente = new Cliente($this->db);
        $this->producto = new Producto($this->db);
        $this->pedido = new Pedido($this->db);
    }

    public function index() {
        $total_clientes = $this->cliente->countTotal();
        $total_productos = $this->producto->countTotal();
        $total_pedidos = $this->pedido->countTotal();
        $ingreso_total = $this->pedido->getTotalIncome();
        $valor_inventario = $this->producto->getTotalValue();

        $productos_stock = $this->producto->getAll();
        $pedidos_recientes = $this->pedido->getAll();

        include 'views/home.php';
    }
}
?>
