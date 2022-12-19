<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['tipo_autor'] == 1 || $_SESSION['tipo_autor'] == 5 || $_SESSION['tipo_autor'] == 4) {
    header('location: index.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

$nome_autor = (string) "";
$login_autor = (string) "";
$senha_autor = (string) "";
$nivel_autor = (int) 0;

if (isset($_FILES['fotoAdmin'])) {
    $arquivo = $_FILES['fotoAdmin'];

    if ($arquivo['size'] > 2097152) {
        die("Arquivo muito grande! O tamanho máximo é 2MB");
    }

    $diretorio = "../upload/perfil-admin/";
    $nome_arquivo = $arquivo['name'];
    $novo_nome_arquivo = uniqid();
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    if ($extensao != 'jpg' && $extensao != 'jpeg' && $extensao != 'png' && $extensao != "") {
        die("Esse tipo de arquivo não é aceito");
    }

    if (move_uploaded_file($arquivo['tmp_name'], $diretorio . $novo_nome_arquivo . "." . $extensao)) {

        if (isset($_POST['btnCadastrarAdmin'])) {
            $nome_autor = $_POST['txtNomeUsuario'];
            $login_autor = $_POST['txtLoginUsuario'];
            $senha_autor = $_POST['txtSenhaUsuario'];
            $nivel_autor = $_POST['sltNivel'];
            $foto_autor = $novo_nome_arquivo . "." . $extensao;

            $verificar_email = "SELECT * FROM autor WHERE login_autor = '" . $login_autor . "'";
            $select_verificar = mysqli_query($conexao, $verificar_email);
            $row_count = mysqli_num_rows($select_verificar);

            if ($nivel_autor == 0) {
                echo ("<script>alert('Selecione um nível do usuário para continuar!')</script>");
            } else if ($nome_autor == "" || $login_autor == "" || $senha_autor == "") {
                echo ("<script>alert('Alguns dos campos obrigatórios não foram preenchidos. Por favor, verifique-os e tente novamente.')</script>");
            } else if ($row_count >= 1) {
                echo ("<script>alert('Esse email já está cadastrado em nosso sistema. Favor, inserir outro')</script>");
            } else {
                $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor, foto_autor, tipo_autor, autor_status) VALUES('" . $nome_autor . "', '" . $login_autor . "', sha1(md5('" . $senha_autor . "')), '" . $foto_autor . "', " . $nivel_autor . ", true)";

                if ($select = mysqli_query($conexao, $sql)) {
                    echo ("<script>alert('Usuário cadastrado com sucesso!')</script>");
                    echo ("<script>window.location='users-manager.php'</script>");
                } else {
                    echo ("<script>alert('Erro ao cadastrar o usuário!')</script>");
                    echo ($sql);
                }
            }
        }
    } else {

        if (isset($_POST['btnCadastrarAdmin'])) {
            $nome_autor = $_POST['txtNomeUsuario'];
            $login_autor = $_POST['txtLoginUsuario'];
            $senha_autor = $_POST['txtSenhaUsuario'];
            $nivel_autor = $_POST['sltNivel'];

            $verificar_email = "SELECT * FROM autor WHERE login_autor = '" . $login_autor . "'";
            $select_verificar = mysqli_query($conexao, $verificar_email);
            $row_count = mysqli_num_rows($select_verificar);

            if ($nivel_autor == 0) {
                echo ("<script>alert('Selecione um nível do usuário para continuar!')</script>");
            } else if ($nome_autor == "" || $login_autor == "" || $senha_autor == "") {
                echo ("<script>alert('Alguns dos campos obrigatórios não foram preenchidos. Por favor, verifique-os e tente novamente.')</script>");
            } else if ($row_count >= 1) {
                echo ("<script>alert('Esse email já está cadastrado em nosso sistema. Favor, inserir outro')</script>");
            } else {
                $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor, tipo_autor, autor_status) VALUES('" . $nome_autor . "', '" . $login_autor . "', sha1(md5('" . $senha_autor . "')), " . $nivel_autor . ", true)";

                if ($select = mysqli_query($conexao, $sql)) {
                    echo ("<script>alert('Usuário cadastrado com sucesso!')</script>");
                    echo ("<script>window.location='users-manager.php'</script>");
                } else {
                    echo ("<script>alert('Erro ao cadastrar o usuário!')</script>");
                    echo ($sql);
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
    <link rel="shortcut icon" href="../svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <title>Adicionar Administrador - Gerenciadores - Dry Telecom</title>
</head>

<body>
    <div class="container">
        <h3 class="my-4 text-center">Adicionar Administrador</h3>

        <div class="card-cadastro mx-auto">
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="txtNomeUsuario" class="form-label">Nome:</label>
                    <input type="text" class="input-sunk-white" id="txtNomeUsuario" name="txtNomeUsuario" value="<?= $nome_autor ?>">
                </div>
                <div class="mb-3">
                    <label for="txtLoginUsuario" class="form-label">Email:</label>
                    <input type="email" class="input-sunk-white" id="txtLoginUsuario" name="txtLoginUsuario" value="<?= $login_autor ?>">
                </div>
                <div class="mb-3">
                    <label for="txtSenhaUsuario" class="form-label">Senha:</label>
                    <div class="pass-cont">
                        <input type="password" class="input-sunk-white" id="txtSenhaUsuario" name="txtSenhaUsuario">
                        <span onclick="view()" class="eye"></span>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="fotoAdmin" class="input-group-text btn-padrao">
                        Foto: <span class="material-symbols-outlined">file_upload</span>
                    </label>
                    <input type="file" name="fotoAdmin" id="fotoAdmin">
                    <p class="desc-file-foto pt-3 text-center"></p>
                </div>
                <div class="mb-3 position-relative">
                    <label for="sltNivel">Nível do Usuário:</label>
                    <span class="material-symbols-outlined seta-select" style="top: 55%; right: 4%;">expand_more</span>
                    <select name="sltNivel" id="sltNivel" class="form-control select w-100">
                        <option value="0">Escolha um nível</option>
                        <option value="1">Gerenciar Posts</option>
                        <option value="2">Gerenciar Post e Adicionar Usuários</option>
                        <?php if ($_SESSION['tipo_autor'] == 3) { ?>
                            <option value="3">Acesso Total</option>
                            <option value="4">Gerenciar Posts e Revendedores</option>
                            <option value="5">Gerenciar Revendedores</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="d-flex justify-content-around mt-5">
                    <a href="./users-manager.php" class="btn-padrao font-weight-bold">
                        <span class="material-symbols-outlined">arrow_back_ios_new</span>
                    </a>
                    <button type="submit" class="btn-padrao" name="btnCadastrarAdmin" id="btnCadastrarAdmin">Cadastrar</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        let div = document.querySelector('.desc-file-foto');
        let input = document.getElementById('fotoAdmin');

        function nameFileFoto() {
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

        function view() {
            let x = document.getElementById('txtSenhaUsuario');
            let eye = document.querySelector('.eye');

            if (x.type === 'password') {
                x.type = 'text';
                eye.style.backgroundImage = 'url("../svg/eye_open.svg")';
            } else {
                x.type = 'password';
                eye.style.backgroundImage = 'url("../svg/eye_close.svg")';
            }
        }
    </script>
</body>

</html>