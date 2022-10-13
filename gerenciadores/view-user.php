<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['tipo_usuario'] != 2) {
    header('location: index.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

if (isset($_GET['modo']) && $_GET['modo'] == 'visualizar') {
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

        if ($result['tipo_usuario'] == 1) {
            $nivel_autor = 'Administrador de Posts';
        } else if ($result['tipo_usuario'] == 2) {
            $nivel_autor = 'Administrador Geral';
        }
    }
} else {
    header('location: users-manager.php');
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
    <title>Visualizar Usuários - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container my-4">
        <h3 class="mb-5 text-center">Visualizar Usuário</h3>

        <div class="card-materia-lateral p-4 mx-auto align-items-stretch" style="max-width: 400px; gap: 10px;">
            <div class="flex-row">
                <strong>Nome: </strong> <?= $nome_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>E-mail: </strong> <?= $login_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>Nível de Acesso: </strong> <?= $nivel_autor ?> <br>
            </div>
        </div>

        <div class="d-flex justify-content-around my-5">
            <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                <span class="material-symbols-outlined">
                    arrow_back_ios_new
                </span>
            </button>
            <a href="./add-user.php?modo=editar&id=<?= $result['id_autor'] ?>">
                <button class="btn-padrao">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                </button>
            </a>
            <a onclick="return confirm('Atenção: Ao excluir esse usuário, tudo referente à ele, inclusive posts, também serão excluídos. Deseja realmente excluir esse usuário?');" href="./delete.php?modo=excluir-autor&id=<?= $result['id_autor'] ?>">
                <button class="btn-padrao">
                    <span class="material-symbols-outlined">
                        delete
                    </span>
                </button>
            </a>
        </div>
    </div>
</body>

</html>