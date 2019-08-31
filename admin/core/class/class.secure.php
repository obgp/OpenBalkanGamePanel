<?php

function redirect_to($rdr_link) {
    if (!empty($rdr_link)) {
        header("Location: /admin/".$rdr_link);
        die();
    }
}

/**
* Secure Text
*/

function txt($text) {
    /* decode txt */
    $text = txt_secure($text);
    /* ispravi txt */
    $text = zt_text($text);
    /* decode urls */
    $text = url_secure($text);
    /* decode links */
    $text = decode_urls($text);

    return $text;
}

function zt_text($zt_txt) {
    $s_zamene = array (
        '&lt;3'     => ':_3',
        '&lt;/3'    => ':_/3',
        'picka'     => '**cka',
        'kurac'     => '**rac',
        'svinja'    => '**inja',
        'stoka'     => '**oka',
        'materina'  => '***erina',
    );
        
    $zt_txt = str_replace(array_keys($s_zamene), array_values($s_zamene), $zt_txt);
    
    return $zt_txt;
}

/**
* Valid email
*/

function valid_email($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        return true;
    } else {
        return false;
    }
}

/**
 * Validate Ip Addresses
 */
function valid_ip($ip) {
    $regex = "#[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}#";
    $validate = preg_match($regex, $ip);
    if ($validate == 1) {
        return true;
    } else {
        return false;
    }
}

/**
* Secure Text
*/

function txt_secure($string, $br = true) {
    $string = trim($string);
    $string = mysql_real_escape_string($string);
    $string = htmlspecialchars($string, ENT_QUOTES);

    if ($br == true) {
        $string = str_replace('\r\n', " <br />", $string);
        $string = str_replace('\n\r', " <br />", $string);
        $string = str_replace('\r', " <br />", $string);
        $string = str_replace('\n', " <br />", $string);
    } else {
        $string = str_replace('\r\n', "", $string);
        $string = str_replace('\n\r', "", $string);
        $string = str_replace('\r', "", $string);
        $string = str_replace('\n', "", $string);
    }

    $string = stripslashes($string);
    $string = str_replace('&amp;#', '&#', $string);

    return $string;
}

function txt_secure2($string, $br = true) {
    $string = trim($string);
    //$string = mysql_real_escape_string($string);
    $string = htmlspecialchars($string, ENT_QUOTES);
    if ($br == true) {
        $string = str_replace('\r\n', " <br>", $string);
        $string = str_replace('\n\r', " <br>", $string);
        $string = str_replace('\r', " <br>", $string);
        $string = str_replace('\n', " <br>", $string);
    } else {
        $string = str_replace('\r\n', "", $string);
        $string = str_replace('\n\r', "", $string);
        $string = str_replace('\r', "", $string);
        $string = str_replace('\n', "", $string);
    }
    $string = stripslashes($string);
    $string = str_replace('&amp;#', '&#', $string);

    return $string;
}

/**
* Detect smile in text
*/

function smile($smile) {
    /*$smile = str_replace('&lt;3', "<i class='fa fa-heart'></i>", $smile);
    $smile = str_replace('&lt;/3', "<i class='fa fa-heart'></i>", $smile);

    $smile = str_replace(':D', "<i class='icomoon icon-smiley'></i>", $smile);
    $smile = str_replace(':)', "<i class='icomoon icon-smiley'></i>", $smile);
    $smile = str_replace(':(', "<i class='fa fa-frown-o'></i>", $smile);
    $smile = str_replace(':|', "<i class='icomoon icon-neutral'></i>", $smile);
    
    $smile = str_replace(';)', "<i class='icomoon icon-wink'></i>", $smile);
    $smile = str_replace(':P', "<i class='icomoon icon-tongue'></i>", $smile);
    $smile = str_replace(':O', "<i class='icomoon icon-shocked'></i>", $smile);
    $smile = str_replace(':~', "<i class='icomoon icon-cool'></i>", $smile);*/

    $s_zamene = array (
        ':D'        => '<img src="/assets/img/icon/smile/002.png"  class="smile-img-icon">',
        ':P'        => '<img src="/assets/img/icon/smile/104.png"  class="smile-img-icon">',
        'o.o'       => '<img src="/assets/img/icon/smile/012.png"  class="smile-img-icon">',
        ':)'        => '<img src="/assets/img/icon/smile/001.png"  class="smile-img-icon">',
        ':m'        => '<img src="/assets/img/icon/smile/006.png"  class="smile-img-icon">',
        ';)'        => '<img src="/assets/img/icon/smile/003.gif"  class="smile-img-icon">',
        ':O'        => '<img src="/assets/img/icon/smile/004.png"  class="smile-img-icon">',
        ':/'        => '<img src="/assets/img/icon/smile/007.png"  class="smile-img-icon">',
        ':$'        => '<img src="/assets/img/icon/smile/008.png"  class="smile-img-icon">',
        ':S'        => '<img src="/assets/img/icon/smile/009.png"  class="smile-img-icon">',
        ':('        => '<img src="/assets/img/icon/smile/010.png"  class="smile-img-icon">',
        ';('        => '<img src="/assets/img/icon/smile/011.gif"  class="smile-img-icon">',
        ':_3'       => '<img src="/assets/img/icon/smile/015.png"  class="smile-img-icon">',
        ':_/3'      => '<img src="/assets/img/icon/smile/016.png"  class="smile-img-icon">',
        '-.-'       => '<img src="/assets/img/icon/smile/083.png"  class="smile-img-icon">',
        ':n'        => '<img src="/assets/img/icon/smile/086.png"  class="smile-img-icon">',
        ':P'        => '<img src="/assets/img/icon/smile/104.png"  class="smile-img-icon">',
        ':T'        => '<img src="/assets/img/icon/smile/tuga.gif" class="smile-img-icon">',
        'xD'        => '<img src="/assets/img/icon/smile/xD.png"   class="smile-img-icon">',
        '.!,'       => '<img src="/assets/img/icon/smile/kk.png"   class="smile-img-icon">',
        'picka'     => '**cka',
        'kurac'     => '**rac',
        'svinja'    => '**inja',
        'stoka'     => '**oka',
        'materina'  => '***erina',
    );
        
    $smile = str_replace(array_keys($s_zamene), array_values($s_zamene), $smile);
    
    return $smile;
}

/***
* Log view text
*/
function a_log_v($text) {
    $t_zamene = array (
        'dobrodosli nazad.'             => 'uspesan login.',
        'Samo Developer ima pristup!'       => 'Redirekt sa stranice kojoj nema pristup.',
        //''     => '',
    );
        
    $text = str_replace(array_keys($t_zamene), array_values($t_zamene), $text);
    
    return $text;
}

/**
* Detect url in text
*/

function decode_urls($text) {
    $text = preg_replace('/(https?:\/\/[^\s]+)/', "<a target='_blank' href='$1'>$1</a>", $text);
    return $text;
}

/**
* HTTPS secure page
*/

function https_secure() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
}

/**
* Replace text
*/

function url_secure($url_secure) {
    // Latin
    $url_secure = str_replace('À', 'A', $url_secure);
    $url_secure = str_replace('Á', 'A', $url_secure);
    $url_secure = str_replace('Â', 'A', $url_secure);
    $url_secure = str_replace('Ã', 'A', $url_secure);
    $url_secure = str_replace('Ä', 'A', $url_secure);
    $url_secure = str_replace('Å', 'A', $url_secure);
    $url_secure = str_replace('Æ', 'AE', $url_secure);
    $url_secure = str_replace('Ç', 'C', $url_secure);
    $url_secure = str_replace('È', 'E', $url_secure);
    $url_secure = str_replace('É', 'E', $url_secure);
    $url_secure = str_replace('Ê', 'E', $url_secure);
    $url_secure = str_replace('Ë', 'E', $url_secure);
    $url_secure = str_replace('Ì', 'I', $url_secure);
    $url_secure = str_replace('Í', 'I', $url_secure);
    $url_secure = str_replace('Î', 'I', $url_secure);
    $url_secure = str_replace('Ï', 'I', $url_secure);
    $url_secure = str_replace('Ð', 'D', $url_secure);
    $url_secure = str_replace('Ñ', 'N', $url_secure);
    $url_secure = str_replace('Ò', 'O', $url_secure);
    $url_secure = str_replace('Ó', 'O', $url_secure);
    $url_secure = str_replace('Ô', 'O', $url_secure);
    $url_secure = str_replace('Õ', 'O', $url_secure);
    $url_secure = str_replace('Ö', 'O', $url_secure);
    $url_secure = str_replace('Ő', 'O', $url_secure);
    $url_secure = str_replace('Ø', 'O', $url_secure);
    $url_secure = str_replace('Ù', 'U', $url_secure);
    $url_secure = str_replace('Ú', 'U', $url_secure);
    $url_secure = str_replace('Û', 'U', $url_secure);
    $url_secure = str_replace('Ü', 'U', $url_secure);
    $url_secure = str_replace('Ű', 'U', $url_secure);
    $url_secure = str_replace('Ý', 'Y', $url_secure);
    $url_secure = str_replace('Þ', 'TH', $url_secure);
    $url_secure = str_replace('ß', 'ss', $url_secure);
    $url_secure = str_replace('à', 'a', $url_secure);
    $url_secure = str_replace('á', 'a', $url_secure);
    $url_secure = str_replace('â', 'a', $url_secure);
    $url_secure = str_replace('ã', 'a', $url_secure);
    $url_secure = str_replace('ä', 'a', $url_secure);
    $url_secure = str_replace('å', 'a', $url_secure);
    $url_secure = str_replace('æ', 'ae', $url_secure);
    $url_secure = str_replace('ç', 'c', $url_secure);
    $url_secure = str_replace('è', 'e', $url_secure);
    $url_secure = str_replace('é', 'e', $url_secure);
    $url_secure = str_replace('ê', 'e', $url_secure);
    $url_secure = str_replace('ë', 'e', $url_secure);
    $url_secure = str_replace('ì', 'i', $url_secure);
    $url_secure = str_replace('í', 'i', $url_secure);
    $url_secure = str_replace('î', 'i', $url_secure);
    $url_secure = str_replace('ï', 'i', $url_secure);
    $url_secure = str_replace('ð', 'd', $url_secure);
    $url_secure = str_replace('ñ', 'n', $url_secure);
    $url_secure = str_replace('ò', 'o', $url_secure);
    $url_secure = str_replace('ó', 'o', $url_secure);
    $url_secure = str_replace('ô', 'o', $url_secure);
    $url_secure = str_replace('õ', 'o', $url_secure);
    $url_secure = str_replace('ö', 'o', $url_secure);
    $url_secure = str_replace('ő', 'o', $url_secure);
    $url_secure = str_replace('ø', 'o', $url_secure);
    $url_secure = str_replace('ù', 'u', $url_secure);
    $url_secure = str_replace('ú', 'u', $url_secure);
    $url_secure = str_replace('û', 'u', $url_secure);
    $url_secure = str_replace('ü', 'u', $url_secure);
    $url_secure = str_replace('ű', 'u', $url_secure);
    $url_secure = str_replace('ý', 'y', $url_secure);
    $url_secure = str_replace('þ', 'th', $url_secure);
    $url_secure = str_replace('ÿ', 'y', $url_secure);
    
    // Symbols
    $url_secure = str_replace('&copy;', '(c)', $url_secure);
    $url_secure = str_replace('©', '(c)', $url_secure);
    
    // Greek
    $url_secure = str_replace('Α', 'A', $url_secure);
    $url_secure = str_replace('Β', 'B', $url_secure);
    $url_secure = str_replace('Γ', 'G', $url_secure);
    $url_secure = str_replace('Δ', 'D', $url_secure);
    $url_secure = str_replace('Ε', 'E', $url_secure);
    $url_secure = str_replace('Ζ', 'Z', $url_secure);
    $url_secure = str_replace('Η', 'H', $url_secure);
    $url_secure = str_replace('Θ', '8', $url_secure);
    $url_secure = str_replace('Ι', 'I', $url_secure);
    $url_secure = str_replace('Κ', 'K', $url_secure);
    $url_secure = str_replace('Λ', 'L', $url_secure);
    $url_secure = str_replace('Μ', 'M', $url_secure);
    $url_secure = str_replace('Ν', 'N', $url_secure);
    $url_secure = str_replace('Ξ', '3', $url_secure);
    $url_secure = str_replace('Ο', 'O', $url_secure);
    $url_secure = str_replace('Π', 'P', $url_secure);
    $url_secure = str_replace('Ρ', 'R', $url_secure);
    $url_secure = str_replace('Σ', 'S', $url_secure);
    $url_secure = str_replace('Τ', 'T', $url_secure);
    $url_secure = str_replace('Υ', 'Y', $url_secure);
    $url_secure = str_replace('Φ', 'F', $url_secure);
    $url_secure = str_replace('Χ', 'X', $url_secure);
    $url_secure = str_replace('Ψ', 'PS', $url_secure);
    $url_secure = str_replace('Ω', 'W', $url_secure);
    $url_secure = str_replace('Ά', 'A', $url_secure);
    $url_secure = str_replace('Έ', 'E', $url_secure);
    $url_secure = str_replace('Ί', 'I', $url_secure);
    $url_secure = str_replace('Ό', 'O', $url_secure);
    $url_secure = str_replace('Ύ', 'Y', $url_secure);
    $url_secure = str_replace('Ή', 'H', $url_secure);
    $url_secure = str_replace('Ώ', 'W', $url_secure);
    $url_secure = str_replace('Ϊ', 'I', $url_secure);
    $url_secure = str_replace('Ϋ', 'Y', $url_secure);
    $url_secure = str_replace('α', 'a', $url_secure);
    $url_secure = str_replace('β', 'b', $url_secure);
    $url_secure = str_replace('γ', 'g', $url_secure);
    $url_secure = str_replace('δ', 'd', $url_secure);
    $url_secure = str_replace('ε', 'e', $url_secure);
    $url_secure = str_replace('ζ', 'z', $url_secure);
    $url_secure = str_replace('η', 'h', $url_secure);
    $url_secure = str_replace('θ', '8', $url_secure);
    $url_secure = str_replace('ι', 'i', $url_secure);
    $url_secure = str_replace('κ', 'k', $url_secure);
    $url_secure = str_replace('λ', 'l', $url_secure);
    $url_secure = str_replace('μ', 'm', $url_secure);
    $url_secure = str_replace('ν', 'n', $url_secure);
    $url_secure = str_replace('ξ', '3', $url_secure);
    $url_secure = str_replace('ο', 'o', $url_secure);
    $url_secure = str_replace('π', 'p', $url_secure);
    $url_secure = str_replace('ρ', 'r', $url_secure);
    $url_secure = str_replace('σ', 's', $url_secure);
    $url_secure = str_replace('τ', 't', $url_secure);
    $url_secure = str_replace('υ', 'y', $url_secure);
    $url_secure = str_replace('φ', 'f', $url_secure);
    $url_secure = str_replace('χ', 'x', $url_secure);
    $url_secure = str_replace('ψ', 'ps', $url_secure);
    $url_secure = str_replace('ω', 'w', $url_secure);
    $url_secure = str_replace('ά', 'a', $url_secure);
    $url_secure = str_replace('έ', 'e', $url_secure);
    $url_secure = str_replace('ί', 'i', $url_secure);
    $url_secure = str_replace('ό', 'o', $url_secure);
    $url_secure = str_replace('ύ', 'y', $url_secure);
    $url_secure = str_replace('ή', 'h', $url_secure);
    $url_secure = str_replace('ώ', 'w', $url_secure);
    $url_secure = str_replace('ς', 's', $url_secure);
    $url_secure = str_replace('ϊ', 'i', $url_secure);
    $url_secure = str_replace('ΰ', 'y', $url_secure);
    $url_secure = str_replace('ϋ', 'y', $url_secure);
    $url_secure = str_replace('ΐ', 'i', $url_secure);
    
    // Turkish
    $url_secure = str_replace('Ş', 'S', $url_secure);
    $url_secure = str_replace('İ', 'I', $url_secure);
    $url_secure = str_replace('Ç', 'C', $url_secure);
    $url_secure = str_replace('Ü', 'U', $url_secure);
    $url_secure = str_replace('Ö', 'O', $url_secure);
    $url_secure = str_replace('Ğ', 'G', $url_secure);
    $url_secure = str_replace('ş', 's', $url_secure);
    $url_secure = str_replace('ı', 'i', $url_secure);
    $url_secure = str_replace('ç', 'c', $url_secure);
    $url_secure = str_replace('ü', 'u', $url_secure);
    $url_secure = str_replace('ö', 'o', $url_secure);
    $url_secure = str_replace('ğ', 'g', $url_secure);
    
    // Russian
    $url_secure = str_replace('А', 'A', $url_secure);
    $url_secure = str_replace('Б', 'B', $url_secure);
    $url_secure = str_replace('В', 'V', $url_secure);
    $url_secure = str_replace('Г', 'G', $url_secure);
    $url_secure = str_replace('Д', 'D', $url_secure);
    $url_secure = str_replace('Е', 'E', $url_secure);
    $url_secure = str_replace('Ё', 'Yo', $url_secure);
    $url_secure = str_replace('Ж', 'Zh', $url_secure);
    $url_secure = str_replace('З', 'Z', $url_secure);
    $url_secure = str_replace('И', 'I', $url_secure);
    $url_secure = str_replace('Й', 'J', $url_secure);
    $url_secure = str_replace('К', 'K', $url_secure);
    $url_secure = str_replace('Л', 'L', $url_secure);
    $url_secure = str_replace('М', 'M', $url_secure);
    $url_secure = str_replace('Н', 'N', $url_secure);
    $url_secure = str_replace('О', 'O', $url_secure);
    $url_secure = str_replace('П', 'P', $url_secure);
    $url_secure = str_replace('Р', 'R', $url_secure);
    $url_secure = str_replace('С', 'S', $url_secure);
    $url_secure = str_replace('Т', 'T', $url_secure);
    $url_secure = str_replace('У', 'U', $url_secure);
    $url_secure = str_replace('Ф', 'F', $url_secure);
    $url_secure = str_replace('Х', 'H', $url_secure);
    $url_secure = str_replace('Ц', 'C', $url_secure);
    $url_secure = str_replace('Ч', 'Ch', $url_secure);
    $url_secure = str_replace('Ш', 'Sh', $url_secure);
    $url_secure = str_replace('Щ', 'Sh', $url_secure);
    $url_secure = str_replace('Ъ', '', $url_secure);
    $url_secure = str_replace('Ы', 'Y', $url_secure);
    $url_secure = str_replace('Ь', '', $url_secure);
    $url_secure = str_replace('Э', 'E', $url_secure);
    $url_secure = str_replace('Ю', 'Yu', $url_secure);
    $url_secure = str_replace('Я', 'Ya', $url_secure);
    $url_secure = str_replace('а', 'a', $url_secure);
    $url_secure = str_replace('б', 'b', $url_secure);
    $url_secure = str_replace('в', 'v', $url_secure);
    $url_secure = str_replace('г', 'g', $url_secure);
    $url_secure = str_replace('д', 'd', $url_secure);
    $url_secure = str_replace('е', 'e', $url_secure);
    $url_secure = str_replace('ё', 'yo', $url_secure);
    $url_secure = str_replace('ж', 'zh', $url_secure);
    $url_secure = str_replace('з', 'z', $url_secure);
    $url_secure = str_replace('и', 'i', $url_secure);
    $url_secure = str_replace('й', 'j', $url_secure);
    $url_secure = str_replace('к', 'k', $url_secure);
    $url_secure = str_replace('л', 'l', $url_secure);
    $url_secure = str_replace('м', 'm', $url_secure);
    $url_secure = str_replace('н', 'n', $url_secure);
    $url_secure = str_replace('о', 'o', $url_secure);
    $url_secure = str_replace('п', 'p', $url_secure);
    $url_secure = str_replace('р', 'r', $url_secure);
    $url_secure = str_replace('с', 's', $url_secure);
    $url_secure = str_replace('т', 't', $url_secure);
    $url_secure = str_replace('у', 'u', $url_secure);
    $url_secure = str_replace('ф', 'f', $url_secure);
    $url_secure = str_replace('х', 'h', $url_secure);
    $url_secure = str_replace('ц', 'c', $url_secure);
    $url_secure = str_replace('ч', 'ch', $url_secure);
    $url_secure = str_replace('ш', 'sh', $url_secure);
    $url_secure = str_replace('щ', 'sh', $url_secure);
    $url_secure = str_replace('ъ', '', $url_secure);
    $url_secure = str_replace('ы', 'y', $url_secure);
    $url_secure = str_replace('ь', '', $url_secure);
    $url_secure = str_replace('э', 'e', $url_secure);
    $url_secure = str_replace('ю', 'yu', $url_secure);
    $url_secure = str_replace('я', 'ya', $url_secure);
    
    // Ukrainian
    $url_secure = str_replace('Є', 'Ye', $url_secure);
    $url_secure = str_replace('І', 'I', $url_secure);
    $url_secure = str_replace('Ї', 'Yi', $url_secure);
    $url_secure = str_replace('Ґ', 'G', $url_secure);
    $url_secure = str_replace('є', 'ye', $url_secure);
    $url_secure = str_replace('і', 'i', $url_secure);
    $url_secure = str_replace('ї', 'yi', $url_secure);
    $url_secure = str_replace('ґ', 'g', $url_secure);
    
    // Czech
    $url_secure = str_replace('Č', 'C', $url_secure);
    $url_secure = str_replace('Ď', 'D', $url_secure);
    $url_secure = str_replace('Ě', 'E', $url_secure);
    $url_secure = str_replace('Ň', 'N', $url_secure);
    $url_secure = str_replace('Ř', 'R', $url_secure);
    $url_secure = str_replace('Š', 'S', $url_secure);
    $url_secure = str_replace('Ť', 'T', $url_secure);
    $url_secure = str_replace('Ů', 'U', $url_secure);
    $url_secure = str_replace('Ž', 'Z', $url_secure);
    $url_secure = str_replace('č', 'c', $url_secure);
    $url_secure = str_replace('ď', 'd', $url_secure);
    $url_secure = str_replace('ě', 'e', $url_secure);
    $url_secure = str_replace('ň', 'n', $url_secure);
    $url_secure = str_replace('ř', 'r', $url_secure);
    $url_secure = str_replace('š', 's', $url_secure);
    $url_secure = str_replace('ť', 't', $url_secure);
    $url_secure = str_replace('ů', 'u', $url_secure);
    $url_secure = str_replace('ž', 'z', $url_secure);
    
    // Polish
    $url_secure = str_replace('Ą', 'A', $url_secure);
    $url_secure = str_replace('Ć', 'C', $url_secure);
    $url_secure = str_replace('Ę', 'e', $url_secure);
    $url_secure = str_replace('Ł', 'L', $url_secure);
    $url_secure = str_replace('Ń', 'N', $url_secure);
    $url_secure = str_replace('Ó', 'o', $url_secure);
    $url_secure = str_replace('Ś', 'S', $url_secure);
    $url_secure = str_replace('Ź', 'Z', $url_secure);
    $url_secure = str_replace('Ż', 'Z', $url_secure);
    $url_secure = str_replace('ą', 'a', $url_secure);
    $url_secure = str_replace('ć', 'c', $url_secure);
    $url_secure = str_replace('ę', 'e', $url_secure);
    $url_secure = str_replace('ł', 'l', $url_secure);
    $url_secure = str_replace('ń', 'n', $url_secure);
    $url_secure = str_replace('ó', 'o', $url_secure);
    $url_secure = str_replace('ś', 's', $url_secure);
    $url_secure = str_replace('ź', 'z', $url_secure);
    $url_secure = str_replace('ż', 'z', $url_secure);
    
    // Latvian
    $url_secure = str_replace('Ā', 'A', $url_secure);
    $url_secure = str_replace('Č', 'C', $url_secure);
    $url_secure = str_replace('Ē', 'E', $url_secure);
    $url_secure = str_replace('Ģ', 'G', $url_secure);
    $url_secure = str_replace('Ī', 'i', $url_secure);
    $url_secure = str_replace('Ķ', 'k', $url_secure);
    $url_secure = str_replace('Ļ', 'L', $url_secure);
    $url_secure = str_replace('Ņ', 'N', $url_secure);
    $url_secure = str_replace('Š', 'S', $url_secure);
    $url_secure = str_replace('Ū', 'u', $url_secure);
    $url_secure = str_replace('Ž', 'Z', $url_secure);
    $url_secure = str_replace('ā', 'a', $url_secure);
    $url_secure = str_replace('č', 'c', $url_secure);
    $url_secure = str_replace('ē', 'e', $url_secure);
    $url_secure = str_replace('ģ', 'g', $url_secure);
    $url_secure = str_replace('ī', 'i', $url_secure);
    $url_secure = str_replace('ķ', 'k', $url_secure);
    $url_secure = str_replace('ļ', 'l', $url_secure);
    $url_secure = str_replace('ņ', 'n', $url_secure);
    $url_secure = str_replace('š', 's', $url_secure);
    $url_secure = str_replace('ū', 'u', $url_secure);
    $url_secure = str_replace('ž', 'z', $url_secure);

    return $url_secure;
}

?>