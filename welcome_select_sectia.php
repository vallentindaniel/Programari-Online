<?php
require_once "config.php";


$sql = "SELECT id, nume_sp
FROM spitale WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($idd,$nume_sp);
$stmt->fetch();
$stmt->close();

$sqll =  "SELECT id,id_spital, sectia
FROM sectii WHERE id_spital ='$idd' ";
 $result = $link->query($sqll);
 if ($result->num_rows > 0){
 	
  echo "<form>"; 
  echo "<b>Lista sectii:</b>";	
  echo "<select  name="."sectii".">";
  echo "<option>click-me</option>";
 while ($row = $result->fetch_assoc()) {
                  $tabel = ' <option value="'. $row["id"].'">'. $row["sectia"].'</option>';     
                   echo $tabel;
  }
  echo "</select>";
  echo "</form>";
}

?>
