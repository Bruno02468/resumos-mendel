<?php

include("../outros/banco.php");

require_login();

?>
<html>
    <head>
        <title>Painel Administrativo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
            <h1>Painel Administrativo</h1>
            <br>
            <div class="big">
                <a href="..">[Página inicial]</a><br>
                <br>
                <a href="criar_resumo.php">[Criar um resumo]</a><br>
                <br>
                <a target="_blank" href="estilo.html">[Manual de Estilo]</a><br>
                <br>
                <a target="_blank" href="../visual/">[Editor Visual]</a>
                <br>(novo!)
            </div>
        </center>
    </body>
</html>