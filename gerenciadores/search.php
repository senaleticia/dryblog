<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true && $_SESSION['autor_status'] == false) {
    header('location: ../login-gerenciador.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

$search = $_GET['search'];
$sql = "SELECT * FROM post WHERE titulo LIKE '%" . $search . "%' ORDER BY id_post DESC";
$select = mysqli_query($conexao, $sql);

if (!$select) {
    printf("Error: %s\n", mysqli_error($conexao));
    exit();
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
    <title>Pesquisa - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container mt-4">
        <button class="btn-padrao font-weight-bold mb-3" onclick="history.go(-1)">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </button>

        <div class="container-pesquisa m-0">
            <?php
            $row_count = mysqli_num_rows($select);

            if ($row_count == 0) {
            ?>
                <h6 class="font-weight-bold text-center">Nenhum resultado foi encontrado para sua pesquisa "<?= $search ?>"</h6>
            <?php } else if ($row_count >= 1) { ?>
                <h4 class="text-center">Resultados para sua pesquisa: "<?= $search ?>"</h4>

                <ul class="list-group mt-5">
                    <?php while ($result = mysqli_fetch_array($select)) { ?>
                        <li class="post-list">
                            <?= $result['titulo'] ?>
                            <div class="icons-box float-right">
                                <a href="./view-post.php?modo=visualizar&id=<?= $result['id_post'] ?>">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                                <a href="./add-post.php?modo=editar&id=<?= $result['id_post'] ?>">
                                    <span class="material-symbols-outlined">border_color</span>
                                </a>
                                <a onclick="return confirm('Tem certeza que deseja excluir o post?')" href="./delete.php?modo=excluir-post&id=<?= $result['id_post'] ?>">
                                    <span class="material-symbols-outlined">delete</span>
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</body>

</html>