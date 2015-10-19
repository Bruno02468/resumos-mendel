<?php

include("funcs.php");
$mat= "";
if (isset($_GET["mat"]))
    $mat = $_GET["mat"];
else
    redir("..");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    $fa = file($a);
    $fb = file($b);
    return trim($fa[2]) < trim($fb[2]);
});

$links = "";
foreach ($arquivos as $file) {
    $bas = basename($file);
    if ("." === $bas) continue;
    if (".." === $bas) continue;
    $arquivo = file($file);

    $first = explode(":", trim($arquivo[0]), 2);
    $materia = htmlspecialchars(trim($first[0]));
    if ($materia != $mat) continue;

    $assunto = htmlspecialchars(trim($first[1]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    $links .= "<a target=\"_blank\" href=\"../resumo/$bas\">Resumo sobre \"<b><i>$assunto</i></b>\", por $autoria</a><br><br>";
}

?>
<html>
    <head>
        <title>Resumos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../resumo.css">
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../favicon.ico" type="image/x-icon">
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
            <a href="..">[Voltar à página inicial]</a><br>
            <br>
            <br>
            <span id="msg">Resumos de <?php echo $mat; ?>:</span><br>
            <br>
            <?php echo $links; ?>
        </center>
    </body>
</html>
