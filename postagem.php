<?php
session_start();

//Colocando o boolean de usuário autenticado em uma variável
$usuario_autenticado = $_SESSION['usuarioAutenticado'];
//Colocando o ID do usuário ativo na sessão em uma variável
$id_user = $_SESSION['id_usuario'];

//Conexão com o banco de dados
require_once("./bd/conexao.php");
$conexao = conexaoMySql();

//Verificando se a variável 'p' existe na URL
if (isset($_GET['p'])) {
    $url = $_GET['p'];

    //Script para rodar no banco e trazer os dados do post
    $sql = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor WHERE post.url_post = '" . $url . "'";
    $select = mysqli_query($conexao, $sql);

    //Verificando se o script funcionou
    if (!$select) {
        printf("Error: %s\n", mysqli_error($conexao));
        exit();
    }

    if ($result = mysqli_fetch_array($select)) {
        $id = $result['id_post'];
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
        $data_atualizacao = $result['data_atualizacao'];

        //Adicionando quebra de linhas a cada "Enter" que o usuário der nos campos de texto
        $conteudo = $result['conteudo'];
        $order = array("\r\n", "\n", "\r");
        $replace = "<br>";
        $conteudo_final = str_replace($order, $replace, $conteudo);

        $conteudo2 = $result['segundo_conteudo'];
        $order = array("\r\n", "\n", "\r");
        $replace = "<br>";
        $segundo_conteudo_final = str_replace($order, $replace, $conteudo2);

        $conteudo3 = $result['terceiro_conteudo'];
        $order = array("\r\n", "\n", "\r");
        $replace = "<br>";
        $terceiro_conteudo_final = str_replace($order, $replace, $conteudo3);

        $conteudo4 = $result['quarto_conteudo'];
        $order = array("\r\n", "\n", "\r");
        $replace = "<br>";
        $quarto_conteudo_final = str_replace($order, $replace, $conteudo4);

        $tags = explode(';', $tags);
    } else {
        //Encaminhando o usuário para uma página de erro caso o post não exista ou foi excluído
        header('location: pagina-inexistente.php');
    }
} else {
    header('location: blog.php');
}

//Verificando se o botão "Comentar" foi acionado
if (isset($_POST['btnComentar'])) {
    $id;
    $id_usuario = $_SESSION['id_usuario'];
    $comentario = $_POST['txtComentario'];

    //Capturando data atual e colocando em uma variável
    date_default_timezone_set('America/Sao_paulo');
    $data = date('d/m/Y');

    if ($comentario == "") {
        echo ("<script>alert('Esse campo é obrigatório!');</script>");
    } else {
        //Script para inserir um comentário no banco de dados
        $sql_comment = "INSERT INTO comentario (id_post, id_usuario, conteudo_comentario, data_comentario) VALUES (" . $id . ", " . $id_usuario . ", '" . $comentario . "', '" . $data . "')";

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./guideline-social.css">
    <title><?= $titulo ?> - Dry Telecom</title>
</head>

<body>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <nav class="navbar navbar-expand-lg  navbar-light navbar-inner">
        <div class="container">
            <div id="navbar-mobile">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </div>

            <li class="nav-item" style="list-style: none;">
                <a class="navbar-brand" href="./index.php">
                    <img id="logo-index" src="./svg/logo-drytelecom.svg" alt="Logo">
                </a>
            </li>
            <div class="login-box">
                <?php if ($usuario_autenticado == true) { ?>
                    <a class="logout" href="./index.php?modo=logout">
                        <button class="btn-padrao btn-menu">SAIR</button>
                    </a>
                <?php } else if ($usuario_autenticado == false) { ?>
                    <a class="logout" href="./login.php">
                        <button class="btn-padrao btn-menu">LOGIN</button>
                    </a>
                <?php } ?>
            </div>

            <div class="menu-desk">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./blog.php">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-modal">
            <div class="colapse-nav-mobile">
                <span id="close-modal" class="material-symbols-outlined">
                    close
                </span>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./blog.php">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="pl-1">Curtiu?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Faça seu login para nos dizer o que achou agora mesmo!</p>
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
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body ml-auto mr-auto">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=5511980002870&text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20Dry%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!">
                            <button class="btn-padrao font-weight-bold">CONVERSE COM UM ESPECIALISTA</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="view-post-table mt-5">
                    <div class="titulo-padrao mt-5">
                        <h1 class="text-uppercase pb-3"><?= $titulo ?></h1>
                        <div class="caixa-tags pb-3">
                            <div class="tags mt-2 d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        folder_copy
                                    </span>
                                    <p class="btn-tag">
                                        <?= implode(";", $tags) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tags mt-2 d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        person
                                    </span>
                                    <p class="btn-tag">
                                        <?= $nome_autor ?>
                                    </p>
                                </div>
                            </div>
                            <div class="tags mt-2 d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">
                                        hourglass_empty
                                    </span>
                                    <p class="btn-tag">
                                        Leitura <?= $tempo_leitura ?>min
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="caixa-tags">
                            <div class="d-flex flex-column">
                                <p class="btn-tag pb-0">Postagem:</p>

                                <div class="d-flex align-items-center">
                                    <span class="material-symbols-outlined icon-tag">date_range</span>
                                    <p class="btn-tag font-weight-bold pb-0"><?= $data_post ?></p>
                                </div>
                            </div>
                            <?php if ($data_atualizacao != "") { ?>
                                <div class="d-flex flex-column">
                                    <p class="btn-tag pb-0">Atualização:</p>

                                    <div class="d-flex align-items-center">
                                        <span class="material-symbols-outlined icon-tag">date_range</span>
                                        <p class="btn-tag font-weight-bold pb-0"><?= $data_atualizacao ?></p>
                                    </div>
                                </div>
                            <?php } ?>
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
                            <iframe class="youtube-video" src="https://www.youtube.com/embed/<?= $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    <?php } ?>

                    <div class="d-flex justify-content-around mt-4">
                        <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                            <span class="material-symbols-outlined">
                                arrow_back_ios_new
                            </span>
                        </button>
                        <div id="div-copy-link">
                            <input type="text" id="copy-link" value="localhost/dryblog/postagem.php?p=<?= $url ?>">
                        </div>
                        <button class="btn-padrao font-weight-bold" id="copy-button" onclick="copiarLink()">
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
        $sql_relacionados = "SELECT * FROM post WHERE tags LIKE '%" . $tags[0] . "%' AND id_post <> " . $id . " LIMIT 4";
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
                        <a href="./postagem.php?p=<?= $rs_relacionados['url_post'] ?>">
                            <div class="card-materia-lateral">
                                <div class="materia-img" style="background-image: url('./upload/arquivos/<?= $rs_relacionados['foto'] ?>');"></div>
                                <h4 class="materia-title"><?= $rs_relacionados['titulo'] ?></h4>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php
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
            $sql = "SELECT comentario.*, usuario.* FROM comentario INNER JOIN usuario ON comentario.id_usuario = usuario.id_usuario WHERE comentario.id_post = " . $id . " ORDER BY comentario.id_comentario DESC";
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
                            <small>
                                <?= $result['data_comentario'] ?>
                            </small>
                            <?php
                            if ($usuario_autenticado == true) {
                                if ($id_user == $result['id_usuario']) {
                            ?>
                                    <div class="modal fade" id="modalExcluirComentario" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="TituloModalCentralizado">Excluir comentário</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                                        <span aria-hidden="true" class="material-symbols-outlined">close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem certeza que deseja excluir o comentário? Essa ação não poderá ser desfeita!
                                                </div>
                                                <div class="modal-footer p-3">
                                                    <button type="button" class="btn-padrao" data-dismiss="modal">Cancelar</button>
                                                    <a href="./bd/excluir-comentario.php?modo=excluir&id_comment=<?= $result['id_comentario'] ?>">
                                                        <button type="button" class="btn-secundario">Excluir</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a data-toggle="modal" data-target="#modalExcluirComentario">
                                        <small class="float-right">Excluir</small>
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
                <div class="col-md-4 align-center-vertical mx-auto" style="margin-top: 70px;">
                    <div class="footer-logo">
                        <img src="./svg/logo-drytelecom.svg" alt="Logo">
                    </div>
                    <button class="btn-padrao borda-botao" style="width: 140px;" data-toggle="modal" data-target="#modalContato">CONTATO</button>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4">
                    <h3 class="footer-title text-center">EXPLORE</h3>
                    <div class="footer-menu">
                        <a href="./index.php#clientes">Clientes</a>
                        <a href="./index.php#cobertura">Cobertura</a>
                        <a href="./blog.php">Blog</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">TRANSPARÊNCIA</h3>
                    <div class="footer-menu">
                        <a href="./politica-de-privacidade.php">Política de Privacidade</a>
                        <a href="./politica-de-privacidade.php#cookies">Política de Cookies</a>
                        <a href="./politica-de-privacidade.php#LGPD">LGPD</a>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>

    <script>
        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        $('#exampleModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        $('#modalExcluirComentario').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        function copiarLink() {
            let textoCopiado = document.querySelector('#copy-link');
            textoCopiado.select();
            textoCopiado.setSelectionRange(0, 99999);
            document.execCommand('copy');
            Swal.fire(
                'Link copiado!',
                'Agora você pode compartilhar essa publicação com seus amigos',
                'success'
            )
        }
    </script>
</body>

</html>