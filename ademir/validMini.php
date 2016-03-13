<?php

include("../outros/banco.php");
require_login();

$mini = req_get("mini");

if (!validar_nome($mini)) die("<br>Só são permitidos números, letras, - e _.");

foreach (getFullJSON() as $resumo) {
    if ($resumo["mini"] === $mini) die("<br>Um resumo com essa URL já existe!");
}

?>