<?php

include("../../funcs.php");

$filename = req_post('filename');
$titulo = req_post('titulo');
$autoria = req_post('autoria');
$dados = req_post('dados');
$likes = req_post("likes");


$arquivo = "$titulo\n$autoria\n$likes\n$dados";
file_put_contents("../../dados/" . $filename, $arquivo);

redir("../../resumo/$filename");

?>