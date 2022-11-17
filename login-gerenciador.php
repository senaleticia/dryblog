<?php
// Conexão com o banco de dados
require "./bd/conexao.php";
$conexao = conexaoMySql();

// Inicia sessões
session_start();

//Definindo variáveis
$email = (string) "";
$senha = (string) "";

//Verificando a existência do botão "Entrar"
if (isset($_POST["btnEntrar"])) {
    //Pegando os valores digitados nos inputs e jogando em suas respectivas variáveis
    $email = $_POST['txtEmail'];
    $senha = sha1(md5($_POST['txtSenha']));

    //Script SQL para buscar usuário e senha digitados no banco de dados
    $sql = "SELECT * FROM autor WHERE login_autor = '" . $email . "' AND senha_autor = '" . $senha . "' AND autor_status = true";
    $select = mysqli_query($conexao, $sql);

    if ($result = mysqli_fetch_array($select)) {
        $_SESSION['nome_autor'] = $result['nome_autor'];
        $_SESSION['id_autor'] = $result['id_autor'];
        $_SESSION['tipo_usuario'] = $result['tipo_autor'];
        $_SESSION['login_autor'] = $result['login_autor'];
        $_SESSION['senha_autor'] = $result['senha_autor'];
        $_SESSION['gerenciadorAutenticado'] = true;

        header("location: gerenciadores/");
    } else {
        echo ("<script>alert('Usuário e/ou senha inválido')</script>");
        echo ($sql);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <title>Login Sistema Interno - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <div class="materia-title">
            <h2 class="py-4">Login - Sistema Interno</h2>
        </div>
        <div class="container-login">
            <form action="#" method="POST" name="formAutenticacao" id="formAutenticacao" style="width: 80%;">
                <div class="mb-3">
                    <label for="txtEmail" class="form-label">Email:</label>
                    <input type="email" class="input-sunk-white" id="txtEmail" name="txtEmail" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="txtSenha" class="form-label">Senha:</label>
                    <div id="pass-cont">
                        <input type="password" class="input-sunk-white" id="txtSenha" name="txtSenha" required>
                        <span onclick="view()" id="eye"></span>
                    </div>
                </div>
                <button type="submit" class="btn-padrao mx-auto" name="btnEntrar">Entrar</button>
            </form>
        </div>
    </div>

    <script>
        function view() {
            let x = document.getElementById("txtSenha");
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