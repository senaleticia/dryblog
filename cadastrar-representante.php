<?php
session_start();

require_once('./bd/conexao.php');
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];

$erro = "";

if (isset($_POST['btnRepresentante'])) {
    $nome_representante = $_POST['txtNomeRepresentante'];
    $endereco_representante = $_POST['txtEnderecoRepresentante'];
    $email_representante = $_POST['txtEmailRepresentante'];
    $celular_representante = $_POST['txtCelularRepresentante'];
    $mensagem_representante = $_POST['txtMensagemRepresentante'];

    $verificar_email = "SELECT * FROM representantes WHERE email_representante = '" . $email_representante . "'";
    $select_email = mysqli_query($conexao, $verificar_email);
    $count_email = mysqli_num_rows($select_email);

    if ($count_email >= 1) {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>Este email já faz parte da lista dos representantes da Dry, tente outro!</p>
                </div>";
    } else if ($nome_representante == "" || $endereco_representante == "" || $email_representante == "" || $celular_representante == "" || $mensagem_representante == "") {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>Campos obrigatórios não preenchidos, verifique-os e tente novamente.</p>
                </div>";
    } else {
        $sql = "INSERT INTO representantes (nome_representante, endereco_representante, email_representante, celular_representante, mensagem_representante) VALUES ('" . $nome_representante . "', '" . $endereco_representante . "', '" . $email_representante . "', '" . $celular_representante . "', '" . $mensagem_representante . "')";

        if ($select = mysqli_query($conexao, $sql)) {
            $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                        <h4 class='alert-heading text-center'>Cadastro feito!</h4>
                        <p>Seu cadastro foi feito corretamente, agora só aguardar e em breve entraremos em contato. <a class='adesao font-weight-bold' href='./index.php'>Volte à página inicial</a></p>
                    </div>";
        } else {
            $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                        <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                        <p class='m-0'>Houve um erro na hora do seu cadastro, tente novamente mais tarde.</p>
                    </div>";
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
    <link rel="stylesheet" href="./beneficios.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <title>Cadastro de Representante - Dry Telecom</title>
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

        <?= $erro ?>

        <form action="#" method="POST" id="cadastroRepresentante" name="cadastroRepresentante">
            <div class="card-cadastro mx-auto mt-3">
                <div class="mb-4">
                    <small>*Campos Obrigatórios</small>
                </div>

                <div class="mb-3">
                    <label for="txtNomeRepresentante">Nome Completo:*</label>
                    <input type="text" name="txtNomeRepresentante" id="txtNomeRepresentante" class="input-sunk-white">
                </div>
                <div class="mb-3">
                    <label for="txtEnderecoRepresentante">Endereço Completo:*</label>
                    <input type="text" name="txtEnderecoRepresentante" id="txtEnderecoRepresentante" class="input-sunk-white" required>
                </div>
                <div class="mb-3">
                    <label for="txtEmailRepresentante">Email:*</label>
                    <input type="email" name="txtEmailRepresentante" id="txtEmailRepresentante" class="input-sunk-white" required>
                </div>
                <div class="mb-3">
                    <label for="txtCelularRepresentante">Celular:*</label>
                    <input type="text" name="txtCelularRepresentante" id="txtCelularRepresentante" class="input-sunk-white">
                </div>
                <div class="mb-3">
                    <label for="txtMensagemRepresentante">Deixe sua mensagem:*</label>
                    <textarea name="txtMensagemRepresentante" id="txtMensagemRepresentante" class="textarea-sunk-white" required></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn-padrao font-weight-bold" id="btnRepresentante" name="btnRepresentante">CADASTRAR-SE</button>
                </div>
            </div>
        </form>
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
        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })
    </script>
</body>

</html>