<?php
session_start();

require './bd/conexao.php';
$conexao = conexaoMySql();
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
    <link rel="stylesheet" href="./beneficios.css" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./responsive.css" />
    <title>Documento de Teste</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Alterna navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="./index.php">
                <img id="logo-index" src="./svg/logo-drytelecom.svg" alt="Logo">
            </a>
            <div class="login-box">
                <a class="logout" href="./login.php">
                    <button class="btn-padrao btn-menu">LOGIN</button>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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

    <div class="content-parallax">
        <section>
            <div id="layer-1" class="text-white">Aliquam faucibus, elit ut dapibus iaculis, erat erat molestie augue, ut consequat urna purus vel urna. Vestibulum euismod elit arcu, vitae fermentum nulla finibus ac. Sed ultricies congue urna, non volutpat sapien pharetra sed. Praesent aliquet risus risus, non malesuada neque viverra quis. Donec viverra, justo eu porttitor cursus, massa dolor vulputate ipsum, a feugiat diam turpis in massa. Morbi dignissim, nunc in vestibulum blandit, sem nibh rhoncus tellus, nec dapibus velit massa id nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec non augue lorem. Cras in nulla risus. Nunc faucibus tellus quis arcu varius tempus. Mauris velit tellus, molestie vel libero ac, lobortis mollis elit.</div>
            <div class="img-parallax"></div>
            <div class="img-parallax"></div>
        </section>

        <article id="content">
            <script>
                for (var i = 0; i < 50; i++) {
                    document.write('<h1>Testando parallax ' + i + ' </h1>');
                }
            </script>
        </article>
    </div>

    <style>
        #content {
            position: absolute;
        }

        .content-parallax {
            background: url(./img/foto-parallax-teste.jpg) fixed no-repeat;
            background-size: cover;
        }

        h1 {
            color: transparent;
        }

        .img-parallax {
            position: fixed;
            width: 100%;
            height: 1000px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

</body>

</html>