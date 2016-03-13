<?php

include("outros/banco.php");

$mini = "";
if (isset($_GET["mini"])) {
    $mini = $_GET["mini"];
} else {
    redir("..");
}

$resumos = getFullJSON();
$resumo = null;
foreach ($resumos as $found) {
    if ($found["mini"] == $mini) {
        $resumo = $found;
        break;
    }
}
if (is_null($resumo)) redir("..");

$materia = $resumo["materia"];
$autoria = $resumo["autor"];
$assunto = $resumo["assunto"];
$conteudo = substituir_global("/color\:/", "c_o_l_o_r:", formatar($resumo["conteudo"]));
$ano = $resumo["ano"];
$guid = $resumo["guid"];

?>

<html>
    <head>
        <title>Imprimir Resumo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php echo file_get_contents("outros/resumos.css"); ?>
            body {
                background-color: white;
            }
            .conteudo, .conteudo *, h1, * {
                color: black; !important
            }
        </style>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>

    <body>
        <?php include("outros/analytics.php"); ?>
        <center>
            <h1><?php echo "$materia: $assunto"; ?></h1>
        </center>
        <br>
        <div class="conteudo"><?php echo $conteudo; ?></div>
        <br>
    </body>
</html>
