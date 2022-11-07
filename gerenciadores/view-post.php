<?php
$titulo = (string) "";
$conteudo = (string) "";
$video = (string) "";
$foto = (string) "";

if ($_SESSION['gerenciadorAutenticado'] = false) {
    header("location:../login.php");
};

$id_post = $_GET['id'];

if (isset($_GET['modo'])) {
    session_start();

    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    if ($_GET['modo'] == 'visualizar') {
        $id = $_GET['id'];

        $sql = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor WHERE post.id_post = " . $id;
        $select = mysqli_query($conexao, $sql);

        if (!$select) {
            printf("Error: %s\n", mysqli_error($conexao));
            exit();
        }

        if ($result = mysqli_fetch_array($select)) {
            $titulo = $result['titulo'];
            $tags = $result['tags'];
            $tempo_leitura = $result['tempo_leitura'];
            $nome_autor = $result['nome_autor'];
            $foto = $result['foto'];
            $foto2 = $result['segunda_foto'];
            $foto3 = $result['terceira_foto'];
            $foto4 = $result['quarta_foto'];
            $video = $result['video'];
            $data_post = $result['data_post'];
            $hora_post = $result['hora_post'];

            $conteudo_post = $result['conteudo'];
            $str     = $conteudo_post;
            $order   = array("\r\n", "\n", "\r");
            $replace = '<br>';
            $conteudo_quebrado = str_replace($order, $replace, $str);

            $segundo_conteudo_post = $result['segundo_conteudo'];
            $str     = $segundo_conteudo_post;
            $order   = array("\r\n", "\n", "\r");
            $replace = '<br>';
            $segundo_conteudo_quebrado = str_replace($order, $replace, $str);

            $terceiro_conteudo_post = $result['terceiro_conteudo'];
            $str     = $terceiro_conteudo_post;
            $order   = array("\r\n", "\n", "\r");
            $replace = '<br>';
            $terceiro_conteudo_quebrado = str_replace($order, $replace, $str);

            $quarto_conteudo_post = $result['quarto_conteudo'];
            $str     = $quarto_conteudo_post;
            $order   = array("\r\n", "\n", "\r");
            $replace = '<br>';
            $quarto_conteudo_quebrado = str_replace($order, $replace, $str);
        } else {
            header('location: index.php');
        }
    }
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <link rel="stylesheet" href="../guideline-social.css">
    <title><?= $titulo ?> - DryBlog</title>
</head>

<body>
    <div class="container">
        <div class="view-post-table">
            <div class="space-postagem mt-5 text-center">
                <h1><?= $titulo ?></h1>
            </div>
            <div class="py-4 text-center">
                <span>
                    <strong>Publicado em: </strong><?= $data_post ?> às <?= $hora_post ?>|
                    <strong>Autor(a): </strong><?= $nome_autor ?> |
                    <strong>Tempo de leitura: </strong><?= $tempo_leitura ?> min
                </span>
            </div>

            <?php if ($foto != "") { ?>
                <div class="post-img ml-auto mr-auto">
                    <img src="../upload/arquivos/<?= $foto ?>" alt="Imagem do post">
                </div>
            <?php } ?>

            <?php if ($conteudo_post != "") { ?>
                <div class="post-full-text">
                    <p><?= $conteudo_quebrado ?></p>
                </div>
            <?php } ?>

            <?php if ($foto2 != "") { ?>
                <div class="post-img ml-auto mr-auto">
                    <img src="../upload/arquivos/<?= $foto2 ?>" alt="Imagem do post">
                </div>
            <?php } ?>

            <?php if ($segundo_conteudo_post != "") { ?>
                <div class="post-full-text">
                    <p><?= $segundo_conteudo_quebrado ?></p>
                </div>
            <?php } ?>

            <?php if ($foto3 != "") { ?>
                <div class="post-img ml-auto mr-auto">
                    <img src="../upload/arquivos/<?= $foto3 ?>" alt="Imagem do post">
                </div>
            <?php } ?>

            <?php if ($terceiro_conteudo_post != "") { ?>
                <div class="post-full-text">
                    <p><?= $terceiro_conteudo_quebrado ?></p>
                </div>
            <?php } ?>

            <?php if ($foto4 != "") { ?>
                <div class="post-img ml-auto mr-auto">
                    <img src="../upload/arquivos/<?= $foto4 ?>" alt="Imagem do post">
                </div>
            <?php } ?>

            <?php if ($quarto_conteudo_post != "") { ?>
                <div class="post-full-text">
                    <p><?= $quarto_conteudo_quebrado ?></p>
                </div>
            <?php } ?>

            <?php if ($video != "") { ?>
                <div class="view-post-video mb-5">
                    <iframe width="100%" height="570" src="https://www.youtube.com/embed/<?= $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-around mb-5">
                <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                    <span class="material-symbols-outlined">
                        arrow_back_ios_new
                    </span>
                </button>
                <a href="./add-post.php?modo=editar&id=<?= $result['id_post'] ?>">
                    <button class="btn-padrao">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </button>
                </a>
                <a onclick="return confirm('Tem certeza que deseja excluir o post?');" href="./delete.php?modo=excluir-post&id=<?= $result['id_post'] ?>">
                    <button class="btn-padrao">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</body>

</html>