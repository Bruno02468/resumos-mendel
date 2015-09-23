var resumos = document.getElementById("resumos").childNodes;
function pesquisar(str) {
    var exp = new RegExp(str, "gi");
    console.log(exp);
    for (var i in resumos) {
        var elem = resumos[i];
        if (elem.tagName == "SPAN") {
            var titulo = elem.childNodes[0].innerHTML;
            console.log(titulo);
            console.log(exp.test(titulo));
            if (str == "" || exp.test(titulo))
                elem.style.display = "block";
            else
                elem.style.display = "none";
        }
    }
}
