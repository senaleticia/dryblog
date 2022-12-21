<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['adm_usuarios'] == 0) {
    header('location: ./');
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

            if ($result['adm_posts'] == 1) {
                $adm_posts = 'Acesso a somente visualização de posts';
            } else if ($result['adm_posts'] == 2) {
                $adm_posts = 'Acesso total a administração de posts';
            } else if ($result['adm_posts'] == 0) {
                $adm_posts = 'Acesso não permitido aos posts';
            }

            if ($result['adm_usuarios'] == 1) {
                $adm_usuarios = 'Acesso a somente visualização de usuários';
            } else if ($result['adm_usuarios'] == 2) {
                $adm_usuarios = 'Acesso total a administração de usuários';
            } else if ($result['adm_usuarios'] == 0) {
                $adm_usuarios = 'Acesso não permitido aos usuários';
            }

            if ($result['adm_revendedores'] == 1) {
                $adm_revendedores = 'Acesso a somente visualização de revendedores';
            } else if ($result['adm_revendedores'] == 2) {
                $adm_revendedores = 'Acesso total a administração de revendedores';
            } else if ($result['adm_revendedores'] == 0) {
                $adm_revendedores = 'Acesso não permitido aos revendedores';
            }

            if ($result['autor_status'] == true) {
                $status_autor = 'Ativo';
            } else if ($result['autor_status'] == false) {
                $status_autor = 'Inativo';
            }
        }
    } else if ($_GET['modo'] == 'status') {
        if ($_SESSION['adm_usuarios'] != 2) {
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
                    echo ("<script>history.back()</script>");
                } else {
                    echo ("<script>alert('Erro ao desativar o usuário')</script>");
                    echo ($sql);
                }
            } else if ($rs_verificacao['autor_status'] == false) {
                $sql = "UPDATE autor SET autor_status = true WHERE id_autor = " . $id;

                if (mysqli_query($conexao, $sql)) {
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Visualizar Usuários - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container my-4">
        <h3 class="mb-5 text-center">Visualizar Usuário</h3>

        <div class="card-materia-lateral p-4 mx-auto align-items-stretch" style="width: 500px; gap: 15px;">
            <div class="flex-row">
                <strong>Nome: </strong> <?= $nome_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>E-mail: </strong> <?= $login_autor ?> <br>
            </div>
            <div class="flex-row">
                <strong>Nível de acesso aos posts: </strong> <?= $adm_posts ?> <br>
            </div>
            <div class="flex-row">
                <strong>Nível de acesso aos usuários: </strong> <?= $adm_usuarios ?> <br>
            </div>
            <div class="flex-row">
                <strong>Nível de acesso aos revendedores: </strong> <?= $adm_revendedores ?> <br>
            </div>
            <div class="flex-row">
                <strong>Status: </strong> <?= $status_autor ?> <br>
            </div>
        </div>

        <div class="d-flex justify-content-around my-5">
            <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                <span class="material-symbols-outlined">arrow_back_ios_new</span>
            </button>

            <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
                <a href="./edit-user.php?editar=<?= $id ?>">
                    <button class="btn-padrao">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                </a>
            <?php } ?>

            <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
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