<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    if($_SESSION['gerenciadorAutenticado'] != true){
        header("location:../login-gerenciador.php");
    }

    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <title>Área de Gerenciadores - DryBlog</title>
</head>
<body>
    <header id="header-gerenciadores">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="mt-5">
                    <h2>Bem-vindo(a), <?=$_SESSION['nome_autor']?>!</h2>
                </div>
                <div class="logout mt-5">
                    <a href="../logout.php">
                        <button type="button" class="btn btn-outline-danger">Sair</button>
                    </a>
                </div>
            </div>           
        </div>
    </header>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Lista de Postagens</h1>

        <div class="my-5">
            <a href="./add-post.php">
                <button type="button" class="btn-secundario">CRIAR POST NOVO</button>
            </a>
        </div>
        
    <?php
        $sql = "SELECT * FROM post ORDER BY id_post DESC";

        $select = mysqli_query($conexao, $sql);

        if(!$select){
            printf("Error: %s\n", mysqli_error($conexao));
            exit();
        }

        while($result = mysqli_fetch_array($select)){
    ?>
            <ul class="list-group">
                <li class="post-list">
                    <?=$result['titulo']?>
                    <div class="icons-box float-right">
                        <a href="./view-post.php?modo=visualizar&id=<?=$result['id_post']?>" style="display: inline-block;">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="./add-post.php?modo=editar&id=<?=$result['id_post']?>">
                            <span class="material-symbols-outlined">border_color</span>
                        </a>
                        <a onclick="return confirm('Tem certeza que deseja excluir o post?');" href="./delete-post.php?modo=excluir&id=<?=$result['id_post']?>">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                    </div>
                </li>
            </ul>
    <?php 
        }
    ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>