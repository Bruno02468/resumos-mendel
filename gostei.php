<?php

function req($str) {
    if (!isset($_GET[$str])) {
        die("Variável GET \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_GET[$str];
    }
}

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$filename = "dados/" . req('f');
if (!file_exists($filename))
    die("404");

$arquivo = file($filename);
$titulo = trim($arquivo[0]);
$autoria = trim($arquivo[1]);
$likes = $arquivo[2] + 1;
$dadosarr = $arquivo;
unset($dadosarr[0]);
unset($dadosarr[1]);
unset($dadosarr[2]);
$dados = implode($dadosarr);
$arquivo = "$titulo\n$autoria\n$likes\n$dados";
file_put_contents($filename, $arquivo);
echo $likes;

?>