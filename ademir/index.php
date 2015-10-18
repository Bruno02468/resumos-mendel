<?php

include("../funcs.php");

$pasta = "../dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    $fa = file($a);
    $fb = file($b);
    return trim($fa[2]) < trim($fb[2]);
});

$edits = "";

foreach ($arquivos as $file) {
    $bas = basename($file);
    if ('.' === $bas) continue;
    if ('..' === $bas) continue;
    $arquivo = file($file);

    $titulo = htmlspecialchars(trim($arquivo[0]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    $edits .= "<a target='_blank' href=\"edita.php?f=$bas\">\"<b><i>$titulo</i></b>\", por $autoria.</a><br><br>";
}

if ($edits == "")
    $edits = "Nenhum resumo disponível agora...";

?>

<html>
    <head>
        <title>Painel Administrativo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../resumo.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <?php include("../analytics.php"); ?>
        <center>
        <h1>Site dos Resumos - Painel Administrativo</h1>
        <br>
        <big>
            <a href="..">[Página inicial]</a><br><br>
            <a href="cria.html">[Criar um resumo]</a><br><br>
            <a target="_blank" href="estilo.html">[Manual de Estilo]</a><br>
            <a target="../visual" href="estilo.html">[Editor Visual]</a> (em testes)<br>
        </big>
        <br>
        <br>
        Editar um resumo:<br>
        <br>
        <?php echo $edits; ?>
        </center>
    </body>
</html>