var inp = document.getElementById("editor");
var out = document.getElementById("out");
var req;
var selection = [0, 0];

function output() {
    if (req.readyState == 4)
        if (req.status == 200)
            out.innerHTML = req.responseText;
}

function preview() {
    var fd = new FormData();
    fd.append("dados", inp.value);
    req = new XMLHttpRequest();
    req.open("POST", "preview.php");
    req.onreadystatechange = output;
    req.send(fd);
}

String.prototype.insertAt = function(index, string) {
    return this.substr(0, index) + string + this.substr(index);
}

function enclose(tag) {
    if (selection[0] == selection[1]) return;
    var otag = "[" + tag + "]";
    var ctag = "[/" + tag + "]";
    inp.value = inp.value.insertAt(selection[0], otag).insertAt(selection[1] + otag.length, ctag);
    preview();
}

function limpar() {
    if (selection[0] == selection[1]) return;
    var beginning = inp.value.substring(0, selection[0]);
    var acting = inp.value.substring(selection[0], selection[1]).replace(/\[(.*?)\]/gi, "");
    var ending = inp.value.substr(selection[1]);
    inp.value = beginning + acting + ending;
    preview();
}

function imagem() {
    var url = prompt("Insira a URL da imagem:");
    inp.value = inp.value.insertAt(selection[0], "[imagem:" + url + "]");
    preview();
}

function link() {
    var url = prompt("Insira a URL do link:");
    var txt = prompt("Insira o texto do link:");
    inp.value = inp.value.insertAt(selection[0], "[" + url + "|" + txt + "]");
    preview();
}
