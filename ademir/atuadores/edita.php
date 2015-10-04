<?php

include("../../funcs.php");

$filename = req_post("filename");
$path = "../../dados/" . $filename;
if (!file_exists($path) or !validar_nome($filename))
    die("Erro: você não foi o primeiro a pensar nisso.");
$materia = req_post("materia");
$assunto = req_post("assunto");
$autoria = req_post("autoria");
$dados = req_post("dados");
$likes = trim(file($path)[2]);


$arquivo = "$materia: $assunto\n$autoria\n$likes\n$dados";
file_put_contents($path, $arquivo);

redir("../../resumo/$filename");

?>