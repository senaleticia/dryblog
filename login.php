<?php
    // Conexão com o banco de dados
    require "./bd/conexao.php";
    $conexao = conexaoMySql();

    // Inicia sessões
    session_start();

    //Definindo variáveis
    $email = (string) "";
    $senha = (string) "";

    if(isset($_POST['btnLogin'])){
        $email = $_POST['txtEmailUsuario'];
        $senha = sha1(md5($_POST['txtSenhaUsuario']));

        $sql = "SELECT * FROM usuario WHERE login_usuario = '".$email."' AND senha_usuario = '".$senha."'";
        $select = mysqli_query($conexao, $sql);

        if($result = mysqli_fetch_array($select)){
            $_SESSION['id_usuario'] = $result['id_usuario'];
            $_SESSION['nome_usuario'] = $result['nome_usuario'];
            $_SESSION['foto_usuario'] = $result['foto_usuario'];
            $_SESSION['usuarioAutenticado'] = true;

            header("location: index.php");
        }else{
            echo("<script>alert('Usuário e/ou senha inválido')</script>");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
	<link rel="stylesheet" href="./guideline-social.css">
    <title>Login</title>
</head>
<body>
    <div class="materia-title">
        <h2 class="py-4">Login - DryBlog</h2>
    </div>
    <div class="container-login">
        <span id="msg-error"></span>
        <form action="#" method="POST" id="loginUsuario" name="loginUsuario">
            <div class="mb-3">
                <label for="txtEmailUsuario" class="form-label">Email:&nbsp;&nbsp;</label>
                <input class="input-sunk-white" type="email" id="txtEmailUsuario" name="txtEmailUsuario" aria-describedby="emailHelp" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="txtSenhaUsuario" class="form-label">Senha:&nbsp;</label>
                <input class="input-sunk-white" type="password" id="txtSenhaUsuario" name="txtSenhaUsuario" placeholder="Senha" required>
            </div>
            <div class="d-flex justify-content-around">
                <button type="submit" class="btn-padrao" name="btnLogin">Login</button>
            </div>
        </form>
    </div>
    <div class="container">
        <h5 class="text-center" style="margin-top: 90px;">Não possui conta? Crie uma agora mesmo!</h5>

        <div class="d-flex justify-content-center my-4">
            <a href="./cadastrar-usuario.php">
                <button class="btn-padrao ml-auto mr-auto">Criar Conta</button>
            </a>
        </div>       
    </div>
</body>
</html>