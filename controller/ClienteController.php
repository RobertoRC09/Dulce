<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Cliente.php';

class ClienteController {
    private $db;
    private $cliente;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: index.php');
            exit;
        }
        $database = new Database();
        $this->db = $database->connect();
        $this->cliente = new Cliente($this->db);
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
            if ($_POST['accion'] === 'crear') {
                $this->cliente->create(
                    $_POST['nombre'],
                    $_POST['apellido'],
                    $_POST['dni'],
                    $_POST['telefono'],
                    $_POST['direccion'],
                    $_POST['correo']
                );
            } elseif ($_POST['accion'] === 'eliminar') {
                $this->cliente->delete($_POST['id_cliente']);
            }
            header('Location: index.php?view=clientes');
            exit;
        }

        $clientes = $this->cliente->getAll();
        include 'views/clientes.php';
    }
}
?>
