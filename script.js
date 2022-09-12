function nameFileUser() {
    var div = document.getElementsByClassName("desc-file-foto")[0];
    var div2 = document.getElementsByClassName("desc-file-foto")[1];
    var div3 = document.getElementsByClassName("desc-file-foto")[2];
    var div4 = document.getElementsByClassName("desc-file-foto")[3];
    var input = document.getElementById("fileFoto");
    var input2 = document.getElementById("fileFoto2");
    var input3 = document.getElementById("fileFoto3");
    var input4 = document.getElementById("fileFoto4");

    if ((div !== null) & (input !== null)) {
        div.addEventListener("click", function () {
            input.click();
        });

        div2.addEventListener('click', function () {
            input2.click();
        });

        div3.addEventListener('click', function () {
            input3.click();
        });

        div4.addEventListener('click', function () {
            input4.click();
        });

        input.addEventListener("change", function () {
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if (input.files.length > 0) nome = input.files[0].name;
            div.innerHTML = nome;
        });

        input2.addEventListener("change", function () {
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if (input.files.length > 0) nome = input2.files[0].name;
            div2.innerHTML = nome;
        });

        input3.addEventListener("change", function () {
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if (input.files.length > 0) nome = input3.files[0].name;
            div3.innerHTML = nome;
        });

        input4.addEventListener("change", function () {
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if (input.files.length > 0) nome = input4.files[0].name;
            div4.innerHTML = nome;
        });
    }
}

nameFileUser();

function openModal() {
    const backgroundModal = document.querySelector(".bg-modal");
    const iconNav = document.querySelector("#navbar-mobile");

    iconNav.addEventListener("click", function () {
        backgroundModal.classList.toggle("view-modal");
        document.body.classList.toggle("fixed-body");
    })

    backgroundModal.addEventListener("click", function () {
        backgroundModal.classList.toggle("view-modal");
        document.body.classList.toggle("fixed-body");
    })
}

openModal();

function copyToClipBoard() {
    const url = window.location.href;
    const content = document.getElementById("textArea");
    console.log(content);
    content.innerHTML = url;
    content.select();
    document.execCommand("copy");
}

function copyToClipBoard2() {
    const content = document.getElementById("textArea2");
    console.log(content);
    content.select();
    document.execCommand("copy");
}

//copyToClipBoard2()

const nomeCadastro = document.getElementById("txtNomeCadastro");
const emailCadastro = document.getElementById("txtEmailCadastro");
const telefoneCadastro = document.getElementById("txtTelefoneCadastro");

console.log(nomeCadastro);

function validarEntrada(caracter, typeBlock) {
    var tipo = typeBlock;

    if (window.event) {
        var asc = caracter.charCode;
    } else {
        var asc = caracter.which;
    }

    if (tipo == "caracter") {
        if (asc >= 33 && asc <= 64) {
            return false;
        }
    } else if (tipo == "number") {
        if (asc < 48 || asc > 57) {
            return false;
        }
    }
}

function limitarCaracteres() {
    nomeCadastro.maxLength = 100;
    emailCadastro.maxLength = 50;
    telefoneCadastro.maxLength = 11;
}

limitarCaracteres();