<?php
//Variável de sessão
session_start();

//Verificando se tem um gerenciador autenticado
if ($_SESSION['gerenciadorAutenticado'] != true) {
    header("location:../login-gerenciador.php");
};

$id_autor = $_SESSION['id_autor'];

//Conexão com o banco de dados
require_once("../bd/conexao.php");
$conexao = conexaoMySql();

//Variáveis
$botao = (string) "Salvar";
$titulo = (string) "";
$conteudo = (string) "";
$conteudo2 = (string) "";
$conteudo3 = (string) "";
$conteudo4 = (string) "";
$video = (string) "";
$foto = (string) "";
$foto2 = (string) "";
$foto3 = (string) "";
$foto4 = (string) "";
$tempo_leitura = (string) "";
$tags = (string) "";

//Verificando se a variável da URL 'modo' existe
if (isset($_GET['modo'])) {

    //Verificando se o resultado do modo é editar
    if ($_GET['modo'] == 'editar') {
        //Pegando o resultado da variável 'id' que está na URL
        $id = $_GET['id'];

        //Script para rodar no banco e trazer os dados do post
        $sql = "SELECT * FROM post WHERE id_post = " . $id;
        $select = mysqli_query($conexao, $sql);

        //Verificando se o script deu certo
        if (!$select) {
            printf("Error: %s\n", mysqli_error($conexao));
            exit();
        }

        //Pegando os dados do banco e colocando em variáveis
        if ($result = mysqli_fetch_array($select)) {
            $titulo = $result['titulo'];
            $conteudo = $result['conteudo'];
            $conteudo2 = $result['segundo_conteudo'];
            $conteudo3 = $result['terceiro_conteudo'];
            $conteudo4 = $result['quarto_conteudo'];
            $video = $result['video'];
            $foto = $result['foto'];
            $tempo_leitura = $result['tempo_leitura'];
            $tags = $result['tags'];

            $botao = "Atualizar";
        }
    }
}

if (isset($_FILES['fileFoto']) != "" || isset($_FILES['fileFoto2']) != "" || isset($_FILES['fileFoto3']) != "" || isset($_FILES['fileFoto4']) != "") {
    $arquivo = $_FILES['fileFoto'];
    $arquivo2 = $_FILES['fileFoto2'];
    $arquivo3 = $_FILES['fileFoto3'];
    $arquivo4 = $_FILES['fileFoto4'];

    // if($arquivo['error']){
    //     echo('<script>alert("Falha ao enviar foto")</script>');
    // }

    // Verificando se os arquivos enviados são maiores que 2MB
    if ($arquivo['size'] > 2097152 || $arquivo2['size'] > 2097152 || $arquivo3['size'] > 2097152 || $arquivo4['size'] > 2097152) {
        die("Arquivo muito grande! O tamanho máximo é 2MB");
    }

    // Pasta para onde vai os arquivos
    $diretorio = "../upload/arquivos/";
    $diretorio2 = "../upload/arquivos/";
    $diretorio3 = "../upload/arquivos/";
    $diretorio4 = "../upload/arquivos/";

    // Mudando o nome e validando o primeiro arquivo
    if ($arquivo['name'] != "") {
        $nome_arquivo = $arquivo['name'];
        $nome_primeiro_arquivo = uniqid();
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        $foto = $nome_primeiro_arquivo . "." . $extensao;
    }

    // Mudando o nome e validando o segundo arquivo
    if ($arquivo2['name'] != "") {
        $nome_arquivo2 = $arquivo2['name'];
        $nome_segundo_arquivo = uniqid();
        $extensao2 = strtolower(pathinfo($nome_arquivo2, PATHINFO_EXTENSION));
        $foto2 = $nome_segundo_arquivo . "." . $extensao2;
    }

    if ($arquivo3['name'] != "") {
        // Mudando o nome e validando o terceiro arquivo
        $nome_arquivo3 = $arquivo3['name'];
        $nome_terceiro_arquivo = uniqid();
        $extensao3 = strtolower(pathinfo($nome_arquivo3, PATHINFO_EXTENSION));
        $foto3 = $nome_terceiro_arquivo . "." . $extensao3;
    }

    if ($arquivo4['name'] != "") {
        // Mudando o nome e validando o quarto arquivo
        $nome_arquivo4 = $arquivo4['name'];
        $nome_quarto_arquivo = uniqid();
        $extensao4 = strtolower(pathinfo($nome_arquivo4, PATHINFO_EXTENSION));
        $foto4 = $nome_quarto_arquivo . "." . $extensao4;
    }

    // Validando o tipo de arquivo enviado para upload
    if (($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg' && $extensao != '') || ($extensao2 != 'jpg' && $extensao2 != 'png' && $extensao2 != 'jpeg' && $extensao2 != '') || ($extensao3 != 'jpg' && $extensao3 != 'png' && $extensao3 != 'jpeg' && $extensao3 != '') || ($extensao4 != 'jpg' && $extensao4 != 'png' && $extensao4 != 'jpeg' && $extensao4 != '')) {
        die("Esse tipo de arquivo não é aceito");
    } else if ($extensao == '' && $extensao2 == '' && $extensao3 == '' && $extensao4 == '') {

        if (isset($_POST['btnSalvar'])) {
            //Pegando valores do input e dando a sua variável especifica
            $titulo = addslashes($_POST['txtTitulo']);
            $conteudo = addslashes($_POST['txtConteudo']);
            $conteudo2 = addslashes($_POST['txtSegundoConteudo']);
            $conteudo3 = addslashes($_POST['txtTerceiroConteudo']);
            $conteudo4 = addslashes($_POST['txtQuartoConteudo']);
            $video = $_POST['txtVideo'];
            $tempo_leitura = $_POST['txtTempoLeitura'];
            $tags = $_POST['txtTags'];

            //Capturando data atual e colocando em uma variável
            date_default_timezone_set('America/Sao_paulo');
            $data_post = date('d/m/Y');
            $hora_post = date('H:i');

            if ($botao == "Salvar") {
                if ($titulo == "" || $conteudo == "") {
                    echo ("<script>alert('Não é possível publicar um post sem um título e/ou um conteúdo')</script>");
                    echo ("<script>history.back()</script>");
                } else if (substr($video, 0, 24) == "https://www.youtube.com/") {
                    echo ("Não é possível colar o link todo! Cole somente a parte em destaque:
                    www.youtube.com/watch?v=<b>jm1A-KZ2Dpo</b>");
                } else {
                    //Script SQL para inserir um post no banco de dados
                    $sql = "INSERT INTO post (titulo, conteudo, video, data_post, hora_post, id_autor, tempo_leitura, tags) VALUES ('" . $titulo . "', '" . $conteudo . "', '" . $conteudo2 . "', '" . $conteudo3 . "', '" . $conteudo4 . "', '" . $video . "', '" . $data_post . "', '" . $hora_post . "', '" . $id_autor . "', '" . $tempo_leitura . "', '" . $tags . "')";
                }
            } else if ($botao == "Atualizar") {
                $sql = "UPDATE post SET titulo = '" . $titulo . "', conteudo = '" . $conteudo . "', segundo_conteudo = '" . $conteudo2 . "', terceiro_conteudo = '" . $conteudo3 . "', quarto_conteudo = '" . $conteudo4 . "', video = '" . $video . "', id_autor = " . $id_autor . ", tempo_leitura = '" . $tempo_leitura . "', tags = '" . $tags . "' WHERE id_post = " . $id;
            }

            //Rodando a conexão com o banco de dados e o script SQL
            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Post inserido com sucesso')</script>");
                header("location: index.php");
            } else {
                echo ("<script>alert('Erro ao inserir post')</script>");
                echo ($sql);
            }
        }
    } else {
        move_uploaded_file($arquivo['tmp_name'],  $diretorio . $nome_primeiro_arquivo . '.' . $extensao);
        move_uploaded_file($arquivo2['tmp_name'],  $diretorio2 . $nome_segundo_arquivo . '.' . $extensao2);
        move_uploaded_file($arquivo3['tmp_name'],  $diretorio3 . $nome_terceiro_arquivo . '.' . $extensao3);
        move_uploaded_file($arquivo4['tmp_name'],  $diretorio4 . $nome_quarto_arquivo . '.' . $extensao4);

        if (isset($_POST['btnSalvar'])) {
            //Pegando valores do input e dando a sua variável especifica
            $titulo = addslashes($_POST['txtTitulo']);
            $conteudo = addslashes($_POST['txtConteudo']);
            $conteudo2 = addslashes($_POST['txtSegundoConteudo']);
            $conteudo3 = addslashes($_POST['txtTerceiroConteudo']);
            $conteudo4 = addslashes($_POST['txtQuartoConteudo']);
            $video = $_POST['txtVideo'];
            $tempo_leitura = $_POST['txtTempoLeitura'];
            $tags = $_POST['txtTags'];
            $foto;
            $foto2;
            $foto3;
            $foto4;

            //Capturando data atual e colocando em uma variável
            date_default_timezone_set('America/Sao_paulo');
            $data_post = date('d/m/Y');
            $hora_post = date('H:i');

            if ($botao == "Salvar") {
                if ($titulo == "" || $conteudo == "") {
                    echo ("<script>alert('Não é possível publicar um post sem um título e/ou um conteúdo')</script>");
                    echo ("<script>history.back()</script>");
                } else if (substr($video, 0, 24) == "https://www.youtube.com/") {
                    echo ("<script>Não é possível colar o link todo! Cole somente a parte em destaque:
                    www.youtube.com/watch?v=<b>jm1A-KZ2Dpo</b></script>");
                    //echo ("<script>history.back()</script>");
                } else {
                    //Script SQL para inserir um post no banco de dados
                    $sql = "INSERT INTO post (titulo, conteudo, segundo_conteudo, terceiro_conteudo, quarto_conteudo, video, foto, segunda_foto, terceira_foto, quarta_foto, data_post, hora_post, id_autor, tempo_leitura, tags) VALUES ('" . $titulo . "', '" . $conteudo . "', '" . $conteudo2 . "', '" . $conteudo3 . "', '" . $conteudo4 . "', '" . $video . "', '" . $foto . "', '" . $foto2 . "', '" . $foto3 . "', '" . $foto4 . "', '" . $data_post . "', '" . $hora_post . "', '" . $id_autor . "', '" . $tempo_leitura . "', '" . $tags . "')";
                }
            } else if ($botao == "Atualizar") {
                if ($titulo == "" || $conteudo == "") {
                    echo ("<script>alert('Não é possível atualizar um post sem um título e/ou um conteúdo')</script>");
                    echo ("<script>history.back()</script>");
                } else {
                    $sql = "UPDATE post SET titulo = '" . $titulo . "', conteudo = '" . $conteudo . "', segundo_conteudo = '" . $conteudo2 . "', terceiro_conteudo = '" . $conteudo3 . "', quarto_conteudo = '" . $conteudo4 . "', video = '" . $video . "', foto = '" . $foto . "', segunda_foto = '" . $foto2 . "', terceira_foto = '" . $foto3 . "', quarta_foto = '" . $foto4 . "', id_autor = '" . $id_autor . "', tempo_leitura = '" . $tempo_leitura . "', tags = '" . $tags . "' WHERE id_post = " . $id;
                }
            }

            //Rodando a conexão com o banco de dados e o script SQL
            if ($select = mysqli_query($conexao, $sql)) {
                echo ("<script>alert('Post inserido com sucesso')</script>");
                header("location: index.php");
            } else {
                echo ("<script>alert('Erro ao inserir post')</script>");
                echo ($sql);
                echo (mysqli_error($conexao));
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
    <title>Criar Postagens - DryBlog</title>
</head>

<body>
    <div class="container">

        <h1 class="my-4">Criar Postagem</h1>

        <form action="#" method="POST" enctype="multipart/form-data" name="formAddPost">
            <div class="mb-3">
                <label for="txtTitulo" class="form-label" style="background-color: #EBEBEB;">Título:</label>
                <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" value="<?= $titulo ?>" required>
            </div>
            <div class="mb-3 align-2">
                <label class="input-group-text btn-padrao" for="fileFoto">
                    Foto 1 (Foto do Banner):
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <p class="desc-file-foto"></p>
                <input type="file" class="form-control-file" id="fileFoto" name="fileFoto" value="<?= $result['foto'] ?>" selected>
            </div>
            <div class="mb-3">
                <label for="txtConteudo" class="form-label" style="background: transparent !important;">Conteúdo:</label>
                <textarea style="height: 120px;" class="form-control" id="txtConteudo" name="txtConteudo" cols="30" rows="10" required><?= $conteudo ?></textarea>
            </div>
            <div class="mb-3 align-2">
                <label class="input-group-text btn-padrao" for="fileFoto2">
                    Foto 2:
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <p class="desc-file-foto"></p>
                <input type="file" class="form-control-file" id="fileFoto2" name="fileFoto2" value="<?= $result['segunda_foto'] ?>" selected>
            </div>
            <div class="mb-3">
                <label for="txtSegundoConteudo" class="form-label" style="background: transparent !important;">Conteúdo 2:</label>
                <textarea style="height: 120px;" class="form-control" id="txtSegundoConteudo" name="txtSegundoConteudo" cols="30" rows="10"><?= $conteudo2 ?></textarea>
            </div>
            <div class="mb-3 align-2">
                <label class="input-group-text btn-padrao" for="fileFoto3">
                    Foto 3:
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <p class="desc-file-foto"></p>
                <input type="file" class="form-control-file" id="fileFoto3" name="fileFoto3" value="<?= $result['terceira_foto'] ?>" selected>
            </div>
            <div class="mb-3">
                <label for="txtTerceiroConteudo" class="form-label" style="background: transparent !important;">Conteúdo 3:</label>
                <textarea style="height: 120px;" class="form-control" id="txtTerceiroConteudo" name="txtTerceiroConteudo" cols="30" rows="10"><?= $conteudo3 ?></textarea>
            </div>
            <div class="mb-3 align-2">
                <label class="input-group-text btn-padrao" for="fileFoto4">
                    Foto 4:
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <p class="desc-file-foto"></p>
                <input type="file" class="form-control-file" id="fileFoto4" name="fileFoto4" value="<?= $result['quarta_foto'] ?>" selected>
            </div>
            <div class="mb-3">
                <label for="txtQuartoConteudo" class="form-label" style="background: transparent !important;">Conteúdo 4:</label>
                <textarea style="height: 120px;" class="form-control" id="txtQuartoConteudo" name="txtQuartoConteudo" cols="30" rows="10"><?= $conteudo4 ?></textarea>
            </div>
            <div class="mb-3">
                <label for="txtTempoLeitura" class="form-label mr-3">Tempo de Leitura (em minutos):</label>
                <input type="number" class="form-control" id="txtTempoLeitura" name="txtTempoLeitura" value="<?= $tempo_leitura ?>" style="background: transparent !important;">
            </div>
            <div class="mb-3">
                <label for="txtTags" class="form-label mr-3" style="background: transparent !important;">Tag:</label>
                <input type="text" class="form-control" id="txtTags" name="txtTags" value="<?= $tags ?>">
            </div>
            <div class="mb-3">
                <label for="txtVideo" class="form-label mr-5" style="background: transparent !important;">Link do vídeo:</label>
                <input type="text" class="form-control" id="txtVideo" name="txtVideo" value="<?= $video ?>">
                <div class="instrucao mt-3" style="color: #FE5000">
                    <u>
                        Obs: cole somente a parte em destaque do link: www.youtube.com/watch?v=<b>jm1A-KZ2Dpo</b>
                    </u>
                </div>
            </div>
            <div class="mb-5">
                <input type="submit" class="btn btn-success" id="btnSalvar" name="btnSalvar" value="<?= $botao ?>">
                <a href="./index.php" class="btn btn-primary float-right" id="btnVoltar">
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