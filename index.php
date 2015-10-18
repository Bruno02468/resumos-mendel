<?php

include("funcs.php");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    $fa = file($a);
    $fb = file($b);
    return trim($fa[2]) < trim($fb[2]);
});

$mats = array();
$links = "";
$final = "";
$lim = 5;
$curr = 1;
foreach ($arquivos as $file) {
    $bas = basename($file);
    if ("." === $bas) continue;
    if (".." === $bas) continue;
    $arquivo = file($file);

    $titulo = htmlspecialchars(trim($arquivo[0]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    $materia = explode(":", $titulo)[0];
    if (!in_array($materia, $mats)) {
        array_push($mats, $materia);
        $links .= "<br><button onclick=\"showMat('$materia')\">Mostrar resumos de $materia</button>";
    }
    if ($curr <= $lim)
        $final .= "<span><a target=\"_blank\" href=\"resumo/$bas\">\"<b><i>$titulo</i></b>\", por $autoria</a><br><br></span>";
    $curr++;
}

if ($final == "")
    $final = "Nenhum resumo disponível agora...";

?>

<html>
    <head>
        <title>Resumos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="resumo.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <?php include("analytics.php"); ?>
        <center>
            <h1>Site dos Resumos</h1>
            <small>
                Tudo programado por <a target="_blank" href="/licao/contato.html">Bruno Borges Paschoalinoto</a> (1º E)<br>
                <small><a href="ademir/">[Somente pessoal autorizado]</a></small>
            </small>
            <br>
            <br>
            <br>
            <a class="ajude" target="_blank" href="ajude.html">Faça um resumo e ajude um amigo!</a><br>
            <br>
            <br>
            <span id="msg">Resumos mais populares:</span><br>
            <br>
            <div id="resumos">
                <?php echo $final; ?>
            </div>
            <br>
            Mostrar resumos de uma certa matéria:<br>
            <?php echo $links; ?><br>
            <button onclick="pormat.innerHTML = '';"><b>Não mostrar resumos de nada</b></button>
            <br>
            <span id="pormat"></span>
        </center>
        <script src="index.js"></script>
    </body>
</html>