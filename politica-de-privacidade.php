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
    <title>Política de Privacidade - Dry Telecom</title>
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
                        <button class="btn-padrao">SAIR</button>
                    </a>
                <?php } else if ($usuario_autenticado == false) { ?>
                    <a class="logout" href="./login.php">
                        <button class="btn-padrao">LOGIN</button>
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

        <button class="btn-padrao margem-btn font-weight-bold" onclick="history.go(-1)">
            <span class="material-symbols-outlined">arrow_back</span>
            VOLTAR
        </button>
    </div>

    <section class="politica-privacidade py-5">
        <div class="container">
            <h1 class="text-center mb-5 font-weight-bold">POLÍTICA DE PRIVACIDADE</h1>

            <h3 class="font-weight-bold">1 - INFORMAÇÕES GERAIS</h3>

            <div class="privacidade-text">
                <p>&emsp; A presente Política de Privacidade contém informações sobre coleta, uso, armazenamento, tratamento e proteção dos dados pessoais dos usuários e visitantes do site www.drytelecom.com.br, plataforma que sedia as atividades da DRY TELECOM, com o intuito de apresentar completa transparência sobre nossos serviços, bem como esclarecer quaisquer interessados sobre os tipos de dados coletados, as razões da coleta e o modo como os usuários podem gerenciar e/ou excluir suas informações pessoais.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; A presente Política de Privacidade, aplica-se a todos os usuários e visitantes do site www.drytelecom.com.br e integra os Termos e Condições Gerais de Uso do site www.drytelecom.com.br, representado por intermédio de sua controladora e operadora MVNO - DRY COMPANY DO BRASIL TECNOLOGIA S/A, pessoa jurídica responsável pelo tratamento dos dados e devidamente inscrita no CNPJ sob o nº 15.564.295/0001-04, situado em AV ANÁPOLIS, Nº 510 - VILA NILVA - BARUERI/SP - CEP 06404-25. O presente documento foi elaborado em plena conformidade com a Lei Geral de Proteção de Dados Pessoais - LGPD (Lei nº 13.709/18) e o Marco Civil da Internet (Lei nº 12.965/14).</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Ademais, o documento poderá sofrer atualizações decorrentes de eventuais alterações normais, razão pela qual convidamos o usuário a consultar esta seção periodicamente.</p>
            </div>
        </div>
    </section>

    <section id="LGPD" class="py-5">
        <div class="container">
            <h3 class="font-weight-bold pt-6">2 - TRATAMENTO DE DADOS</h3>

            <div class="privacidade-text">
                <p>&emsp; Os dados pessoais de usuário e visitantes serão coletados, classificados, utilizados, processados e arquivados como condição indispensável para a execução de contratos relativos à contratação dos produtos e serviços da MVNO, mediante a consentimento expresso manifestado no Termo de Adesão aos Serviços, disponível em: <a class="adesao font-weight-bold" href="./termos-de-adesao.php">Termos de Adesão</a>, e por intermédio das nossas Políticas de Privacidade.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; No âmbito do consentimento para tratamento de dados pessoais, estão incluídos:</p>
            </div>
            <ul class="ml-5">
                <li>Autenticação e autorização para acesso aos produtos e serviços;</li>
                <li>Autorização para contactuar o titular via telefone, e-mail, SMS, mala direta e outros meios de comunicação;</li>
                <li>Aprimoramento da experiência e uso dos produtos e serviços;</li>
                <li>Autorização para divulgação de produtos e serviços da MVNO e seus parceiros;</li>
                <li>Atualização sobre novas funcionalidades e demais informações relevantes;</li>
                <li>Preservação de direitos;</li>
                <li>Envio de informações sobre consumo, planos, promoções e cobranças.</li>
            </ul>

            <h3 class="font-weight-bold pt-6">2.1 - COMO REALIZAMOS A COLETA DE DADOS?</h3>

            <div class="privacidade-text">
                <p>&emsp; Os dados pessoais de usuários e visitantes são coletados por meio das seguintes ações:</p>
            </div>

            <strong class="d-block pt-5 pb-3">Ao criar uma conta/perfil na plataforma da MVNO:</strong>

            <div class="privacidade-text">
                <p>&emsp; Por meio desta ação são coletados básicos de identificação, como por exemplo: nome do usuário ou visitante, CPF, RG, data de nascimento, telefones, endereço e e-mail. A partir desses dados, podemos identificar o usuário e o visitante, além de garantir uma maior segurança e bem-estar às suas necessidades.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Ao acessar as páginas da plataforma da MVNO:</strong>

            <div class="privacidade-text">
                <p>&emsp; Por meio desta ação, as informações sobre interação e acesso são coletadas pela empresa para garantir melhor experiência ao usuário ou visitante. Tais dados podem tratar sobre palavras-chave utilizadas ao realizar busca, comentários, visualização de páginas, perfis, a URL de onde o usuário ou visitante provêm, o navegador utilizado e seus respectivos IPs de acesso, localização, recursos, ofertas contratadas ou pesquisadas, informações fornecidas enquanto utiliza os serviços, duração e frequência das atividades, entre outras informações que poderão ser armazenadas e retidas.</p>
            </div>

            <h3 class="font-weight-bold pt-6">2.2 - QUAIS DADOS COLETAMOS?</h3>

            <div class="privacidade-text">
                <p>&emsp; Os dados pessoais de usuários e visitantes coletados são os seguintes:</p>
            </div>

            <strong class="d-block pt-5 pb-3">Dados da criação de conta/perfil no site da MVNO:</strong>

            <div class="privacidade-text">
                <p>&emsp; Nome do usuário ou visitante, CPF, RG, data de nascimento, telefones, endereço e e-mail.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Dados para otimização da navegação:</strong>

            <div class="privacidade-text">
                <p>&emsp; Palavras-chave utilizadas ao realizar uma busca, comentários, visualizações de páginas, perfis, a URL de onde o usuário ou visitante provêm, o navegador utilizado e seus respectivos IPs de acesso, duração e frequência das atividades, localização, recursos, ofertas contratadas ou pesquisadas e informações fornecidas enquanto utiliza os serviços.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Dados para realização de transações financeiras:</strong>

            <div class="privacidade-text">
                <p>&emsp; Poderão ser coletados e armazenados dados necessários para concretizar a contratação dos serviços fornecidos por meio do site da MVNO, como número de cartão de crédito, bem como sua data de validade, código de verificação e demais informações relativas aos pagamentos efetuados.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Dados relacionados a contratos e demais formalizações:</strong>

            <div class="privacidade-text">
                <p>&emsp; Serão coletados e armazenados dados relativos às execuções contratuais, para cumprimento das formalizações requeridas no processo de contratação dos produtos e serviços oferecidos pela MVNO. De igual modo, eventuais comunicações realizadas entre a empresa supraticada e os usuários também ficarão à disposição de ambas as partes, para dirimir qualquer desacordo perante o que ficou estabelecido no ato de contratação de quaisquer serviços, e que se assegura por meio desse documento.</p>
            </div>

            <h3 class="font-weight-bold pt-6">2.3 - POR QUE REALIZAMOS A COLETA DE DADOS?</h3>

            <div class="privacidade-text">
                <p>&emsp; Os dados pessoais do usuário e/ou do visitante coletados e armazenados pela MVNO têm por finalidade:</p>
            </div>

            <strong class="d-block pt-5 pb-3">Bem-estar do usuário e/ou visitante:</strong>

            <div class="privacidade-text">
                <p>&emsp; Aprimorar os produtos e serviços oferecidos pela MVNO; facilitar, agilizar e cumprir os compromissos estabelecidos entre a MVNO e os usuários de seus produtos e serviços; melhorar a experiência de usuários e visitantes; fornecer funcionalidades específicas aos usuários dos produtos e serviços da MVNO.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Melhorias da plataforma:</strong>

            <div class="privacidade-text">
                <p>&emsp; Compreender as facilidades e limitações dos usuários e visitantes no contato com os produtos e serviços oferecidos pela MVNO, com o intuito de ajudar no desenvolvimento de negócios e de novas técnicas.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Comercial:</strong>

            <div class="privacidade-text">
                <p>&emsp; Os dados também serão utilizados para personalizar o conteúdo oferecido pela MVNO e gerar subsídio à plataforma, possibilitando a melhoria da qualidade no funcionamento do sistema, bem como de seus produtos e serviços.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Anúncios:</strong>

            <div class="privacidade-text">
                <p>&emsp; Apresentar anúncios personalizados aos usuários e visitantes, com base nos dados fornecidos.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Mapeamento do perfil do usuário e visitante:</strong>

            <div class="privacidade-text">
                <p>&emsp; Tratamento automatizado de dados pessoais para avaliar o comportamento e mapear os perfis dos usuários e visitantes.</p>
            </div>

            <strong class="d-block pt-5 pb-3">Dados de Contrato:</strong>

            <div class="privacidade-text">
                <p>&emsp; Conferir segurança jurídica às partes, com o intuito de facilitar as operações de aquisição dos produtos e serviços oferecidos pela MVNO.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; O tratamento de dados pessoais para finalidades não previstas nesta Política de Privacidade somente ocorrerá mediante comunicação prévia ao usuário, de modo que os direitos e obrigações aqui previstos permanecem aplicáveis.</p>
            </div>

            <h3 class="font-weight-bold pt-6">2.4 - POR QUANTO TEMPO OS DADOS FICAM ARMAZENADOS?</h3>

            <div class="privacidade-text">
                <p>&emsp; Por corresponder a um serviço de execução continuada, passível de reativação, para maior conveniência do titular, os dados pessoais do usuário e/ou visitante, assim como dados de faturamento e metadados, serão armazenados pela MVNO durante o período necessário para a prestação do serviço ou o cumprimento das finalidades previstas no presente documento, conforme o disposto no inciso I do artigo 15 da Lei 13.709/18.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Os dados poderão ser removidos ou anonimizados a pedido do usuário, excetuando os casos em que a lei oferecer outro tratamento.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Ainda, os dados pessoais dos usuários poderão ser conservados após o término de seu tratamento, apenas nas seguintes hipóteses previstas no artigo nº 16 da referida lei:</p>
            </div>
            <ul class="ml-5" style="list-style: upper-roman;">
                <li>cumprimento de obrigação legal ou regulatória pelo controlador;</li>
                <li>estudo por órgão de pesquisa, garantida, sempre que possível, a anonimização dos dados pessoais;</li>
                <li>transferência a terceiro, desde que respeitados os requisitos de tratamento de dados dispostos nesta Lei;</li>
                <li>uso exclusivo do controlador, vedado seu acesso por terceiro, e desde que anonimizados os dados.</li>
            </ul>

            <h3 class="font-weight-bold pt-6">2.5 - SEGURANÇA DOS DADOS PESSOAIS ARMAZENADOS</h3>

            <div class="privacidade-text">
                <p>&emsp; Todos os dados pessoais serão armazenados em local seguro e em servidores próprios. É assegurado ao titular, a qualquer momento:</p>
            </div>
            <ul class="ml-5">
                <li>Acesso aos seus dados pessoais;</li>
                <li>Correção de dados incompletos, inexatos ou desatualizados;</li>
                <li>Anonimização, bloqueio ou eliminação de dados desnecessários, excessivos ou tratados em desconformidade com a legislação aplicável;</li>
                <li>Portabilidade dos dados a outro fornecedor de serviço ou produto, mediante requisição expressa, de acordo com a regulamentação da autoridade nacional, observados os segredos comercial e industrial;</li>
                <li>Eliminação dos dados pessoais tratados com o consentimento do titular, com as ressalvas previstas na legislação aplicável;</li>
                <li>Informação das entidades públicas e privadas com as quais o controlador realizou uso compartilhado de dados;</li>
                <li>Revogação do consentimento.</li>
            </ul>
            <div class="privacidade-text">
                <p>&emsp; Todas as solicitações relativas a tais direitos deverão ser encaminhadas pelo titular diretamente ao controlador e serão atendidas em prazo compatível com a respectiva complexidade técnica, observados os limites impostos pela legislação aplicável.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Se você tiver uma conta neste site, poderá solicitar um arquivo exportado dos seus dados pessoais, inclusive quaisquer dados que nos tenha fornecido.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Também poderá solicitar que removamos qualquer dado pessoal armazenado sobre você em nosso sistema. Esta concessão não incluirá nenhum dado de manutenção obrigatória para propósitos administrativos, legais ou de segurança.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; As solicitações deverão ser realizadas na página de contato do site da MVNO: </p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; A MVNO se compromete a aplicar as medidas técnicas e organizativas aptas a proteger os dados pessoais de acessos não autorizados e de situações de destruição, perda, alteração, comunicação ou difusão de tais dados.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Dados relativos a cartões de crédito serão sempre criptografados, utilizando a tecnologia "secure socket layer" (SSL), que garante a transmissão de dados de forma segura e confidencial, de modo que a transmissão dos dados entre o servidor e o usuário ocorra de maneira cifrada e encriptada.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; A plataforma não se exime de responsabilidade por culpa exclusiva de terceiro, como em caso de ataque de hackers ou crackers, ou culpa exclusiva do usuário, como no caso em que ele mesmo transfere seus dados a terceiros. O site se compromete a comunicar o usuário em caso de alguma violação de segurança dos seus dados pessoais.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Os dados pessoais armazenados serão tratados com confidencialidade, dentro dos limites legais. No entanto, poderemos divulgar suas informações pessoais em caso de exigência legal ou em caso de violação de nossos Termos de Uso.</p>
            </div>

            <h3 class="font-weight-bold pt-6">2.6 - COMPARTILHAMENTO DOS DADOS</h3>

            <div class="privacidade-text">
                <p>&emsp; Os dados pessoais poderão ser compartilhados com:</p>
            </div>
            <ul class="ml-5">
                <li>Empresas no mesmo grupo econômico da MVNO;</li>
                <li>Terceiros parceiros de negócios, inclusive os localizados fora do País de residência do titular;</li>
                <li>Poder Público, nas hipóteses expressamente previstas na legislação aplicável;</li>
                <li>Instituições de Proteção ao Crédito, para fins de análise de risco de crédito e proteção de pessoas e empresas contra possíveis práticas fraudulentas.</li>
            </ul>
            <div class="privacidade-text mt-3">
                <p>&emsp; O compartilhamento de dados do usuário ocorrerá com os dados de usuários mediante autorização determinada a partir da publicação da presente Política de Privacidade.</p>
            </div>

            <h3 class="font-weight-bold pt-6">2.7 - OS DADOS PESSOAIS ARMAZENADOS SERÃO TRANSFERIDOS A TERCEIROS?</h3>

            <div class="privacidade-text mt-3">
                <p>&emsp; A MVNO e o controlador são responsáveis por sua própria base de dados e podem utilizar as informações dentro do limite e propósito de seu ramo de atuação, mas não respondem pelo tratamento de dados fornecidos a partir de outros meios, como aplicativos, sistemas operacionais, plataformas e publicidade oferecidos por terceiros, ainda que realizadas a partir da página da MVNO, sendo obrigação do titular consultar suas respectivas políticas de privacidade respectivas.</p>
            </div>
            <div class="privacidade-text mt-3">
                <p>&emsp; Assim, os dados pessoais coletados a partir da página da MVNO poderão ser compartilhados com as seguintes empresas:</p>
            </div>
            <div class="privacidade-text mt-3">
                <p>&emsp; GOOGLE ANALYTICS - Google Brasil Internet LTDA, inscrita sob o CNPJ nº 06.990.590/0001-23, para coletar informações de navegação do usuário. Sua política de cookies está disponível <a class="adesao" href="https://developers.google.com/analytics/devguides/collection/analyticsjs/cookie-usage?hl=pt-PT">aqui</a>.</p>
            </div>
        </div>
    </section>

    <section id="cookies" class="py-5">
        <div class="container">
            <h3 class="font-weight-bold pt-6">3 - COOKIES OU DADOS DE NAVEGAÇÃO</h3>

            <div class="privacidade-text">
                <p>&emsp; Informações relativas à navegação no site www.drytelecom.com , como local e horário de acesso, serão enviados pela plataforma ao dispositivo do usuário e/ou visitante - e nele ficarão armazenados - por meio de cookies.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; O usuário e/ou visitante do site www.drytelecom.com manifesta conhecer e aceitar a coleta de dados de navegação realizada mediante a utilização de cookies.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Os cookies persistentes permanecerão no disco rígido do usuário e/ou visitante mesmo após o encerramento do navegador e será usado pela própria plataforma de navegação em visitas subsequentes ao mesmo site. Os cookies persistentes também poderão ser removidos seguindo as instruções do seu navegador. Por sua vez, os cookies de sessão são temporários e desaparecem após o encerramento da navegação.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; É possível redefinir seu navegador da web para recusar todos os cookies, porém alguns recursos da plataforma poderão não funcionar corretamente caso a funcionalidade de aceitar cookies estiver desabilitada.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Ao acessar sua conta de usuário no site www.drytelecom.com , os seguintes cookies serão criados e/ou utilizar para melhorar e facilitar a experiência de navegação:</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; A MVNO se reserva ao direito de modificar a política de cookies a qualquer momento, informando ao titular por intermédio de banner no site a respeito das alterações e da necessidade de consentimento como condição para a preservação das funcionalidades e navegabilidade do site.</p>
            </div>

            <h3 class="font-weight-bold pt-6">4 - CONSENTIMENTO</h3>

            <div class="privacidade-text">
                <p>&emsp; Ao utilizar e/ou contratar os serviços oferecidos pela MVNO e fornecer suas informações pessoais na plataforma, o usuário e/ou visitante estará consentindo com os termos descritos na presente Política de Privacidade.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; O usuário, ao cadastrar-se, manifesta conhecê-lo e pode exercitar seus direitos de realizar o cancelamento, acessar e atualizar seus dados pessoais. Nos mesmos termos, o usuário e/ou visitante reconhece e aceita voluntariamente que o serviço será utilizado, em qualquer caso, sob sua única e exclusiva responsabilidade, assumindo o compromisso de fornecer informações cadastrais verdadeiras e atualizadas.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; O usuário, por fim, tem o pleno direito retirar o seu consentimento a qualquer tempo, para tanto deve entrar em contato através do e-mail contato@drytelecom.com.br ou por correio enviado ao seguinte endereço: AV ANÁPOLIS, N° 510 - VILA NILVA - BARUERI/SP - CEP 06404-250</p>
            </div>

            <h3 class="font-weight-bold pt-6">5 - ALTERAÇÕES</h3>

            <div class="privacidade-text">
                <p>&emsp; Com o intuito de respeitar, em absoluto, a transparência, a integridade das informações que aqui estão apresentadas e eventuais alterações - seja em decorrência de mudanças no site da MVNO, nos sites a ele associados, utilização de novas tecnologias, cumprimento da legislação aplicável ou sempre que a MVNO julgar necessário - reservamos o direito de modificar nossa Política de Privacidade a qualquer momento. Assim, recomendamos aos usuários e visitantes que busquem revisitar este documento regularmente, para acompanhar possíveis alterações em seu texto original.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Ademais, alterações e possíveis esclarecimentos surtirão efeito imediatamente após sua publicação no site da MVNO. Deste modo, todos os usuários serão notificados em caso de alteração. Ao utilizar nossos serviços ou fornecer informações pessoais em período posterior às eventuais modificações, os usuários e visitantes atestam concordar com as novas normas.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Diante da fusão ou venda da plataforma à outra empresa, os dados dos usuários poderão ser transferidos para os novos proprietários, garantindo que a permanência dos serviços oferecidos seja plenamente assegurada.</p>
            </div>

            <h3 class="font-weight-bold pt-6">6 - JURISDIÇÃO PARA RESOLUÇÃO DE CONFLITOS</h3>

            <div class="privacidade-text">
                <p>&emsp; Para resolução efetiva de eventuais desacordos ou controvérsias decorrentes da presente Política de Privacidade, será aplicado integralmente o Direito Brasileiro.</p>
            </div>
            <div class="privacidade-text">
                <p>&emsp; Eventuais litígios deverão ser apresentados no foro da comarca em que encontra-se sediada a empresa responsável por este instrumento.</p>
            </div>
        </div>
    </section>

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
        $('#staticBackdrop').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        $('#modalContato').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });
    </script>
</body>

</html>