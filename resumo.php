<?php

include("funcs.php");

$pasta = "dados/";

$file = trim(req_get("f"));

if ($file == "" || !file_exists($pasta . $file))
    redir("./");

$arquivo = file($pasta . $file);

$first = explode(":", trim($arquivo[0]), 2);
$materia = $first[0];
$assunto = $first[1];
$autoria = formatar(trim($arquivo[1]));
$likes = substr_count($arquivo[2], ";") - 1;
unset($arquivo[0]);
unset($arquivo[1]);
unset($arquivo[2]);

$conteudo = formatar(implode("", $arquivo));

?>

<html>
    <head>
        <title><?php echo $assunto; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php echo file_get_contents("resumo.css"); ?>
        </style>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>

    <body>
        <?php include("analytics.php"); ?>
        <center>
            <h1>Site dos Resumos</h1>
            <a href="..">[Voltar à página inicial]</a><br>
            <small>
                <a href="../ademir/edita.php?f=<?php echo $file; ?>">[Editar resumo]</a><br>
                Tudo programado por <a target="_blank" href="http://licoes.com/licao/contato.html">Bruno Borges Paschoalinoto</a> (1º E)<br>
            </small><br>
        </center>
        <br>
         <table style="font-size: 1.17em">
            <tr><td class="right">Resumo de: </td><td><b><?php echo $materia; ?></b></td></tr>
            <tr><td class="right">Assunto: </td><td><b><?php echo $assunto; ?></b></td></tr>
            <tr><td class="right">Escrito por: </td><td><b><?php echo $autoria; ?></b></tr>
        </table>
        <h3 style="font-weight: normal;">
            <small><a target="_blank" href="../imprimir.php?f=<?php echo $file; ?>">Versão para imprimir</a></small><br>
            <br>
            <a href="javascript:void(0);" onclick="gostei();">Gostei desse resumo!</a> [<span id="likes"><?php echo $likes; ?></span>]<br>
        </h3>
        <br>
        <div class="conteudo"><?php echo $conteudo; ?></div>
        <br>
        <br>
        <br>
        <footer>
            <small>Tudo programado por Bruno Borges Paschoalinoto (1º E).<br>
            O conteúdo aqui foi criado por um monte de pessoas. :D</small>
        </footer>
        <script>
            filename = "<?php echo $file; ?>";
            <?php echo file_get_contents("resumo.js"); ?>
        </script>
    </body>
</html>
