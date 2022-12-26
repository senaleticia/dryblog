<?php
require_once('./bd/conexao.php');
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];

$erro = "";

if (isset($_POST['btnRepresentante'])) {
    $nome = $_POST['txtNomeRepresentante'];
    $email = $_POST['txtEmailRepresentante'];
    $celular = $_POST['txtCelularRepresentante'];
    $cep = $_POST['txtCepRepresentante'];
    $tipo_documento = $_POST['radioDocumento'];
    $cpf_cnpj = $_POST['txtCpfCnpjRepresentante'];
    $vendas = $_POST['sltVendasChip'];
    $mensagem = addslashes($_POST['txtMensagemRepresentante']);

    $verificar_email = "SELECT * FROM representantes WHERE email_representante = '" . $email . "'";
    $select_email = mysqli_query($conexao, $verificar_email);
    $count_email = mysqli_num_rows($select_email);

    if ($tipo_documento == "") {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>Você precisa marcar o tipo do seu documento antes de continuar!</p>
                </div>";
    } else if ($tipo_documento == 'CPF' && strlen($cpf_cnpj) != 11) {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>A quantidade de caracteres do CPF está incorreta, tente novamente!</p>
                </div>";
    } else if ($tipo_documento == 'CNPJ' && strlen($cpf_cnpj) != 14) {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>A quantidade de caracteres do CNPJ está incorreta, tente novamente!</p>
                </div>";
    } else if ($count_email >= 1) {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>Este email já faz parte da lista dos representantes da Dry, tente outro!</p>
                </div>";
    } else if ($nome == "" || $email == "" || $celular == "" || $cpf_cnpj == "" || $cep == "" || $vendas == "") {
        $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                    <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                    <p class='m-0'>Campos obrigatórios não preenchidos, verifique-os e tente novamente</p>
                </div>";
    } else {
        $sql = "INSERT INTO representantes (nome_representante, email_representante, celular_representante, cep_representante, tipo_documento, cpf_cnpj_representante, expectativa_vendas, mensagem_representante, status_representante) VALUES ('" . $nome . "', '" . $email . "', '" . $celular . "', '" . $cep . "', '" . $tipo_documento . "', '" . $cpf_cnpj . "', '" . $vendas . "', '" . $mensagem . "', 'NÃO CONTATADO')";

        if ($select = mysqli_query($conexao, $sql)) {
            $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                        <h4 class='alert-heading'>Prontinho!</h4>
                        <p class='m-0'>Seu cadastro foi feito com sucesso, e em breve entraremos em contato com você. <a class='adesao' href='./'>Clique aqui para voltar à página inicial</a></p>
                    </div>";
        } else {
            echo ("<script>alert('Erro ao fazer o cadastro, tente novamente mais tarde')</script>");
            echo ("<script>history.back()</script>");
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
                        <a class="nav-link fonte-menu" href="#">REVENDA</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-modal">
            <div class="colapse-nav-mobile">
                <span id="close-modal" class="material-symbols-outlined">close</span>

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
                        <a class="nav-link fonte-menu" href="#">REVENDA</a>
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

        <div class="titulo-padrao text-center margem-form">
            <h1 class="font-weight-bold">Quer conquistar sua liberdade financeira?</h1>
        </div>

        <div class="d-flex flex-column align-items-center">
            <div class="content-revenda ">
                <div id="star-revenda" class="icon-revenda">
                    <span class="material-symbols-outlined">auto_awesome</span>
                </div>
                <div id="text-star-revenda">
                    <p>As nossas operadoras aproximam o público de suas paixões e proporcionam experiências diferentes de tudo que já foi visto no ramo de telefonia móvel.</p>
                </div>

                <div id="celebration-revenda" class="icon-revenda">
                    <span class="material-symbols-outlined">celebration</span>
                </div>
                <div id="text-celebration-revenda">
                    <p>Venha fazer a diferença. Seja um revendedor Dry Telecom e alcance sua autonomia.</p>
                </div>
            </div>
        </div>

        <section id="inscricao">
            <h1 class="font-weight-bold titulo-padrao margem-form">Curtiu? Preencha seus dados:</h1>

            <?= $erro ?>

            <form action="#inscricao" method="POST" id="cadastroRepresentante" name="cadastroRepresentante">
                <div class="card-cadastro mx-auto mt-5 bg-transparent">
                    <div class="mb-3">
                        <label for="txtNomeRepresentante">Nome completo*</label>
                        <input type="text" name="txtNomeRepresentante" id="txtNomeRepresentante" class="input-sunk-white" required>
                    </div>

                    <div class="mb-3">
                        <label for="txtEmailRepresentante">E-mail*</label>
                        <input type="email" name="txtEmailRepresentante" id="txtEmailRepresentante" class="input-sunk-white" required>
                    </div>

                    <div class="mb-3">
                        <label for="txtCelularRepresentante">Celular*</label>
                        <input type="number" name="txtCelularRepresentante" id="txtCelularRepresentante" class="input-sunk-white" required>
                    </div>

                    <div class="mb-3">
                        <label for="txtCepRepresentante">CEP*</label>
                        <input type="text" name="txtCepRepresentante" id="txtCepRepresentante" class="input-sunk-white" required>
                    </div>

                    <div class="mb-3">
                        <p>Tipo do Documento*</p>
                        <div class="d-flex flex-row" style="gap: 25px;">
                            <label class="label-radio">
                                CPF
                                <input type="radio" name="radioDocumento" value="CPF" required>
                                <span class="checkmark"></span>
                            </label>
                            <label class="label-radio">
                                CNPJ
                                <input type="radio" name="radioDocumento" value="CNPJ" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="txtCpfCnpjRepresentante">Documento (somente números)*</label>
                        <input type="number" name="txtCpfCnpjRepresentante" id="txtCpfCnpjRepresentante" class="input-sunk-white" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="txtVendasRepresentante">Quantos chips gostaria de vender?*</label>
                        <div class="position-relative">
                            <span class="material-symbols-outlined seta-select" style="top: 18%; right: 3%">expand_more</span>
                            <select name="sltVendasChip" id="sltVendasChip" class="select w-100 form-control" required>
                                <option value="0" selected>Selecione um valor</option>
                                <option value="20 a 50">20 a 50</option>
                                <option value="51 a 100">51 a 100</option>
                                <option value="101 a 200">101 a 200</option>
                                <option value="+200">+200</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="txtMensagemRepresentante">Deixe sua mensagem:</label>
                        <textarea name="txtMensagemRepresentante" id="txtMensagemRepresentante" class="textarea-sunk-white"></textarea>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn-padrao font-weight-bold" id="btnRepresentante" name="btnRepresentante">CADASTRAR-SE</button>
                    </div>

                    <div class="mt-4">
                        <small>*Campos Obrigatórios</small>
                    </div>
                </div>
            </form>
        </section>
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
                        <a href="#">Revenda</a>
                        <a href="./#clientes">Clientes</a>
                        <a href="./#cobertura">Cobertura</a>
                        <a href="./blog">Blog</a>
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
                            <a href="https://instagram.com/drytelecom" target="_blank">
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
        });

        const inputCelular = document.querySelector('#txtCelularRepresentante');
        const inputCep = document.querySelector('#txtCepRepresentante');
        const labelRadio = document.querySelectorAll('.label-radio');
        const inputDocumento = document.querySelector('#txtCpfCnpjRepresentante');

        inputCelular.addEventListener('focus', function() {
            this.setAttribute('onkeypress', 'if(this.value.length==11) return false;')
        });

        function cep() {
            let inputLength = inputCep.value.length;
            inputCep.maxLength = 9;

            if (inputLength === 5) {
                inputCep.value += "-";
            }
        }

        labelRadio.forEach((label) => {
            label.addEventListener('click', function() {
                let valorRadio = document.querySelector('input[name=radioDocumento]:checked').value;

                if (valorRadio == "CPF") {
                    inputDocumento.removeAttribute('disabled');
                    inputDocumento.value = "";
                    inputDocumento.setAttribute('onkeypress', 'if(this.value.length==11) return false;');
                } else if (valorRadio == "CNPJ") {
                    inputDocumento.removeAttribute('disabled');
                    inputDocumento.value = "";
                    inputDocumento.setAttribute('onkeypress', 'if(this.value.length==14) return false;');
                }
            });
        })

        inputCep.addEventListener('keypress', cep);
    </script>
</body>

</html>