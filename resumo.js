var likespan = document.getElementById("likes");

function ajaxGet(url) {
    var request = new XMLHttpRequest();
    request.open("GET", url, false);
    request.send(null);
    return request.responseText;
}

function gostei() {
    likespan.innerHTML = ajaxGet("../gostei.php?f=" + filename);
}