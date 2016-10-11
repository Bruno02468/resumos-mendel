<?php

include("../outros/banco.php");

require_login();

?>
<html>
    <head>
        <title>Mensagem do site</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
            <h1>Mensagem geral</h1>
            <br>
            <div class="big">
                <a class="buttonlink btnorange bigbtn" href="..">Página inicial</a><br>
                <br>
                <form action="atuadores/seta_msg.php" method="POST">
                    <textarea name="msg" rows="15" cols="75"><?php echo htmlspecialchars(file_get_contents("../msg.txt")); ?></textarea><br>
                    <input class="buttonlink bigbtn" type="submit" value="Salvar!">
                </form>
            </div>
        </center>
    </body>
</html>