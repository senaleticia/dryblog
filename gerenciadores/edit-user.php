<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['tipo_usuario'] != 3) {
    header('location: users-manager.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

$selectedAdminPost = "";
$selectedAdminGeral = "";
$selectedMaster = "";

if (isset($_GET['editar'])) {
    $id = $_GET['editar'];

    $sql = "SELECT * FROM autor WHERE id_autor = " . $id;
    $select = mysqli_query($conexao, $sql);

    if (!$select) {
        printf("Error: %s\n", mysqli_error($conexao));
        exit();
    }

    if ($result = mysqli_fetch_array($select)) {
        $nome_autor = $result['nome_autor'];
        $login_autor = $result['login_autor'];
        $senha_autor = $result['senha_autor'];
        $nivel_autor = $result['tipo_usuario'];

        if ($nivel_autor == 1) {
            $selectedAdminPost = "selected";
        } else if ($nivel_autor == 2) {
            $selectedAdminGeral = "selected";
        } else if ($nivel_autor == 3) {
            $selectedMaster = "selected";
        }
    }

    if (isset($_POST['btnAtualizarUsuario'])) {
        $senha_autor = $_POST['txtSenhaUsuario'];
        $nivel_autor = $_POST['sltNivel'];

        if ($senha_autor == "") {
            $sql = "UPDATE autor SET tipo_usuario = " . $nivel_autor . " WHERE id_autor = " . $id;
        } else {
            $sql = "UPDATE autor SET senha_autor = sha1(md5('" . $senha_autor . "')), tipo_usuario = " . $nivel_autor . " WHERE id_autor = " . $id;
        }

        if ($select = mysqli_query($conexao, $sql)) {
            echo ("<script>alert('Usuário atualizado com sucesso')</script>");
            echo ("<script>window.location='users-manager.php'</script>");
        } else {
            echo ("<script>alert('Erro ao atualizar o usuário')</script>");
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
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <title>Editar Usuário - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h3 class="my-4 text-center">Editar Usuário</h3>

        <div class="card-cadastro mx-auto">
            <div class="my-4 mx-auto" style="width: fit-content;">
                <div class="row" style="gap: 25px;">
                    <div class="d-flex flex-column text-right">
                        <strong>Usuário:</strong>
                        <strong>Login:</strong>
                    </div>
                    <div class="d-flex flex-column">
                        <span><?= $nome_autor ?></span>
                        <span><?= $login_autor ?></span>
                    </div>
                </div>
            </div>

            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="txtSenhaUsuario" class="form-label">Senha:</label>
                    <div class="pass-cont">
                        <input type="password" class="input-sunk-white" id="txtSenhaUsuario" name="txtSenhaUsuario">
                        <span onclick="view()" class="eye"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="sltNivel">Nível do Usuário:</label>
                    <select name="sltNivel" id="sltNivel" class="form-control select w-100">
                        <option value="0">Escolha um nível</option>
                        <option value="1" <?= $selectedAdminPost ?>>Administrador de Posts</option>
                        <option value="2" <?= $selectedAdminGeral ?>>Administrador Geral</option>
                        <option value="3" <?= $selectedMaster ?>>Administrador Master</option>
                    </select>
                </div>
                <div class="d-flex justify-content-around mt-5">
                    <a href="./users-manager.php" class="btn-padrao font-weight-bold">
                        <span class="material-symbols-outlined">arrow_back_ios_new</span>
                    </a>
                    <button type="submit" class="btn-padrao" name="btnAtualizarUsuario" id="btnAtualizarUsuario">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function view() {
            let x = document.getElementById("txtSenhaUsuario");
            let eye = document.querySelector(".eye");

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