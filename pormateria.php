<?php

include("funcs.php");

$mat = req_get("mat");

$pasta = "dados/";

$arquivos = glob($pasta . "*");
usort($arquivos, function($a, $b) {
    $fa = file($a);
    $fb = file($b);
    return trim($fa[2]) < trim($fb[2]);
});

echo "<br>Mostrando resumos de $mat:<br><br>";

foreach ($arquivos as $file) {
    $bas = basename($file);
    if ("." === $bas) continue;
    if (".." === $bas) continue;
    $arquivo = file($file);

    $titulo = htmlspecialchars(trim($arquivo[0]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    $materia = explode(":", $titulo)[0];
    if ($materia == $mat)
        echo "<a target=\"_blank\" href=\"resumo/$bas\">\"<b><i>$titulo</i></b>\", por $autoria</a><br><br>";
}

?>
