<?php
require_once "config.php";


$sql = "SELECT id, nume_loc
FROM localitati WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $nume_jud);
$stmt->fetch();
$stmt->close();

$sqll =  "SELECT id,id_loc, nume_sp
FROM spitale WHERE id_loc ='$id' ";
 $result = $link->query($sqll);
 if ($result->num_rows > 0){
 	echo "<b>Lista spitale:</b>";
  echo "<form>"; 	
  echo "<select  name="."spital"." onchange="."showCustomerrr(this.value)".">";
  echo "<option>Click-me</option>";
 while ($row = $result->fetch_assoc()) {
                  $tabel = ' <option value="'. $row["id"].'">'. $row["nume_sp"].'</option>';     
                   echo $tabel;
  }
  echo "</select>";
  echo "</form>"; 
  echo "<br>";
  echo "<div id="."txtHinttt"."></div>";
}
?>
