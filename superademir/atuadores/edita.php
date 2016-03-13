<?php

include("../../outros/banco.php");

require_login("borginhos");

editCredencial(req_post("nome"), req_post("pass"));

redir("..");

?>