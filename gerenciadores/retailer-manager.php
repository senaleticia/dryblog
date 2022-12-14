<?php
session_start();

if ($_SESSION['gerenciadorAutenticado'] != true) {
    header('location: ../login-gerenciador.php');
}

if ($_SESSION['adm_revendedores'] == 0) {
    header('location: users-manager.php');
}

require_once('../bd/conexao.php');
$conexao = conexaoMySql();

// selected filtro revendedores
$selectedNaoContatado = "";
$selectedEmContato = "";
$selectedRecusado = "";

// selected status revendedores
$naoContatatoAtivo = "";
$emContatoAtivo = "";
$recusadoAtivo = "";

$filtro = "";
$todosAtivo = "selected";

function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}

if (isset($_POST['sltFiltroRepresentante'])) {
    $filtro = $_POST['sltFiltroRepresentante'];

    if ($filtro == "NÃO CONTATADO") {
        $naoContatatoAtivo = "selected";
        $todosAtivo = "";
    } else if ($filtro == "EM CONTATO") {
        $emContatoAtivo = "selected";
        $todosAtivo = "";
    } else if ($filtro == "RECUSADO") {
        $recusadoAtivo = "selected";
        $todosAtivo = "";
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
    <title>Gerenciar Revendedores - Dry Telecom</title>
</head>

<body>
    <header id="header-gerenciadores">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="mt-5">
                    <h2>Bem-vindo(a), <?= $_SESSION['nome_autor'] ?>!</h2>
                </div>
                <div class="dropdown mt-5">
                    <button class="btn-padrao dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="material-symbols-outlined">person</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./edit-profile.php?user=<?= $_SESSION['id_autor'] ?>">Editar Perfil</a>
                        <a class="dropdown-item" href="./change-password.php?user=<?= $_SESSION['id_autor'] ?>">Alterar Senha</a>
                        <a class="dropdown-item" href="./logout.php">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container my-5">
        <div class="mb-4 d-flex justify-content-center flex-wrap" style="gap: 36px;">
            <?php if ($_SESSION['adm_posts'] != 0) { ?>
                <a href="./" class="btn-padrao btn-gerenciar">
                    GERENCIAR POSTAGENS
                </a>
            <?php } ?>

            <?php if ($_SESSION['adm_usuarios'] != 0) { ?>
                <a href="./users-manager.php" class="btn-padrao btn-gerenciar">
                    GERENCIAR USUÁRIOS
                </a>
            <?php } ?>

            <button class="btn-padrao btn-gerenciar ativo">
                GERENCIAR REVENDEDORES
            </button>
        </div>

        <div class="d-flex justify-content-between align-items-center my-4">
            <a href="retailer-authorized.php" class="btn-secundario">
                VER REVENDEDORES AUTORIZADOS
            </a>

            <form action="#" method="POST" name="frmRepresentantes">
                <div class="mb-3 position-relative">
                    <label for="sltFiltroRepresentante" style="padding-left: 18px;">Filtrar Mensagens:</label>
                    <span class="material-symbols-outlined seta-select" style="top: 55%; right: 5%;">expand_more</span>
                    <select name="sltFiltroRepresentante" id="sltFiltroRepresentante" class="form-control select" onchange="this.form.submit()">
                        <option value="TODOS" <?= $todosAtivo ?>>Todos</option>
                        <option value="NÃO CONTATADO" <?= $naoContatatoAtivo ?>>Não contatado</option>
                        <option value="EM CONTATO" <?= $emContatoAtivo ?>>Em contato</option>
                        <option value="RECUSADO" <?= $recusadoAtivo ?>>Recusado</option>
                    </select>
                </div>
            </form>
        </div>

        <h3 class="text-center mb-0">Lista de Interessados</h3>

        <div class="retailer-list py-4">
            <?php
            $sql = "SELECT * FROM representantes WHERE status_representante <> 'ACEITO' ORDER BY id_representante DESC";

            if ($filtro == "NÃO CONTATADO") {
                $sql = "SELECT * FROM representantes WHERE status_representante = 'NÃO CONTATADO' ORDER BY id_representante DESC";
            } else if ($filtro == "EM CONTATO") {
                $sql = "SELECT * FROM representantes WHERE status_representante = 'EM CONTATO' ORDER BY id_representante DESC";
            } else if ($filtro == "RECUSADO") {
                $sql = "SELECT * FROM representantes WHERE status_representante = 'RECUSADO' ORDER BY id_representante DESC";
            } else if ($filtro == "TODOS") {
                $sql = "SELECT * FROM representantes WHERE status_representante <> 'ACEITO' ORDER BY id_representante DESC";
            }

            $select = mysqli_query($conexao, $sql);

            if (!$select) {
                printf("Error: %s\n", mysqli_error($conexao));
                exit();
            }

            while ($result = mysqli_fetch_array($select)) {
                if ($result['status_representante'] == "EM CONTATO") {
                    $selectedEmContato = "selected";
                    $selectedNaoContatado = "";
                    $selectedRecusado = "";
                } else if ($result['status_representante'] == "NÃO CONTATADO") {
                    $selectedNaoContatado = "selected";
                    $selectedRecusado = "";
                    $selectedEmContato = "";
                } else if ($result['status_representante'] == "RECUSADO") {
                    $selectedRecusado = "selected";
                    $selectedEmContato = "";
                    $selectedNaoContatado = "";
                }
            ?>
                <div class="card-cadastro mx-auto mt-3 mb-5 pb-3">
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
                        <?php if (strlen($result['celular_representante']) == 11) { ?>
                            <span><?= mask($result['celular_representante'], '(##) #####-####') ?></span>
                        <?php } else { ?>
                            <p class="text-grey m-0 d-flex align-items-center">
                                <span class="material-symbols-outlined">error</span>
                                Número inválido ou não é um número brasileiro
                            </p>
                            <p><?= $result['celular_representante'] ?></p>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <span class="text-grey">CPF / CNPJ:</span>
                        <?php if (strlen($result['cpf_cnpj_representante']) == 11) { ?>
                            <span><?= mask($result['cpf_cnpj_representante'], '###.###.###-##') ?></span>
                        <?php } else if (strlen($result['cpf_cnpj_representante']) == 14) { ?>
                            <span><?= mask($result['cpf_cnpj_representante'], '##.###.###/####-##') ?></span>
                        <?php } else { ?>
                            <p class="text-grey m-0 d-flex align-items-center">
                                <span class="material-symbols-outlined">error</span>
                                O número do documento enviado não é válido
                            </p>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <span class="text-grey">Expectativa de Venda:</span>
                        <span><?= $result['expectativa_vendas'] ?></span>
                    </div>

                    <?php if ($result['mensagem_representante'] != "") { ?>
                        <div class="mb-3">
                            <span class="text-grey">Mensagem:</span>
                            <p><?= $result['mensagem_representante'] ?></p>
                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <?php if ($_SESSION['adm_revendedores'] == 2) { ?>
                            <form action="retailer-status.php?representante=<?= $result['id_representante'] ?>" method="POST" name="frmStatus" id="frmStatus">
                                <div class="position-relative">
                                    <span class="material-symbols-outlined seta-select">expand_more</span>
                                    <select name="sltStatus" id="sltStatus" class="form-control select mx-auto" onchange="this.form.submit()">
                                        <option value="NÃO CONTATADO" <?= $selectedNaoContatado ?>>Não contatado</option>
                                        <option value="EM CONTATO" <?= $selectedEmContato ?>>Em contato</option>
                                        <option value="ACEITO">Aceito</option>
                                        <option value="RECUSADO" <?= $selectedRecusado ?>>Recusado</option>
                                    </select>
                                </div>
                            </form>
                        <?php } else if ($_SESSION['adm_revendedores'] == 1) { ?>
                            <span class="text-grey">Status:</span>
                            <p><?= $result['status_representante'] ?></p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>