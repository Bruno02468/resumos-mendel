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
$likes = trim($arquivo[2]);
$ip = trim($_SERVER['REMOTE_ADDR']);
$delim = ";";
if (substr_count($likes, $delim) == 0)
    $likes = $delim;
if (!in_array($ip, explode($delim, $likes))) {
    $likes .= trim($ip . $delim);
}
$dadosarr = $arquivo;
unset($dadosarr[0]);
unset($dadosarr[1]);
unset($dadosarr[2]);
$dados = implode($dadosarr);
$arquivo = "$titulo\n$autoria\n$likes\n$dados";
file_put_contents($filename, $arquivo);
echo substr_count($likes, $delim) - 1;

?>