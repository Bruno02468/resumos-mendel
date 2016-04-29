<?php

include("../outros/banco.php");

require_login();

?>
<html>
    <head>
        <title>Criar um resumo</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../outros/resumos.css">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <center>
            <h1>Criar um resumo</h1>
            <br>
            <form action="atuadores/cria.php" method="POST">
                <table align="center">
                    <tr><td>Ano: </td><td><input type="number" min="1" max="3" name="ano"></tr>
                    <tr><td>Matéria: </td><td><input type="text" name="materia"></tr>
                    <tr><td>Assunto/tópico: </td><td><input type="text" name="assunto"></tr>
                    <tr><td>Endereço: </td><td><small>http://licoes.com/resumos/resumo/</small>&nbsp;<input type="text" id="n" name="mini" onchange="validateMini(this)" value=""><span id="m"></span></tr>
                    <tr><td>Autoria (quem ESCREVEU o resumo): </td><td><input type="text" name="autoria"></tr>
                    <tr><td>Código do texto (pode ser criado no <a target="_blank" href="../visual/">editor visual™</a>): </td><td><textarea rows="50" cols="75" name="dados"></textarea></tr>
                </table>
                <input class="buttonlink bigbtn" type="submit" value="Criar resumo!">
            </form>
        </center>
        <script>
            var msg = document.getElementById("m");
            function ajaxGet(url) {
                var request = new XMLHttpRequest();
                request.open("GET", url, false);
                request.send(null);
                return request.responseText;
            }
            function validateMini(elem) {
                var mini = elem.value;
                m.innerHTML = ajaxGet("validMini.php?mini=" + mini);
            }
        </script>
    </body>
</html>