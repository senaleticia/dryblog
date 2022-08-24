<?php
    session_start();

    require_once "./bd/conexao.php";
    $conexao = conexaoMySql();

    $usuario_autenticado = $_SESSION['usuarioAutenticado'];

    if(!isset($_GET['caixaPesquisa'])){
        header('location: ./blog.php');
    }

    $pesquisa = ($_GET['caixaPesquisa']);
    $sql = "SELECT * FROM post WHERE (titulo LIKE '%".$pesquisa."%') OR (conteudo LIKE '%".$pesquisa."%')";
    $select = mysqli_query($conexao, $sql);

    if(!$select){
        printf("Error: %s\n", mysqli_error($conexao));
        exit();
    }
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
    <title>Pesquisa - DryBlog</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner">
        <div class="container">
            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-light"></span>
            </button>
            <li class="nav-item mx-auto" style="list-style: none;">
                <a class="navbar-brand" href="./index.php">
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
        <div class="modal fade" id="modalContato" tabindex="-1" aria-labelledby="modalContatoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="mx-auto">Alguma dúvida?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=5511920000909&text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20Dry%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!">
                            <button class="btn-padrao font-weight-bold">CONVERSE COM UM ESPECIALISTA</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-pesquisa">
            <h4 class="mb-5">Resultados da sua pesquisa "<?=$pesquisa?>"</h4>
            <?php while($result = mysqli_fetch_array($select)){ ?>
                <div class="card-resultado mx-auto my-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="post-img" style="background-image: url('./upload/arquivos/<?=$result['foto']?>'); padding: 32%;"></div>
                        </div>
                        <div class="col-md-8">
                            <h5 style="color: #FE5000;" class="titulo-pesquisa font-weight-bold mb-4"><?=$result['titulo']?></h5>

                            <div class="resultado-text">
                                <?=$result['conteudo']?>
                            </div>

                            <div class="d-flex justify-content-center my-4">
                                <a href="./postagem.php?modo=visualizar&id=<?=$result['id_post']?>">
                                    <button class="btn-padrao font-weight-bold">VER MATÉRIA</button>
                                </a>
                            </div>
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
                        <img src="./img/logo-dry-laranja-footer.png" alt="Logo">
                    </div>
                    <button class="btn-padrao borda-botao" style="width: 140px;" data-toggle="modal" data-target="#modalContato">CONTATO</button>     
                </div>
                
            </div>
            <div class="row mb-5">
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
                        Política de Privacidade<br>
                        Política de Cookies<br>
                        LGPD<br>
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
        $('#staticBackdrop').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });

        $('#exampleModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
    </script>
</body>
</html>