<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Producto.php';

class ProductoController {
    private $db;
    private $producto;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php');
            exit;
        }
        $database = new Database();
        $this->db = $database->connect();
        $this->producto = new Producto($this->db);
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
            if ($_POST['accion'] === 'crear') {
                $this->producto->create(
                    $_POST['nombre_producto'],
                    $_POST['categoria'],
                    $_POST['region_origen'],
                    $_POST['precio'],
                    $_POST['stock'],
                    $_POST['descripcion']
                );
            } elseif ($_POST['accion'] === 'eliminar') {
                $this->producto->delete($_POST['id_producto']);
            }
            header('Location: index.php?view=productos');
            exit;
        }

        $productos = $this->producto->getAll();
        include 'views/productos.php';
    }
}
?>
