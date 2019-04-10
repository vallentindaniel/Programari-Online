<?php
require_once "config.php";
$mysqli = new mysqli("localhost", "root", "", "tfop");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT id, nr_zile, luna FROM `lunile_anului` WHERE luna = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id,$nr_zile, $luna);
$stmt->fetch();
$stmt->close();
                $m_zi = 1;
                echo "<select name = "."data_zi".">";
                while ($m_zi <= $nr_zile ){
                  $sell = '<option value ="'.$m_zi.'">'.$m_zi.'</option>';
                  echo $sell;
                  $m_zi = $m_zi + 1;  
                }
                echo "</select>";              
?>