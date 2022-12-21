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

if (isset($_POST['filtroOpcao'])) {
    $opcao = $_POST['filtroOpcao'];
}

$selectedAtivo = "selected";
$selectedInativo = "";
$selectedAll = "";
$filtro = "";

if (isset($_POST['sltFiltro'])) {
    $filtro = $_POST['sltFiltro'];

    if ($filtro == "todos") {
        $selectedAll = "selected";
        $selectedAtivo = "";
    } else if ($filtro == "inativo") {
        $selectedInativo = "selected";
        $selectedAtivo = "";
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Gerenciar Usuários - Dry Telecom</title>
</head>

<body>
    <header id="header-gerenciadores">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="mt-5">
                    <h2>Bem-vindo(a), <?= $_SESSION['nome_autor'] ?>!</h2>
                </div>
                <div class="dropdown mt-5">
                    <button class="btn-padrao dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="material-symbols-outlined">person</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./edit-profile.php?user=<?= $_SESSION['id_autor'] ?>">Editar Perfil</a>
                        <a class="dropdown-item" href="./change-password.php?user=<?= $_SESSION['id_autor'] ?>">Alterar Senha</a>
                        <a class="dropdown-item" href="./logout.php">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-5">
        <div class="mb-4 d-flex justify-content-center" style="gap: 36px;">
            <a href="./" class="btn-padrao btn-gerenciar">
                GERENCIAR POSTAGENS
            </a>
            <button class="btn-padrao btn-gerenciar ativo">
                GERENCIAR USUÁRIOS
            </button>
            <?php if ($_SESSION['adm_revendedores'] == 1 || $_SESSION['adm_revendedores'] == 2) { ?>
                <a href="./retailer-manager.php" class="btn-padrao btn-gerenciar">
                    GERENCIAR REVENDEDORES
                </a>
            <?php } ?>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="./add-user.php" class="btn-secundario">
                ADICIONAR NOVO USUÁRIO
            </a>

            <form action="#" method="POST" name="frmConsulta">
                <div class="mb-3 position-relative">
                    <label for="sltFiltro" style="padding-left: 18px;">Filtrar Usuários:</label>
                    <span class="material-symbols-outlined seta-select" style="top: 55%; right: 5%;">expand_more</span>
                    <select name="sltFiltro" id="sltFiltro" class="form-control select" onchange="this.form.submit()">
                        <option name="filtroOpcao" value="ativo" <?= $selectedAtivo ?>>Ativos</option>
                        <option name="filtroOpcao" value="inativo" <?= $selectedInativo ?>>Inativos</option>
                        <option name="filtroOpcao" value="todos" <?= $selectedAll ?>>Todos</option>
                    </select>
                </div>
            </form>
        </div>

        <ul class="list-group">
            <?php
            $sql = "SELECT * FROM autor WHERE autor_status = true ORDER BY id_autor DESC";

            if ($filtro == "ativo") {
                $sql = "SELECT * FROM autor WHERE autor_status = true ORDER BY id_autor DESC";
            } else if ($filtro == "inativo") {
                $sql = "SELECT * FROM autor WHERE autor_status = false ORDER BY id_autor DESC";
            } else if ($filtro == "todos") {
                $sql = "SELECT * FROM autor ORDER BY id_autor DESC";
            }

            $select = mysqli_query($conexao, $sql);

            if (!$select) {
                printf("Error: %s\n", mysqli_error($conexao));
                exit();
            }

            while ($result = mysqli_fetch_array($select)) {
            ?>
                <li class="post-list">
                    <?= $result['nome_autor'] ?>

                    <div class="icons-box">
                        <a href="./view-user.php?modo=visualizar&id=<?= $result['id_autor'] ?>">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>

                        <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
                            <a href="./edit-user.php?editar=<?= $result['id_autor'] ?>">
                                <span class="material-symbols-outlined">border_color</span>
                            </a>
                        <?php } ?>

                        <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
                            <a href="./view-user.php?modo=status&id=<?= $result['id_autor'] ?>">
                                <?php if ($result['autor_status'] == true) { ?>
                                    <span class="material-symbols-outlined" style="font-size: 28px; color: #FE5000;">toggle_on</span>
                                <?php } else if ($result['autor_status'] == false) { ?>
                                    <span class="material-symbols-outlined" style="color: #313131; font-size: 28px;">toggle_off</span>
                                <?php } ?>
                            </a>
                        <?php } else if ($_SESSION['adm_usuarios'] == 1) {
                        ?>
                            <a href="#" class="inativo">
                                <?php if ($result['autor_status'] == true) { ?>
                                    <span class="material-symbols-outlined" style="font-size: 28px; color: #FE5000;">toggle_on</span>
                                <?php } else if ($result['autor_status'] == false) { ?>
                                    <span class="material-symbols-outlined" style="color: #313131; font-size: 28px;">toggle_off</span>
                                <?php } ?>
                            </a>
                        <?php }
                        ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>