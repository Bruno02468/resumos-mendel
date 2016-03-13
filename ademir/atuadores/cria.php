<?php

include("../../outros/banco.php");

require_login();

$ano = req_post("ano");
$materia = req_post("materia");
$assunto = req_post("assunto");
$autoria = req_post("autoria");
$dados = req_post("dados");
$mini = req_post("mini");
if (!validar_nome($mini)) die("<br>Só são permitidos números, letras, - e _.");
foreach (getFullJSON() as $resumo) {
    if ($resumo["mini"] === $mini) die("<br>Um resumo com essa URL já existe!");
}

addResumo($ano, $materia, $assunto, $autoria, $dados, $mini);

redir("../../resumo/$mini");

?>