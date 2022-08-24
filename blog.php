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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./guideline-social.css">
    <title>Blog - DryBlog</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner">
        <div class="container">
            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-light"></span>
            </button>
            <li class="nav-item ml-auto mr-auto" style="list-style: none;">
                <a class="navbar-brand" href="#">
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
            <?php if($usuario_autenticado == true){ ?>
                <a class="logout" href="./index.php?modo=logout">
                    <button class="btn-padrao">SAIR</button> 
                </a>
            <?php }else if($usuario_autenticado == false){ ?> 
                <a class="logout" href="./login.php">
                    <button class="btn-padrao">LOGIN</button> 
                </a> 
            <?php } ?>  
            </div>
        </div>       
    </nav>
    <button class="btn-padrao margem-btn font-weight-bold" onclick="history.go(-1)">
        <img src="./img/back-icon.png" alt="Voltar">
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
                $sql = "SELECT post.*, autor.* FROM post INNER JOIN autor ON post.id_autor = autor.id_autor";
                $select = mysqli_query($conexao, $sql);

                if(!$select){
                    printf("Error: %s\n", mysqli_error($conexao));
                    exit();
                }

                while($result = mysqli_fetch_array($select)){
            ?>
                <div class="container-chip">
                    <div class="post-header">
                        <div class="post-profile">
                        <?php if($result['foto_autor'] != ""){ ?>
                            <img src="./upload/arquivos/<?=$result['foto_autor']?>" alt="Foto de perfil">
                        <?php }else{ ?>
                            <img src="./img/icon-profile.png" alt="Foto de perfil">
                        <?php } ?>
                        </div>  
                        <div class="post-name">
                            <p>
                                <?=$result['nome_autor']?>
                            </p><br>
                            <div class="post-data">
                                <?=$result['data_post']?>
                            </div>
                        </div>                
                    </div>
                    <div class="titulo-padrao text-uppercase">
                        <h1><?=$result['titulo']?></h1>
                    </div>
                    <div class="post-text">
                        <p><?=$result['conteudo']?></p>
                    </div>
                <?php
                    if($result['foto'] != ""){
                ?>
                    <div class="post-img mx-auto my-3">
                        <img src="./upload/arquivos/<?=$result['foto']?>" alt="Imagem">
                    </div>
                    <?php
                    }
                        $sql_curtidas = "SELECT * FROM curtidas WHERE id_post = ".$result['id_post'];
                        $select_curtidas = mysqli_query($conexao, $sql_curtidas);
                        $curtidas_count = mysqli_num_rows($select_curtidas);

                        $sql_comentarios = "SELECT * FROM comentario WHERE id_post = ".$result['id_post'];
                        $select_comentarios = mysqli_query($conexao, $sql_comentarios);
                        $comentarios_count = mysqli_num_rows($select_comentarios);
                    ?>
                    <div class="post-buttons">
                    <?php 
                        if($usuario_autenticado == true){
                            $id_post = $result['id_post'];
                            $id_usuario = $_SESSION['id_usuario'];

                            $sql_curtir = "SELECT * FROM curtidas WHERE id_post = ".$id_post." AND id_usuario = ".$id_usuario;
                            $select_curtir = mysqli_query($conexao, $sql_curtir);
                            $row_count = mysqli_num_rows($select_curtir);

                            if($row_count >= 1){ ?>
                                <a href="./bd/curtir.php?modo=curtir&id_post=<?=$result['id_post']?>">
                                    <button class="btn-actions" style="display: flex; justify-content: center; gap: 5px; padding-top: 7px;">
                                        <span class="material-symbols-outlined icon-like" style="align-items: center;">thumb_up</span>
                                        <span class="number-actions" style="align-items: center;"><?=$curtidas_count?></span>
                                    </button>
                                </a>
                    <?php   }else if($row_count == 0){ ?>
                                <a href="./bd/curtir.php?modo=curtir&id_post=<?=$result['id_post']?>">
                                    <button class="btn-actions" style="display: flex; justify-content: center; gap: 5px; padding-top: 7px;">
                                        <span class="material-symbols-outlined" style="color: #FE5000;">thumb_up</span>
                                        <span class="number-actions" style="align-items: center;"><?=$curtidas_count?></span>
                                    </button>
                                </a>
                    <?php   }
                        }else if($usuario_autenticado == false){
                    ?>
                        <button class="btn-actions pt-2" style="display: flex; justify-content: center; gap: 5px; padding-top: 7px;" data-toggle="modal" data-target="#staticBackdrop">
                            <span class="material-symbols-outlined" style="color: #FE5000;">thumb_up</span>
                            <span class="number-actions"><?=$curtidas_count?></span>
                        </button>
                    <?php }?>
                        <a href="./postagem.php?modo=visualizar&id=<?=$result['id_post']?>#comentarios">
                            <button class="btn-actions pt-2" style="display: flex; justify-content: center; gap: 5px;">
                            <span class="material-symbols-outlined" style="color: #FE5000;">comment</span>
                                <span class="number-actions"><?=$comentarios_count?></span>
                            </button>
                        </a>
                        <button class="btn-actions pt-2" style="display: flex; justify-content: center; gap: 5px;">
                            <span class="material-symbols-outlined" style="color: #FE5000;">
                                share
                            </span>
                        </button>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="./postagem.php?modo=visualizar&id=<?=$result['id_post']?>">
                            <button class="btn-padrao font-weight-bold">VER MATÉRIA</button>
                        </a>                       
                    </div>
                </div>
                <?php }?>
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
                            $sql_popular = "SELECT post.*, autor.nome_autor FROM post INNER JOIN autor ON post.id_autor = autor.id_autor ORDER BY id_post DESC LIMIT 3";
                            $select_popular = mysqli_query($conexao, $sql_popular);
                            
                            while($rs_popular = mysqli_fetch_array($select_popular)){
                        ?>
                            <div class="card-materia-lateral">
                                <div class="materia-img" style="background-image: url('./upload/arquivos/<?=$rs_popular['foto']?>');"></div>
                                <a href="./postagem.php?modo=visualizar&id=<?=$rs_popular['id_post']?>">
                                    <h4 class="materia-title"><?=$rs_popular['titulo']?></h4>
                                </a>      
                            </div>
                        <?php }?>
                        </div>
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
                        <img src="./img/logo-dry-laranja-footer.png" alt="Logo"><br>
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
                                <img src="./img/icon-instagram.png" alt="Instagram">
                            </a>                           
                        </div>
                        <div class="redes-sociais-pic">
                            <a href="https://www.linkedin.com/company/drycompanybrasil/" target="_blank">
                                <img src="./img/icon-linkedin.png" alt="LinkedIn">
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

    <script>
        $('#staticBackdrop').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });

        $('#modalContato').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
    </script>

</body>
</html>