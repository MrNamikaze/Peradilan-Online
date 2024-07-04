<?php

$db_host = "localhost";
$db_user = "mula7126_peradilan";
$db_pass = "Mulatama_2023";
$db_name = "mula7126_peradilan";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}

?>