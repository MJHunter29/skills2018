<?php
function conecta(){
    $host = "bbdd.balearskills17.org";
    $user = "ddb118667";
    $password = "n9SCPgAIDz";
    $bbdd = "ddb118667";
    $mysqli = new mysqli($host,$user,$password,$bbdd);
    if (!$mysqli){
        die("error con la conexion");
    }
    $mysqli ->set_charset("utf8");
    return $mysqli;
}

?>