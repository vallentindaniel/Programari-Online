<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'alexdumi_user');
define('DB_PASSWORD', '#7X?@qUZ38-H&Dh~');
define('DB_NAME', 'alexdumi_data');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

function saptamana($z){
 /* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'alexdumi_user');
define('DB_PASSWORD', '#7X?@qUZ38-H&Dh~');
define('DB_NAME', 'alexdumi_data');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
  $sql = "SELECT id, ziua FROM `zile_sapt` WHERE `id` > '$z'";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<th>'.$row["ziua"].'</th>';

                   echo $sp;
                   }                
                   }
   $sql = "SELECT id, ziua FROM `zile_sapt` WHERE `id` <= '$z'";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<th>'.$row["ziua"].'</th>';

                   echo $sp;
                   }                
                   }
}

$mysqli = new mysqli("localhost", "alexdumi_user", "#7X?@qUZ38-H&Dh~", "alexdumi_data");
if($mysqli->connect_error) {
  exit('Could not connect');
}


?>