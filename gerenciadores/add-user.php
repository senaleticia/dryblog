<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['adm_usuarios'] == 0) {
    header('location: ./');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

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
            $adm_posts = $_POST['rdoAdmPosts'];
            $adm_usuarios = $_POST['rdoAdmUsuarios'];
            $adm_revendedores = $_POST['rdoAdmRevendedores'];
            $foto_autor = $novo_nome_arquivo . "." . $extensao;

            $verificar_email = "SELECT * FROM autor WHERE login_autor = '" . $login_autor . "'";
            $select_verificar = mysqli_query($conexao, $verificar_email);
            $row_count = mysqli_num_rows($select_verificar);

            if ($adm_posts == "" || $adm_usuarios == "" || $adm_revendedores == "") {
                echo ("<script>alert('Selecione as permissões do usuário para continuar!')</script>");
            } else if ($nome_autor == "" || $login_autor == "" || $senha_autor == "") {
                echo ("<script>alert('Alguns dos campos obrigatórios não foram preenchidos. Por favor, verifique-os e tente novamente.')</script>");
            } else if ($row_count >= 1) {
                echo ("<script>alert('Esse email já está cadastrado em nosso sistema. Favor, inserir outro')</script>");
            } else {
                $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor, foto_autor, adm_posts, adm_usuarios, adm_revendedores, autor_status) VALUES('" . $nome_autor . "', '" . $login_autor . "', sha1(md5('" . $senha_autor . "')), '" . $foto_autor . "', " . $adm_posts . ", " . $adm_usuarios . ", " . $adm_revendedores . " true)";

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
            $adm_posts = $_POST['rdoAdmPosts'];
            $adm_usuarios = $_POST['rdoAdmUsuarios'];
            $adm_revendedores = $_POST['rdoAdmRevendedores'];

            $verificar_email = "SELECT * FROM autor WHERE login_autor = '" . $login_autor . "'";
            $select_verificar = mysqli_query($conexao, $verificar_email);
            $row_count = mysqli_num_rows($select_verificar);

            if ($adm_posts == "" || $adm_usuarios == "" || $adm_revendedores == "") {
                echo ("<script>alert('Selecione as permissões do usuário para continuar!')</script>");
            } else if ($nome_autor == "" || $login_autor == "" || $senha_autor == "") {
                echo ("<script>alert('Alguns dos campos obrigatórios não foram preenchidos. Por favor, verifique-os e tente novamente.')</script>");
            } else if ($row_count >= 1) {
                echo ("<script>alert('Esse email já está cadastrado em nosso sistema. Favor, inserir outro')</script>");
            } else {
                $sql = "INSERT INTO autor (nome_autor, login_autor, senha_autor, adm_posts, adm_usuarios, adm_revendedores, autor_status) VALUES('" . $nome_autor . "', '" . $login_autor . "', sha1(md5('" . $senha_autor . "')), " . $adm_posts . ", " . $adm_usuarios . ", " . $adm_revendedores . ", true)";

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

        <form action="#" method="POST" enctype="multipart/form-data" id="cadastroAdmin">
            <div class="card-cadastro mx-auto mb-5 w-75">
                <div class="foto-input mx-auto">
                    <p class="text-center">Foto:</p>
                    <label class="input-group-text mx-auto" for="fotoAdmin">
                        <span class="material-symbols-outlined">file_upload</span>
                    </label>
                    <p class="desc-file-foto pt-3 text-center"></p>
                    <input type="file" class="form-control-file" id="fotoAdmin" name="fotoAdmin">
                </div>

                <div class="mb-3">
                    <label for="txtNomeUsuario" class="form-label">Nome:</label>
                    <input type="text" class="input-sunk-white" id="txtNomeUsuario" name="txtNomeUsuario" required>
                </div>

                <div class="mb-3">
                    <label for="txtLoginUsuario" class="form-label">Email:</label>
                    <input type="email" class="input-sunk-white" id="txtLoginUsuario" name="txtLoginUsuario" required>
                </div>

                <div class="mb-3">
                    <label for="txtSenhaUsuario" class="form-label">Senha:</label>
                    <div class="pass-cont">
                        <input type="password" class="input-sunk-white" id="txtSenhaUsuario" name="txtSenhaUsuario" required>
                        <span onclick="view()" class="eye"></span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="rdoAdmPosts" class="form-label">Administração de Posts:</label>
                    <div class="d-flex justify-content-around">
                        <label class="label-radio">
                            Nenhum Acesso
                            <input type="radio" name="rdoAdmPosts" value="0" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="label-radio">
                            Somente Visualização
                            <input type="radio" name="rdoAdmPosts" value="1" required>
                            <span class="checkmark"></span>
                        </label>
                        <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
                            <label class="label-radio">
                                Acesso Total
                                <input type="radio" name="rdoAdmPosts" value="2" required>
                                <span class="checkmark"></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="rdoAdmUsuarios" class="form-label">Administração de Usuários:</label>
                    <div class="d-flex justify-content-around">
                        <label class="label-radio">
                            Nenhum Acesso
                            <input type="radio" name="rdoAdmUsuarios" value="0" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="label-radio">
                            Somente Visualização
                            <input type="radio" name="rdoAdmUsuarios" value="1" required>
                            <span class="checkmark"></span>
                        </label>
                        <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
                            <label class="label-radio">
                                Acesso Total
                                <input type="radio" name="rdoAdmUsuarios" value="2" required>
                                <span class="checkmark"></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="rdoAdmRevendedores" class="form-label text-center">Administração de Revendedores:</label>
                    <div class="d-flex justify-content-around">
                        <label class="label-radio">
                            Nenhum Acesso
                            <input type="radio" name="rdoAdmRevendedores" value="0" required>
                            <span class="checkmark"></span>
                        </label>
                        <label class="label-radio">
                            Somente Visualização
                            <input type="radio" name="rdoAdmRevendedores" value="1" required>
                            <span class="checkmark"></span>
                        </label>
                        <?php if ($_SESSION['adm_usuarios'] == 2) { ?>
                            <label class="label-radio">
                                Acesso Total
                                <input type="radio" name="rdoAdmRevendedores" value="2" required>
                                <span class="checkmark"></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>

                <div class="d-flex justify-content-around mt-5">
                    <a href="./users-manager.php" class="btn-padrao font-weight-bold">
                        <span class="material-symbols-outlined">arrow_back_ios_new</span>
                    </a>
                    <button type="submit" class="btn-padrao" name="btnCadastrarAdmin" id="btnCadastrarAdmin">Cadastrar</button>
                </div>
            </div>
        </form>
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