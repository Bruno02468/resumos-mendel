<?php
// Onde a mágica acontece.

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
    $brreg = "/\n/";
    $brrep = "<br>";
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
    $colorrep = "<span class=\"colored\" style=\"color: $1;\">";
    $endcolorreg = "/\[\/cor\]/";
    $endcolorrep = "</span>";
    $fourreg = "/    /";
    $fourrep = "&nbsp;&nbsp;&nbsp;&nbsp;";
    $tags = "table|tr|td|sub|sup|b|i|u|s|code|br|hr";
    $tagreg = "/\[(($tags)|(\/($tags)))\]/";
    $tagrep = "<$1>";
    $tablereg = "/<table>/";
    $tablerep = "<table class=\"restable\">";

    $texto = htmlspecialchars($texto);
    $texto = substituir_global("/\{l\}/", "ℓ", $texto);
    $texto = substituir_global("/\{g\}/", "[sup]↗[/sup]", $texto);
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

    return $texto;
}

function formatar_array($arr) {
    $res = "";
    foreach ($arr as $key => $line)
        $res .= formatar($line);
    return $res;
}

function validar_nome($nome) {
  $permitido = array("-", "_");

  return ctype_alnum(str_replace($permitido, "", $nome));
}

function currentDir() {
    return realpath(dirname(__FILE__)) . "/";
}

function make_salt() {
    return uniqid(rand(), true);
}

function make_guid() {
    mt_srand((double)microtime()*10000);
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $hyphen = chr(45);
    $uuid =
         substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12);
    return $uuid;
}

function getFullJSON($arq = "resumos.json") {
    return json_decode(file_get_contents(currentDir() . $arq), true);
}

function setNewJSON($new_json, $arq = "resumos.json") {
    file_put_contents(currentDir() . $arq, json_encode($new_json, JSON_HEX_TAG
    | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

function getIndexByGuid($guid) {
    $resumos = getFullJSON();
    foreach ($resumos as $index => $resumo) {
        if (!isset($resumo["guid"])) continue;
        if ($resumo["guid"] === $guid) return $index;
    }
}

function anoExists($ano) {
    $resumos = getFullJSON();
    foreach ($resumos as $resumo) {
        if (!isset($resumo["ano"])) continue;
        if ($resumo["ano"] === $ano) return true;
    }
    return false;
}

function addResumo($ano, $materia, $assunto, $autor, $conteudo, $mini) {
    $json = getFullJSON();
    $resumo = array(
        "ano" => $ano,
        "materia" => $materia,
        "assunto" => $assunto,
        "autor" => $autor,
        "conteudo" => $conteudo,
        "mini" => $mini,
        "guid" => make_guid()
    );
    array_push($json, $resumo);
    setNewJSON($json);
}

function editResumo($ano, $materia, $assunto, $autor, $conteudo, $mini, $guid) {
    $json = getFullJSON();
    $index = getIndexByGuid($guid);
    $resumo = array(
        "ano" => $ano,
        "materia" => $materia,
        "assunto" => $assunto,
        "autor" => $autor,
        "conteudo" => $conteudo,
        "mini" => $mini,
        "guid" => $guid
    );
    $json[$index] = $resumo;
    setNewJSON($json);
}

function removeResumo($guid) {
    $json = getFullJSON();
    $index = getIndexByGuid($guid);
    unset($json[$index]);
    setNewJSON($json);
}

function getCredenciais() {
    return getFullJSON("credenciais.json");
}

function setCredenciais($novas) {
    setNewJSON($novas, "credenciais.json");
}

function userExists($nome) {
    $credenciais = getCredenciais();
    foreach ($credenciais as $credencial) {
        if ($credencial["nome"] == $nome) return true;
    }
    return false;
}

function getCredencial($nome) {
    $credenciais = getCredenciais();
    foreach ($credenciais as $credencial) {
        if ($credencial["nome"] === $nome) return $credencial;
    }
}

function addCredencial($nome, $pass) {
    $credenciais = getCredenciais();
    $salt = make_salt();
    $nova = array(
        "nome" => $nome,
        "opaque" => hash("sha512", "${pass}${salt}"),
        "salt" => $salt
    );
    array_push($credenciais, $nova);
    setCredenciais($credenciais);
}

function editCredencial($nome, $newpass) {
    $credenciais = getCredenciais();
    $newsalt = make_salt();
    foreach ($credenciais as $index => $credencial) {
        if ($credencial["nome"] === $nome) {
            $nova = array(
                "nome" => $nome,
                "opaque" => hash("sha512", "${newpass}${newsalt}"),
                "salt" => $newsalt
            );
            $credenciais[$index] = $nova;
        }
    }
    setCredenciais($credenciais);
}

function removeCredencial($nome) {
    $credenciais = getCredenciais();
    foreach ($credenciais as $index => $credencial) {
        if ($credencial["nome"] === $nome) unset($credenciais[$index]);
    }
    setCredenciais($credenciais);
}

// Checa se um login consta no banco de dados.
function isright($user, $pass) {
    if (!userExists($user)) return false;
    $credencial = getCredencial($user);
    $opaque = $credencial["opaque"];
    $salt = $credencial["salt"];
    $newopaque = hash("sha512", "${pass}${salt}");
    return $opaque === $newopaque;
}

// Insere o header de login na resposta do servidor.
function headauth($msg) {
    header("WWW-Authenticate: Basic realm=\"$msg\"");
    header("HTTP/1.0 401 Unauthorized");
    echo $msg;
    die("<br><br>Eu disse que tinha que fazer login...");
}

// Exige um certo login para a exibição da página.
// Se $wanted == "", aceita qualquer login menos "borginhos".
function require_login($wanted = "") {
    $username = null;
    $password = null;

    if (isset($_SERVER["PHP_AUTH_USER"])) {
        $username = $_SERVER["PHP_AUTH_USER"];
        $password = $_SERVER["PHP_AUTH_PW"];
    }

    if (is_null($username)) {
        headauth("Voce precisa fazer login para continuar!");
    } else {
        if (!userExists($username)) {
            headauth("Esse usuario nao existe!");
        }
        if ($username !== $wanted && $wanted != "")  {
            headauth("Esse login nao e o correto!");
        }
        if (!isright($username, $password)) {
            headauth("Senha incorreta!");
        }
    }
}

function getUser() {
    return $_SERVER["PHP_AUTH_USER"];
}

?>
