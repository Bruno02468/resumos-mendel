<?php

include("../outros/banco.php");

require_login("borginhos");

$credenciais = getCredenciais();

$editlinks = "";
foreach ($credenciais as $credencial) {
    $user = $credencial["nome"];
    $editlinks .= "<a href=\"editar.php?nome=$user\">$user</a>
     <a href=\"atuadores/deleta.php?nome=$user\">[deletar]</a><br><br>";
}

?>

<html>
    <head>
        <title>Painel Superadministrativo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
            <h1>Painel Superadministrativo</h1>
            <br>
            <div class="big">
                <a href="..">[Página inicial]</a><br>
                <br>
                <a href="criar.php">[Criar um login]</a><br>
                <br>
                Editar um login:<br>
                <br>
                <?php echo $editlinks; ?>
            </div>
        </center>
    </body>
</html>