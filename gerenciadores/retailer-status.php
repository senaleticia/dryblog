<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['adm_revendedores'] == 0) {
    header('location: users-manager.php');
} else if ($_SESSION['adm_revendedores'] == 1) {
    header('location: retailer-manager.php');
}

if (isset($_GET['modo'])) {
    if ($_GET['modo'] == 'desativar') {
        require_once("../bd/conexao.php");
        $conexao = conexaoMySql();

        $id = $_GET['id'];

        $sql = "UPDATE representantes SET status_representante = 'RECUSADO' WHERE id_representante = " . $id;

        if ($select = mysqli_query($conexao, $sql)) {
            header('location: retailer-authorized.php');
        } else {
            echo ("<script>alert('Erro ao atualizar o status')</script>");
            echo ($sql);
        }
    }
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
