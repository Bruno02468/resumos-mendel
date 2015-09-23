<?php

function req($str) {
    if (!isset($_POST[$str])) {
        die("Variável POST \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_POST[$str];
    }
}

$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$filename = req('filename');
$titulo = req('titulo');
$autoria = req('autoria');
$dados = req('dados');
$likes = req("likes");


$arquivo = "$titulo\n$autoria\n$likes\n$dados";
file_put_contents("../../dados/" . $filename, $arquivo);

header("Location: http://$host$uri/../../resumo/$filename");

?>