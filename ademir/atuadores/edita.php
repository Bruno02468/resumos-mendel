<?php

include("../../outros/banco.php");

require_login();

$guid = req_post("guid");
$ano = req_post("ano");
$materia = req_post("materia");
$assunto = req_post("assunto");
$autoria = req_post("autoria");
$dados = req_post("dados");
$mini = req_post("mini");
if (!validar_nome($mini)) die("<br>Só são permitidos números, letras, - e _.");

foreach (getFullJSON() as $resumo) {
    if ($resumo["mini"] === $mini && $resumo["guid"] !== $guid) {
        die("<br>Um outro resumo com essa URL já existe!");
    }
}

editResumo($ano, $materia, $assunto, $autoria, $dados, $mini, $guid);

redir("../../resumo/$mini");

?>