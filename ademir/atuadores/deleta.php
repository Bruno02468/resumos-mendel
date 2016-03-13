<?php

include("../../outros/banco.php");

require_login();

$guid = req_get("guid");

removeResumo($guid);

redir("../");

?>