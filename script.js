/*const form = document.getElementById('loginUsuario');
const nome = document.getElementById('txtNomeUsuario');
const email = document.getElementById('txtEmailUsuario');
const senha = document.getElementById('txtSenhaUsuario');
const formComentarios = document.getElementById('frmComentarios');
const comentario = document.getElementById('txtComentario');

function validarCampos(){
    const comentario = document.getElementById('txtComentario').value;

    if(!comentario){

    }
}*/

function nameFileUser() {
    var div = document.getElementsByClassName("desc-file-foto")[0];
    var div2 = document.getElementsByClassName("desc-file-foto")[1];
    var div3 = document.getElementsByClassName("desc-file-foto")[2];
    var div4 = document.getElementsByClassName("desc-file-foto")[3];
    var input = document.getElementById("fileFoto");
    var input2 = document.getElementById("fileFoto2");
    var input3 = document.getElementById("fileFoto3");
    var input4 = document.getElementById("fileFoto4");
    
    if((div !== null) & (input !== null)){
        div.addEventListener("click", function(){
            input.click();
        });

        div2.addEventListener('click', function(){
            input2.click();
        });

        div3.addEventListener('click', function(){
            input3.click();
        });

        div4.addEventListener('click', function(){
            input4.click();
        });

        input.addEventListener("change", function(){
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if(input.files.length > 0) nome = input.files[0].name;
            div.innerHTML = nome;
        });

        input2.addEventListener("change", function(){
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if(input.files.length > 0) nome = input2.files[0].name;
            div2.innerHTML = nome;
        });

        input3.addEventListener("change", function(){
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if(input.files.length > 0) nome = input3.files[0].name;
            div3.innerHTML = nome;
        });

        input4.addEventListener("change", function(){
            var nome = "Não há arquivo selecionado. Selecionar arquivo...";
            if(input.files.length > 0) nome = input4.files[0].name;
            div4.innerHTML = nome;
        });
    }
}

nameFileUser();