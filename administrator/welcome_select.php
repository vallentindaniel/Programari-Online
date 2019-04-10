<?php
require_once "config.php";
$mysqli = new mysqli("localhost", "root", "", "tfop");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT id, nume_jud
FROM judete WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $nume_jud);
$stmt->fetch();
$stmt->close();

$sqll =  "SELECT id,id_jud, nume_loc
FROM localitati WHERE id_jud ='$id' ";
 $result = $link->query($sqll);
 if ($result->num_rows > 0){
 	
  echo "<form>"; 
  echo "<b>Lista localitati:</b>";	
  echo "<select  name="."localitati"." onchange="."showCustomerr(this.value)".">";
  echo "<option>Click-me</option>";
 while ($row = $result->fetch_assoc()) {
                  $tabel = ' <option value="'. $row["id"].'">'. $row["nume_loc"].'</option>';     
                   echo $tabel;
  }
  echo "</select>";
  echo "</form>";
}
echo "<br>";
echo "<div id="."txtHintt"."></div>";
?>
