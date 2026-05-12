<?php
session_start();

require_once 'controller/AuthController.php';
require_once 'controller/HomeController.php';
require_once 'controller/ClienteController.php';
require_once 'controller/ProductoController.php';
require_once 'controller/PedidoController.php';

$auth = new AuthController();

// Determinar la vista
$view = $_GET['view'] ?? 'login';

if ($view === 'login') {
    $auth->login();
} elseif ($view === 'logout') {
    $auth->logout();
} else {
    // Vistas protegidas
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: index.php?view=login');
        exit;
    }

    switch ($view) {
        case 'home':
            $home = new HomeController();
            $home->index();
            break;
        case 'clientes':
            $clientes = new ClienteController();
            $clientes->index();
            break;
        case 'productos':
            $productos = new ProductoController();
            $productos->index();
            break;
        case 'pedidos':
            $pedidos = new PedidoController();
            $pedidos->index();
            break;
        case 'registro':
            include 'views/registro.php';
            break;
        case 'contacto':
            include 'views/contacto.php';
            break;
        case 'quienes':
            include 'views/quienes.php';
            break;
        default:
            $home = new HomeController();
            $home->index();
            break;
    }
}
?>
