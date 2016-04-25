<?php

include("../outros/banco.php");

require_login();

?>
<html>
    <head>
        <title>Área restrita</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
            <h1>Área dos autores de resumos</h1>
            <br>
            <div class="big">
                <a class="buttonlink btnorange bigbtn" href="..">Página inicial</a><br>
                <br>
                <a class="buttonlink bigbtn" href="criar_resumo.php">Criar um resumo</a><br>
                <br>
                <a class="buttonlink bigbtn" target="_blank" href="../visual/">Editor Visual<sub style="color: black">BETA</sub></a>
            </div>
        </center>
    </body>
</html>