<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['tipo_usuario'] == 1) {
    header('location: index.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

$nome_autor = (string) "";
$login_autor = (string) "";
$senha_autor = (string) "";
$nivel_autor = (int) 0;
$button = "Cadastrar";
$selectedAdminPost = "";
$selectedAdminGeral = "";
$selectedMaster = "";
$disabledSenha = "";

if (isset($_GET['modo']) && $_GET['modo'] == 'editar') {
    $id = $_GET['id'];

    $sql = "SELECT * FROM autor WHERE id_autor = " . $id;
    $select = mysqli_query($conexao, $sql);

    if (!$select) {
        printf("Error: %s\n", mysqli_error($conexao));
        exit();
    }

    if ($result = mysqli_fetch_array($select)) {
        $nome_autor = $result['nome_autor'];
        $login_autor = $result['login_autor'];
        $nivel_autor = $result['tipo_usuario'];

        if ($nivel_autor == 1) {
            $selectedAdminPost = "selected";
        } else if ($nivel_autor == 2) {
            $selectedAdminGeral = "selected";
        }

        if ($_SESSION['id_autor'] != $id) {
            $disabledSenha = "disabled";
        }

        $button = "Atualizar";
    }
}

if (isset($_POST['btnCadastrarUsuario'])) {
    $nome_autor = $_POST['txtNomeUsuario'];
    $login_autor = $_POST['txtLoginUsuario'];
    $senha_autor = sha1(md5($_POST['txtSenhaUsuario']));
    $nivel_autor = $_POST['sltNivel'];

    if ($nivel_autor == 0) {
        echo ("<script>alert('Selecione um nível do usuário para continuar!')</script>");
    } else if ($nome_autor == "" || $login_autor == "" || $senha_autor == "") {
        echo ("<script>alert('Alguns dos campos obrigatórios não foram preenchidos. Por favor, verifique-os e tente novamente.')</script>");
    } else if ($button == "Cadastrar") {
        $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor, tipo_usuario, autor_status) VALUES('" . $nome_autor . "', '" . $login_autor . "', '" . $senha_autor . "', " . $nivel_autor . ", true)";

        if ($select = mysqli_query($conexao, $sql)) {
            echo ("<script>alert('Usuário cadastrado com sucesso!')</script>");
            header('location: users-manager.php');
        } else {
            echo ("<script>alert('Erro ao cadastrar o usuário!')</script>");
            echo ($sql);
        }
    } else if ($button == "Atualizar") {
        $sql = "UPDATE autor SET nome_autor = '" . $nome_autor . "', login_autor = '" . $login_autor . "', senha_autor = '" . $senha_autor . "', tipo_usuario = '" . $nivel_autor . "' WHERE id_autor = " . $_GET['id'];

        if ($select = mysqli_query($conexao, $sql)) {
            echo ("<script>alert('Usuário cadastrado com sucesso!')</script>");
            header('location: users-manager.php');
        } else {
            echo ("<script>alert('Erro ao cadastrar o usuário!')</script>");
            echo ($sql);
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
    <title>Adicionar Usuário - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h3 class="my-4">Adicionar Usuário</h3>

        <form action="#" method="POST">
            <div class="mb-3">
                <label for="txtNomeUsuario" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="txtNomeUsuario" name="txtNomeUsuario" value="<?= $nome_autor ?>">
            </div>
            <div class="mb-3">
                <label for="txtLoginUsuario" class="form-label">Email:</label>
                <input type="email" class="form-control" id="txtLoginUsuario" name="txtLoginUsuario" value="<?= $login_autor ?>">
            </div>
            <?php if ($_SESSION['tipo_usuario'] != 3) { ?>
                <div class="mb-3">
                    <label for="txtSenhaUsuario" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="txtSenhaUsuario" name="txtSenhaUsuario" value="<?= $senha_autor ?>" <?= $disabledSenha ?>>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label for="sltNivel">Nível do Usuário:</label>
                <select name="sltNivel" id="sltNivel" class="form-control">
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
                <button type="submit" class="btn-padrao" name="btnCadastrarUsuario" id="btnCadastrarUsuario"><?= $button ?></button>
            </div>
        </form>
    </div>
</body>

</html>