<?php
// Prepare reading of SQL dump file and executing SQL statements
function db_install($sql_dump_file)
{
    $fullpath             = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $projectsecurity_path = substr($fullpath, 0, strpos($fullpath, '/install'));
    
    global $error_mg;
    global $username;
    global $password;
    global $table_prefix;
    global $db;
    
    $sql_array = array();
    $query     = "";
    
    // Get  sql dump content
    $sql_dump = file($sql_dump_file);
    
    // Replace database prefix if exists
    $sql_dump = str_replace("<DB_PREFIX>", $table_prefix, $sql_dump);
    $sql_dump = str_replace("<PROJECTSECURITY_PATH>", $projectsecurity_path, $sql_dump);
    
    // Add ";" at the end of file to catch last sql query
    if (substr($sql_dump[count($sql_dump) - 1], -1) != ";")
        $sql_dump[count($sql_dump) - 1] .= ";";
    
    foreach ($sql_dump as $sql_line) {
        $tsl = trim(utf8_decode($sql_line));
        if (($sql_line != "") && (substr($tsl, 0, 2) != "--") && (substr($tsl, 0, 1) != "?") && (substr($tsl, 0, 1) != "#")) {
            $query .= $sql_line;
            if (preg_match("/;\s*$/", $sql_line)) {
                if (strlen(trim($query)) > 5) {
                    if (!@$db->Query($query))
                        return false;
                }
                $query = "";
            }
        }
    }
    return true;
}

// Returns language key
function lang_key($key)
{
    global $arrLang;
    $output = "";
    
    if (isset($arrLang[$key])) {
        $output = $arrLang[$key];
    } else {
        $output = str_replace("_", " ", $key);
    }
    return $output;
}
?>