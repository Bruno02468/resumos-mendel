<?php

include("../outros/banco.php");

require_login();

$guid = req_get("guid");

$resumos = getFullJSON();
$resumo = null;
foreach ($resumos as $found) {
    if ($found["guid"] == $guid) {
        $resumo = $found;
        break;
    }
}
if (is_null($resumo)) redir("..");

$materia = $resumo["materia"];
$autoria = $resumo["autor"];
$mini= $resumo["mini"];
$assunto = $resumo["assunto"];
$conteudo = $resumo["conteudo"];
$ano = $resumo["ano"];

?>

<html>
    <head>
        <title>Editando resumo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
        <h1>Editando resumo</h1>
        <a class="buttonlink btnred" href="atuadores/deleta.php?guid=<?php echo $guid; ?>">Deletar este resumo</a><br>
        <br>
        <form action="atuadores/edita.php" method="POST" class="resform">
            <input type="hidden" value="<?php echo $guid; ?>" name="guid">
            <table align="center">
                <tr><td>Ano (pra quê mudar?): </td><td><input type="number" min="1" max="3" value="<?php echo $ano; ?>" name="ano"></tr>
                <tr><td>Matéria: </td><td><input type="text" value="<?php echo $materia; ?>" name="materia"></tr>
                <tr><td>Assunto/tópico: </td><td><input type="text" value="<?php echo $assunto; ?>" name="assunto"></tr>
                <tr><td>Autoria (quem ESCREVEU): </td><td><input type="text" value="<?php echo $autoria; ?>" name="autoria"></tr>
                <tr><td>Endereço: </td><td><small>http://licoes.com/resumos/resumo/</small>&nbsp;<input type="text" value="<?php echo $mini; ?>" name="mini"></tr>
                <tr><td>Código do texto: </td><td><textarea rows="50" cols="75" name="dados"><?php echo $conteudo; ?></textarea></tr>
            </table>
            <input type="submit" value="Salvar resumo!">
        </form>
    </body>
</html>