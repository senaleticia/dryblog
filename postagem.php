<?php
session_start();

//Colocando o boolean de usuário autenticado em uma variável
$usuario_autenticado = $_SESSION['usuarioAutenticado'];
//Colocando o ID do usuário ativo na sessão em uma variável
$id_user = $_SESSION['id_usuario'];
//$foto_user = $_SESSION['foto_usuario'];

//Conexão com o banco de dados
require_once("./bd/conexao.php");
$conexao = conexaoMySql();

//Definindo variáveis
$titulo = (string) "";
$video = (string) "";

//Verificando se a variável 'modo' existe na URL
if (isset($_GET['modo'])) {
    //Verificando se o resultado da variável 'modo' é 'visualizar'
    if ($_GET['modo'] == 'visualizar') {
        //Pegando o resultado da variável 'id' que está na URL
        $id = $_GET['id'];

        //Script para rodar no banco e trazer os dados do post
        $sql = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor WHERE post.id_post = " . $id;
        $select = mysqli_query($conexao, $sql);

        //Verificando se o script funcionou
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

            $conteudo = $result['conteudo'];
            $str = $conteudo;
            $order = array("\r\n", "\n", "\r");
            $replace = "<br>";
            $conteudo_final = str_replace($order, $replace, $str);

            $conteudo2 = $result['segundo_conteudo'];
            $str = $conteudo2;
            $order = array("\r\n", "\n", "\r");
            $replace = "<br>";
            $segundo_conteudo_final = str_replace($order, $replace, $str);

            $conteudo3 = $result['terceiro_conteudo'];
            $str = $conteudo3;
            $order = array("\r\n", "\n", "\r");
            $replace = "<br>";
            $terceiro_conteudo_final = str_replace($order, $replace, $str);

            $conteudo4 = $result['quarto_conteudo'];
            $str = $conteudo4;
            $order = array("\r\n", "\n", "\r");
            $replace = "<br>";
            $quarto_conteudo_final = str_replace($order, $replace, $str);
        }

        //Script para trazer as curtidas do post
        $sql_curtidas = "SELECT * FROM curtidas WHERE id_post = " . $id;

        //Criando o contador de curtidas através do número de linhas que o script retorna
        if ($select_curtidas = mysqli_query($conexao, $sql_curtidas)) {
            $rs_curtidas = mysqli_fetch_array($select_curtidas);
            $curtidas_count = mysqli_num_rows($select_curtidas);

            //Definindo como a variável $curtidas_count vai aparecer na tela, 
            //dependendo da quantidade de linhas retornadas
            if ($curtidas_count == 1) {
                $curtidas_count = $curtidas_count . " curtida";
            } else if ($curtidas_count > 1 || $curtidas_count == 0) {
                $curtidas_count = $curtidas_count . " curtidas";
            }
        }

        //Script para trazer os comentários do post
        $sql_comentarios = "SELECT * FROM comentario WHERE id_post = " . $id;

        //Criando o contador de comentários através do número de linhas que o script retorna
        if ($select_comentarios = mysqli_query($conexao, $sql_comentarios)) {
            $rs_comentarios = mysqli_fetch_array($select_comentarios);
            $comentarios_count = mysqli_num_rows($select_comentarios);

            //Definindo como a variável $comentarios_count vai aparecer na tela, 
            //dependendo da quantidade de linhas retornadas
            if ($comentarios_count == 1) {
                $comentarios_count = $comentarios_count . " comentário";
            } else if ($comentarios_count > 1 || $comentarios_count == 0) {
                $comentarios_count = $comentarios_count . " comentários";
            }
        }
    }
}

//Verificando se o botão "Comentar" foi acionado
if (isset($_POST['btnComentar'])) {
    $id_post = $_GET['id'];
    $id_usuario = $_SESSION['id_usuario'];
    $comentario = $_POST['txtComentario'];

    //Capturando data atual e colocando em uma variável
    date_default_timezone_set('America/Sao_paulo');
    $data = date('d/m/Y');

    if ($comentario == "") {
        echo ("<script>alert('Esse campo é obrigatório')</script>");
    } else {
        //Script para inserir um comentário no banco de dados
        $sql_comment = "INSERT INTO comentario (id_post, id_usuario, conteudo_comentario, data_comentario) VALUES (" . $id_post . ", " . $id_usuario . ", '" . $comentario . "', '" . $data . "')";

        //Rodando a conexão com o banco de dados e o script SQL
        if ($select_comment = mysqli_query($conexao, $sql_comment)) {
            echo ("<script>history.back()</script>");
        } else {
            echo ("<script>alert('Erro ao comentar')</script>");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick-theme.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./guideline-social.css">
    <title><?= $titulo ?> - DryBlog</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner">
        <div class="container">
            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-light"></span>
            </button>
            <li class="nav-item ml-auto mr-auto" style="list-style: none;">
                <a href="./index.php">
                    <img src="./img/logo-dry-laranja.png" alt="Logo">
                </a>
            </li>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-5 mr-auto">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./blog.php">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu modal-contato" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
            <div class="login-box">
                <?php if ($usuario_autenticado == true) { ?>
                    <a class="logout" href="./index.php?modo=logout">
                        <button class="btn-padrao">SAIR</button>
                    </a>
                <?php } else if ($usuario_autenticado == false) { ?>
                    <a class="logout" href="./login.php">
                        <button class="btn-padrao">LOGIN</button>
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Ação Inválida</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Você precisa estar autenticado para realizar essa ação</p>
                    </div>
                    <div class="modal-footer">
                        <a href="./login.php">
                            <button type="button" class="btn-padrao">Entrar</button>
                        </a>
                        <a href="./cadastrar-usuario.php">
                            <button type="button" class="btn-padrao">Cadastrar-se</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalContato" tabindex="-1" aria-labelledby="modalContatoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="ml-auto mr-auto">Alguma dúvida?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ml-auto mr-auto">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=5511920000909&text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20Dry%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!">
                            <button class="btn-padrao font-weight-bold">CONVERSE COM UM ESPECIALISTA</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="view-post-table mt-5">
                    <div class="titulo-padrao text-uppercase mt-5">
                        <h1><?= $titulo ?></h1>
                        <div class="caixa-tags">
                            <div class="tags mt-2 d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        folder_copy
                                    </span>
                                    <p class="btn-tag">
                                        <?= $tags ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tags mt-2 d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        person
                                    </span>
                                    <p class="btn-tag">
                                        <?= $nome_autor ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tags mt-2 d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        hourglass_empty
                                    </span>
                                    <p class="btn-tag">
                                        <?= $tempo_leitura ?> min
                                    </p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        date_range
                                    </span>
                                    <p class="btn-tag">
                                        <?= $data_post ?>
                                    </p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        schedule
                                    </span>
                                    <p class="btn-tag"><?= $hora_post ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($foto != "") { ?>
                        <div class="post-img mx-auto">
                            <img src="./upload/arquivos/<?= $foto ?>" alt="Foto post">
                        </div>
                    <?php } ?>

                    <div class="post-full-text">
                        <p><?= $conteudo_final ?></p>
                    </div>

                    <?php if ($foto2 != "") { ?>
                        <div class="post-img mx-auto">
                            <img src="./upload/arquivos/<?= $foto2 ?>" alt="Foto post">
                        </div>
                    <?php } ?>

                    <?php if ($conteudo2 != "") { ?>
                        <div class="post-full-text">
                            <p><?= $segundo_conteudo_final ?></p>
                        </div>
                    <?php } ?>

                    <?php if ($foto3 != "") { ?>
                        <div class="post-img mx-auto">
                            <img src="./upload/arquivos/<?= $foto3 ?>" alt="Foto post">
                        </div>
                    <?php } ?>

                    <?php if ($conteudo3 != "") { ?>
                        <div class="post-full-text">
                            <p><?= $terceiro_conteudo_final ?></p>
                        </div>
                    <?php } ?>

                    <?php if ($foto4 != "") { ?>
                        <div class="post-img mx-auto">
                            <img src="./upload/arquivos/<?= $foto4 ?>" alt="Foto post">
                        </div>
                    <?php } ?>

                    <?php if ($conteudo4 != "") { ?>
                        <div class="post-full-text">
                            <p><?= $quarto_conteudo_final ?></p>
                        </div>
                    <?php } ?>

                    <?php if ($video != "") { ?>
                        <div class="post-video">
                            <iframe width="100%" height="570" src="https://www.youtube.com/embed/<?= $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    <?php } ?>

                    <div class="d-flex justify-content-around mt-4">
                        <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                            <span class="material-symbols-outlined">
                                arrow_back_ios_new
                            </span>
                        </button>
                        <button class="btn-padrao font-weight-bold">
                            <span class="material-symbols-outlined">
                                share
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="relacionados">
        <?php
        $sql_relacionados = "SELECT * FROM post WHERE tags = '" . $tags . "' AND id_post <> " . $id . " LIMIT 4";
        $select_relacionados = mysqli_query($conexao, $sql_relacionados);
        $relacionados_count = mysqli_num_rows($select_relacionados);

        if ($relacionados_count >= 1) {
        ?>
            <div class="titulo-padrao">
                <h3 class="titulo-secundario">Relacionados</h3>
            </div>
            <div class="scroll-container">
                <div class="container-relacionados">
                    <?php while ($rs_relacionados = mysqli_fetch_array($select_relacionados)) { ?>
                        <div class="card-materia-lateral">
                            <div class="materia-img" style="background-image: url('./upload/arquivos/<?= $rs_relacionados['foto'] ?>');"></div>
                            <a href="./postagem.php?modo=visualizar&id=<?= $rs_relacionados['id_post'] ?>">
                                <h4 class="materia-title"><?= $rs_relacionados['titulo'] ?></h4>
                            </a>
                        </div>
                </div>
            </div>
    <?php               }
                }
    ?>
    </div>

    <div id="comentarios">
        <div class="container">
            <?php if ($usuario_autenticado == false) { ?>
                <div id="caixa-comentar">
                    <div class="foto-usuario" style="background-image: url('./img/icon-profile.png');"></div>
                    <div class="input-comentario">
                        <textarea name="txtComentario" id="txtComentario" class="textarea-sunk-white" cols="30" rows="20" placeholder="Comente aqui o que você achou"></textarea>
                        <input type="button" class="btn-padrao ml-auto borda-botao" value="Postar" data-toggle="modal" data-target="#staticBackdrop">
                    </div>
                </div>
            <?php } else if ($usuario_autenticado == true) { ?>
                <form action="#" name="frmComentario" id="frmComentario" method="POST">
                    <div id="caixa-comentar">
                        <?php
                        $sql_user = "SELECT * FROM usuario WHERE id_usuario = " . $id_user;
                        $select_user = mysqli_query($conexao, $sql_user);
                        $rs_user = mysqli_fetch_array($select_user);

                        if ($rs_user['foto_usuario'] == 0) {
                        ?>
                            <div class="foto-usuario" style="background-image: url('./img/icon-profile.png');"></div>
                        <?php } else { ?>
                            <div class="foto-usuario" style="background-image: url('./upload/arquivos/<?= $rs_user['foto_usuario'] ?>');"></div>
                        <?php } ?>

                        <div class="input-comentario">
                            <textarea name="txtComentario" id="txtComentario" class="textarea-sunk-white" cols="30" rows="20" placeholder="Comente aqui o que você achou" required></textarea>
                            <input type="submit" class="btn-padrao borda-botao ml-auto" value="Postar" id="btnComentar" name="btnComentar">
                        </div>
                    </div>
                </form>
            <?php }
            // Script SQL para exibir os comentários da publicação
            $sql = "SELECT comentario.*, usuario.* FROM comentario INNER JOIN usuario ON comentario.id_usuario = usuario.id_usuario WHERE comentario.id_post = " . $_GET['id'];
            $select = mysqli_query($conexao, $sql);

            while ($result = mysqli_fetch_array($select)) {
            ?>
                <div id="caixa-comentarios" class="mx-auto">
                    <?php if ($result['foto_usuario'] == 0) { ?>
                        <div class="foto-usuario" style="background-image: url('./img/icon-profile.png');"></div>
                    <?php } else { ?>
                        <div class="foto-usuario" style="background-image: url('./upload/arquivos/<?= $result['foto_usuario'] ?>');"></div>
                    <?php } ?>
                    <div class="post-comentarios">
                        <strong class="comentario-usuario"><?= $result['nome_usuario'] ?></strong>
                        <p class="comentario-conteudo"><?= $result['conteudo_comentario'] ?>
                        </p>
                        <div class="opcoes-comentario">
                            <?php
                            if ($usuario_autenticado == true) {
                                if ($id_user == $result['id_usuario']) {
                            ?>
                                    <a onclick="return confirm('Tem certeza que deseja excluir esse comentário?')" href="./bd/excluir-comentario.php?modo=excluir&id_comment=<?= $result['id_comentario'] ?>">
                                        <small>Excluir</small>
                                    </a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 align-center-vertical ml-auto mr-auto" style="margin-top: 70px;">
                    <div class="footer-logo">
                        <img src="./img/logo-dry-laranja-footer.png" alt="Logo">
                    </div>
                    <button class="btn-padrao borda-botao" style="width: 140px;" data-toggle="modal" data-target="#modalContato">CONTATO</button>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    <h3 class="footer-title text-center">EXPLORE</h3>
                    <div class="footer-menu">
                        <a href="./index.php#clientes">Clientes</a> <br>
                        <a href="./index.php#cobertura">Cobertura</a> <br>
                        <a href="./blog.php">Blog</a> <br>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">TRANSPARÊNCIA</h3>
                    <div class="footer-menu">
                        <a href="./politica-de-privacidade.php">Política de Privacidade</a> <br>
                        <a href="./politica-de-privacidade.php#cookies">Política de Cookies</a> <br>
                        <a href="./politica-de-privacidade.php#LGPD">LGPD</a> <br>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">REDES SOCIAIS</h3>
                    <div id="redes-sociais" class="d-flex justify-content-center">
                        <div class="redes-sociais-pic mr-3">
                            <a href="https://instagram.com/drytelecom?igshid=YmMyMTA2M2Y" target="_blank">
                                <img src="./svg/icon-instagram.svg" alt="Instagram">
                            </a>
                        </div>
                        <div class="redes-sociais-pic">
                            <a href="https://www.linkedin.com/company/drycompanybrasil/" target="_blank">
                                <img src="./svg/icon-linkedin.svg" alt="LinkedIn">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="footer-credits">
                    2022. Dry Telecom. Todos os direitos reservados. CNPJ: 15.564.295/0001-04 RAZÃO SOCIAL: DRY COMPANY DO BRASIL TECNOLOGIA LTDA AV ANÁPOLIS, N° 510 - VILA NILVA - BARUERI/SP - CEP 06404-250
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://drytelecom.com.br/slick/slick.min.js"></script>

    <script>
        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        $('#exampleModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</body>

</html>