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

    $first = explode(":", trim($arquivo[0]), 2);
    $materia = htmlspecialchars(trim($first[0]));
    $assunto = htmlspecialchars(trim($first[1]));
    $autoria = htmlspecialchars(trim($arquivo[1]));

    if ($materia == $mat)
        echo "<a target=\"_blank\" href=\"resumo/$bas\">Resumo sobre \"<b><i>$assunto</i></b>\", por $autoria</a><br><br>";
}

?>
