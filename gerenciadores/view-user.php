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

if (isset($_GET['modo'])) {
    if ($_GET['modo'] == 'visualizar') {
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

            if ($result['tipo_autor'] == 1) {
                $nivel_autor = 'Administrador de Posts';
            } else if ($result['tipo_autor'] == 2) {
                $nivel_autor = 'Administrador Geral';
            } else if ($result['tipo_autor'] == 3) {
                $nivel_autor = 'Administrador Master';
            }

            if ($result['autor_status'] == true) {
                $status_autor = 'Ativo';
            } else if ($result['autor_status'] == false) {
                $status_autor = 'Inativo';
            }
        }
    } else if ($_GET['modo'] == 'status') {
        if ($_SESSION['tipo_usuario'] != 3) {
            echo ("<script>alert('Você não tem permissão para ativar/desativar usuários!')</script>");
            echo ("<script>history.back()</script>");
        } else {
            $id = $_GET['id'];

            $verificar_usuario = "SELECT * FROM autor WHERE id_autor = " . $id;
            $select_verificar = mysqli_query($conexao, $verificar_usuario);
            $rs_verificacao = mysqli_fetch_array($select_verificar);

            if ($rs_verificacao['autor_status'] == true) {
                $sql = "UPDATE autor SET autor_status = false WHERE id_autor = " . $id;

                if (mysqli_query($conexao, $sql)) {
                    echo ("<script>alert('Usuário desativado com sucesso')</script>");
                    echo ("<script>history.back()</script>");
                } else {
                    echo ("<script>alert('Erro ao desativar o usuário')</script>");
                    echo ($sql);
                }
            } else if ($rs_verificacao['autor_status'] == false) {
                $sql = "UPDATE autor SET autor_status = true WHERE id_autor = " . $id;

                if (mysqli_query($conexao, $sql)) {
                    echo ("<script>alert('Usuário ativado com sucesso')</script>");
                    echo ("<script>history.back()</script>");
                } else {
                    echo ("<script>alert('Erro ao ativar o usuário')</script>");
                    echo ($sql);
                }
            }
        }
    } else {
        header('location: users-manager.php');
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

        <div class="card-materia-lateral p-4 mx-auto align-items-stretch" style="width: 400px; gap: 10px;">
            <div class="flex-row">
                <strong>Nome: </strong> <?= $nome_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>E-mail: </strong> <?= $login_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>Nível de Acesso: </strong> <?= $nivel_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>Status: </strong> <?= $status_autor ?> <br>
            </div>
        </div>

        <div class="d-flex justify-content-around my-5">
            <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                <span class="material-symbols-outlined">
                    arrow_back_ios_new
                </span>
            </button>

            <?php if ($_SESSION['tipo_usuario'] == 3) { ?>
                <a href="./edit-user.php?editar=<?= $id ?>">
                    <button class="btn-padrao">
                        <span class="material-symbols-outlined">
                            edit
                        </span>
                    </button>
                </a>
            <?php } ?>

            <?php if ($_SESSION['tipo_usuario'] == 3) { ?>
                <a href="./view-user.php?modo=status&id=<?= $result['id_autor'] ?>">
                    <button class="btn-padrao">
                        <?php if ($status_autor == 'Ativo') { ?>
                            <span class="material-symbols-outlined" style="font-size: 28px;">toggle_on</span>
                        <?php } else if ($status_autor == 'Inativo') { ?>
                            <span class="material-symbols-outlined" style="color: #777; font-size: 28px">toggle_off</span>
                        <?php } ?>
                    </button>
                </a>
            <?php } ?>
        </div>
    </div>
</body>

</html>