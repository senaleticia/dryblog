<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['tipo_usuario'] != 3) {
    header('location: ./');
}

if (isset($_POST['sltStatus'])) {
    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    $status = $_POST['sltStatus'];

    if (isset($_GET['representante'])) {
        $representante = $_GET['representante'];

        $sql = "UPDATE representantes SET status_representante = '" . $status . "' WHERE id_representante = " . $representante;

        if ($select = mysqli_query($conexao, $sql)) {
            header('location: retailer-manager.php');
        } else {
            echo ("<script>alert('Erro ao atualizar o status')</script>");
            echo ($sql);
        }
    }
}
