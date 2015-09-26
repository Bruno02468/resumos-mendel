<?php

include("../../funcs.php");

$filename = req_get('f');

$arquivo = "../../dados/$filename";
unlink($arquivo);

redir("../");

?>