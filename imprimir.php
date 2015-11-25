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
        <title>Imprimir Resumo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php echo file_get_contents("resumo.css"); ?>
            body {
                background-color: white;
            }
            .conteudo, .conteudo *, h1 {
                color: black; !important
            }
        </style>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    </head>

    <body>
        <?php include("analytics.php"); ?>
        <center>
            <h1><?php echo "$materia: $assunto"; ?></h1>
        </center>
        <br>
        <div class="conteudo"><?php echo $conteudo; ?></div>
        <br>
        <br>
        <br>
        <script>
            filename = "<?php echo $file; ?>";
            <?php echo file_get_contents("resumo.js"); ?>
        </script>
    </body>
</html>
