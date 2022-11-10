<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['id_autor'] != $_GET['user']) {
    header("location: index.php");
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

$senha_atual = (string) "";
$nova_senha = (string) "";
$confirmar_senha = (string) "";

if (isset($_GET['user'])) {
    $sql_autor = "SELECT * FROM autor WHERE id_autor = " . $_SESSION['id_autor'];
    $select_autor = mysqli_query($conexao, $sql_autor);
    $rs_autor = mysqli_fetch_array($select_autor);

    if (isset($_POST['btnAlterarSenha'])) {
        $senha_atual = $_POST['txtSenhaAtual'];
        $nova_senha = $_POST['txtNovaSenha'];
        $confirmar_senha = $_POST['txtConfirmarSenha'];

        if (($senha_atual == '') || ($nova_senha == '') || ($confirmar_senha == '')) {
            echo ("<script>alert('Alguns dos campos não foram preenchidos corretamente. Por favor, verifique-os e tente novamente!')</script>");
        } else if (sha1(md5($senha_atual)) != $rs_autor['senha_autor']) {
            echo ("<script>alert('A senha atual está incorreta, tente novamente!')</script>");
        } else if ($nova_senha != $confirmar_senha) {
            echo ("<script>alert('As novas senhas não coincidem')</script>");
        } else {
            $sql = "UPDATE autor SET senha_autor = sha1(md5('" . $confirmar_senha . "')) WHERE id_autor = " . $_SESSION['id_autor'];

            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Senha alterada com sucesso')</script>");
                echo ("<script>window.location='index.php'</script>");
            } else {
                echo ("<script>alert('Erro ao alterar a senha')</script>");
                echo ($sql);
            }
        }
    }
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <title>Alterar Senha - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h2 class="my-4 text-center">Alterar Senha</h2>

        <div class="card-cadastro mx-auto">
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="txtSenhaAtual">Senha Atual:</label>
                    <div class="pass-cont">
                        <input type="password" name="txtSenhaAtual" id="txtSenhaAtual" class="input-sunk-white">
                        <span onclick="viewAtual()" class="eye"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="txtNovaSenha">Nova Senha:</label>
                    <div class="pass-cont">
                        <input type="password" name="txtNovaSenha" id="txtNovaSenha" class="input-sunk-white">
                        <span onclick="viewNova()" class="eye-nova-senha"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="txtConfirmarSenha">Confirme a Senha:</label>
                    <div class="pass-cont">
                        <input type="password" name="txtConfirmarSenha" id="txtConfirmarSenha" class="input-sunk-white">
                        <span onclick="viewConfirma()" class="eye-confirma-senha"></span>
                    </div>
                </div>
                <div class="d-flex justify-content-around mt-5">
                    <a href="./index.php" class="btn-padrao font-weight-bold">
                        <span class="material-symbols-outlined">arrow_back_ios_new</span>
                    </a>
                    <button type="submit" class="btn-padrao" name="btnAlterarSenha" id="btnAlterarSenha">Alterar Senha</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function viewAtual() {
            let x = document.getElementById("txtSenhaAtual");
            let eye = document.querySelector(".eye");

            if (x.type === "password") {
                x.type = "text";
                eye.style.backgroundImage = "url('../svg/eye_open.svg')";
            } else {
                x.type = "password";
                eye.style.backgroundImage = "url('../svg/eye_close.svg')";
            }
        }

        function viewNova() {
            let x = document.getElementById("txtNovaSenha");
            let eye = document.querySelector(".eye-nova-senha");

            if (x.type === "password") {
                x.type = "text";
                eye.style.backgroundImage = "url('../svg/eye_open.svg')";
            } else {
                x.type = "password";
                eye.style.backgroundImage = "url('../svg/eye_close.svg')";
            }
        }

        function viewConfirma() {
            let x = document.getElementById("txtConfirmarSenha");
            let eye = document.querySelector(".eye-confirma-senha");

            if (x.type === "password") {
                x.type = "text";
                eye.style.backgroundImage = "url('../svg/eye_open.svg')";
            } else {
                x.type = "password";
                eye.style.backgroundImage = "url('../svg/eye_close.svg')";
            }
        }
    </script>
</body>

</html>