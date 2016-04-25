<?php

include("outros/banco.php");

$mat = "";
$ano = "";
if (isset($_GET["mat"]) && isset($_GET["ano"])) {
    $mat = $_GET["mat"];
    $ano = $_GET["ano"];
} else {
    redir("..");
}

$resumos = getFullJSON();
$final = "";
foreach ($resumos as $resumo) {
    if ($resumo["materia"] !== $mat || $resumo["ano"] !== $ano) continue;
    $assunto = $resumo["assunto"];
    $mini = $resumo["mini"];
    $final .= "<a class=\"buttonlink bigbtn\" href=\"../resumo/$mini\">$assunto</a><br><br>";
}

if ($final == "") {
    redir("..");
}


?>
<html>
    <head>
        <title>Resumos de <?php echo $mat; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>

    <body>
        <?php include("outros/analytics.php"); ?>
        <center>
            <h1>Site dos Resumos</h1>
            <small>
                Tudo programado por <a target="_blank" href="http://licoes.com/licao/contato.html">Bruno Borges Paschoalinoto</a> (2º F)<br>
                <br>
                <br>
                <a class="buttonlink btnblue smallbtn" href="../ademir/">Área dos autores de resumos</a>
            </small>
            <br>
            <br>
            <br>
            <div class="big">
                <?php echo "<a class=\"buttonlink btnorange bigbtn\" href=\"../ano/$ano\">Outras matérias do ${ano}º</a>"; ?><br>
                <br>
                <span id="msg">Resumos de <?php echo $mat; ?>:</span><br>
                <br>
                <?php echo $final; ?>
        </div>
        </center>
    </body>
</html>
