<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador');
}

if ($_SESSION['tipo_usuario'] != 3) {
    header('location: ./');
}

require_once('../bd/conexao.php');
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <title>Revendedores Autorizados - Dry Telecom</title>
</head>

<body>
    <div class="container my-5">
        <button class="btn-padrao font-weight-bold" onclick="history.go(-1)">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </button>

        <h3 class="text-center pb-5">Revendedores Aceitos</h3>

        <div class="caixa-representantes">
            <?php
            $sql = "SELECT * FROM representantes WHERE status_representante = 'ACEITO' ORDER BY id_representante DESC";
            $select = mysqli_query($conexao, $sql);

            if (!$select) {
                printf("Error: s%\n", mysqli_error($conexao));
                exit();
            }

            while ($result = mysqli_fetch_array($select)) {
            ?>
                <div class="card-cadastro" style="width: 100%; gap: 24px;">
                    <div class="position-relative">
                        <div class="foto-representante mx-auto">
                            <?php if ($result['foto_representante'] != "") { ?>
                                <img class="mx-auto" src="../upload/revendedores/<?= $result['foto_representante'] ?>" alt="Foto">
                            <?php } else { ?>
                                <img class="mx-auto" src="../img/icon-profile.png" alt="Foto">
                            <?php } ?>

                            <a class="btn-transparent" href="retailer-edit.php?id=<?= $result['id_representante'] ?>">
                                <span class="material-symbols-outlined">photo_camera</span>
                            </a>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="mb-3">
                            <span class="text-grey">Nome:</span>
                            <span><?= $result['nome_representante'] ?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-grey">Email:</span>
                            <span><?= $result['email_representante'] ?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-grey">Celular:</span>
                            <span><?= $result['celular_representante'] ?></span>
                        </div>
                        <div class="mb-3">
                            <span class="text-grey">CPF / CNPJ:</span>
                            <span><?= $result['cpf_cnpj_representante'] ?></span>
                        </div>
                    </div>
                    <div>
                        <a href="retailer-status.php?modo=desativar&id=<?= $result['id_representante'] ?>" class="btn-padrao mx-auto" style="width: 210px;">
                            Desativar Revendedor
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>