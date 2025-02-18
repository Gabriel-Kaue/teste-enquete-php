var formfield = document.getElementById("formfield");

function add() {
    var novoCampo = document.createElement("input");
    novoCampo.setAttribute("type", "text");
    novoCampo.setAttribute("name", "resposta");
    novoCampo.setAttribute("placeholder", "resposta");
    formfield.appendChild(novoCampo);
}

function remover() {
    var inputT = formfield.getElementsByTagName("input");
    if (inputT.length > 6) {
        formfield.removeChild(inputT[inputT.length - 1]);
    }
}
