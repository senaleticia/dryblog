<?php
session_start();

require_once("./bd/conexao.php");
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];

if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    if ($modo == 'logout') {
        session_destroy();
        header('location: ./login');
    }
}

$rota = $_GET['url'] ?? '';

if ($rota == "") {
    $rota = "home";
}

if (file_exists("./{$rota}.php")) {
    include "./{$rota}.php";
} else {
    header('location: ./pagina-inexistente');
}
