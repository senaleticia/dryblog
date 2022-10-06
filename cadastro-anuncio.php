<?php
session_start();

require './bd/conexao.php';
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];

if (isset($_GET['modo'])) {
    if ($_GET['modo'] == 'cadastrar') {
        $anuncio = $_GET['anuncio'];

        $anuncio_detalhes = "SELECT * FROM anuncios WHERE id_anuncio = " . $anuncio;
        $select_detalhes = mysqli_query($conexao, $anuncio_detalhes);

        if ($rs_detalhes = mysqli_fetch_array($select_detalhes)) {
            $foto_anuncio = $rs_detalhes['foto_anuncio'];
        } else {
            header('location: pagina-inexistente.php');
        }

        if (isset($_POST['btnCadastro'])) {
            $nome_cadastro = $_POST['txtNomeCadastro'];
            $email_cadastro = $_POST['txtEmailCadastro'];
            $telefone_cadastro = $_POST['txtTelefoneCadastro'];
            $profissao_cadastro = $_POST['txtProfissaoCadastro'];
            $receber_informacoes = isset($_POST['rdoReceberInformacoes']) ? 1 : 0;

            $sql = "INSERT INTO cadastro_anuncios (nome_cadastrado, email_cadastrado, telefone_cadastrado, profissao, receber_informacoes, id_anuncio) VALUES ('" . $nome_cadastro . "', '" . $email_cadastro . "', '" . $telefone_cadastro . "', '" . $profissao_cadastro . "', " . $receber_informacoes . ", " . $anuncio . ")";

            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Cadastro feito com sucesso')</script>");
            } else {
                echo ("<script>alert('Erro ao fazer o cadastro')</script>");
                echo ($sql);
            }
        }
    } else {
        header('location: blog.php');
    }
} else {
    header('location: blog.php');
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
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick-theme.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./guideline-social.css">
    <title>Cadastro Anúncio - Dry Telecom</title>
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

    <div class="container">
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

        <button class="btn-padrao margem-btn font-weight-bold" onclick="history.go(-1)">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </button>

        <h2 class="py-4 text-center">Anúncio Dry Telecom</h2>

        <div class="cadastro-anuncio">
            <div class="foto-anuncio">
                <img class="w-75" src="./upload/arquivos/<?= $foto_anuncio ?>" alt="Anúncio">
            </div>

            <div class="caixa-form-anuncio mt-5">
                <form action="#" method="POST" name="cadastroAnuncio" id="cadastroAnuncio">
                    <div class="my-3">
                        <small>*Campos Obrigatórios</small>
                        <div class="col-sm-12">
                            <input type="text" class="input-sunk-white" id="txtNomeCadastro" name="txtNomeCadastro" placeholder="Nome e Sobrenome*" required onkeypress="return validarEntrada(event, 'caracter');">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-sm-12">
                            <input type="email" class="input-sunk-white" id="txtEmailCadastro" name="txtEmailCadastro" placeholder="Email*" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="input-sunk-white" id="txtTelefoneCadastro" name="txtTelefoneCadastro" placeholder="Telefone*" required onkeypress="return validarEntrada(event, 'number');">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-sm-12">
                            <input type="text" class="input-sunk-white" id="txtProfissaoCadastro" name="txtProfissaoCadastro" placeholder="Profissão*" required onkeypress="return validarEntrada(event, 'caracter');">
                        </div>
                    </div>
                    <div class="caixa-checkbox mb-4 mx-auto">
                        <div>
                            <label class="label-radio">
                                Eu concordo em receber outras comunicações da Dry Telecom.
                                <input type="checkbox" name="radio" value="true">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <label class="label-radio">
                                Eu concordo em permitir que a Dry Telecom armazene e processe meus dados pessoais.*
                                <input type="checkbox" name="rdoReceberInformacoes" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <input type="submit" class="btn-padrao mx-auto" id="btnCadastro" name="btnCadastro" value="Cadastrar-se">
                    </div>
                </form>
            </div>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>

    <script>
        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</body>

</html>