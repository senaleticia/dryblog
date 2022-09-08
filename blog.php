<?php
session_start();

require_once('./bd/conexao.php');
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];
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
    <title>Blog - Dry Telecom</title>
</head>

<body>
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
    <button class="btn-padrao margem-btn font-weight-bold" onclick="history.go(-1)">
        <span class="material-symbols-outlined">arrow_back</span>
        VOLTAR
    </button>

    <div class="container">
        <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Ação Inválida</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
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
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
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

        <div id="row-posts" class="row">
            <div id="posts-principais" class="col-md-8">
                <?php
                $sql = "SELECT post.*, autor.* FROM post INNER JOIN autor ON post.id_autor = autor.id_autor ORDER BY id_post DESC";
                $select = mysqli_query($conexao, $sql);

                if (!$select) {
                    printf("Error: %s\n", mysqli_error($conexao));
                    exit();
                }

                while ($result = mysqli_fetch_array($select)) {
                ?>
                    <div class="container-chip">
                        <div class="post-header">
                            <div class="post-profile">
                                <?php if ($result['foto_autor'] != "") { ?>
                                    <img src="./upload/arquivos/<?= $result['foto_autor'] ?>" alt="Foto de perfil">
                                <?php } else { ?>
                                    <img src="./img/icon-profile.png" alt="Foto de perfil">
                                <?php } ?>
                            </div>
                            <div class="post-name">
                                <p>
                                    <?= $result['nome_autor'] ?>
                                </p><br>
                                <div class="post-data">
                                    <?= $result['data_post'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="titulo-padrao text-uppercase">
                            <h1><?= $result['titulo'] ?></h1>
                        </div>
                        <div class="post-text my-4">
                            <p><?= $result['conteudo'] ?></p>
                        </div>
                        <?php
                        if ($result['foto'] != "") {
                        ?>
                            <div class="post-img mx-auto my-3">
                                <img src="./upload/arquivos/<?= $result['foto'] ?>" alt="Imagem">
                            </div>
                        <?php
                        }
                        $sql_curtidas = "SELECT * FROM curtidas WHERE id_post = " . $result['id_post'];
                        $select_curtidas = mysqli_query($conexao, $sql_curtidas);
                        $curtidas_count = mysqli_num_rows($select_curtidas);

                        $sql_comentarios = "SELECT * FROM comentario WHERE id_post = " . $result['id_post'];
                        $select_comentarios = mysqli_query($conexao, $sql_comentarios);
                        $comentarios_count = mysqli_num_rows($select_comentarios);
                        ?>
                        <div class="post-buttons">
                            <?php
                            if ($usuario_autenticado == true) {
                                $id_post = $result['id_post'];
                                $id_usuario = $_SESSION['id_usuario'];

                                $sql_curtir = "SELECT * FROM curtidas WHERE id_post = " . $id_post . " AND id_usuario = " . $id_usuario;
                                $select_curtir = mysqli_query($conexao, $sql_curtir);
                                $row_count = mysqli_num_rows($select_curtir);

                                if ($row_count >= 1) { ?>
                                    <a href="./bd/curtir.php?modo=curtir&id_post=<?= $result['id_post'] ?>">
                                        <button class="btn-actions" style="display: flex; justify-content: center; gap: 5px; padding-top: 7px;">
                                            <span class="material-symbols-outlined icon-like" style="align-items: center;">thumb_up</span>
                                            <span class="number-actions" style="align-items: center;"><?= $curtidas_count ?></span>
                                        </button>
                                    </a>
                                <?php   } else if ($row_count == 0) { ?>
                                    <a href="./bd/curtir.php?modo=curtir&id_post=<?= $result['id_post'] ?>">
                                        <button class="btn-actions" style="display: flex; justify-content: center; gap: 5px; padding-top: 7px;">
                                            <span class="material-symbols-outlined" style="color: #FE5000;">thumb_up</span>
                                            <span class="number-actions" style="align-items: center;"><?= $curtidas_count ?></span>
                                        </button>
                                    </a>
                                <?php   }
                            } else if ($usuario_autenticado == false) {
                                ?>
                                <button class="btn-actions pt-2" style="display: flex; justify-content: center; gap: 5px; padding-top: 7px;" data-toggle="modal" data-target="#staticBackdrop">
                                    <span class="material-symbols-outlined" style="color: #FE5000;">thumb_up</span>
                                    <span class="number-actions"><?= $curtidas_count ?></span>
                                </button>
                            <?php } ?>
                            <a href="./postagem.php?modo=visualizar&id=<?= $result['id_post'] ?>#comentarios">
                                <button class="btn-actions pt-2" style="display: flex; justify-content: center; gap: 5px;">
                                    <span class="material-symbols-outlined" style="color: #FE5000;">comment</span>
                                    <span class="number-actions"><?= $comentarios_count ?></span>
                                </button>
                            </a>
                            <button class="btn-actions pt-2 btn-share" style="display: flex; justify-content: center; gap: 5px;" onclick="copyToClipBoard2()">
                                <span class="material-symbols-outlined" style="color: #FE5000;">
                                    share
                                </span>
                                <textarea style="font-size: 0; z-index: -1; position: absolute;" id="textArea2">localhost/dryblog/postagem.php?modo=visualizar&id=<?= $result['id_post'] ?></textarea>
                            </button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="link-materia" href="./postagem.php?modo=visualizar&id=<?= $result['id_post'] ?>">
                                <button class="btn-padrao font-weight-bold">VER MATÉRIA</button>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="coluna-mais-acessados" class="col-md-4">
                <div class="container-lado-direito">
                    <form action="pesquisa.php" method="GET">
                        <div class="position-relative d-flex">
                            <input type="text" id="caixaPesquisa" name="caixaPesquisa" placeholder="Pesquisar">
                            <button class="icon-search">
                                <img src="./img/icon-search.png" alt="Pesquisar">
                            </button>
                        </div>
                    </form>
                    <div>
                        <h3 class="titulo-secundario">MAIS ACESSADOS</h3>
                    </div>
                    <div class="scroll-container">
                        <div class="container-acessados">
                            <?php
                            $sql_popular = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor LIMIT 3";
                            $select_popular = mysqli_query($conexao, $sql_popular);

                            while ($rs_popular = mysqli_fetch_array($select_popular)) {
                            ?>
                                <div class="card-materia-lateral">
                                    <div class="materia-img" style="background-image: url('./upload/arquivos/<?= $rs_popular['foto'] ?>');"></div>
                                    <a href="./postagem.php?modo=visualizar&id=<?= $rs_popular['id_post'] ?>">
                                        <h4 class="materia-title"><?= $rs_popular['titulo'] ?></h4>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="anuncios">
                        <img src="./img/anuncio-pic.png" alt="Anúncio">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 align-center-vertical ml-auto mr-auto">
                    <div class="footer-logo">
                        <img src="./svg/logo-drytelecom.svg" alt="Logo">
                    </div>
                    <div class="botao-contato align-self-center">
                        <button class="btn-padrao borda-botao contato-btn" style="min-width: 140px;" data-toggle="modal" data-target="#modalContato">CONTATO</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3 class="footer-title text-center">EXPLORE</h3>
                    <div class="footer-menu">
                        <a href="./index.php#clientes">Clientes<br></a>
                        <a href="./index.php#cobertura">Cobertura<br></a>
                        <a href="./blog.php">Blog<br></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">TRANSPARÊNCIA</h3>
                    <div class="footer-menu">
                        <a href="./politica-de-privacidade.php">Política de Privacidade<br></a>
                        <a href="./politica-de-privacidade.php#cookies">Política de Cookies<br></a>
                        <a href="./politica-de-privacidade.php#LGPD">LGPD<br></a>
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
                <div class="footer-credits mb-5">
                    2022. Dry Telecom. Todos os direitos reservados. CNPJ: 15.564.295/0001-04 RAZÃO SOCIAL: DRY COMPANY DO BRASIL TECNOLOGIA LTDA AV ANÁPOLIS, N° 510 - VILA NILVA - BARUERI/SP - CEP 06404-250
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./script.js"></script>

    <script>
        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });
    </script>

</body>

</html>