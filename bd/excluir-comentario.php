<?php
if (isset($_GET['modo'])) {
    session_start();

    $id_user = $_SESSION['id_usuario'];

    require_once("conexao.php");
    $conexao = conexaoMySql();

    if ($_GET['modo'] == 'excluir') {
        $id_comment = $_GET['id_comment'];

        $verificar_usuario = "SELECT comentario.*, post.url_post FROM comentario INNER JOIN post ON comentario.id_post = post.id_post WHERE id_usuario = " . $id_user . " AND id_comentario = " . $id_comment;

        if ($select_verificacao = mysqli_query($conexao, $verificar_usuario)) {
            $rs_verificacao = mysqli_fetch_array($select_verificacao);
            $count_verificacao = mysqli_num_rows($select_verificacao);

            if ($count_verificacao == 1) {
                $sql = "DELETE FROM comentario WHERE id_comentario = " . $id_comment;

                if (mysqli_query($conexao, $sql)) {
                    echo ("<script>window.location='../postagem.php?p=" . $rs_verificacao['url_post'] . "#comentarios'</script>");
                } else {
                    echo ("<script>alert('Erro ao excluir o comentário')</script>");
                }
            } else if ($count_verificacao == 0) {
                echo ("<script>alert('Você não tem autorização para excluir esse comentário')</script>");
                echo ("<script>history.back()</script>");
            }
        }
    }
}
