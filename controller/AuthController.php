<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Usuario.php';

class AuthController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->usuario = new Usuario($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
            $contraseña = $_POST['contraseña'] ?? '';
            
            $user = $this->usuario->login($nombre_usuario, $contraseña);
            if ($user) {
                $_SESSION['id_usuario'] = $user['id_usuario'];
                $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
                $_SESSION['rol'] = $user['rol'];
                header('Location: index.php?view=home');
                exit;
            } else {
                $error = 'Usuario o contraseña incorrectos';
                include 'views/login.php';
            }
        } else {
            include 'views/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}
?>
