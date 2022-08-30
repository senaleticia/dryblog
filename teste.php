<?php
session_start();

require './bd/conexao.php';
$conexao = conexaoMySql();

$video = $_POST['txtVideo'];
echo substr($video, 0, 24);

if (substr($video, 0, 24) == "https://www.youtube.com/") {
    echo ('<br>Isso é um link do YouTube');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous" />
    <link rel="shortcut icon" href="svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./beneficios.css" />
    <link rel="stylesheet" href="./style.css" />
    <link rel="stylesheet" href="./responsive.css" />
    <title>Documento de Teste</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-inner">
        <div class="container">
            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon navbar-light"></span>
            </button>
            <li class="nav-item ml-auto mr-auto" style="list-style: none">
                <a class="navbar-brand" href="#">
                    <img src="./img/logo-dry-laranja.png" alt="Logo" />
                </a>
            </li>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ml-5 mr-auto">
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#">Resultados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#">Cronograma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#">Aos inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="#">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="login-box">
                <a class="logout" href="./login.php">
                    <button class="btn-padrao">LOGIN</button>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- <button id="compartilhar" class="btn-padrao">Copiar</button> -->
        <form action="#" method="post">
            <div class="mb-3">
                <label for="txtVideo" class="form-label mr-5" style="background: transparent !important;">Link do vídeo:</label>
                <input type="text" class="form-control" id="txtVideo" name="txtVideo" value="">
                <div class="instrucao mb-5" style="color: #FE5000">
                    Obs: cole somente a parte em destaque do link: www.youtube.com/watch?v=<b>jm1A-KZ2Dpo</b>
                </div>
                <input type="submit" class="btn btn-success" id="btnSalvar" name="btnSalvar" value="Enviar">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://drytelecom.com.br/slick/slick.min.js"></script>
    <script src="./script.js"></script>

    <script>
        let url = window.location.href;
        //let urlSplit = url.split('/')[0];

        function copiarLink() {
            alert(urlSplit);
            Clipboard
        }

        copiarLink();

        /*document.getElementById('compartilhar').addEventListener('click', copiarLink);
        function copiarLink(){
            let url = window.location.href;
        }*/
    </script>

</body>

</html>