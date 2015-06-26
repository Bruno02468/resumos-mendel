<?php

date_default_timezone_set("America/Sao_Paulo");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    return filectime($a) < filectime($b);
});

$final = "";

foreach ($arquivos as $file) {
    if ('.' === $file) continue;
    if ('..' === $file) continue;
    $arquivo = file($file);
    
    $titulo = $arquivo[0];
    $autoria = $arquivo[1];
    $dadosarr = $arquivo;
    unset($dadosarr[0]);
    unset($dadosarr[1]);

    $final .= "<a href=\"resumo.php?f=$file\">$titulo, por $autoria</a><br>";
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
        Resumos disponíveis:<br>
        <br>
        <?php echo $final; ?>
        </center>
    </body>
</html>