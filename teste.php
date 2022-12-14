<?php
session_start();

require './bd/conexao.php';
$conexao = conexaoMySql();

$cpf_cnpj = "";

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

$cnpj = '11222333000199';
$cpf = '00100200300';
$cep = '08665110';
$data = '10102010';
$hora = '021050';




/*echo mask($cnpj, '##.###.###/####-##') . '<br>';
echo mask($cpf, '###.###.###-##') . '<br>';*/
echo mask($cep, '#####-###') . '<br>';
echo mask($data, '##/##/####') . '<br>';
echo mask($data, '##/##/####') . '<br>';
echo mask($data, '[##][##][####]') . '<br>';
echo mask($data, '(##)(##)(####)') . '<br>';
echo mask($hora, 'Agora são ## horas ## minutos e ## segundos') . '<br>';
echo mask($hora, '##:##:##');

if (isset($_POST['btnRepresentante'])) {
    $cpf_cnpj = $_POST['txtCPFRepresentante'];

    if (strlen($cpf_cnpj) == 14) {
        echo ('Essa string tem ' . strlen($cpf_cnpj) . " caracteres<br>");
        echo mask($cpf_cnpj, '##.###.###/####-##') . '<br>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/beneficios.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/responsive.css" />
    <title>Documento de Teste</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner">
        <div class="container">
            <div id="navbar-mobile">
                <span class="material-symbols-outlined">
                    menu
                </span>
            </div>

            <li class="nav-item" style="list-style: none;">
                <a class="navbar-brand" href="./index.php">
                    <img id="logo-index" src="./svg/logo-drytelecom.svg" alt="Logo">
                </a>
            </li>
            <div class="login-box">
                <a class="logout" href="./login.php">
                    <button class="btn-padrao btn-menu">LOGIN</button>
                </a>
            </div>

            <div class="menu-desk">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./blog.php">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#staticBackdrop">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-modal">
            <div class="colapse-nav-mobile">
                <span id="close-modal" class="material-symbols-outlined">
                    close
                </span>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./blog.php">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#clientes">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#staticBackdrop">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <form action="#" method="POST">
            <div class="card-cadastro mx-auto mt-5">
                <div class="mb-3">
                    <label for="txtCPFRepresentante">CPF*</label>
                    <input type="number" name="txtCPFRepresentante" id="txtCPFRepresentante" class="input-sunk-white" required>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn-padrao font-weight-bold" id="btnRepresentante" name="btnRepresentante">CADASTRAR-SE</button>
                </div>
            </div>
        </form>

        <?= strlen($cpf_cnpj) ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>

</html>