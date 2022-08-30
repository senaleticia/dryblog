<?php
require_once("./bd/conexao.php");
$conexao = conexaoMySql();

$nome_usuario = (string) "";
$login_usuario = (string) "";
$senha_usuario = (string) "";
$botao = "Cadastrar-se";

echo ($senha_usuario);

if (isset($_GET['modo'])) {
    if ($_GET['modo'] == 'editar') {
        $id_usuario = $_GET['id_usuario'];

        $sql = "SELECT * FROM usuario WHERE id_usuario = " . $id_usuario;
        $select = mysqli_query($conexao, $sql);

        if (!$select) {
            printf("Error: %s\n", mysqli_error($conexao));
            exit();
        }

        if ($result = mysqli_fetch_array($select)) {
            $nome_usuario = $result['nome_usuario'];
            $login_usuario = $result['login_usuario'];
            $senha_usuario = $result['senha_usuario'];

            $botao = "Atualizar";
        }
    }
}

if (isset($_FILES['fileFoto']) != "") {
    $arquivo = $_FILES['fileFoto'];

    // if($arquivo['error']){
    //     echo('<script>alert("Falha ao enviar foto")</script>');
    // }

    if ($arquivo['size'] > 2097152) {
        die("Arquivo muito grande! O tamanho máximo é 2MB");
    }

    $diretorio = "./upload/arquivos/";
    $nome_arquivo = $arquivo['name'];
    $novo_nome_arquivo = uniqid();
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'png' && $extensao != '') {
        die("Esse tipo de arquivo não é aceito");
    }

    if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . '.' . $extensao)) {

        if (isset($_POST['btnCadastro'])) {
            //Pegando valores do input e dando a sua variável especifica
            $nome_usuario = $_POST['txtNomeUsuario'];
            $login_usuario = $_POST['txtEmailUsuario'];
            $senha_usuario = sha1(md5($_POST['txtSenhaUsuario']));
            $foto_usuario = $novo_nome_arquivo . "." . $extensao;

            $verificar_email = "SELECT * FROM usuario WHERE login_usuario = " . $login_usuario;
            $select_email = mysqli_query($conexao, $verificar_email);
            $count_email = mysqli_num_rows($select_email);

            if ($count_email >= 1) {
                echo ("<script>alert('Esse e-mail já está cadastrado em nosso sistema, favor inserir outro')</script>");
            } else if ($nome_usuario == "" || $login_usuario == "" || $senha_usuario == "") {
                echo ("<script>alert('Os campos nome, email e senha são obrigatórios')</script>");
            } else {
                //Script SQL para inserir um post no banco de dados
                $sql = "INSERT INTO usuario (nome_usuario, login_usuario, senha_usuario, foto_usuario) VALUES ('" . $nome_usuario . "', '" . $login_usuario . "', '" . $senha_usuario . "', '" . $foto_usuario . "')";

                //Rodando a conexão com o banco de dados e o script SQL
                if ($select = mysqli_query($conexao, $sql)) {
                    echo ("<script>alert('Cadastro inserido')</script>");
                    header("location: login.php");
                } else {
                    echo ("<script>alert('Erro ao inserir cadastro')</script>");
                }
            }
        }
    } else {

        if (isset($_POST['btnCadastro'])) {
            //Pegando valores do input e dando a sua variável especifica
            $nome_usuario = $_POST['txtNomeUsuario'];
            $login_usuario = $_POST['txtEmailUsuario'];
            $senha_usuario = sha1(md5($_POST['txtSenhaUsuario']));

            $verificar_email = "SELECT * FROM usuario WHERE login_usuario = '" . $login_usuario . "'";
            $select_email = mysqli_query($conexao, $verificar_email);
            $count_email = mysqli_num_rows($select_email);

            if ($count_email >= 1) {
                echo ("<script>alert('Esse e-mail já está cadastrado em nosso sistema, favor inserir outro')</script>");
            } else if ($nome_usuario == "" || $login_usuario == "" || $senha_usuario == "") {
                echo ("<script>alert('Os campos nome, email e senha são obrigatórios')</script>");
            } else {
                //Script SQL para inserir um post no banco de dados
                $sql = "INSERT INTO usuario (nome_usuario, login_usuario, senha_usuario, foto_usuario) VALUES ('" . $nome_usuario . "', '" . $login_usuario . "', '" . $senha_usuario . "', '" . $foto_usuario . "')";

                //Rodando a conexão com o banco de dados e o script SQL
                if ($select = mysqli_query($conexao, $sql)) {
                    echo ("<script>alert('Cadastro inserido')</script>");
                    header("location: login.php");
                } else {
                    echo ("<script>alert('Erro ao inserir cadastro')</script>");
                }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="shortcut icon" href="svg/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Cadastro de Usuário - DryBlog</title>
</head>

<body>
    <div class="container">
        <h2 class="my-4">Criar conta</h2>

        <form action="#" method="POST" name="cadastroUsuario" id="cadastroUsuario" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="txtNomeUsuario" class="col-sm-2 col-form-label">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" class="input-sunk-white" id="txtNomeUsuario" name="txtNomeUsuario" value="<?= $nome_usuario ?>" required>
                </div>
                <div class="error-input" style='color: red; display: none;'>
                    O preenchimento desse campo é obrigatório
                </div>
            </div>
            <div class="mb-3 align-2">
                <label class="input-group-text" for="fileFoto">
                    Foto:
                    <span class="material-symbols-outlined">file_upload</span>
                </label>
                <p class="desc-file-foto"></p>
                <input type="file" class="form-control-file" id="fileFoto" name="fileFoto" value="<?= $result['foto'] ?>" selected>
            </div>
            <div class="mb-3 row">
                <label for="txtEmailUsuario" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="input-sunk-white" id="txtEmailUsuario" name="txtEmailUsuario" value="<?= $login_usuario ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtSenhaUsuario" class="col-sm-2 col-form-label">Senha:</label>
                <div class="col-sm-10">
                    <input type="password" class="input-sunk-white" id="txtSenhaUsuario" name="txtSenhaUsuario" required>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" class="btn-padrao mx-auto" id="btnCadastro" name="btnCadastro" value="<?= $botao ?>">
            </div>
        </form>

    </div>
</body>

</html>