<?php

date_default_timezone_set("America/Sao_Paulo");

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

    $edits .= "<a target='_blank' href=\"edita.php?f=$bas\">\"<i>$titulo</i>\", por $autoria</a>&nbsp&nbsp&nbsp<a href=\"atuadores/deleta.php?f=$bas\">[Deletar]</a><br><br>";
}

if ($edits == "")
    $edits = "Nenhum resumo disponível agora...";

?>

<html>
    <head>
        <title>Painel Administrativo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/stylesheets/dark.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
        <h1>Site dos Resumos - Painel Administrativo</h1>
        <br>
        <big>
            <a href="..">[Página inicial]</a><br><br>
            <a href="cria.html">[Criar um resumo]</a><br><br>
            <a target="_blank" href="estilo.html">[Manual de Estilo]</a><br>
        </big>
        <br>
        <br>
        Editar um resumo:<br>
        <br>
        <?php echo $edits; ?>
        </center>
    </body>
</html>