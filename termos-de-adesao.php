<?php
session_start();

require './bd/conexao.php';
$conexao = conexaoMySql();

$usuario_autenticado = $_SESSION['usuarioAutenticado'];
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
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./responsive.css">
    <link rel="stylesheet" href="./guideline-social.css">
    <title>Termos de Adesão - Dry Telecom</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-light navbar-inner">
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
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
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
                        <a class="nav-link fonte-menu" href="#" data-toggle="modal" data-target="#modalContato">CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fonte-menu" href="./index.php#cobertura">COBERTURA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="modal fade" id="modalContato" tabindex="-1" aria-labelledby="modalContatoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="ml-auto mr-auto">Alguma dúvida?</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    <div class="modal-body ml-auto mr-auto">
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=5511920000909&text=Ol%C3%A1%2C%20vim%20pelo%20site%20da%20Dry%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es!">
                            <button class="btn-padrao font-weight-bold">CONVERSE COM UM ESPECIALISTA</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn-padrao margem-btn font-weight-bold" onclick="window.history.back()">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </button>

        <div id="titulo-adesao">
            <h2 class="text-center mt-5">Termos de adesão</h2>
            <span class="font-weight-bold">Atualizado em 04 de abril de 2022</span>
        </div>


        <div class="privacidade-text mt-5">
            <p>O termo de adesão da DRY COMPANY BRASIL TECNOLOGIA S/A - CNPJ 15.564.295/0001-04, com sede na Avenida Anápolis, 510, Vila Nilva - Barueri/SP, doravante simplesmente denominada DRY COMPANY (empresa MVNO credenciada da SURF TELECOM S/A, em conformidade com a resolução 550/2010 da Anatel) é valido para os planos de Serviço pré-pagos da operação, que são oferecidos para toda pessoa física ou jurídica na qualidade de usuário final, doravante denominada CLIENTE.</p>
        </div>
        <div class="privacidade-text">
            <p>A prestadora de origem dos serviços de telecomunicações oferecidas pela DRY COMPANY é a SURF TELECOM S/A, empresa devidamente licenciada para a prestação do SMP-RRV pela Anatel.</p>
        </div>
        <div class="privacidade-text">
            <p>A adesão dos benefícios se dará de forma automática, por meio da compra de um chip de telefonia móvel comercializado pela MVNO e após a recarga realizada pelo CLIENTE. Ao comprar um chip e carregá-lo com um dos valores disponíveis, o CLIENTE está aderindo automaticamente aos benefícios correspondentes ao plano de Serviço comercializado.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">1. Período de adesão a plano de Serviço</p>
        </div>
        <div class="privacidade-text">
            <p>A qualquer momento, desde que o plano esteja sendo comercializado e divulgado no site. Eventuais promoções serão válidas por 30 dias a partir de sua data de divulgação e não constam do presente termo de adesão.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">2. Ativação do plano de serviço</p>
        </div>
        <div class="privacidade-text">
            <p>A qualquer momento, desde que o plano esteja sendo comercializado e divulgado no site. Eventuais promoções serão válidas por 30 dias a partir de sua data de divulgação e não constam do presente termo de adesão.</p>
        </div>
        <div class="privacidade-text">
            <p>2.1 - A ativação é feita automaticamente após a realização da recarga pelo CLIENTE e recebimento de SMS, confirmando a ativação do plano.</p>
        </div>
        <div class="privacidade-text">
            <p>2.2 - O número do telefone informado para realização da recarga é de inteira responsabilidade do CLIENTE. A MVNO não se responsabiliza em caso de números de registro telefônico preenchidos incorretamente e confirmados pelo CLIENTE durante a transação, tendo assim resguardado seu direito de executar a ação e cobrar os devidos custos operacionais.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">3. Taxa de adesão</p>
        </div>
        <div class="privacidade-text">
            <p>Não há cobrança de taxa de adesão a qualquer plano de Serviço. Para aderir ao plano, o CLIENTE deve ter adquirido e ativado previamente o chip da operação e escolher por um valor de recarga disponível.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">4. Benefícios</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold">4.1 - Plano de serviços individual</p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.1.1 - Valor e prazo de validade:</strong> <br>
                O plano possui as seguintes opções e os planos de benefícios correspondentes a cada valor de recarga são válidos por 30 dias. <br>
                As chamadas ilimitadas são para ligação local e longa distância nacional para qualquer número de telefone fixo ou móvel de qualquer prestadora dentro do território nacional. Os minutos para chamadas e SMS para longa distância incluídos no plano NÃO são válidos para ligações sem marcação pelo CLIENTE do Código da Prestadora de longa distância ou marcação com o Código 41, caso contrário a chamado ou SMS não será processada por inexistir saldo em reais em sua carteira, recebendo a informação "saldo insuficiente". Para ligações ilimitadas (apenas para as recargas identificadas como 40, 50 e 75) serão concedidos 1000 minutos para serem usados como descrito nos itens I e II acima. Consumida essa franquia de minutos, o cliente ficará elegível para mais um aporte de 1000 minutos sem custo adicional e assim sucessivamente. Esse processo se repetirá indefinidamente desde que não seja detectado consumo fraudulento ou em desacordo às regras estabelecidas no presente Termo de Adesão.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.1.2 - Roaming Nacional:</strong> <br>
                O Roaming é gratuito para o CLIENTE. Não haverá cobrança adicional para o encaminhamento das chamadas de longa distância em todo o território nacional. Não haverá cobrança de taxa de deslocamento para as chamadas recebidas fora de sua localidade.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.1.3 - Internet sem corte, durante a validade do plano:</strong> <br>
                O plano contempla uma franquia para conexão com qualidade descrita em 4.1.3.1. Após o consumo de 100% da franquia, o acesso à internet não é cortado e o CLIENTE continuará navegando em velocidade reduzida (64 Kbps) até o prazo final de validade do plano.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.1.3.1 - Velocidades e navegação de internet:</strong> <br>
                A velocidade de referência de navegação na rede 3G é de até 1 Mbps para download e de até 100 Kbps para upload. <br>
                A velocidade de referência na rede 4G é de até 5 Mbps para download e de até 500 Kbps para upload. Para ter acesso ao 4G, é preciso que o cliente tenha chip e aparelho compatíveis com a tecnologia, além de estar em um local com cobertura 4G.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.1.4 - WhatsApp Grátis:</strong> <br>
                O uso do WhatsApp para mensagens de texto, fotos e chamadas de voz não será descontado da franquia de dados, durante o período de validade do plano, independentemente de haver saldo ou não na franquia de dados. Para baixar ou enviar vídeos via WhatsApp, haverá consumo de dados da sua franquia.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.1.5 - Acúmulo de benefícios não utilizados no mês:</strong> <br>
                Os benefícios de minutos/SMS ou dados não utilizados no período de validade do plano, que é 30 dias, são acumulados, desde que o CLIENTE tenha feito uma recarga dentro do prazo de validade do seu plano, observando o limite máximo de 24GB para acúmulo de benefícios em qualquer plano comercializado. <br>
                <strong>Atenção:</strong> <br>
                O acúmulo de benefícios num plano está limitado a 24 GB para dados. <br>
                Caso a nova recarga seja feita após o término do período de validade do plano não haverá acúmulo de benefícios.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>4.2 - Plano Família:</strong> <br>
                Ao plano Família, quando disponível, aplicam-se as mesmas regras inerentes ao plano de Serviços Individual, com as seguintes modificações:
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.1 - O plano família consiste da aquisição em bloco de créditos promocionais para utilização conjunta em 04 (quatro) CHIPS vinculados ao CPF do responsável financeiro, com franquias mensais individuais e intransferíveis para os serviços de voz, dados, SMS e benefícios.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.2 - Como condição ao gozo dos benefícios e vantagens exclusivas oferecidos, o plano família está sujeita ao prazo de vigência de 12 (dose) meses; contudo, caso o CLIENTE não confirme as recargas mensais consecutivas até a data de vencimento do plano, perderá os benefícios e vantagens exclusivas oferecidos, hipótese em que serão aplicadas as disposições relativas ao cancelamento referidas no item 12 abaixo.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.3 - O plano família tem prazo de vigência de 12 (doze) meses, período durante o qual o CLIENTE obriga-se a adquirir créditos pré-determinados a cada 30 (trinta) dias.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.4 - O CLIENTE deverá efetuar recargas mensais de R$ 150,00 (cento e cinquenta reais) durante 12 meses. A renovação do plano família não se dará automaticamente. Ao término do plano, a renovação e os respectivos valores de um novo plano, se houver, serão estabelecidos por critérios da Empresa.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.5 - As recargas do plano família conferem ao CLIENTE o direito de utilização dos seguintes serviços e benefícios:
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.5.1 - Chamadas ilimitadas e SMS para ligação local e longa distância nacional para qualquer número de telefone fixo ou móvel de qualquer prestadora dentro do território nacional, observadas as limitações e condições específicas nos itens 4.1.1 "II" e "III" supra.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.5.2 - Plano de dados total de 60GB com prazo de utilização de 30 dias, sendo 15GB para cada chip, a partir da data das recargas mensais.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.5.3 - No plano família, os dados e benefícios não utilizados no período de validade da recarga não se acumulam e não podem ser transferidos ou utilizados pelos demais chips integrantes do plano.
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                4.2.6 - Caso o CLIENTE não efetue as recargas periódicamente no plano família, perderá automaticamente todos os benefícios e descontos oferecidos.
            </p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">5. Usos não autorizados dos benefícios do plano de Serviço</p>
        </div>
        <div class="privacidade-text">
            <p>O CLIENTE estará passível de bloqueio de seu plano e o cancelamento da sua adesão ao Termo quando for identificado o uso indevido dos benefícios enquadrados em quaisquer dos itens abaixo, inclusive se constatado o uso de informação incorreta, incompleta ou falsa prestada ao cliente:</p>
        </div>
        <div class="privacidade-text">
            <p>
                5.1 - Comercialização de minutos/serviços ou utilizando Torpedos com finalidade comercial, destinados à obtenção de lucro por parte do cliente;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.2 - Envio de Torpedos promocionais através de máquinas, computadores, ou outro dispositivo que não seja o celular do cliente;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.3 - Envio de Torpedos promocionais indesejados classificados como SPAM;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.4 - Realização de chamadas promocionais através de máquinas, computadores, ou outro dispositivo que não seja o celular do cliente;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.5 - Realização de chamadas promocionais indesejadas classificados como SPAM;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.6 - Utilização de equipamentos de equipamentos como GSM Box, Black Box e equipamentos similares;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.7 - Uso estático (sem mobilidade) do aparelho;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.8 - Desbalanceamento de tráfego sainte / entrante, com utilização de 60% do tráfego originado pelo cliente e recebimento de ligações em proporção inferior a 33% do volume originado, por mês;
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                5.9 - Utilização do benefício para realização de conferências, ou seja, não está permitida a realização de chamadas (local ou longa distância nacional, com o código 41) para diferentes números de qualquer operadora simultaneamente;
            </p>
        </div>
        <div class="privacidade-text">
            <p>5.10 - Utilização do benefício para serviços de Sala de Conversação, Tele-amizade, Tele-sexo e similares;</p>
        </div>
        <div class="privacidade-text">
            <p>5.11 - Para utilizações que venham infringir as normas de uso da operação ou qualquer outro dispositivo legal ou para qualquer finalidade que não seja o envio pessoal e individual de mensagens;</p>
        </div>
        <div class="privacidade-text">
            <p>5.12 - Consentimento aos termos de uso e políticas de privacidade prestado por pessoa sem capacidade civil plena no momento da contratação.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">6. Renovação da Adesão a plano de Serviço</p>
        </div>
        <div class="privacidade-text">
            <p>6.1 - A renovação de plano ocorre sempre que o CLIENTE da operação efetuar uma recarga num dos valores disponíveis.</p>
        </div>
        <div class="privacidade-text">
            <p>6.1.1 - O CLIENTE tem o direito de escolher a recarga que melhor lhe convier, a qualquer momento e sem cobrança de qualquer tipo de multa ou imposição de fidelização, salvo na hipótese de adesão ao plano família, que se rege pelas disposições próprias indicadas no item 4.2 acima.</p>
        </div>
        <div class="privacidade-text">
            <p>6.1.2 - Os benefícios não utilizados serão somados aos novos benefícios correspondentes ao plano de recarga realizada, da mesma forma os dias remanescentes de validade do plano anterior serão acrescidos ao novo período de validade. Observando que nos planos que não possuem plano de voz ilimitada, a regra acumulativa serve apenas para os dados. </p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold my-5">7. Recargas</p>
        </div>
        <div class="privacidade-text">
            <p>As recargas disponíveis são:</p>
            <ul class="ml-3">
                <li>R$ 20 (vinte reais), referente ao Plano 20 - Validade 30 dias;</li>
                <li>R$ 25 (vinte e cinco reais), referente ao Plano 25 - Validade 30 dias;</li>
                <li>R$ 30 (trinta reais), referente ao Plano 30 - Validade 30 dias;</li>
                <li>R$ 40 (quarenta reais), referente ao Plano 40 - Validade 30 dias;</li>
                <li>R$ 50 (cinquenta reais), referente ao Plano 50 - Validade 30 dias;</li>
                <li>R$ 75 (setenta e cinco reais), referente ao Plano 75 - Validade 30 dias;</li>
            </ul>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold my-5">7. Descrição das Recargas</p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>R$ 20 (vinte reais), referente ao Plano 20 - Validade 30 dias</strong> <br>
                750 MB de internet <br>
                30 minutos de ligação <br>
                30 SMS
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>R$ 25 (vinte e cinco reais), referente ao Plano 25 - Validade 30 dias</strong> <br>
                1.5GB de internet <br>
                60 minutos de ligação <br>
                60 SMS
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>R$ 30 (trinta reais), referente ao Plano 30 - Validade 30 dias;</strong> <br>
                3GB de internet <br>
                100 minutos de ligação <br>
                100 SMS
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>R$ 40 (quarenta reais), referente ao Plano 40 - Validade 30 dias;</strong> <br>
                5GB de internet <br>
                Ligações ilimitadas (de 1000 minutos em 1000 minutos) <br>
                100 SMS
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>R$ 50 (cinquenta reais), referente ao Plano 50 - Validade 30 dias;</strong> <br>
                9GB de internet <br>
                Ligações ilimitadas (de 1000 minutos em 1000 minutos) <br>
                100 SMS
            </p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>R$ 75 (setenta e cinco reais), referente ao Plano 75 - Validade 30 dias;</strong> <br>
                15GB de internet <br>
                Ligações ilimitadas (de 1000 minutos em 1000 minutos) <br>
                100 SMS
            </p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">8. Compras no Boleto</p>
        </div>
        <div class="privacidade-text">
            <p>Seu pedido será efetivado após a compensação de pagamento.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">9. Sobre os serviços de dados da operação</p>
        </div>
        <div class="privacidade-text">
            <p>
                A velocidade disponível no acesso pode ter oscilações e variações conforme condições topográficas e/ou climáticas, velocidade de movimento, distância que o CLIENTE se encontrar da Estação Rádio Base (ERB), número de CLIENTES que utilizarem ao mesmo tempo a cobertura provida pela mesma ERB, modem usado na conexão, aplicações utilizadas e sites de conteúdo e informação que estão sendo acessados, além de outros fatores externos que porventura venham a interferir no nível do sinal , que independem de ações de empresas envolvidas. <br>
                A MVNO obriga-se perante ao CLIENTE a prestar os serviços segundos os padrões de qualidade exigidos pela Anatel, utilizando todos os meios comercialmente viáveis para atingir a velocidade contratada pelo CLIENTE, nos padrões de mercado e observadas as limitações previstas neste Termo. <br>
                A MVNO não se responsabiliza pelas diferenças de velocidades ocorridas em razão de fatores externos, bem como problemas no equipamento utilizado pelo CLIENTE, entre outros. Além das hipóteses acima apontadas, outros fatores podem ter influência na variabilidade da velocidade do tráfego de dados, tais como a tecnologia utilizada para a navegação: GPRS, EDGE ou HSDPA. O CLIENTE declara ter sido informado a respeito da cobertura na sua localidade, acessível também a qualquer momento no site da operação, estando também ciente que, por características técnicas decorrentes da natureza do serviço, podem haver limitações de cobertura em eventuais áreas, não se aplicando, entretanto, nestes casos, a concessão de quaisquer descontos ou dispensa de pagamento do serviço. <br>
                Dentro da rede 4G ou 3G, a MVNO garante ao CLIENTE serviço de dados mínimo de 40% da velocidade contratada, em conformidade com a Resolução 575/2011 da Anatel.
            </p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">10. Aparelhos celulares a serem utilizados no plano de Serviço da operação</p>
        </div>
        <div class="privacidade-text">
            <p>O correto funcionamento e desempenho da operação somente será possível por meio do uso de equipamentos homologados pela Anatel e compatíveis com as frequências autorizadas e em uso pelas prestadoras parceiras da operação e cujo IMEI não esteja bloqueado por autoridades competentes.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">11. Outras informações sobre o plano</p>
        </div>
        <div class="privacidade-text">
            <p>
                11.1 - A MVNO poderá extinguir, ou mesmo alterar qualquer plano total ou parcialmente, a qualquer momento devendo para tanto efetuar a comunicação ao CLIENTE, com antecedência de 30 (trinta) dias, para que este possa optar por outro plano de serviços, sendo que, caso não ocorra a manifestação do CLIENTE, a MVNO está autorizada a efetuar a transferência deste para outro plano alternativo de serviço similar, de acordo com a regulamentação da Anatel, então vigente. <br>
                Para informações sobre:
            <ul class="ml-3">
                <li>Para ATIVAR o chip, acesse a página Ativar Chip;</li>
                <li>O número do seu celular, digite *221#;</li>
                <li>Saldo dos benefícios de Internet e voz / sms, digite *225#;</li>
                <li>Outras informações, digite *288, ou acesse o site da operação.</li>
            </ul>
            </p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">12. Disposições Gerais</p>
        </div>
        <div class="privacidade-text">
            <p>12.1 - O serviço da operação poderá ser suspenso sempre que for detectado o uso indevido do código de acesso não atribuído ao cliente ou seu uso para fins ilícitos e que possam perturbar a ordem pública por ação do CLIENTE cessando, nesses casos, a responsabilidade da operação.</p>
        </div>
        <div class="privacidade-text">
            <p>12.2 - Aplicam-se ao Termo as disposições do Regularmento Geral de Direitos do Consumidor de Serviços de Telecomunicações da Anatel e as disposições contidas no Código de Defesa do Consumidor.</p>
        </div>
        <div class="privacidade-text">
            <p>12.2.1 - É assegurado o CLIENTE o direito de arrependimento previsto no art. 49 do Código de Defesa do Consumidor sempre que o chip e/ou aparelho for adquirido fora de uma das lojas físicas da operação, por e-Commerce, telefone ou qualquer meio não presencial. No entanto, a partir da ativação do CHIP e início do uso dos serviços e aparelhos, consideram-se aceita contratação pelo CLIENTE.</p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">13. Suspensão do Serviço</p>
        </div>
        <div class="privacidade-text">
            <p>Se não houver renovação após expiração de recarga, o cliente passa por 2 estágios até a desativação da linha:</p>
        </div>
        <div class="privacidade-text">
            <p>
                <strong>1º estágio (após a expiração da recarga):</strong> o cliente recebe chamadas e SMS, porém não terá os benefícios de voz e dados. <br>
                <strong>2º estágio (45 dias após o 1):</strong> o cliente poderá apenas originar chamadas e enviar mensagens de textos aos serviços públicos de emergência definidos por ordem de regulamentação da Anatel e conseguirá contratar o Call Center através do *288 e realizar recarga e ficará por 30 dias nesse estágio até a desativação total do serviço. <br>
                <strong>Obs: </strong>O prazo para o cancelamento total do serviço é baseado
            </p>
        </div>
        <div class="privacidade-text">
            <p class="mt-5">
                <strong>14 -</strong> O CLIENTE reconhece que os serviços poderão eventualmente ser afetados ou temporariamente interrompidos nas hipóteses legais de exclusão de responsabilidade, casos em que não será a MVNO responsável por eventuais falhas, atrasos ou interrupções destes, não estabelecendo nenhum tipo de direito adquirido.
            </p>
        </div>
        <div class="privacidade-text">
            <p class="font-weight-bold mt-5">15 - Glossário</p>
        </div>
        <div class="privacidade-text" style="margin-bottom: 60px;">
            <p>
                Da operação Dry Company: é LICENCIADA da marca Dry Conecta, na qualidade de MVNO credenciada da Surf Telecom S.A nos termos da resolução 550/2010 da Anatel. <br>
                SITE = dryconecta.com.br <br>
                PLANO : é um plano de serviço pré-pago disponibilizado pela MVNO. <br>
                PLANO DE SERVIÇO: é o documento que descreve as condições de prestação do serviço quanto às suas características, ao seu acesso, manutenção do direito de uso, utilização, facilidades e serviços eventuais e suplementares a ele inerentes, os preços associados, seus valores e as regras e critérios de sua aplicação. Prestadoras: pessoa jurídica que possui autorização da Anatel para prestar serviço de telecomunicações de interesse coletivo. <br>
                RECARGA: são créditos em reais para que o CLIENTE da operação possa usufruir dos benefícios oferecidos por meio de plano de Serviço pré-pago. <br>
                PLANO/BENEFÍCIOS: são os serviços disponibilizados por determinado plano de serviço. <br>
                SMS: Serviço de mensagens curtas (em inglês: Short Message Service). <br>
                GB: Gigabyte (símbolo GB) é uma unidade de medida de informação, segundo o Sistema Internacional de Unidades, que equivale a um bilhão (milhar de milhões) de bytes, ou seja, 1.000.000.000 bytes. <br>
                MB: Megabyte – um milhão de bytes; no caso, equivalente a 1024 KB. <br>
                Kbps: é uma unidade de transmissão de dados igual a 1.000 bits por segundo. <br>
                Mbps: é uma unidade de medida de velocidade de transmissão de dados equivalente a 1.000 Kbps ou 1.000.000 bits por segundo. <br>
            </p>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-4 align-center-vertical ml-auto mr-auto">
                    <div class="footer-logo">
                        <img src="./svg/logo-drytelecom.svg" alt="Logo">
                    </div>
                    <div class="botao-contato align-self-center">
                        <button class="btn-padrao borda-botao contato-btn" style="min-width: 140px;" data-toggle="modal" data-target="#modalContato">CONTATO</button>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://drytelecom.com.br/slick/slick.min.js"></script>
    <script src="./script.js"></script>

    <script>
        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });
    </script>
</body>

</html>