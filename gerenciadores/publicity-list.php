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
    <title>Anúncios - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Lista de Anúncios</h1>
        <div class="d-flex justify-content-around" style="gap: 32px;">
            <?php
            $sql = "SELECT * FROM anuncios ORDER BY id_anuncio DESC";
            $select = mysqli_query($conexao, $sql);

            if (!$select) {
                printf("Error: %s\n", mysqli_error($conexao));
                exit();
            }

            while ($result = mysqli_fetch_array($select)) {
            ?>
                <div class="card-materia-lateral">
                    <div class="materia-img" style="background-image: url('../upload/arquivos/<?= $result['foto_anuncio'] ?>');"></div>
                    <a href="#">
                        <p class="limite-anuncio px-2 pt-2"><?= $result['descricao_anuncio'] ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>