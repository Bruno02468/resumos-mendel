<?php

include("../funcs.php");

$pasta = "../dados/";
$file = req_get("f");
$arquivo = file($pasta . $file);

if (!$arquivo)
    die("Arquivo não encontrado. Esse link deve estar quebrado. Volte ao <a href='/resumos/ademir'>painel administrativo</a>.");

$first = explode(":", trim($arquivo[0]), 2);
$materia = htmlspecialchars(trim($first[0]));
$assunto = htmlspecialchars(trim($first[1]));
$autoria = htmlspecialchars(trim($arquivo[1]));
$dadosarr = $arquivo;
unset($dadosarr[0]);
unset($dadosarr[1]);
unset($dadosarr[2]);
$conteudo = htmlspecialchars(implode("", $dadosarr));

?>

<html>
    <head>
        <title>Editando resumo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/stylesheets/dark.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
        <h1>Site dos Resumos - Editando resumo "<?php echo trim($arquivo[0]); ?>"</h1>
        <br>
        <form action="atuadores/edita.php" method="POST">
            <input type="hidden" value="<?php echo $file; ?>" name="filename">
            <table align="center">
                <tr><td>Matéria: </td><td><input type="text" value="<?php echo $materia; ?>" name="materia"></tr>
                <tr><td>Assunto: </td><td><input type="text" value="<?php echo $assunto; ?>" name="assunto"></tr>
                <tr><td>Autoria: </td><td><input type="text" value="<?php echo $autoria; ?>" name="autoria"></tr>
                <tr><td>Corpo do texto: </td><td><textarea rows="50" cols="75" name="dados"><?php echo $conteudo; ?></textarea></tr>
            </table>
            <input type="submit" value="Salvar resumo!">
        </form>
    </body>
</html>