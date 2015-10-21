var inp = document.getElementById("editor");
var out = document.getElementById("out");
var selection = [0, 0];
noSelection = true;
function updateSelection() {
    selection = [inp.selectionStart, inp.selectionEnd];
    noSelection = selection[0] == selection[1];
}

if (localStorage) {
    inp.value = localStorage["dados"] || "";
    preview();
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
    var tagreg = /\[((table|tr|td|sub|sup|b|i|u|s|code|hr|br)|(\/(table|tr|td|sub|sup|b|i|u|s|code|hr|br)))\]/gi;
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

function setText(text) {
    inp.value = text;
    preview();
}

function getText() {
    return inp.value;
}

function enclose(tag) {
    if (noSelection) return;
    var otag = "[" + tag + "]";
    var ctag = "[/" + tag + "]";
    setText(getText().insertAt(selection[0], otag).insertAt(selection[1] + otag.length, ctag));
}

function inserir(string) {
    if (!noSelection) return;
    setText(getText().insertAt(selection[0], string));
}

function limpar() {
    if (noSelection) return;
    var beginning = inp.value.substring(0, selection[0]);
    var acting = inp.value.substring(selection[0], selection[1]).replace(/\[(.*?)\]/gi, "");
    var ending = inp.value.substr(selection[1]);
    inp.value = beginning + acting + ending;
    preview();
}

function imagem() {
    var url = prompt("Insira a URL da imagem:");
    inserir("[imagem:" + url + "]");
}

function link() {
    var url = prompt("Insira a URL do link:");
    var txt = prompt("Insira o texto do link:");
    inserir("[" + url + "|" + txt + "]");
}

function tabela() {
    var rows = prompt("Número de linhas:");
    var cols = prompt("Número de colunas:");
    var table = "[table]\n";
    for (var line = 0; line < rows; line++) {
        table += "[tr]";
        for (var cell = 0; cell < cols; cell++)
            table += "[td]Linha " + (line+1) + ", coluna " + (cell+1) + "[/td]";
        table += "[/tr]\n";
    }
    table += "[/table]";
    inserir(table);
}

var but = document.getElementById("colorButton");
var prev = document.getElementById("prev");
function updateColors() {
    var r = document.getElementById("r").value;
    var g = document.getElementById("g").value;
    var b = document.getElementById("b").value;

    prev.style.backgroundColor = (but.style.color = "rgb(" + r + ", " + g + ", " + b + ")");
}
updateColors();

function cor() {
    var tag = "[cor:" + but.style.color + "]";
    setText(getText().insertAt(selection[0], tag).insertAt(selection[1] + tag.length, "[/cor]"));
}
