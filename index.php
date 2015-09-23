<?php

date_default_timezone_set("America/Sao_Paulo");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    $fa = file($a);
    $fb = file($b);
    return trim($fa[2]) < trim($fb[2]);
});

$final = "";

foreach ($arquivos as $file) {
    $bas = basename($file);
    if ('.' === $bas) continue;
    if ('..' === $bas) continue;
    $arquivo = file($file);

    $titulo = htmlspecialchars(trim($arquivo[0]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    $final .= "<span><a target='_blank' href=\"resumo/$bas\">\"<i>$titulo</i>\", por $autoria</a><br><br></span>";
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
            <a href="ademir/">[Somente pessoal autorizado]</a>
        </small><br>
        <br>
        <br>
        <!--Pesquisar: <input type="text" id="pesq" oninput="pesquisar(this.value)" style="width: 20%"><br>
        <br>-->
        <span id="msg">Todos os resumos:</span><br>
        <br>
        <div id="resumos">
            <?php echo $final; ?>
        </div>
        </center>
        <script src="index.js"></script>
    </body>
</html>