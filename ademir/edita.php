<?php

function req($str) {
    if (!isset($_GET[$str])) {
        die("Variável GET \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_GET[$str];
    }
}

$pasta = "../dados/";
$file = req("f");
$arquivo = file($pasta . $file);

if (!$arquivo)
    die("Arquivo não encontrado. Esse link deve estar quebrado. Volte ao <a href='/resumos/ademir'>painel administrativo</a>.");

$titulo = htmlspecialchars(trim($arquivo[0]));
$autoria = htmlspecialchars(trim($arquivo[1]));
$likes = trim($arquivo[2]);
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
        <h1>Site dos Resumos - Editando resumo "<?php echo $titulo; ?>"</h1>
        <br>
        <form action="atuadores/cria.php" method="POST">
            <input type="hidden" value="<?php echo $file; ?>" name="filename">
            <input type="hidden" value="<?php echo $likes; ?>" name="likes">
            <table align="center">
                <tr><td>Título: </td><td><input type="text" value="<?php echo $titulo; ?>" name="titulo"></tr>
                <tr><td>Autoria: </td><td><input type="text" value="<?php echo $autoria; ?>" name="autoria"></tr>
                <tr><td>Corpo do texto: </td><td><textarea rows="50" cols="75" name="dados"><?php echo $conteudo; ?></textarea></tr>
            </table>
            <input type="submit" value="Salvar resumo!">
        </form>
    </body>
</html>