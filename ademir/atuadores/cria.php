<?php

include("../../funcs.php");

$pasta = "../../dados/";

function filename($length = 10) {
    $pasta = "../../dados/";
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    if (!file_exists($pasta . $randomString))
        return $randomString;
    else
        return filename();
}

$filename = trim(req_post("fname"));

if ($filename == "" or !ctype_alnum($filename) or file_exists($pasta . $filename))
    $filename = filename();

$titulo = req_post("materia") . ": " . req_post('titulo');
$autoria = req_post("autoria");
$dados = req_post("dados");

$arquivo = "$titulo\n$autoria\n;\n$dados";
file_put_contents($pasta . $filename, $arquivo);

redir("../../resumo/$filename");

?>