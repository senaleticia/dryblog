<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['adm_posts'] != 2) {
    header('location: ./');
}

if (isset($_GET['modo'])) {
    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    if ($_GET['modo'] == 'excluir-post') {
        $id = $_GET['id'];
        $arquivo = $_GET['arquivo'];

        $sql = "DELETE FROM post WHERE id_post = " . $id;

        if (mysqli_query($conexao, $sql)) {
            unlink("../upload/blog/" . $arquivo);
            echo ("<script>history.back()</script>");
        } else {
            echo ("<script>alert('Erro ao excluir o post')</script>");
            echo ("<script>history.back()</script>");
        }
    } else if ($_GET['modo'] == 'excluir-anuncio') {
        $id = $_GET['id'];
        $arquivo = $_GET['arquivo'];

        $sql = "DELETE FROM anuncios WHERE id_anuncio = " . $id;

        if (mysqli_query($conexao, $sql)) {
            unlink("../upload/anuncios/" . $arquivo);
            echo ("<script>alert('Anúncio excluído com sucesso')</script>");
            header("location: publicity-list.php");
        } else {
            echo ("<script>alert('Erro ao excluir o anúncio')</script>");
            echo ("<script>history.back()</script>");
        }
    }
} else {
    header('location: index.php');
}
