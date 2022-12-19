<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['tipo_autor'] == 1 || $_SESSION['tipo_autor'] == 2) {
    header('location: ./');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    require_once('../bd/conexao.php');
    $conexao = conexaoMySql();

    $sql_consulta = "SELECT * FROM representantes WHERE id_representante = " . $id;
    $select_consulta = mysqli_query($conexao, $sql_consulta);

    if (!$select_consulta) {
        printf("Error: %s\n", mysqli_error($conexao));
        exit();
    }

    $rs_consulta = mysqli_fetch_array($select_consulta);

    if (isset($_FILES['fotoRepresentante'])) {
        $arquivo = $_FILES['fotoRepresentante'];

        if ($arquivo['size'] > 2097152) {
            die('Arquivo muito grande! O tamanho máximo é 2MB');
        }

        $diretorio = "../upload/revendedores/";
        $nome_arquivo = $arquivo['name'];
        $novo_nome_arquivo = uniqid();
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

        if ($extensao != 'png' && $extensao != 'jpg' && $extensao != 'jpeg') {
            die('Esse tipo de arquivo não é aceito');
        }

        if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . "." . $extensao)) {
            $foto_representante = $novo_nome_arquivo . "." . $extensao;

            $sql = "UPDATE representantes SET foto_representante = '" . $foto_representante . "' WHERE id_representante = " . $id;

            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Foto inserida com sucesso!')</script>");
                echo ("<script>window.location='retailer-authorized.php'</script>");
            } else {
                echo ("<script>alert('Erro ao inserir a foto')</script>");
                echo ($sql);
            }
        }
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
    <title>Adicionar Foto - Dry Telecom</title>
</head>

<body>
    <div class="container my-4">
        <a class="btn-padrao font-weight-bold" href="retailer-authorized.php">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </a>

        <h3 class="text-center pb-4">Adicionar Foto</h3>

        <div class="card-cadastro mx-auto d-flex justify-content-center flex-column">
            <div class="dados">
                <div class="mb-3">
                    <span class="text-grey">Nome:</span>
                    <span><?= $rs_consulta['nome_representante'] ?></span>
                </div>
                <div class="mb-3">
                    <span class="text-grey">Email:</span>
                    <span><?= $rs_consulta['email_representante'] ?></span>
                </div>
                <div class="mb-3">
                    <span class="text-grey">CPF / CNPJ:</span>
                    <span><?= $rs_consulta['cpf_cnpj_representante'] ?></span>
                </div>
                <div class="mb-5">
                    <span class="text-grey">Celular:</span>
                    <span><?= $rs_consulta['celular_representante'] ?></span>
                </div>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                <label for="fotoRepresentante" class="upload-foto mx-auto">
                    Escolher foto: &nbsp;
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <div class="desc-file-foto mb-3 text-center"></div>
                <input type="file" name="fotoRepresentante" id="fotoRepresentante">

                <button type="submit" class="btn-padrao mx-auto mt-4" name="btnUpload" id="btnUpload">Enviar</button>
            </form>
        </div>
    </div>

    <script>
        function nameFileFoto() {
            let div = document.querySelector('.desc-file-foto');
            let input = document.getElementById('fotoRepresentante');

            if ((div != null) && (input != null)) {
                div.addEventListener("click", function() {
                    input.click();
                });

                input.addEventListener("change", function() {
                    let nome = "Não há arquivo selecionado. Selecionar arquivo...";
                    if (input.files.length > 0) nome = input.files[0].name;
                    div.innerHTML = nome;
                });
            }
        }

        nameFileFoto();
    </script>
</body>

</html>