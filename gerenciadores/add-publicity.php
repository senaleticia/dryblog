<?php
//Variável de sessão
session_start();

//Verificando se tem um gerenciador autenticado
if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location:../login-gerenciador.php");
};

//Conexão com o banco de dados
require_once("../bd/conexao.php");
$conexao = conexaoMySql();

if (isset($_FILES['fotoAnuncio'])) {
    $arquivo = $_FILES['fotoAnuncio'];

    if ($arquivo['size'] > 2097152) {
        die('Arquivo muito grande! O tamanho máximo é 2MB');
    }

    if ($arquivo['error']) {
        echo ('<script>alert("Falha ao enviar foto")</script>');
        echo ($arquivo);
    }

    $diretorio = '../upload/arquivos/';
    $nome_arquivo = $arquivo['name'];
    $novo_nome_arquivo = uniqid();
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'jpeg' && $extensao != 'png') {
        die('Esse tipo de arquivo não é aceito');
    }

    if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . "." . $extensao)) {
        if (isset($_POST['btnCadastrarPubli'])) {
            $foto_anuncio = $novo_nome_arquivo . "." . $extensao;
            $descricao_anuncio = $_POST['txtDescricaoAnuncio'];

            $sql = "INSERT INTO anuncios (foto_anuncio, descricao_anuncio) VALUES ('" . $foto_anuncio . "', '" . $descricao_anuncio . "')";

            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Anúncio cadastrado com sucesso!')</script>");
                header('location: index.php');
            } else {
                echo ("<script>alert('Erro ao cadastrar o anúncio')</script>");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Adicionar Anúncio - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h1 class="my-5">Adicionar Anúncio</h1>

        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlFile1">Foto do Anúncio</label>
                <input type="file" class="form-control-file" id="fotoAnuncio" name="fotoAnuncio" value="" selected>
            </div>
            <!-- <div class="mb-3 align-2">
                <label class="input-group-text btn-padrao" for="fotoAnuncio">
                    Foto do Anúncio:
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <p class="desc-foto-anuncio"></p>
                <input type="file" class="form-control-file" id="fotoAnuncio" name="fotoAnuncio" value="">

                <div class="preview-0"></div>
            </div> -->
            <div class="py-3">
                <label for="txtDescricaoAnuncio" class="form-label">Descrição do Anúncio:</label>
                <textarea style="height: 120px;" class="textarea-sunk-white" id="txtDescricaoAnuncio" name="txtDescricaoAnuncio" required></textarea>
            </div>
            <div class="my-4 d-flex justify-content-between">
                <button type="submit" class="btn-secundario align-items-center" id="btnCadastrarPubli" name="btnCadastrarPubli">
                    <span class="material-symbols-outlined">done</span>
                    Cadastrar
                </button>
                <a href="./index.php" class="btn-padrao">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Voltar
                </a>
            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../script.js"></script>
</body>

</html>