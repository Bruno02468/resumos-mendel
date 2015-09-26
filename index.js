function ajaxGet(url) {
    var request = new XMLHttpRequest();
    request.open("GET", url, false);
    request.send(null);
    return request.responseText;
}

var pormat = document.getElementById("pormat");
function showMat(materia) {
    var links = ajaxGet("pormateria.php?mat=" + encodeURIComponent(materia));
    pormat.innerHTML = links;
}
