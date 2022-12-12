<?php
require_once("./bd/conexao.php");
$conexao = conexaoMySql();

$erro = "";
$script_modal = "";

if (isset($_FILES['fileFotoUsuario']) != "") {
    $arquivo = $_FILES['fileFotoUsuario'];

    if ($arquivo['size'] > 2097152) {
        die("Arquivo muito grande! O tamanho máximo é 2MB");
    }

    $diretorio = "./upload/perfil-usuarios/";
    $nome_arquivo = $arquivo['name'];
    $novo_nome_arquivo = uniqid();
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg' && $extensao != '') {
        die("Esse tipo de arquivo não é aceito");
    }

    if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . '.' . $extensao)) {

        if (isset($_POST['btnCadastro'])) {
            //Pegando valores do input e dando a sua variável especifica
            $nome_usuario = $_POST['txtNomeUsuario'];
            $login_usuario = $_POST['txtEmailUsuario'];
            $senha_usuario = $_POST['txtSenhaUsuario'];
            $confirmar_senha_usuario = $_POST['txtConfSenhaUsuario'];
            $foto_usuario = $novo_nome_arquivo . "." . $extensao;

            // Script para verificar se o e-mail que o usuário digitou já existe no banco
            $verificar_email = "SELECT * FROM usuario WHERE login_usuario = '" . $login_usuario . "'";
            $select_email = mysqli_query($conexao, $verificar_email);
            $count_email = mysqli_num_rows($select_email);

            if ($senha_usuario != $confirmar_senha_usuario) {
                $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                            <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                            <p class='m-0'>As senhas digitadas estão diferentes, verifique-as e tente novamente.</p>
                        </div>";
            } else if ($count_email >= 1) {
                $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                            <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                            <p class='m-0'>Este email já faz parte da lista dos DryLovers, tente outro!</p>
                        </div>";
            } else if ($nome_usuario == "" || $login_usuario == "" || $senha_usuario == "" || $confirmar_senha_usuario == "") {
                $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                            <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                            <p class='m-0'>Campos obrigatórios não preenchidos, verifique-os e tente novamente.</p>
                        </div>";
            } else {
                //Script SQL para inserir um post no banco de dados
                $sql = "INSERT INTO usuario (nome_usuario, login_usuario, senha_usuario, foto_usuario) VALUES ('" . $nome_usuario . "', '" . $login_usuario . "', sha1(md5('" . $confirmar_senha_usuario . "')), '" . $foto_usuario . "')";

                //Rodando a conexão com o banco de dados e o script SQL
                if ($select = mysqli_query($conexao, $sql)) {
                    $script_modal = "$('#myModal').modal('show');";
                } else {
                    echo ("<script>alert('Erro ao inserir cadastro')</script>");
                }
            }
        }
    } else {

        if (isset($_POST['btnCadastro'])) {
            //Pegando valores do input e dando a sua variável especifica
            $nome_usuario = $_POST['txtNomeUsuario'];
            $login_usuario = $_POST['txtEmailUsuario'];
            $senha_usuario = $_POST['txtSenhaUsuario'];
            $confirmar_senha_usuario = $_POST['txtConfSenhaUsuario'];

            // Script para verificar se o e-mail que o usuário digitou já existe no banco
            $verificar_email = "SELECT * FROM usuario WHERE login_usuario = '" . $login_usuario . "'";
            $select_email = mysqli_query($conexao, $verificar_email);
            $count_email = mysqli_num_rows($select_email);

            if ($senha_usuario != $confirmar_senha_usuario) {
                $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                            <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                            <p class='m-0'>As senhas digitadas estão diferentes, verifique-as e tente novamente.</p>
                        </div>";
            } else if ($count_email >= 1) {
                $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                            <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                            <p class='m-0'>Este email já faz parte da lista dos DryLovers, tente outro!</p>
                        </div>";
            } else if ($nome_usuario == "" || $login_usuario == "" || $senha_usuario == "" || $confirmar_senha_usuario == "") {
                $erro = "<div class='alert alerta-erro mt-3 mx-auto' role='alert'>
                            <h4 class='alert-heading'>Ops, espere um pouco...</h4>
                            <p class='m-0'>Campos obrigatórios não preenchidos, verifique-os e tente novamente.</p>
                        </div>";
            } else {
                //Script SQL para inserir um post no banco de dados
                $sql = "INSERT INTO usuario (nome_usuario, login_usuario, senha_usuario) VALUES ('" . $nome_usuario . "', '" . $login_usuario . "', sha1(md5('" . $confirmar_senha_usuario . "')))";

                //Rodando a conexão com o banco de dados e o script SQL
                if ($select = mysqli_query($conexao, $sql)) {
                    $script_modal = "$('#myModal').modal('show');";
                } else {
                    echo ("<script>alert('Erro ao inserir cadastro')</script>");
                }
            }
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
    <meta property="og:description" content="Somos uma Mobiletech que oferece serviços de telefonia móvel digital com cobertura em todo país, oferecendo experiências exclusivas com o que você gosta." />
    <meta name="geo.placename" content="BARUERI" />
    <meta name="geo.region" content="BR" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="svg/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/responsive.css">
    <title>Cadastro de Usuário - Dry Telecom</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner fixed-top">
        <div class="container" style="justify-content: flex-start; gap: 21%;">
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
    </nav>

    <div class="container mb-5">
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

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastro Feito!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Seu cadastro foi feito com sucesso! Agora <a href="./login">clique aqui</a> e você será redirecionado à página de login.
                    </div>
                    <div class="modal-footer">
                        <a href="./login.php" class="btn-padrao">Ok</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center position-relative pt-4 margem-btn">
            <button class="btn-voltar font-weight-bold" onclick="history.go(-1)">
                <span class="material-symbols-outlined">arrow_back</span>
                VOLTAR
            </button>

            <h1 style="font-size: 2rem;">Criar conta</h1>
        </div>

        <?= $erro ?>

        <form action="#" method="POST" name="cadastroUsuario" id="cadastroUsuario" enctype="multipart/form-data">
            <div class="card-cadastro mx-auto my-3">
                <small>*Campos obrigatórios</small>
                <div class="foto-input mx-auto">
                    <p class="text-center">Foto:</p>
                    <label class="input-group-text mx-auto" for="fileFotoUsuario">
                        <span class="material-symbols-outlined">file_upload</span>
                    </label>
                    <p class="desc-file-foto pt-3 text-center"></p>
                    <input type="file" class="form-control-file" id="fileFotoUsuario" name="fileFotoUsuario">
                </div>
                <div class="mb-3">
                    <label for="txtNomeUsuario" class="col-sm-2 col-form-label">Nome:*</label>
                    <input type="text" class="input-sunk-white" id="txtNomeUsuario" name="txtNomeUsuario">
                </div>
                <div class="mb-3">
                    <label for="txtEmailUsuario" class="col-sm-2 col-form-label">Email:*</label>
                    <input type="email" class="input-sunk-white" id="txtEmailUsuario" name="txtEmailUsuario">
                </div>
                <div class="mb-3">
                    <label for="txtSenhaUsuario" class="col-sm-2 col-form-label">Senha:*</label>
                    <div class="pass-cont">
                        <input type="password" class="input-sunk-white" id="txtSenhaUsuario" name="txtSenhaUsuario" required>
                        <span onclick="view()" class="eye"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="txtConfSenhaUsuario" class="col-sm-5 col-form-label">Confirmar Senha:*</label>
                    <div class="pass-cont">
                        <input type="password" class="input-sunk-white" id="txtConfSenhaUsuario" name="txtConfSenhaUsuario" required>
                        <span onclick="viewConfirma()" class="eye-confirma-senha"></span>
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn-padrao font-weight-bold" id="btnCadastro" name="btnCadastro">CADASTRAR-SE</button>
                </div>
            </div>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script>
        <?= $script_modal ?>

        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        function nameFileFoto() {
            let div = document.querySelector('.desc-file-foto');
            let input = document.getElementById('fileFotoUsuario');

            if ((div != null) && (input != null)) {
                div.addEventListener("click", function() {
                    input.click();
                });

                input.addEventListener("change", function() {
                    let nome = "Não há arquivo selecionado. Selecionar arquivo...";
                    if (input.files.length > 0) nome = input.files[0].name;
                    div.innerHTML = nome;
                });
            }
        }

        nameFileFoto();

        function view() {
            let x = document.getElementById("txtSenhaUsuario");
            let eye = document.querySelector(".eye");

            if (x.type === "password") {
                x.type = "text";
                eye.style.backgroundImage = "url('./svg/eye_open.svg')";
            } else {
                x.type = "password";
                eye.style.backgroundImage = "url('./svg/eye_close.svg')";
            }
        }

        function viewConfirma() {
            let x = document.getElementById("txtConfSenhaUsuario");
            let eye = document.querySelector(".eye-confirma-senha");

            if (x.type === "password") {
                x.type = "text";
                eye.style.backgroundImage = "url('./svg/eye_open.svg')";
            } else {
                x.type = "password";
                eye.style.backgroundImage = "url('./svg/eye_close.svg')";
            }
        }
    </script>
</body>

</html>