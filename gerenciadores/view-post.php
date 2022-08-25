<?php
    $titulo = (string) "";
    $conteudo = (string) "";
    $video = (string) "";
    $foto = (string) "";

    if($_SESSION['gerenciadorAutenticado'] = false){
        header("location:../login.php");
    };

    $id_post = $_GET['id'];

    if(isset($_GET['modo'])){
        session_start();

        require_once("../bd/conexao.php");
        $conexao = conexaoMySql();

        if($_GET['modo'] == 'visualizar'){
            $id = $_GET['id'];

            $sql = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor WHERE post.id_post = ".$id;
            $select = mysqli_query($conexao, $sql);

            if(!$select){
                printf("Error: %s\n", mysqli_error($conexao));
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <link rel="stylesheet" href="../guideline-social.css">
    <title>Visualizar postagem - DryBlog</title>
</head>
<body>
    <div class="container">
        <div class="view-post-table">
        <?php
            while($result = mysqli_fetch_array($select)){  
                $conteudo_post = $result['conteudo'];

                $str     = $conteudo_post;
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />';
                $conteudo_quebrado = str_replace($order, $replace, $str);

                $segundo_conteudo_post = $result['segundo_conteudo'];

                $str     = $segundo_conteudo_post;
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />'; 
                $segundo_conteudo_quebrado = str_replace($order, $replace, $str);

                $terceiro_conteudo_post = $result['terceiro_conteudo'];

                $str     = $terceiro_conteudo_post;
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />'; 
                $terceiro_conteudo_quebrado = str_replace($order, $replace, $str);

                $quarto_conteudo_post = $result['quarto_conteudo'];

                $str     = $quarto_conteudo_post;
                $order   = array("\r\n", "\n", "\r");
                $replace = '<br />'; 
                $quarto_conteudo_quebrado = str_replace($order, $replace, $str);
        ?>
            <div class="space-postagem mt-5 text-center">
                <h1><?=$result['titulo']?></h1>
            </div>
            <div class="py-4 text-center">
                <span>
                    <strong>Publicado em: </strong><?=$result['data_post']?>, às <?=$result['hora_post']?> | 
                    <strong>Autor(a): </strong><?=$result['nome_autor']?> |
                    <strong>Tempo de leitura: </strong><?=$result['tempo_leitura']?> min
                </span>
            </div>

        <?php if($result['foto'] > 0){ ?>
            <div class="post-img ml-auto mr-auto">
                <img src="../upload/arquivos/<?=$result['foto']?>" alt="Imagem do post">
            </div>
        <?php } ?>

            <div class="post-full-text">
                <?=$conteudo_quebrado?>
            </div>

        <?php if($result['segunda_foto'] > 0){ ?>
            <div class="post-img ml-auto mr-auto">
                <img src="../upload/arquivos/<?=$result['segunda_foto']?>" alt="Imagem do post">
            </div>
        <?php } ?>

            <div class="post-full-text">
                <?=$segundo_conteudo_quebrado?>
            </div>

        <?php if($result['terceira_foto'] > 0){ ?>
            <div class="post-img ml-auto mr-auto">
                <img src="../upload/arquivos/<?=$result['terceira_foto']?>" alt="Imagem do post">
            </div>
        <?php } ?>

            <div class="post-full-text">
                <?=$terceiro_conteudo_quebrado?>
            </div> 

        <?php if($result['quarta_foto'] > 0){ ?>
            <div class="post-img ml-auto mr-auto">
                <img src="../upload/arquivos/<?=$result['quarta_foto']?>" alt="Imagem do post">
            </div>
        <?php } ?>
            <div class="post-full-text">
                <?=$quarto_conteudo_quebrado?>
            </div>
            
        <?php if($result['video'] > 0){ ?>   
            <div class="view-post-video mb-5">
                <iframe width="100%" height="570" src="https://www.youtube.com/embed/<?=$result['video']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php } ?>
            <div class="d-flex justify-content-around mb-5">
                <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                    <span class="material-symbols-outlined">
                        arrow_back_ios_new
                    </span>
                </button>
                <a href="./add-post.php?modo=editar&id=<?=$result['id_post']?>">
                    <button class="btn-padrao">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </button>
                </a>
                <a onclick="return confirm('Tem certeza que deseja excluir o post?');" href="./delete-post.php?modo=excluir&id=<?=$result['id_post']?>">
                    <button class="btn-padrao">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                </a>               
            </div>
        <?php } ?>   
        </div>
    </div>
</body>
</html>