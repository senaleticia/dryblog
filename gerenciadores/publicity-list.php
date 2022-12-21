<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location: ../login-gerenciador.php");
}

if ($_SESSION['adm_posts'] == 0) {
    header('location: retailer-manager.php');
}

$selectedAtivo = "selected";
$selectedInativo = "";
$selectedAll = "";
$filtro = "";

if (isset($_POST['sltAnuncio'])) {
    $filtro = $_POST['sltAnuncio'];

    if ($filtro == 'todos') {
        $selectedAll = 'selected';
        $selectedAtivo = '';
    } else if ($filtro == 'inativo') {
        $selectedInativo = 'selected';
        $selectedAtivo = '';
    }
}

require_once("../bd/conexao.php");
$conexao = conexaoMySql();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Anúncios - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center position-relative">
            <a class="btn-voltar font-weight-bold" href="./">
                <span class="material-symbols-outlined">arrow_back</span>
                <p>VOLTAR</p>
            </a>

            <h1 class="login-title">Lista de Anúncios</h1>
        </div>

        <div class="mt-5 d-flex justify-content-between align-items-center">
            <a href="./add-publicity.php" class="btn-secundario">
                ADICIONAR NOVO ANÚNCIO
            </a>

            <form action="#" method="POST" name="frmConsulta">
                <div class="mb-3 position-relative">
                    <label for="sltAnuncio" style="padding-left: 18px;">Filtrar Anúncios:</label>
                    <span class="material-symbols-outlined seta-select" style="top: 55%; right: 5%;">expand_more</span>
                    <select name="sltAnuncio" id="sltAnuncio" class="form-control select" onchange="this.form.submit()">
                        <option value="ativo" <?= $selectedAtivo ?>>Ativos</option>
                        <option value="inativo" <?= $selectedInativo ?>>Inativos</option>
                        <option value="todos" <?= $selectedAll ?>>Todos</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-center flex-wrap pt-5" style="gap: 32px;">
            <?php
            $sql = "SELECT * FROM anuncios WHERE status_anuncio = true ORDER BY id_anuncio DESC";

            if ($filtro == 'ativo') {
                $sql = "SELECT * FROM anuncios WHERE status_anuncio = true ORDER BY id_anuncio DESC";
            } else if ($filtro == 'inativo') {
                $sql = "SELECT * FROM anuncios WHERE status_anuncio = false ORDER BY id_anuncio DESC";
            } else if ($filtro == 'todos') {
                $sql = "SELECT * FROM anuncios ORDER BY id_anuncio DESC";
            }

            $select = mysqli_query($conexao, $sql);

            if (!$select) {
                printf("Error: %s\n", mysqli_error($conexao));
                exit();
            }

            while ($result = mysqli_fetch_array($select)) {
            ?>
                <div class="card-materia-lateral justify-content-between">
                    <div class="materia-img" style="background-image: url('../upload/anuncios/<?= $result['foto_anuncio'] ?>');"></div>
                    <p class="limite-anuncio px-2 pt-2"><?= $result['descricao_anuncio'] ?></p>
                    <div class="icons-box" style="gap: 20px;">
                        <a href="view-publicity.php?modo=visualizar&id=<?= $result['id_anuncio'] ?>">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="add-publicity.php?modo=editar&id=<?= $result['id_anuncio'] ?>">
                            <span class="material-symbols-outlined">border_color</span>
                        </a>
                        <a href="view-publicity.php?modo=status&id=<?= $result['id_anuncio'] ?>">
                            <?php if ($result['status_anuncio'] == true) { ?>
                                <span class="material-symbols-outlined" style="font-size: 28px; color: #FE5000;">toggle_on</span>
                            <?php } else if ($result['status_anuncio'] == false) { ?>
                                <span class="material-symbols-outlined" style="color: #313131; font-size: 28px;">toggle_off</span>
                            <?php } ?>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>