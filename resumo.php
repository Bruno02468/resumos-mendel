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
        <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            tex2jax: {inlineMath: [["[tex]", "[/tex]"], ["\\(","\\)"]]}
        });
        </script>
        <script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML"></script>
    </head>

    <body>
        <?php include("outros/analytics.php"); ?>
        <center>
            <h1>Resumo de <?php echo $materia; ?></h1>
            <a class="buttonlink btnorange" href="..">Página inicial</a><br>
            <br>
            <?php echo "<a class=\"buttonlink btnorange\" href=\"../ano/$ano\">Outras matérias do ${ano}º</a>"; ?><br>
            <br>
            <?php echo "<a class=\"buttonlink btnorange\" href=\"../materia/$materia-$ano\">Outros resumos de $materia</a>"; ?><br>
            <br>
            <small>
                <a class="buttonlink btnblue smallbtn" href="../ademir/editar_resumo.php?guid=<?php echo $guid; ?>">Editar este resumo</a><br>
                <br>
                Tudo programado por <a target="_blank" href="http://licoes.com/licao/contato.html">Bruno Borges Paschoalinoto</a> (2º F)<br>
            </small><br>
        <br>
            <big><big>
            <b><?php echo $assunto; ?><br>
            <small><small><small><small><small><small><br></small></small></small></small></small></small>
            </b>Escrito por <b><?php echo $autoria; ?></b></big></big>

        </center>
        <h3 style="font-weight: normal;" align="center">
            <small>&nbsp;&nbsp;&nbsp;&nbsp;<a class="buttonlink smallbtn" target="_blank" href="../imprimir/<?php echo $mini; ?>">Versão para imprimir</a></small><br>
            <br>
        </h3>
        <center><div class="conteudo"><?php echo $conteudo; ?></div></center>
        <br>
    </body>
</html>
