<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location:../login-gerenciador.php");
}

if ($_SESSION['tipo_autor'] == 5) {
    header('location: ./retailer-manager.php');
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Área de Gerenciadores - Dry Telecom</title>
</head>

<body>
    <header>
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
    <div class="container my-5">
        <div class="mb-4 d-flex justify-content-center" style="gap: 36px;">
            <button class="btn-padrao btn-gerenciar ativo">
                GERENCIAR POSTAGENS
            </button>
            <?php if ($_SESSION['tipo_autor'] == 2 || $_SESSION['tipo_autor'] == 3) { ?>
                <a href="./users-manager.php" class="btn-padrao btn-gerenciar">
                    GERENCIAR USUÁRIOS
                </a>
            <?php } ?>
            <?php if ($_SESSION['tipo_autor'] == 3 || $_SESSION['tipo_autor'] == 4 || $_SESSION['tipo_autor'] == 5) { ?>
                <a href="./retailer-manager.php" class="btn-padrao btn-gerenciar">
                    GERENCIAR REVENDEDORES
                </a>
            <?php } ?>
        </div>

        <div class="my-5 d-flex justify-content-between">
            <a href="./add-post.php" class="btn-secundario">
                CRIAR POST NOVO
            </a>
            <a href="./publicity-list.php" class="btn-secundario">
                VER ANÚNCIOS
            </a>
            <form id="pesquisar-post" action="search.php" method="GET">
                <div class="position-relative">
                    <input type="text" id="search" name="search" placeholder="Pesquisar">
                    <button class="icon-search top-reduce">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </div>
            </form>
        </div>

        <?php
        $sql = "SELECT * FROM post ORDER BY id_post DESC";

        $select = mysqli_query($conexao, $sql);

        if (!$select) {
            printf("Error: %s\n", mysqli_error($conexao));
            exit();
        }

        while ($result = mysqli_fetch_array($select)) {
        ?>
            <ul class="list-group">
                <li class="post-list">
                    <?= $result['titulo'] ?>
                    <div class="icons-box float-right">
                        <a href="./view-post.php?modo=visualizar&id=<?= $result['id_post'] ?>">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="./add-post.php?modo=editar&id=<?= $result['id_post'] ?>">
                            <span class="material-symbols-outlined">border_color</span>
                        </a>
                        <a class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir o post?');" href="./delete.php?modo=excluir-post&id=<?= $result['id_post'] ?>&arquivo=<?= $result['foto'] ?>">
                            <span class="material-symbols-outlined">delete</span>
                        </a>
                    </div>
                </li>
            </ul>
        <?php
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const btnExcluir = document.querySelectorAll('.btn-excluir');

        btnExcluir.forEach(btn => {
            console.log(btn);
        })
    </script>
</body>

</html>