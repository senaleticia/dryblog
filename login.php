<?php
// Conexão com o banco de dados
require "./bd/conexao.php";
$conexao = conexaoMySql();

// Inicia sessões
session_start();

//Definindo variáveis
$email = (string) "";
$senha = (string) "";
$erro = "";

if (isset($_POST['btnLogin'])) {
    $email = $_POST['txtEmailUsuario'];
    $senha = sha1(md5($_POST['txtSenhaUsuario']));

    $sql = "SELECT * FROM usuario WHERE login_usuario = '" . $email . "' AND senha_usuario = '" . $senha . "'";
    $select = mysqli_query($conexao, $sql);

    if ($result = mysqli_fetch_array($select)) {
        $_SESSION['id_usuario'] = $result['id_usuario'];
        $_SESSION['nome_usuario'] = $result['nome_usuario'];
        $_SESSION['foto_usuario'] = $result['foto_usuario'];
        $_SESSION['usuarioAutenticado'] = true;

        echo ("<script>history.go(-2)</script>");
    } else {
        $erro = "<div class='alert alerta-erro mt-5 mx-auto' role='alert'>
                    <h4 class='alert-heading text-center'>Ops, algo deu errado!</h4>
                    <p class='text-center m-0'>Usuário e/ou senha inválidos.</p>
                </div>";
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
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./guideline-social.css">
    <title>Login - Dry Telecom</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner fixed-top">
        <div class="container" style="justify-content: flex-start; gap: 23%;">
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
                        <a class="nav-link fonte-menu" href="./blog.php">BLOG</a>
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
                        <a class="nav-link fonte-menu" href="./#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center position-relative pt-4 margem-btn">
            <button class="btn-voltar font-weight-bold" onclick="history.go(-1)">
                <span class="material-symbols-outlined">arrow_back</span>
                VOLTAR
            </button>

            <h2 class="login-title">Login - Dry Telecom</h2>
        </div>
        <?= $erro ?>
        <div class="container-login mt-5">
            <form action="#" method="POST" id="loginUsuario" name="loginUsuario" style="width: 75%;">
                <div class="mb-3">
                    <label for="txtEmailUsuario" class="form-label">Email:</label>
                    <input class="input-sunk-white" type="email" id="txtEmailUsuario" name="txtEmailUsuario" aria-describedby="emailHelp" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="txtSenhaUsuario" class="form-label">Senha:</label>
                    <div class="pass-cont">
                        <input id="txtSenhaUsuario" name="txtSenhaUsuario" placeholder="Senha" required type="password" class="input-sunk-white">
                        <span onclick="view()" class="eye"></span>
                    </div>
                </div>
                <div class="d-flex justify-content-around">
                    <button type="submit" class="btn-padrao" name="btnLogin">Login</button>
                </div>
            </form>
        </div>

        <h5 class="text-center" style="margin-top: 90px;">Não possui conta? Crie uma agora mesmo!</h5>

        <div class="d-flex justify-content-center my-4">
            <a href="./cadastrar-usuario.php">
                <button class="btn-padrao ml-auto mr-auto">Criar Conta</button>
            </a>
        </div>
    </div>

    <script src="./js/script.js"></script>
    <script>
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
    </script>
</body>

</html>