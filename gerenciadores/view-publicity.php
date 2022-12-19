<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location: ../login-gerenciador.php");
}

if ($_SESSION['tipo_autor'] == 5) {
    header('location: ./retailer-manager.php');
}

if (isset($_GET['modo'])) {
    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    if ($_GET['modo'] == 'visualizar') {
        $id_anuncio = $_GET['id'];

        $sql = "SELECT * FROM anuncios WHERE id_anuncio = " . $id_anuncio;
        $select = mysqli_query($conexao, $sql);

        if (!$select) {
            printf("Error: %s\n", mysqli_error($conexao));
            exit();
        }

        if ($result = mysqli_fetch_array($select)) {
            $foto_anuncio = $result['foto_anuncio'];
            $descricao_anuncio = $result['descricao_anuncio'];
            $status_anuncio = $result['status_anuncio'];

            if ($result['link_anuncio'] == "") {
                $link_anuncio = "Esse anúncio não possui link";
            } else {
                $link_anuncio = $result['link_anuncio'];
            }
        } else {
            header('location: publicity-list.php');
        }
    } else if ($_GET['modo'] == 'status') {
        $id_anuncio = $_GET['id'];

        $verificar_anuncio = "SELECT * FROM anuncios WHERE id_anuncio = " . $id_anuncio;
        $select_verificar = mysqli_query($conexao, $verificar_anuncio);
        $rs_verificacao = mysqli_fetch_array($select_verificar);

        if ($rs_verificacao['status_anuncio'] == true) {
            $sql = "UPDATE anuncios SET status_anuncio = false WHERE id_anuncio = " . $id_anuncio;

            if (mysqli_query($conexao, $sql)) {
                echo ("<script>history.back()</script>");
            } else {
                echo ("<script>alert('Erro ao desativar o anúncio')</script>");
                echo ($sql);
            }
        } else if ($rs_verificacao['status_anuncio'] == false) {
            $sql = "UPDATE anuncios SET status_anuncio = true WHERE id_anuncio = " . $id_anuncio;

            if (mysqli_query($conexao, $sql)) {
                echo ("<script>history.back()</script>");
            } else {
                echo ("<script>alert('Erro ao ativar o anúncio')</script>");
                echo ($sql);
            }
        }
    } else {
        header('location: publicity-list.php');
    }
} else {
    header('location: publicity-list.php');
}
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
    <title>Visualizar Anúncio - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <div class="view-post-table pt-5">
            <div class="post-img img-anuncio mx-auto">
                <img src="../upload/anuncios/<?= $foto_anuncio ?>" alt="Anúncio">
            </div>
            <div class="anuncio-text">
                <p><?= $descricao_anuncio ?></p>

                <p>
                    <strong>Link:</strong> <?= $link_anuncio ?>
                </p>
            </div>
            <div class="d-flex justify-content-around">
                <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
                    <span class="material-symbols-outlined">arrow_back_ios_new</span>
                </button>
                <a href="add-publicity.php?modo=editar&id=<?= $id_anuncio ?>" class="btn-padrao">
                    <span class="material-symbols-outlined">edit</span>
                </a>
                <a href="view-publicity.php?modo=status&id=<?= $id_anuncio ?>" class="btn-padrao">
                    <?php if ($status_anuncio == true) { ?>
                        <span class="material-symbols-outlined" style="font-size: 28px;">toggle_on</span>
                    <?php } else if ($status_anuncio == false) { ?>
                        <span class="material-symbols-outlined" style="color: #777; font-size: 28px">toggle_off</span>
                    <?php } ?>
                </a>
            </div>
        </div>
    </div>
</body>

</html>