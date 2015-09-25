<?php

function req($str) {
    if (!isset($_POST[$str])) {
        die("Variável POST \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_POST[$str];
    }
}

$pasta = "../../dados/";

function filename($length = 10) {
    $pasta = "../../dados/";
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if (!file_exists($pasta . $randomString))
        return $randomString;
    else
        return filename();
}

$filename = trim(req("fname"));

if ($filename == "" or !ctype_alnum($filename) or file_exists($pasta . $filename))
    $filename = filename();

$titulo = req('titulo');
$autoria = req('autoria');
$dados = req('dados');

$arquivo = "$titulo\n$autoria\n;\n$dados";
file_put_contents($pasta . $filename, $arquivo);

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
header("Location: http://$host$uri/../../resumo/$filename");

?>