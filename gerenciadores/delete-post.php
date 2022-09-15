<?php
if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador');
}

if (isset($_GET['modo'])) {
    session_start();

    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    if ($_GET['modo'] == 'excluir') {
        $id = $_GET['id'];

        $sql = "DELETE FROM post WHERE id_post = " . $id;

        if (mysqli_query($conexao, $sql)) {
            //echo("<script>alert('Post excluído com sucesso')</script>");
            echo ("<script>history.back()</script>");
        } else {
            echo ("<script>alert('Erro ao excluir o post')</script>");
            echo ("<script>history.back()</script>");
        }
    }
}
