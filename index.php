<?php

date_default_timezone_set("America/Sao_Paulo");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    return filectime($a) < filectime($b);
});

$final = "";

foreach ($arquivos as $file) {
    $bas = basename($file);
    if ('.' === $bas) continue;
    if ('..' === $bas) continue;
    $arquivo = file($file);
    
    $titulo = htmlspecialchars(trim($arquivo[0]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    $final .= "<a target='_blank' href=\"resumo.php?f=$bas\">\"<i>$titulo</i>\", por $autoria</a><br><br>";
}

if ($final == "")
    $final = "Nenhum resumo disponível agora...";

?>

<html>
    <head>
        <title>Resumos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/stylesheets/dark.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>
    
    <body>
        <center>
        <h1>Site dos Resumos</h1>
        <small>
            Tudo programado por <a target="_blank" href="/licao/contato.html">Bruno Borges Paschoalinoto</a> (1ª E)<br>
            <a href="ademir/">[Somente pessoal autorizado]</a>
        </small><br>
        <br>
        <br>
        Resumos disponíveis:<br>
        <br>
        <br>
        <?php echo $final; ?>
        </center>
    </body>
</html>