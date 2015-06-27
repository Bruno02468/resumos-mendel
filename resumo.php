<?php

date_default_timezone_set("America/Sao_Paulo");

function req($str) {
    if (!isset($_GET[$str])) {
        die("Variável GET \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_GET[$str];
    }
}

function substituir_global($padrao, $subst, $texto) {
    while (preg_match($padrao, $texto))
        $texto = preg_replace($padrao, $subst, $texto);
    return $texto;
}

function formatar($texto) {
    $linkreg = "/\[([^\]]+)\|([^\]]+)\]/";
    $linkrep = "<a href='$1'>$2</a>";
    $nlinkreg = "/\{([^\]]+)\|([^\]]+)\}/";
    $nlinkrep = "<a target='_blank' href='$1'>$2</a>";
    $nbspreg = "/^ +/";
    $nbsprep = "&nbsp;";
    $imgreg = "/\[imagem:([^\]]+)\]/";
    $imgrep = "<img src='$1'>";
    $bireg = "/\[([bi]):([^\]]+)\]/";
    $birep = "<$1>$2</$1>";

    $texto = htmlspecialchars($texto);
    $texto = substituir_global($linkreg, $linkrep, $texto);
    $texto = substituir_global($nlinkreg, $nlinkrep, $texto);
    $texto = substituir_global($nbspreg, $nbsprep, $texto);
    $texto = substituir_global($imgreg, $imgrep, $texto);
    $texto = substituir_global($bireg, $birep, $texto);
    
    return $texto;
}

function formatar_array($arr) {
    $res = "";
    foreach ($arr as $key => $line)
        $res .= formatar($line) . ($key <= count($arr) ? "<br>" : "");
    return $res;
}

$pasta = "dados/";


$file = req("f");

$arquivo = file($pasta . $file);

if (!$arquivo) {
    die("Arquivo não encontrado. Esse link deve estar quebrado. Volte à <a href='/resumos'>página inicial</a>.");
}

$titulo = trim($arquivo[0]);
$autoria = trim($arquivo[1]);
$dadosarr = $arquivo;
unset($dadosarr[0]);
unset($dadosarr[1]);

$conteudo = formatar_array($dadosarr);

?>

<html>
    <head>
        <title>Resumo: "<?php echo $titulo; ?>"</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="/stylesheets/dark.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>
    
    <body>
        <center>
            <h1>Site dos Resumos</h1>
            <small>
                <a href="/resumos">[Voltar à página inicial]</a><br>
                Tudo programado por <a target="_blank" href="contato.html">Bruno Borges Paschoalinoto</a> (1ª E)<br>
            </small><br>
        </center>
        <br>
        Título do resumo: <b><?php echo $titulo; ?></b><br>
        <br>
        Escrito por: <b><?php echo $autoria; ?></b><br>
        <br>
        <?php echo $conteudo; ?>
    </body>
</html>