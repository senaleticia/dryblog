<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

if (isset($_GET['user'])) {
    $id = $_GET['user'];

    if ($_SESSION['id_autor'] != $id) {
        header("location: index.php");
    }

    $sql = "SELECT * FROM autor WHERE id_autor = " . $id;
    $select = mysqli_query($conexao, $sql);

    if (!$select) {
        printf("Error: %s\n", mysqli_error($conexao));
        exit();
    }

    if ($result = mysqli_fetch_array($select)) {
        $nome_autor = $result['nome_autor'];
        $login_autor = $result['login_autor'];
    }

    if (isset($_POST['btnEditarPerfil'])) {
        $senha_confirmacao = $_POST['txtConfirmarIdentidade'];
        $nome_autor = $_POST['txtNome'];
        $login_autor = $_POST['txtEmail'];

        $verificar_email = "SELECT * FROM autor WHERE login_autor = '" . $login_autor . "'";
        $select_email = mysqli_query($conexao, $verificar_email);
        $rs_email = mysqli_fetch_array($select_email);

        if ($senha_confirmacao == "") {
            echo ("<script>alert('É necessário confirmar sua senha para prosseguir com as atualizações')</script>");
        } else if (sha1(md5($senha_confirmacao)) != $_SESSION['senha_autor']) {
            echo ("<script>alert('A senha está incorreta, os dados não serão atualizados')</script>");
        } else if ($login_autor == $_SESSION['login_autor']) {
            $sql = "UPDATE autor SET nome_autor = '" . $nome_autor . "' WHERE id_autor = " . $id;

            if (mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Perfil atualizado com sucesso')</script>");
                echo ("<script>window.location='index.php'</script>");
            } else {
                echo ("<script>alert('Erro ao atualizar o perfil')</script>");
                echo ($sql);
            }
        } else if ($login_autor == $rs_email['login_autor']) {
            echo ("Esse email já está sendo usado por outro usuário");
        } else {
            $sql = "UPDATE autor SET nome_autor = '" . $nome_autor . "', login_autor = '" . $login_autor . "' WHERE id_autor = " . $id;

            if (mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Perfil atualizado com sucesso')</script>");
                echo ("<script>window.location='index.php'</script>");
            } else {
                echo ("<script>alert('Erro ao atualizar o perfil')</script>");
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
    <title>Editar Perfil - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h2 class="my-4">Editar Perfil</h2>

        <form action="#" method="POST">
            <div class="mb-3">
                <label for="txtNome">Nome:</label>
                <input type="text" name="txtNome" id="txtNome" class="input-sunk-white" value="<?= $nome_autor ?>">
            </div>
            <div class="mb-3">
                <label for="txtEmail">Email:</label>
                <input type="text" name="txtEmail" id="txtEmail" class="input-sunk-white" value="<?= $login_autor ?>">
            </div>
            <div class="mb-3">
                <div class="instrucao-url mt-5">
                    <span>Para atualizar essas informações, solicitamos sua senha para certificar a identidade</span> <br>
                    <input type="password" name="txtConfirmarIdentidade" id="txtConfirmarIdentidade" class="input-sunk-white mt-2">
                </div>
            </div>
            <div class="d-flex justify-content-around mt-5">
                <a href="./index.php" class="btn-padrao font-weight-bold">
                    <span class="material-symbols-outlined">arrow_back_ios_new</span>
                </a>
                <button type="submit" class="btn-padrao" name="btnEditarPerfil" id="btnEditarPerfil">Atualizar</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>