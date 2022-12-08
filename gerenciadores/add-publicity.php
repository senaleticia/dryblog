<?php
//Variável de sessão
session_start();

//Verificando se tem um gerenciador autenticado
if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location: ../login-gerenciador.php");
};

//Conexão com o banco de dados
require_once("../bd/conexao.php");
$conexao = conexaoMySql();

$descricao_anuncio = (string) "";
$foto_anuncio = (string) "";
$botao = "Cadastrar";

if (isset($_GET['modo']) == 'editar') {
    $sql = "SELECT * FROM anuncios WHERE id_anuncio = " . $_GET['id'];
    $select = mysqli_query($conexao, $sql);

    if ($result = mysqli_fetch_array($select)) {
        $descricao_anuncio = $result['descricao_anuncio'];
        $foto_anuncio = $result['foto_anuncio'];

        $botao = "Atualizar";
    }
}

if (isset($_FILES['fotoAnuncio']) != "" || isset($_FILES['fotoAnuncioMobile']) != "") {
    $arquivo = $_FILES['fotoAnuncio'];
    $arquivo2 = $_FILES['fotoAnuncioMobile'];

    if ($arquivo['size'] > 2097152 || $arquivo2['size'] > 2097152) {
        die('Arquivo muito grande! O tamanho máximo é 2MB');
    }

    if ($arquivo['error'] || $arquivo2['error']) {
        echo ('<script>alert("Falha ao enviar as fotos")</script>');
    }

    $diretorio = '../upload/anuncios/';
    $diretorio2 = '../upload/anuncios/';

    if ($arquivo['name'] != "") {
        $nome_arquivo = $arquivo['name'];
        $novo_nome_arquivo = uniqid();
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        $foto_anuncio = $novo_nome_arquivo . "." . $extensao;
    }

    if ($arquivo2['name'] != "") {
        $nome_arquivo2 = $arquivo2['name'];
        $nome_segundo_arquivo = uniqid();
        $extensao2 = strtolower(pathinfo($nome_arquivo2, PATHINFO_EXTENSION));
        $foto_mobile = $nome_segundo_arquivo . "." . $extensao2;
    }

    if (($extensao != 'jpg' && $extensao != 'jpeg' && $extensao != 'png' && $extensao != '') && ($extensao2 != 'jpg' && $extensao2 != 'jpeg' && $extensao2 != 'png' && $extensao2 != '')) {
        die('Esse tipo de arquivo não é aceito');
    } else if ($extensao == '' && $extensao2 == '') {
        echo ("<script>alert('As fotos para o anúncio são obrigatórias')</script>");
    } else {
        move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . '.' . $extensao);
        move_uploaded_file($arquivo2['tmp_name'], $diretorio . $nome_segundo_arquivo . '.' . $extensao2);

        if (isset($_POST['btnCadastrarPubli'])) {
            $foto_anuncio;
            $foto_mobile;
            $descricao_anuncio = addslashes($_POST['txtDescricaoAnuncio']);
            $link_anuncio = addslashes($_POST['txtLinkAnuncio']);

            if ($botao == "Cadastrar") {
                $sql = "INSERT INTO anuncios (foto_anuncio, foto_mobile, descricao_anuncio, link_anuncio) VALUES ('" . $foto_anuncio . "', '" . $foto_mobile . "', '" . $descricao_anuncio . "', '" . $link_anuncio . "')";
            } else if ($botao == "Atualizar") {
                $sql = "UPDATE anuncios SET foto_anuncio = '" . $foto_anuncio . "', foto_mobile = '" . $foto_mobile . "', descricao_anuncio = '" . $descricao_anuncio . "', link_anuncio = '" . $link_anuncio . "' WHERE id_anuncio = " . $_GET['id'];
            }

            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Anúncio cadastrado com sucesso')</script>");
                header('location: publicity-list.php');
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Adicionar Anúncio - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h1 class="my-5">Adicionar Anúncio</h1>

        <form action="#" method="POST" enctype="multipart/form-data" id="formAnuncio">
            <div class="card-cadastro w-100">
                <div class="py-3">
                    <label for="txtDescricaoAnuncio" class="form-label">Descrição do Anúncio:</label>
                    <input type="text" name="txtDescricaoAnuncio" id="txtDescricaoAnuncio" class="input-sunk-white">
                </div>

                <div class="form-group">
                    <div>
                        <label for="fotoAnuncio" class="input-group-text btn-padrao" style="width: fit-content; height: max-content;">
                            Foto Desktop do Anúncio:
                            <span class="material-symbols-outlined">file_upload</span>
                        </label>
                        <p class="desc-file-foto text-center pt-2"></p>
                        <input type="file" class="form-control-file" id="fotoAnuncio" name="fotoAnuncio">
                    </div>

                    <div>
                        <label for="fotoAnuncioMobile" class="input-group-text btn-padrao" style="width: fit-content; height: max-content;">
                            Foto Mobile do Anúncio:
                            <span class="material-symbols-outlined">file_upload</span>
                        </label>
                        <p class="desc-file-foto text-center pt-2"></p>
                        <input type="file" class="form-control-file" id="fotoAnuncioMobile" name="fotoAnuncioMobile">
                    </div>
                </div>

                <div class="pt-3 d-flex justify-content-center" style="gap: 15%;">
                    <label class="label-radio">
                        Formulário
                        <input type="radio" name="radioLink" value="formulario">
                        <span class="checkmark"></span>
                    </label>

                    <label class="label-radio">
                        Link
                        <input type="radio" name="radioLink" value="link">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="input-link">
                    <label for="txtLinkAnuncio" class="form-label">Link do Anúncio:</label>
                    <input type="text" name="txtLinkAnuncio" id="txtLinkAnuncio" class="input-sunk-white">
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="submit" class="btn-secundario align-items-center" id="btnCadastrarPubli" name="btnCadastrarPubli">
                        <span class="material-symbols-outlined">done</span>
                        <?= $botao ?>
                    </button>
                    <a href="./publicity-list.php" class="btn-padrao">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Voltar
                    </a>
                </div>
            </div>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/script.js"></script>

    <script>
        function nameFileFoto() {
            let div = document.querySelectorAll('.desc-file-foto')[0];
            let div2 = document.querySelectorAll('.desc-file-foto')[1];
            let input = document.getElementById('fotoAnuncio');
            let input2 = document.getElementById('fotoAnuncioMobile');

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

            if ((div2 != null) && (input2 != null)) {
                div2.addEventListener("click", function() {
                    input2.click();
                });

                input2.addEventListener("change", function() {
                    let nome = "Não há arquivo selecionado. Selecionar arquivo...";
                    if (input2.files.length > 0) nome = input2.files[0].name;
                    div2.innerHTML = nome;
                });
            }
        }

        nameFileFoto();

        const labelRadio = document.querySelectorAll('.label-radio');
        const inputLink = document.querySelector('.input-link');

        labelRadio.forEach((label) => {
            label.addEventListener('click', function() {
                let valorRadio = document.querySelector('input[name=radioLink]:checked').value;

                if (valorRadio == 'link') {
                    inputLink.style.display = 'block';
                } else if (valorRadio == 'formulario') {
                    inputLink.style.display = 'none';
                }
            })
        })
    </script>
</body>

</html>