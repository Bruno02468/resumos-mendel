<?php

include("outros/banco.php");

$resumos = getFullJSON();
$total = count($resumos);
$anos = array();
foreach ($resumos as $resumo) {
    $ano = $resumo["ano"];
    if (!isset($anos[$ano])) {
        $anos[$ano] = 0;
    }
    $anos[$ano]++;
}

$final = "";
foreach ($anos as $ano => $quantos) {
    $final .= "<a href=\"ano/$ano\" class=\"buttonlink bigbtn\">Resumos do ${ano}º ano ($quantos)</a><br><br>";
}

if ($final == "")
    $final = "Nenhum resumo disponível agora...";

?>

<html>
    <head>
        <title>Site dos Resumos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="outros/resumos.css">
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
                <a href="outros/LRS.txt" target="_blank">Direitos autorais se aplicam a 100% deste site.</a><br>
                <br>
                <br>
                <a class="buttonlink btnblue smallbtn" href="ademir/">Área dos autores de resumos</a><br>
                <br><small><a class="buttonlink btnblue smallbtn" href="superademir/">Superadministração</a></small>
            </small>
            <br>
            <br>
            <br>
            <a class="ajude" target="_blank" href="ajude.php">Faça um resumo e ajude um amigo!</a><br>
            <br>
            <br>
            <div class="big">
                <a class="buttonlink btnorange bigbtn" href="//licoes.com/licao">Lições</a><br>
                <br>
                <?php echo "Temos <u>$total</u> resumos e contando!"; ?><br>
                <br>
                Resumos por ano:<br>
                <br>
                <?php echo $final ?>
                <br>
            </div>
        </center>
    </body>
</html>
