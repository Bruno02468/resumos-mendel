<?php

include("outros/banco.php");

$ano = "";
if (isset($_GET["ano"])) {
    $ano = $_GET["ano"];
} else {
    redir("..");
}
if (!anoExists($ano)) {
    redir("..");
}

$resumos = getFullJSON();
$total = 0;
$materias = array();
foreach ($resumos as $index => $resumo) {
    if ($resumo["ano"] !== $ano) continue;
    $total++;
    $materia = $resumo["materia"];
    if (!isset($materias[$materia])) {
        $materias[$materia] = 0;
    }
    $materias[$materia]++;
}

$final = "";
foreach($materias as $materia => $quantos) {
    $final .= "<a href=\"../materia/$materia-$ano\">$materia</a><br><br>";
}

?>

<html>
    <head>
        <title>Resumos do <?php echo $ano; ?>º</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>

    <body>
        <?php include("outros/analytics.php"); ?>
        <center>
            <h1>Resumos do <?php echo $ano; ?>º Ano</h1>
            <small>
                Tudo programado por <a target="_blank" href="http://licoes.com/licao/contato.html">Bruno Borges Paschoalinoto</a> (2º F)<br>
                <br>
                <a href="../ademir/">[Somente pessoal autorizado]</a>
            </small>
            <br>
            <br>
            <div class="big">
                <a href="..">[Outros anos]</a><br>
                <br>
                <?php echo "Contamos com $total resumos para o ${ano}º ano:"; ?><br>
                <br>
                <?php echo $final ?>
                <br>
            </div>
        </center>
    </body>
</html>
