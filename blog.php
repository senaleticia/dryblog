<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:url" content="drytelecom.com.br" />
    <meta property="og:title" content="Operadora de telefonia móvel digital" />
    <meta property="og:image" content="https://drytelecom.com.br/img/og-site.png" />
    <meta name="description" content="Somos uma Mobiletech que oferece serviços de telefonia móvel digital com cobertura em todo país, oferecendo experiências exclusivas com o que você gosta." />
    <meta name="geo.placename" content="BARUERI" />
    <meta name="geo.region" content="BR" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <link rel="stylesheet" href="./css/guideline-social.css">
    <title>Blog - Dry Telecom</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner fixed-top">
        <div class="container">
            <div id="navbar-mobile">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </div>

            <li class="nav-item" style="list-style: none;">
                <a class="navbar-brand" href="./">
                    <img id="logo-index" src="./svg/logo-drytelecom.svg" alt="Logo">
                </a>
            </li>
            <div class="login-box">
                <?php if ($usuario_autenticado == true) { ?>
                    <a class="logout" href="./index.php?modo=logout">
                        <button class="btn-padrao btn-menu">SAIR</button>
                    </a>
                <?php } else if ($usuario_autenticado == false) { ?>
                    <a class="logout" href="./login">
                        <button class="btn-padrao btn-menu">LOGIN</button>
                    </a>
                <?php } ?>
            </div>

            <div class="menu-desk">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./blog">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./#cobertura">COBERTURA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./cadastrar-representante">REVENDA</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-modal">
            <div class="colapse-nav-mobile">
                <span id="close-modal" class="material-symbols-outlined">close</span>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./#cobertura">COBERTURA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./cadastrar-representante">REVENDA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header pt-4">
                        <h2 class="pl-1">Curtiu?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Faça seu login para nos dizer o que achou agora mesmo!</p>
                    </div>
                    <div class="modal-footer">
                        <a href="./login" class="btn-secundario btn-modal">Entrar</a>
                        <a href="./cadastrar-usuario" class="btn-padrao btn-modal">Cadastrar-se</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalContato" tabindex="-1" aria-labelledby="modalContatoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="mx-auto">Alguma dúvida?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=5511980002870&text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20Dry%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!">
                            <button class="btn-padrao font-weight-bold">CONVERSE COM UM ESPECIALISTA</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn-padrao margem-btn font-weight-bold" onclick="history.go(-1)">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </button>

        <div id="row-posts" class="row">
            <div id="posts-principais" class="col-md-7">
                <?php
                $sql = "SELECT post.*, autor.* FROM post INNER JOIN autor ON post.id_autor = autor.id_autor ORDER BY id_post DESC";
                $select = mysqli_query($conexao, $sql);

                if (!$select) {
                    printf("Error: %s\n", mysqli_error($conexao));
                    exit();
                }

                while ($result = mysqli_fetch_array($select)) {
                ?>
                    <div class="container-chip mx-auto">
                        <div class="post-header">
                            <div class="post-profile">
                                <?php if ($result['foto_autor'] != "") { ?>
                                    <img src="./upload/perfil-admin/<?= $result['foto_autor'] ?>" alt="Foto de perfil">
                                <?php } else { ?>
                                    <img src="./img/icon-profile.png" alt="Foto de perfil">
                                <?php } ?>
                            </div>
                            <div class="post-name">
                                <span>
                                    <?= $result['nome_autor'] ?>
                                </span>
                                <div class="post-data">
                                    <?= $result['data_post'] ?>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h1 class="titulo-padrao"><?= $result['titulo'] ?></h1>
                        </div>
                        <div class="post-text">
                            <?= $result['previa_conteudo'] ?>
                        </div>
                        <?php
                        if ($result['foto'] != "") {
                        ?>
                            <div class="post-img mx-auto my-3">
                                <img src="./upload/blog/<?= $result['foto'] ?>" alt="Imagem">
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
                            <a href="./postagem.php?p=<?= $result['url_post'] ?>#comentarios">
                                <button class="btn-actions pt-2" style="display: flex; justify-content: center; gap: 5px;">
                                    <span class="material-symbols-outlined" style="color: #FE5000;">comment</span>
                                    <span class="number-actions"><?= $comentarios_count ?></span>
                                </button>
                            </a>
                            <textarea class="copy-link">http://localhost/dryblog/postagem.php?p=<?= $result['url_post'] ?></textarea>
                            <button class="btn-actions pt-2 copy-button" style="display: flex; justify-content: center; gap: 5px;">
                                <span class="material-symbols-outlined" style="color: #FE5000;">
                                    share
                                </span>
                            </button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="btn-padrao font-weight-bold" href="./postagem.php?p=<?= $result['url_post'] ?>">
                                VER MATÉRIA
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="coluna-mais-acessados" class="col-md-4">
                <div class="container-lado-direito">
                    <form id="form-pesquisa" action="pesquisa.php" method="GET">
                        <div class="position-relative d-flex">
                            <input type="text" id="caixaPesquisa" name="caixaPesquisa" placeholder="Pesquisar">
                            <button class="icon-search">
                                <span class="material-symbols-outlined">search</span>
                            </button>
                        </div>
                    </form>
                    <div>
                        <h3 class="titulo-secundario">MAIS ACESSADOS</h3>
                    </div>
                    <div class="scroll-container">
                        <div class="container-acessados pt-3">
                            <?php
                            $sql_popular = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor LIMIT 3";
                            $select_popular = mysqli_query($conexao, $sql_popular);

                            while ($rs_popular = mysqli_fetch_array($select_popular)) {
                            ?>
                                <a href="./postagem.php?p=<?= $rs_popular['url_post'] ?>">
                                    <div class="card-materia-lateral">
                                        <div class="materia-img" style="background-image: url('./upload/blog/<?= $rs_popular['foto'] ?>');"></div>
                                        <h4 class="materia-title"><?= $rs_popular['titulo'] ?></h4>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 align-center-vertical mx-auto">
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
                        <a href="./cadastrar-representante">Revenda</a>
                        <a href="./#clientes">Clientes</a>
                        <a href="./#cobertura">Cobertura</a>
                        <a href="#">Blog</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">TRANSPARÊNCIA</h3>
                    <div class="footer-menu">
                        <a href="./politica-de-privacidade">Política de Privacidade</a>
                        <a href="./politica-de-privacidade#cookies">Política de Cookies</a>
                        <a href="./politica-de-privacidade#LGPD">LGPD</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">REDES SOCIAIS</h3>
                    <div id="redes-sociais" class="d-flex justify-content-center">
                        <div class="redes-sociais-pic mr-3">
                            <a href="https://instagram.com/drytelecom?" target="_blank">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/script.js"></script>

    <script>
        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        const compartilharBtn = document.querySelectorAll('.copy-button');

        function compartilhar() {
            this.previousElementSibling.select();
            this.previousElementSibling.setSelectionRange(0, 99999);

            document.execCommand('copy');
            Swal.fire(
                'Pronto!',
                'O link foi copiado, agora aproveite e compartilhe nas suas redes sociais!',
                'success'
            );
        }

        compartilharBtn.forEach((botao) => {
            botao.addEventListener('click', compartilhar);
        });
    </script>

</body>

</html>