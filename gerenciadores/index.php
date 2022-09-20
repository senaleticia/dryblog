<?php
if (!isset($_SESSION)) {
    session_start();
}

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location:../login-gerenciador.php");
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <title>Área de Gerenciadores - Dry Telecom</title>
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
    <div class="container my-5">
        <h1 class="mb-4 text-center">Lista de Postagens</h1>

        <div class="my-5 d-flex justify-content-between">
            <a href="./add-post.php" class="btn-secundario">
                CRIAR POST NOVO
            </a>
            <a href="./publicity-list.php" class="btn-secundario disabled">
                VER ANÚNCIOS
            </a>
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
                        <a href="./view-post.php?modo=visualizar&id=<?= $result['id_post'] ?>" style="display: inline-block;">
                            <span class="material-symbols-outlined">visibility</span>
                        </a>
                        <a href="./add-post.php?modo=editar&id=<?= $result['id_post'] ?>">
                            <span class="material-symbols-outlined">border_color</span>
                        </a>
                        <a onclick="return confirm('Tem certeza que deseja excluir o post?');" href="./delete-post.php?modo=excluir&id=<?= $result['id_post'] ?>">
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
</body>

</html>