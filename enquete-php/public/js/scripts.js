var formfield = document.getElementById("formfield");

function add() {
    var novoCampo = document.createElement("input");
    var ul = formfield.querySelector(".wrapper");

    var newLi = document.createElement("li");
    newLi.className = "form-row";
    novoCampo.setAttribute("type", "text");
    novoCampo.setAttribute("name", "resposta");
    novoCampo.setAttribute("placeholder", "resposta");

    newLi.appendChild(novoCampo);
    ul.appendChild(newLi);
}

function remover() {
    var ul = formfield.querySelector(".wrapper");
    var liElements = ul.getElementsByTagName("li");

    if (liElements.length > 6) {
        var lastLi = liElements[liElements.length - 1];
        var inputElements = lastLi.getElementsByTagName("input");
        if (inputElements.length > 0) {
            lastLi.removeChild(inputElements[inputElements.length - 1]);
            if (lastLi.children.length === 0) {
                ul.removeChild(lastLi);
            }
        }
    }
}
