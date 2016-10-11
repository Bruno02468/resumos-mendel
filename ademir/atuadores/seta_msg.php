<?php

include("../../outros/banco.php");
require_login("");


$dados = htmlspecialchars_decode(req_post("msg"));
$arquivo = "../../msg.txt";
file_put_contents($arquivo, $dados);

redir("../");

?>
