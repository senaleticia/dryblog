<?php
    session_start();

    if(isset($_GET['modo'])){
        if($_GET['modo'] == 'curtir'){
            require_once("conexao.php");
            $conexao = conexaoMySql();

            $id_post = $_GET['id_post'];
            $id_usuario = $_SESSION['id_usuario'];

            $sql = "SELECT * FROM curtidas WHERE id_post = ".$id_post." AND id_usuario = ".$id_usuario;

            if($select = mysqli_query($conexao, $sql)){
                $result = mysqli_fetch_array($select);
                $row_count = mysqli_num_rows($select);
                
                if($row_count >= 1){
                    $id_curtida = $result['id_curtida'];

                    $sql_like = "DELETE FROM curtidas WHERE id_curtida = ".$id_curtida;
                    if(mysqli_query($conexao, $sql_like)){
                        echo("<script>history.back()</script>");
                    }
                }else if($row_count == 0){
                    $sql_like = "INSERT INTO curtidas (id_usuario, id_post) VALUES (".$id_usuario.", ".$id_post.")";

                    if(mysqli_query($conexao, $sql_like)){
                        echo("<script>history.back()</script>");
                    }
                }
            }
        }
    }
?>