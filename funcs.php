<?php

// Arquivo comum para funções muito usadas.
// Escrito por Bruno Borges Paschoalinoto.

date_default_timezone_set("America/Sao_Paulo");

// Executa um redirecionamento relativo à URL atual.
function redir($relative) {
    $host  = $_SERVER["HTTP_HOST"];
    $uri  = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
    header("Location: http://$host$uri/$relative");
    die("Redirecionamento em progresso...");
}

// Exige uma variável GET 100% esperada (e.g. de um form)
// e cancela a execução caso ela não esteja presente.
function req_get($str) {
    if (!isset($_GET[$str])) {
        die("Variável GET \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_GET[$str];
    }
}

// Exige uma variável POST 100% esperada (e.g. de um form)
// e cancela a execução caso ela não esteja presente.
function req_post($str) {
    if (!isset($_POST[$str])) {
        die("Variável POST \"" . $str . "\" necessária para esta requisição.");
    } else {
        return $_POST[$str];
    }
}

function substituir_global($padrao, $subst, $texto) {
    while (preg_match($padrao, $texto))
        $texto = preg_replace($padrao, $subst, $texto);
    return $texto;
}

function formatar($texto) {
    $not_bracket = "[^\]]";
    $linkreg = "/\[($not_bracket+)\|($not_bracket+)\]/";
    $linkrep = "<a target=\"_blank\" href=\"$1\">$2</a>";
    $nbspreg = "/^ +/";
    $nbsprep = "&nbsp;";
    $imgreg = "/\[imagem:($not_bracket+)\]/";
    $imgrep = "<a target=\"_blank\" title=\"Clique para ver o tamanho completo.\" href=\"$1\"><img src=\"$1\"></a>";
    $h4reg = "/\[big\]/";
    $h4rep = "<div class=\"big\">";
    $hcreg = "/\[\/big\]/";
    $hcrep = "</div>";
    $colorreg = "/\[cor:($not_bracket+)\]/";
    $colorrep = "<span style=\"color: $1;\">";
    $endcolorreg = "/\[\/cor\]/";
    $endcolorrep = "</span>";
    $fourreg = "/    /";
    $fourrep = "&nbsp;&nbsp;&nbsp;&nbsp;";
    $tags = "table|tr|td|sub|sup|b|i|u|s|code";
    $tagreg = "/\[(($tags)|(\/($tags)))\]/";
    $tagrep = "<$1>";
    $tablereg = "/<table>/";
    $tablerep = "<table class=\"restable\">";

    $texto = htmlspecialchars($texto);
    $texto = substituir_global($fourreg, $fourrep, $texto);
    $texto = substituir_global($linkreg, $linkrep, $texto);
    $texto = substituir_global($nbspreg, $nbsprep, $texto);
    $texto = substituir_global($imgreg, $imgrep, $texto);
    $texto = substituir_global($h4reg, $h4rep, $texto);
    $texto = substituir_global($hcreg, $hcrep, $texto);
    $texto = substituir_global($colorreg, $colorrep, $texto);
    $texto = substituir_global($endcolorreg, $endcolorrep, $texto);
    $texto = substituir_global($tagreg, $tagrep, $texto);
    $texto = substituir_global($tablereg, $tablerep, $texto);
    $texto = substituir_global("/\{l\}/", "ℓ", $texto);

    return $texto;
}

function formatar_array($arr) {
    $res = "";
    foreach ($arr as $key => $line)
        $res .= formatar($line) . ($key <= count($arr) + 1 ? "<br>" : "");
    return $res;
}

function validar_nome($nome) {
  $permitido = array("-", "_");

  return ctype_alnum(str_replace($permitido, "", $nome));
}
?>
