var inp = document.getElementById("editor");
var out = document.getElementById("out");
var selection = [0, 0];

if (localStorage) {
    inp.value = localStorage["dados"] || "";
}

function preview() {
    var texto = inp.value;
    var linkreg = /\[([^\]]+)\|([^\]]+)\]/gi;
    var linkrep = "<a target=\"_blank\" href=\"$1\">$2</a>";
    var nbspreg = /^ +/gi;
    var nbsprep = "&nbsp;";
    var imgreg = /\[imagem:([^\]]+)\]/gi;
    var imgrep = "<a target=\"_blank\" title=\"Clique para ver o tamanho completo.\" href=\"$1\"><img src=\"$1\"></a>";
    var h4reg = /\[big\]/gi;
    var h4rep = "<div class=\"big\">";
    var hcreg = /\[\/big\]/gi;
    var hcrep = "</div>";
    var colorreg = /\[cor:([^\]]+)\]/gi;
    var colorrep = "<span style=\"color: $1;\">";
    var endcolorreg = /\[\/cor\]/gi;
    var endcolorrep = "</span>";
    var fourreg = /    /gi;
    var fourrep = "&nbsp;&nbsp;&nbsp;&nbsp;";
    var tagreg = /\[((table|tr|td|sub|sup|b|i|u|s|code)|(\/(table|tr|td|sub|sup|b|i|u|s|codetags)))\]/gi;
    var tagrep = "<$1>";
    var tablereg = /<table>/gi;
    var tablerep = "<table class=\"restable\">";

    texto = texto.replace(fourreg, fourrep)
        .replace(linkreg, linkrep)
        .replace(nbspreg, nbsprep)
        .replace(imgreg, imgrep)
        .replace(h4reg, h4rep)
        .replace(hcreg, hcrep)
        .replace(colorreg, colorrep)
        .replace(endcolorreg, endcolorrep)
        .replace(tagreg, tagrep)
        .replace(tablereg, tablerep)
        .replace(/\{l\}/, "ℓ");

    localStorage["dados"] = inp.value;
    out.innerHTML = texto;
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
