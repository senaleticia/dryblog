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

if (isset($_POST['filtroOpcao'])) {
    $opcao = $_POST['filtroOpcao'];
}

$selectedAtivo = "";
$selectedInativo = "";
$selectedAll = "selected";

if (isset($_POST['sltFiltro'])) {
    $filtro = $_POST['sltFiltro'];

    if ($filtro == "ativo") {
        $selectedAtivo = "selected";
        $selectedAll = "";
    } else if ($filtro == "inativo") {
        $selectedInativo = "selected";
        $selectedAll = "";
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
    <title>Gerenciar Usuários - Dry Telecom</title>
</head>

<body>
    <header id="header-gerenciadores">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="mt-5">
                    <h2>Bem-vindo(a), <?= $_SESSION['nome_autor'] ?>!</h2>
                </div>
                <div class="logout mt-5">
                    <a href="../logout.php">
                        <button type="button" class="btn btn-outline-danger">Sair</button>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-5">
        <div class="mb-4 d-flex justify-content-center" style="gap: 36px;">
            <a href="./index.php" class="btn-padrao btn-gerenciar">
                GERENCIAR POSTAGENS
            </a>
            <button class="btn-padrao btn-gerenciar ativo">
                GERENCIAR USUÁRIOS
            </button>
        </div>

        <div class="my-5">
            <a href="./add-user.php">
                <button class="btn-secundario">
                    ADICIONAR NOVO USUÁRIO
                </button>
            </a>
        </div>

        <form action="#" method="POST" name="frmConsulta">
            <div class="mb-3">
                <label for="sltFiltro">Filtrar Usuários:</label>
                <select name="sltFiltro" id="sltFiltro" class="form-control" onchange="this.form.submit()">
                    <option name="filtroOpcao" value="todos" <?= $selectedAll ?>>Todos</option>
                    <option name="filtroOpcao" value="ativo" <?= $selectedAtivo ?>>Ativos</option>
                    <option name="filtroOpcao" value="inativo" <?= $selectedInativo ?>>Inativos</option>
                </select>
            </div>
        </form>

        <ul class="list-group">
            <?php
            $sql = "SELECT * FROM autor";

            if ($filtro == "ativo") {
                $sql = $sql . " WHERE autor_status = true ORDER BY id_autor DESC";
            } else if ($filtro == "inativo") {
                $sql = $sql . " WHERE autor_status = false ORDER BY id_autor DESC";
            } else {
                $sql = $sql . " ORDER BY id_autor DESC";
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

                    <div class="icons-box float-right">
                        <a href="./view-user.php?modo=visualizar&id=<?= $result['id_autor'] ?>">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="./add-user.php?modo=editar&id=<?= $result['id_autor'] ?>">
                            <span class="material-symbols-outlined">border_color</span>
                        </a>
                        <a href="./view-user.php?modo=status&id=<?= $result['id_autor'] ?>">
                            <?php if ($result['autor_status'] == true) { ?>
                                <span class="material-symbols-outlined" style="font-size: 28px; color: #FE5000;">toggle_on</span>
                            <?php } else if ($result['autor_status'] == false) { ?>
                                <span class="material-symbols-outlined" style="color: #777; font-size: 28px;">toggle_off</span>
                            <?php } ?>
                        </a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>

</html>