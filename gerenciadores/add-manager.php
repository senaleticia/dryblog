<?php
    if(!isset($_SESSION)){
        session_start();
    }
    
    if($_SESSION['gerenciadorAutenticado'] != true){
        header("location:../login-gerenciador.php");
    }

    require_once("../bd/conexao.php");
    $conexao = conexaoMySql();

    $nome_autor = (string) "";
    $login_autor = (string) "";
    $senha_autor = (string) "";

    if(isset($_FILES['fileFoto']) != ""){
        $arquivo = $_FILES['fileFoto'];

        if($arquivo['error']){
            echo('<script>alert("Falha ao enviar foto")</script>');
        }

        if($arquivo['size'] > 2097152){
            die('Arquivo muito grande! O tamanho máximo 2MB');
        }

        $diretorio = "../upload/arquivos/";
        $nome_arquivo = $arquivo['name'];
        $novo_nome_arquivo = uniqid();
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

        if($extensao != 'jpg' && $extensao != 'png' && $extensao != ''){
            die("Esse tipo de arquivo não é aceito");
        }

        if(move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . '.' . $extensao)){

            if(isset($_POST['btnCadastrar'])){
                //Pegando valores do input e dando a sua variável especifica
                $nome_autor = $_POST['txtNomeAutor'];
                $login_autor = $_POST['txtEmailAutor'];
                $senha_autor = $_POST['txtSenhaAutor'];
                $foto_autor = $novo_nome_arquivo . "." . $extensao;
                
                //Script SQL para inserir um post no banco de dados
                $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor, foto_autor) VALUES ('".$nome_autor."', '".$login_autor."', '".$senha_autor."', '".$foto_autor."')";
                
                //Rodando a conexão com o banco de dados e o script SQL
                if($select = mysqli_query($conexao, $sql)){
                    echo("<script>alert('Cadastro inserido')</script>");
                    header("location: index.php");  
                }else{
                    echo("<script>alert('Erro ao inserir cadastro')</script>");
                    echo($sql);
                }
            }
        }else{

            if(isset($_POST['btnCadastrar'])){
                //Pegando valores do input e dando a sua variável especifica
                $nome_autor = $_POST['txtNomeAutor'];
                $login_autor = $_POST['txtEmailAutor'];
                $senha_autor = $_POST['txtSenhaAutor'];             
                
                //Script SQL para inserir um post no banco de dados
                $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor) VALUES ('".$nome_autor."', '".$login_autor."', '".$senha_autor."')";
                
                //Rodando a conexão com o banco de dados e o script SQL
                if($select = mysqli_query($conexao, $sql)){
                    echo("<script>alert('Cadastro inserido')</script>");
                    header("location: index.php");  
                }else{
                    echo("<script>alert('Erro ao inserir cadastro')</script>");
                    echo($sql);
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
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../responsive.css">
    <title>Cadastro de Gerenciador - DryBlog</title>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Gerenciador</h2>

        <form action="#" method="POST" name="cadastroGerenciador" id="cadastroGerenciador" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label for="txtNomeAutor" class="col-sm-2 col-form-label">Nome:</label>
                <div class="col-sm-10">
                    <input type="text" class="input-sunk-white" id="txtNomeAutor" name="txtNomeAutor" value="" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="input-group-text" for="fileFoto">Foto:</label>
                <input type="file" class="form-control-file" id="fileFoto" name="fileFoto" value="<?=$result['foto']?>" selected>  
            </div>
            <div class="mb-3 row">
                <label for="txtEmailAutor" class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="input-sunk-white" id="txtEmailAutor" name="txtEmailAutor" value="" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="txtSenhaAutor" class="col-sm-2 col-form-label">Senha:</label>
                <div class="col-sm-10">
                    <input type="password" class="input-sunk-white" id="txtSenhaAutor" name="txtSenhaAutor" required>
                </div>
            </div>

            <input type="submit" class="btn-padrao" id="btnCadastrar" name="btnCadastrar" value="Cadastrar">
        </form>

    </div>
</body>
</html>