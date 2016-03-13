<?php

include("../../outros/banco.php");

require_login("borginhos");

addCredencial(req_post("nome"), req_post("pass"));

redir("..");

?>