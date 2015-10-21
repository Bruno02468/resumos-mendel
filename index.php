<?php

include("funcs.php");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    $fa = file($a);
    $fb = file($b);
    return (substr_count($fa[2], ";") - 1) < (substr_count($fb[2], ";") - 1);
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

    $first = explode(":", trim($arquivo[0]), 2);
    $materia = htmlspecialchars(trim($first[0]));
    $assunto = htmlspecialchars(trim($first[1]));
    $autoria = htmlspecialchars(trim($arquivo[1]));


    if (!in_array($materia, $mats)) {
        array_push($mats, $materia);
        //$listar = "ou <a class=\"orange_link\" href=\"javascript:void(0)\" onclick=\"showMat('$materia')\">listar aqui</a>";
        $links .= "<br><big><big><a href=\"materia/$materia\">[$materia]</b></a></big></big><br>";
    }
    if ($curr <= $lim)  {
        $likes = substr_count($arquivo[2], ";") - 1;
        $s = $likes == 1 ? "" : "s";
        $final .= "<span><a target=\"_blank\" href=\"resumo/$bas\">$assunto</a>, por $autoria, com $likes like$s<br><br></span>";
    }
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
            <a class="ajude" target="_blank" href="ajude.php">Faça um resumo e ajude um amigo!</a><br>
            <br>
            <br>
            <span id="msg">Resumos com mais likes:</span><br>
            <br>
            <div id="resumos">
                <?php echo $final; ?>
            </div>
            <br>
            Resumos por matéria:<br>
            <?php echo $links; ?><br>
            <!--<a class="orange_link" href="javascript:void(0)" onclick="pormat.innerHTML = '';">Não listar nada</a>-->
            <br>
            <span id="pormat"></span>
        </center>
        <script src="index.js"></script>
    </body>
</html>