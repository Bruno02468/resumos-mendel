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
$conteudo = formatar($resumo["conteudo"]);
$ano = $resumo["ano"];
$guid = $resumo["guid"];

?>

<html>
    <head>
        <title><?php echo $assunto; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php echo file_get_contents("outros/resumos.css"); ?>
        </style>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>

    <body>
        <?php include("outros/analytics.php"); ?>
        <center>
            <h1>Site dos Resumos</h1>
            <a href="..">Página inicial</a><br>
            <br>
            <a href="//licoes.com/licao">[Site de Lições]</a><br>
            <br>
            <?php echo "<a href=\"../materia/$materia-$ano\">Outros resumos de $materia</a><br>"; ?>
            <br>
            <small>
                Tudo programado por <a target="_blank" href="http://licoes.com/licao/contato.html">Bruno Borges Paschoalinoto</a> (2º F)<br>
                <br>
                <a href="../ademir/editar_resumo.php?guid=<?php echo $guid; ?>">[Editar resumo]</a><br>
            </small><br>
        </center>
        <br>
         <table style="font-size: 1.17em">
            <tr><td class="right">Resumo de: </td><td><b><?php echo $materia; ?></b></td></tr>
            <tr><td class="right">Assunto: </td><td><b><?php echo $assunto; ?></b></td></tr>
            <tr><td class="right">Escrito por: </td><td><b><?php echo $autoria; ?></b></tr>
        </table>
        <h3 style="font-weight: normal;">
            <small><a target="_blank" href="../imprimir/<?php echo $mini; ?>">Versão para imprimir</a></small><br>
            <br>
        </h3>
        <div class="conteudo"><?php echo $conteudo; ?></div>
        <br>
    </body>
</html>
