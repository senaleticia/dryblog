<?php
session_start();

require_once("./bd/conexao.php");
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];

if (isset($_GET['modo'])) {
    $modo = $_GET['modo'];

    if ($modo == 'logout') {
        session_destroy();
        header('location: ./login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="./svg/favicon.svg" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://drytelecom.com.br/slick/slick-theme.css">
    <link rel="stylesheet" href="./beneficios.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <title>Dry Telecom</title>
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
                <?php if ($usuario_autenticado == true) { ?>
                    <a class="logout" href="./index.php?modo=logout">
                        <button class="btn-padrao btn-menu">SAIR</button>
                    </a>
                <?php } else if ($usuario_autenticado == false) { ?>
                    <a class="logout" href="./login.php">
                        <button class="btn-padrao btn-menu">LOGIN</button>
                    </a>
                <?php } ?>
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

    <div id="banner-index"></div>

    <div class="container">
        <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="mx-auto">Alguma dúvida?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body mx-auto">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=5511980002870&text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20Dry%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!">
                            <button class="btn-padrao font-weight-bold">CONVERSE COM UM ESPECIALISTA</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="section-beneficio">
        <div class="container mb-5">
            <div class="titulo-padrao text-center">
                <h1 class="font-weight-bold">Uma operadora como você nunca viu</h1>
            </div>
            <div class="subtitulo">
                Saia do passado! Moderna, prática e sem burocracia, a Dry é uma operadora digital criada para conectar você com o futuro da telefonia!
            </div>
        </div>

        <div id="beneficios">
            <div class="content-beneficios">
                <div id="gigas">
                    <div id="icon-gigas" class="icon-beneficio"></div>
                    <div class="description-beneficio">
                        <p><strong>Gigas que acumulam</strong></p>
                        <P>Acumule seus GIGAS e minutos não utilizados</P>
                    </div>
                </div>
                <div id="suporte">
                    <div id="icon-suporte" class="icon-beneficio"></div>
                    <div class="description-beneficio">
                        <p><strong>Atendimento 24 horas</strong></p>
                        <p>Fale em nosso chat online e humanizado, ou ligue para nossa Central de atendimento pelos números *288 e
                            10543.</p>
                    </div>
                </div>
                <div id="bonus">
                    <div id="icon-bonus" class="icon-beneficio"></div>
                    <div class="description-beneficio">
                        <p><strong>Bônus de internet sempre</strong></p>
                        <p>Tenha muito mais internet com os nossos bônus de recarga programada e de portabilidade</p>
                    </div>
                </div>
                <div id="apps">
                    <div id="icon-apps" class="icon-beneficio"></div>
                    <div class="description-beneficio">
                        <p><strong>Apps ilimitados</strong></p>
                        <p>Acesse WhatsApp e Waze sem limites, sem descontar da sua franquia de internet.</p>
                    </div>
                </div>
            </div>

            <div class="top-beneficio">
                <div class="container-experiencia">
                    <h4 class="materia-title">EXPERIÊNCIAS EXCLUSIVAS</h4>
                    <p class="materia-desc pt-4">Pensar fora da caixa e fazer tudo diferente está no nosso DNA. Aqui, você encontra um universo de possibilidades para se conectar e desfrutar de experiências exclusivas!</p>
                    <div class="materia-index-img" style="background-image: url('./img/experiencia.jpg');"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="clientes">
        <div class="text-center titulo-padrao">
            <h1 class="font-weight-bold my-5">Conheça nossos clientes</h1>
        </div>

        <div class="caixa-1"></div>

        <div class="caixa-2">
            <a href="https://laricel.com.br/" target="_blank" rel="noopener noreferrer">
                <div class="btn-sunk-chip btn-sunk-chip-m">
                    <div class="img-chip-m">
                        <img src="./img/laricelchip.png" alt="LariCel Chip" />
                    </div>
                </div>
            </a>
        </div>

        <div class="caixa-background bg-futebol"></div>

        <div class="caixa-4">
            <section id="section-futebol">
                <div class="card-chip">
                    <a href="https://falatimao.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/falatimaochip.jpg" alt="Fala Timão Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://tricolorchip.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/spfcchip.jpg" alt="Tricolor Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://aloverdao.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/aloverdaochip.jpg" alt="Alô Verdão Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://chipeixao.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/santoschip.jpg" alt="Santos Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://lusafone.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/lusafonechip.jpg" alt="Lusa Fone Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://botafogocelular.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/botafogochip.jpg" alt="Botafogo Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://chipdovascao.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/vascochip.jpg" alt="Vasco Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://cruzeirocelular.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/cruzeirochip.jpg" alt="Cruzeiro Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/galochip.jpg" alt="Atlético Mineiro Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://aloleao.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/aloleaochip.jpg" alt="Alô Leão Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://vozaophone.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/vozaochip.jpg" alt="Ceará Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://home.chipgigante.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/gigantechip.jpg" alt="Internacional Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://esquadraocelular.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/esquadraochip.jpg" alt="Bahia Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://gremiocell.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/gremiochip.jpg" alt="Grêmio Cell" />
                            </div>
                        </div>
                    </a>
                    <a href="https://flumobile.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/flumobilechip.jpg" alt="Flu Mobile Chip" />
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </div>

        <div class="caixa-background bg-entretenimento"></div>

        <div class="caixa-6">
            <section id="section-entretenimento">
                <div class="card-chip">
                    <a href="#">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/chipalobeijaflor.jpg" alt="Chip Alô Beija-Flor" />
                            </div>
                        </div>
                    </a>
                    <a href="https://falamangueira.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/falamangueira.jpg" alt="Fala Mangueira Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/chipportela.png" alt="Portela Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/chipimperio.png" alt="Chip Império" />
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </div>

        <div class="caixa-background bg-empresa"></div>

        <div class="caixa-6">
            <section id="section-empresas">
                <div class="card-chip">
                    <a href="https://barbosachip.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/barbosachip.jpg" alt="Barbosa Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://citymaiscelular.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/citychip.jpg" alt="City Mais Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://enterpmobile.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/enterpchip.jpg" alt="Enterp Mobile Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://gaconecta.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/gaconectachip.png" alt="G.A. Conecta Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://alosocialcelular.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/alosocialchip.jpg" alt="Alô Social Chip" />
                            </div>
                        </div>
                    </a>
                    <a href="https://paraisopoliscelular.com.br/" target="_blank" rel="noopener noreferrer">
                        <div class="btn-sunk-chip">
                            <div class="img-chip">
                                <img src="./img/paraisopolischip.jpg" alt="Paraisópolis Celular Chip" />
                            </div>
                        </div>
                    </a>
                </div>
            </section>
        </div>
    </section>

    <section id="section-slide">
        <div class="titulo-padrao text-center">
            <h1 class="font-weight-bold">Uma operadora para chamar de sua</h1>
            <div class="subtitulo mb-5" style="color: black;">Quem virou Dry, virou o jogo e correu para o abraço!</div>
        </div>

        <div class="slider">
            <div class="caixa-slide px-5 pt-5">
                <div class="card-materia-lateral mx-auto px-3 py-3">
                    <div class="border-slide">
                        <div class="slide-img">
                            <img src="./img/male-avatar.png" alt="Imagem">
                        </div>
                        <h4 class="nome-usuario" style="margin-top: 30px;">Bruno Carrara</h4>
                        <p class="px-4 py-4">
                            Moro no interior e trabalho em São Paulo. O chip funciona PERFEITAMENTE, internet rápida e sempre com sinal. Vale muito a pena!
                        </p>
                        <div class="logo-operadora">
                            <img src="./img/fala-timao.png" alt="Fala Timão">
                        </div>
                    </div>
                </div>
            </div>
            <div class="caixa-slide px-5 pt-5">
                <div class="card-materia-lateral mx-auto px-3 py-3">
                    <div class="border-slide">
                        <div class="slide-img">
                            <img src="./img/male-avatar.png" alt="Imagem">
                        </div>
                        <h4 class="nome-usuario" style="margin-top: 30px;">Calebe Lima</h4>
                        <p class="px-4 py-4">
                            Minha experiência com a Tricolor Chip está sendo maravilhosa. No atendimento, qualidade, nas promoções e em tudo rs! Parabéns e continuem assim!!
                        </p>
                        <div class="logo-operadora">
                            <img src="./img/tricolor-chip.png" alt="Tricolor Chip">
                        </div>
                    </div>
                </div>
            </div>
            <div class="caixa-slide px-5 pt-5">
                <div class="card-materia-lateral mx-auto px-3 py-3">
                    <div class="border-slide">
                        <div class="slide-img">
                            <img src="./img/female-avatar.png" alt="Imagem">
                        </div>
                        <h4 class="nome-usuario" style="margin-top: 30px;">Nicole</h4>
                        <p class="px-4 py-4">
                            Gosto muito do atendimento de vocês, o sinal é sempre perfeito e os planos acessíveis. Tenho muito carinho e respeito pelos adms da conta no insta da LariCel, sempre fofos e atenciosos!
                        </p>
                        <div class="logo-operadora">
                            <img src="./img/laricel.png" alt="LariCel">
                        </div>
                    </div>
                </div>
            </div>
            <div class="caixa-slide px-5 pt-5">
                <div class="card-materia-lateral mx-auto px-3 py-3">
                    <div class="border-slide">
                        <div class="slide-img">
                            <img src="./img/male-avatar.png" alt="Imagem">
                        </div>
                        <h4 class="nome-usuario" style="margin-top: 30px;">Lucas Ribeiro</h4>
                        <p class="px-4 py-4">
                            O preço de vocês e o atendimento é sensacional comparado às outras operadoras. Foi o que me conquistou.
                        </p>
                        <div class="logo-operadora">
                            <img src="./img/flu-mobile.png" alt="Flu Mobile">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-midia">
        <div class="container">
            <div class="titulo-padrao">
                <h1 class="font-weight-bold">Dry na mídia</h1>
            </div>
            <div class="slider-midia">
                <div class="caixa-slide px-2">
                    <div class="card-jumped-white-ext mx-auto">
                        <div class="card-sunk-white">
                            <div class="protection-card">
                                <div class="img-title-slide mt-3">
                                    <img src="./img/logovaloreconomico.png" alt="Valor Economico">
                                </div>
                                <p class="text-center">Clubes de futebol entram no mercado de celular com operadoras virtuais</p>
                                <a href="https://valor.globo.com/empresas/noticia/2020/02/13/clubes-de-futebol-entram-no-mercado-de-celular-com-operadoras-virtuais.ghtml" target="_blank" class="btn-padrao font-weight-bold">
                                    VER MATÉRIA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="caixa-slide px-1">
                    <div class="card-jumped-white-ext mx-auto">
                        <div class="card-sunk-white">
                            <div class="protection-card">
                                <div class="img-title-slide mt-3">
                                    <img src="./svg/logo-estadao.svg" alt="Estadão">
                                </div>
                                <p class="text-center">Larissa Manoela lança operadora virtual de celular e vende 2,5 mil chips em 6 dias</p>
                                <a href="https://economia.estadao.com.br/noticias/geral,larissa-manoela-lanca-operadora-virtual-de-celular-e-vende-2-5-mil-chips-em-6-dias,70003743094" target="_blank" class="btn-padrao font-weight-bold">
                                    VER MATÉRIA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="caixa-slide px-1">
                    <div class="card-jumped-white-ext mx-auto">
                        <div class="card-sunk-white">
                            <div class="protection-card">
                                <div class="img-title-slide mt-3">
                                    <img src="./svg/logo-meio-e-mensagem.svg" alt="Meio & Mensagem">
                                </div>
                                <p class="text-center">Corinthians lança operadora móvel com campanha</p>
                                <a href="https://www.meioemensagem.com.br/home/marketing/2021/06/15/corinthians-lanca-operadora-movel-com-campanha.html" target="_blank" class="btn-padrao font-weight-bold">
                                    VER MATÉRIA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="caixa-slide px-1">
                    <div class="card-jumped-white-ext mx-auto">
                        <div class="card-sunk-white">
                            <div class="protection-card">
                                <div class="img-title-slide mt-3">
                                    <img src="./img/logo-extra.png" alt="Extra Globo">
                                </div>
                                <p class="text-center">FLUmobile: Fred sorteará camisa para sócios do Fluminense em comemoração de aniversário</p>
                                <a href="https://extra.globo.com/esporte/fluminense/flumobile-fred-sorteara-camisa-para-socios-do-fluminense-em-comemoracao-de-aniversario-25255986.html" target="_blank" class="btn-padrao font-weight-bold">
                                    VER MATÉRIA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="caixa-slide px-1">
                    <div class="card-jumped-white-ext mx-auto">
                        <div class="card-sunk-white">
                            <div class="protection-card">
                                <div class="img-title-slide mt-3">
                                    <img src="./svg/gazeta-logo.svg" alt="Gazeta Esportiva">
                                </div>
                                <p class="text-center">São Paulo lança chip de celular com desconto para sócio torcedor</p>
                                <a href="https://www.gazetaesportiva.com/todas-as-noticias/sao-paulo-lanca-chip-de-celular-com-desconto-para-socio-torcedor/" target="_blank" class="btn-padrao font-weight-bold">
                                    VER MATÉRIA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="caixa-slide px-1">
                    <div class="card-jumped-white-ext mx-auto">
                        <div class="card-sunk-white">
                            <div class="protection-card">
                                <div class="img-title-slide mt-3">
                                    <img src="./img/logo-veja.gif" alt="Veja">
                                </div>
                                <p class="text-center">Empresa de telefonia social nasce com foco no acesso à internet em favelas</p>
                                <a href="https://veja.abril.com.br/coluna/radar/empresa-de-telefonia-social-nasce-com-foco-no-acesso-a-internet-em-favelas/" target="_blank" class="btn-padrao font-weight-bold">
                                    VER MATÉRIA
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cobertura">
        <div class="container">
            <div class="titulo-mapa">
                <h1 class="font-weight-bold mt-5">Cobertura do tamanho do Brasil</h1>
            </div>

            <div class="align-center-vertical">
                <div class="bg-mobile"></div>
            </div>

            <div class="text-cobertura mx-auto">Ficou sem sinal? Aqui na Dry isso não existe! Por meio de nossas antenas parceiras, entregamos sinal de alta qualidade em todo o território nacional</div>

            <div class="btn-center">
                <a href="https://tim.img.com.br/mapa-cobertura/" target="_blank" rel="noopener noreferrer">
                    <button class="btn-padrao">VER COBERTURA</button>
                </a>
            </div>
        </div>
    </section>

    <section id="section-aplicativo" class="pt-5">
        <div class="content-aplicativo">
            <div class="col-md-6 w-space">
                <div class="text-aplicativo">
                    <div class="container">
                        <div class="titulo-padrao">
                            <h1 class="font-weight-bold">Transforme sua paixão em <span class="conexao">conexão</span></h1>
                        </div>
                        <p>Chegou a hora de abraçar essa experiência! Baixe o APP da Dry em seu smartphone e conecte-se agora com o futuro da telefonia móvel</p>

                        <div class="caixa-aplicativo mx-auto">
                            <h5 class="text-center mb-4">Baixe agora:</h5>
                            <div class="img-app d-flex justify-content-center">
                                <a href="https://apps.apple.com/br/app/dry-conecta-whitelabel/id1562358701" target="_blank" rel="noopener noreferrer">
                                    <img src="./svg/apple-store.svg" alt="Apple Store">
                                </a>
                                <a href="https://play.google.com/store/apps/details?id=br.com.drycompanybrasil.whitelabel" target="_blank" rel="noopener noreferrer">
                                    <img src="./svg/google-play.svg" alt="Google Play">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="bg-celular" class="col-md-6">

            </div>
        </div>
    </section>

    <footer id="footer-index">
        <div id="img-footer"></div>
        <div class="container">

            <div class="row pt-5">
                <div class="col-md-4 align-center-vertical mx-auto">
                    <div class="footer-logo">
                        <img src="./svg/logo-drytelecom.svg" alt="Logo">
                    </div>
                    <div class="align-self-center">
                        <button class="btn-padrao borda-botao btn-menor" style="min-width: 140px;" data-toggle="modal" data-target="#staticBackdrop">CONTATO</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <h3 class="footer-title text-center">EXPLORE</h3>
                    <div class="footer-menu">
                        <a href="./index.php#clientes">Clientes</a> <br>
                        <a href="./index.php#cobertura">Cobertura</a> <br>
                        <a href="./blog.php">Blog</a> <br>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">TRANSPARÊNCIA</h3>
                    <div class="footer-menu">
                        <a href="./politica-de-privacidade.php">Política de Privacidade</a> <br>
                        <a href="./politica-de-privacidade.php#cookies">Política de Cookies</a> <br>
                        <a href="./politica-de-privacidade.php#LGPD">LGPD</a> <br>
                    </div>
                </div>
                <div class="col-md-4">
                    <h3 class="footer-title text-center">REDES SOCIAIS</h3>
                    <div id="redes-sociais" class="d-flex justify-content-center">
                        <div class="redes-sociais-pic mr-3">
                            <a href="https://instagram.com/drytelecom?igshid=YmMyMTA2M2Y" target="_blank">
                                <img src="./svg/icon-instagram.svg" alt="Instagram">
                            </a>
                        </div>
                        <div class="redes-sociais-pic">
                            <a href="https://www.linkedin.com/company/drycompanybrasil/" target="_blank">
                                <img src="./svg/icon-linkedin.svg" alt="LinkedIn">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="footer-credits mb-5">
                    2022. Dry Telecom. Todos os direitos reservados. CNPJ: 15.564.295/0001-04 RAZÃO SOCIAL: DRY COMPANY DO BRASIL TECNOLOGIA LTDA AV ANÁPOLIS, N° 510 - VILA NILVA - BARUERI/SP - CEP 06404-250
                </div>
            </div>
        </div>
    </footer>
    <script src="./script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://drytelecom.com.br/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.slider').slick({
                dots: true,
                arrows: true,
                //autoplay: true,
                responsive: [{
                    breakpoint: 764,
                    settings: {
                        arrows: false
                    }
                }]
            });

        });

        $(document).ready(function() {

            $('.slider-midia').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 2,
                dots: true,
                arrows: true,
                responsive: [{
                        breakpoint: 780,
                        settings: {
                            arrows: false,
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 850,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            arrows: false,
                        }
                    },
                    {
                        breakpoint: 1000,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 1040,
                        settings: {
                            arrows: false
                        }
                    }
                ]
            });
        });

        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });
    </script>
</body>

</html>