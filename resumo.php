<?php

include("funcs.php");

$pasta = "dados/";


$file = req_get("f");

$arquivo = file($pasta . $file);

if (!$arquivo) {
    die("Arquivo não encontrado. Esse link deve estar quebrado. Volte à <a href='/resumos'>página inicial</a>.");
}

$titulo = formatar(trim($arquivo[0]));
$autoria = formatar(trim($arquivo[1]));
$likes = substr_count($arquivo[2], ";") - 1;
$dadosarr = $arquivo;
unset($dadosarr[0]);
unset($dadosarr[1]);
unset($dadosarr[2]);

$conteudo = formatar_array($dadosarr);

?>

<html>
    <head>
        <title>Resumo: "<?php echo $titulo; ?>"</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            <?php echo file_get_contents("resumo.css"); ?>
        </style>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <?php include("analytics.php"); ?>
        <center>
            <h1>Site dos Resumos</h1>
            <a href="..">[Voltar à página inicial]</a><br>
            <small>
                <a href="../ademir/edita.php?f=<?php echo $file; ?>">[Editar resumo]</a><br>
                Tudo programado por <a target="_blank" href="/licao/contato.html">Bruno Borges Paschoalinoto</a> (1ª E)<br>
            </small><br>
        </center>
        <br>
        <h3>
        Título do resumo: <b><?php echo $titulo; ?></b><br>
        <br>
        Escrito por: <b><?php echo $autoria; ?></b><br>
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