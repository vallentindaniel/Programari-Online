<?php
session_start();
error_reporting(0);
require_once "config.php";
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
function saptamana($z){
 /* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tfop');
 
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


require_once "config.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>TFOP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
  <div class="col-sm">
    <div class="container">
                <ul class="nav nav-tabs">
                    <li><a  href="index.php">Home</a></li>
                    <li><a  href="logout.php" >Deconecteaza-te</a></li>
                    <li><a  href="me.php">Programari</a></li>
                </ul>

      <div class="tab-content">
                    
  
                
             <legend>
	              <h1>Bun venit:<?php print($_SESSION["username"]); ?></h1>
                <h2>Aici puteti face programari online la un spital la alegere din lista cu filtre</h2> 
             </legend>

             <!-- cod div 1            -->
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-heading">
                <h2>Filtre</h2>
            </div>
            <div class="panel-body">
               
  <div>  
    <form action=""> 
      <b>Lista judete:</b>  
      <select name="judete" onchange="showCustomer(this.value)">
        <option value="">Click-me:</option>
        <?php                                                     // cod afisare lista judete
    $sql = "SELECT id, nume_jud FROM judete";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<option value="'.$row["id"].'">'.$row["nume_jud"].'</option>';

                   echo $sp;
                   }                
                   }
                                 // COD PENTRU SALVARE DATE SPITAL SI SECTIE DIN CADRU SPITAL
  
         ?>
      </select>
    </form>
<br>

                  <div id="txtHint">
                    
                  </div>
</div>    
        </div>
        <div class="panel-footer">
         <!-- Continut suplimentar  -->
        </div>
      </div>      
    </div> 




<!-- cod div 2            -->
    
<div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h4>Programarea se face prin completarea tuturor cerintelor:...</h4>
        </div>
        
         <b>Selectati o zi</b>
          <legend>7-DAYS</legend>
  
       <table class=" table-bordered table" >
    <thead>
      <tr>
  <?php
require_once "config.php";

if (date("l")=="Monday") {
  $x = "Luni";
   saptamana(0);  
}
else if (date("l")=="Tuesday") {
  $x="Marti";
   saptamana(1);  
}
else if (date("l")=="Wednesday") {
  $x="Miercuri";
   saptamana(2);  
}
else if (date("l")=="Thursday") {
  $x="Joi";
   saptamana(3);  
}
else if (date("l")=="Friday") {
  $x="Vineri";
   saptamana(4);  
}
else if (date("l")=="Saturday") {
  $x="Sambata";
   saptamana(5);  
}
else if (date("l")=="Sunday") {
  $x="Duminica";
   saptamana(6);           
}

session_start();
$_SESSION["x"] = $x;

$zi_curenta=(date(d)*10)/10;

  $zi = $zi_curenta;
  $luna = date(m);
  $an = date(Y);
echo "
 </tr>
    </thead>
 <tbody>
      <tr>";
 
   
    $d=date(m);
    $sql = "SELECT id, nr_zile FROM lunile_anului WHERE id = '$d' ";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                    $nr_zile = $row["nr_zile"];
                   }                
                   }


  $nr = 1;
if ($zi+7 <= $nr_zile and $nr <= 7) {
  while ( $nr <= 7) {
    echo "<td>".$zi."<input type="."radio"." name="."zi_sel"." value=".$zi."></td>";
    $nr = $nr + 1;
    $zi = $zi + 1;
  }
}
else {
  while ( $zi <= $nr_zile and $nr <= 7) {
    echo "<td>".$zi."<input type="."radio"." name="."zi_sel"." value=".$zi."></td>";
    $nr = $nr + 1;
    $zi = $zi + 1;
  }
}

 if ($nr <=7) {
  $zi1 = 1;
  while ($nr <= 7 ) {
    echo "<td>".$zi."<input type="."radio"." name="."zi_sel"." value=".$zi."></td>";
    $nr = $nr + 1;
    $zi1 = $zi1 + 1;
  }
}
$zi_curenta=(date(d)*10)/10;

  $zi = $zi_curenta;
if ($zi +7>$nr_zile and date(d) > $_GET["zi_sel"]) {
  if (date(m) == 12) {
    $luna_sel = 01;
    $an_sel = date(Y) + 1;
  }
  else{
    $luna_sel = date(m) +1;   
    $an_sel = date(Y);
                                 // COD PENTRU SALVARE VALOARE ZI/ORA/LUNA  PENTRU PROGRAMARI
  }
}
else{
  $luna_sel = date(m);
  $an_sel = date(Y);
}


 ?>
      </tr>    
    </tbody>
  </table>
    <div class="panel-footer">
<?php
echo "Astăzi este: ".$x.' '. date("d.m.Y") . "<br>";
?>
        </div>
        </div>

       
           
    </div> 

<!-- cod div 3            -->
    <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                    <div class="panel-heading">
                       <legend>Formular</legend>
                       <b>Datele din formular vor apartine strict persoanei ce se prezinta la spital</b>
                    </div>
                   <div class="panel-body">
  <table class=" table-bordered table">
      <tbody>
         <tr>
           <td>Nume:</td>
           <td><input type="text" name="nume"></td>
         </tr>
         <tr>
           <td>Prenume:</td>
           <td><input type="text" name="prenume"></td>
         </tr>
         <tr>
           <td>Data nasterii:</td>
           <td>
             <table>
          <td>
             <select name="data_an">
              <?php                      //// DATA NASTERII: AN
                $m_an=date("Y") - 1;
                while ($m_an >= 1900) {
                  $sell = '<option value ="'.$m_an.'">'.$m_an.'</option>';
                  echo $sell;
                  $m_an = $m_an - 1;  
                }
               ?>
             </select>
          </td>
          <td>
            <select name="data_luna" onchange="zile_luna(this.value)">
                <?php  
                    require_once "config.php";

                   $sql = "SELECT id, nr_zile, luna FROM `lunile_anului`";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                  $m_luna = '<option value="'.$row['luna'].'">'.$row['luna'].'</option>';
                    echo $m_luna;
                   }                
                   }

               ?>
             </select>
          </td>   
          <td>   
             <div id="nastere">
              <select name="data_zi">
                 <?php
                  $xd = 1;
                  while ($xd <= 31) {
                    $m_lu = '<option value="'.$xd.'">'.$xd.'</option>';
                    echo $m_lu;
                    $xd = $xd + 1;
                  }
                 ?>
               </select>
             </div>
            
          </td>
          
             </table>
           </td>
         </tr>
         <tr>
           <td>Telefon:</td>
           <td><input type="text" name="nr_tel"></td>
         </tr>
         <tr>
           <td>
              <input type="submit" value="Submit">
           </td>
         </tr>         
     </tbody>
  </table>
 
                  </div>
        <div class="panel-footer">

        </div>
      </div>      
    </div>   

                         
                    
      </div>
    </div>
  </div>
</form> 

<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

$judet = $_GET["judete"];
$localitate = $_GET["localitati"];

if(empty(trim($_GET["spital"]))){
                     $spital_err = "Te rog selecteaza un spital.";
              }
                    else{
                   $spital = $_GET["spital"];
              }
if(empty(trim($_GET["sectii"]))){
                     $sectie_err = "Te rog selecteaza o sectie.";
              }
                    else{
                   $sectie = $_GET["sectii"];
              } 
if(empty(trim($_GET["zi_sel"]))){                                         ///
                     $zi_err = "Te rog selecteaza o zi.";
              }
                    else{
                    $zi_sel = $_GET["zi_sel"];  
              }
if(empty(trim($_GET["nume"]))){
                     $nume_err = "Te rog introdu numele.";
              }
                    else{
                  $nume = $_GET["nume"];
              }
if(empty(trim($_GET["prenume"]))){
                     $prenume_err = "Te rog introdu prenumele.";
              }
                    else{
                   $prenume = $_GET["prenume"];
              } 
$data_an = $_GET["data_an"];
$data_luna = $_GET["data_luna"];
$data_zi = $_GET["data_zi"];

if(empty(trim($_GET["nr_tel"]))){
                     $nr_tel_err = "Te rog introdu numarul de telefon.";
              }
                    else {
                  $nr_tel =  $_GET["nr_tel"];
              } 



if(empty($spital_err) && empty($sectie_err) && empty($nume_err) && 
   empty($prenume_err) && empty($_tel_err) && ($k == 0) ){

 $ora_rom = date("H") + 2 ;                  // Ora  curenta din Romania

$sql =" SELECT  id_spital, id_sectie, ora_select, zi_select, luna_select 
FROM `programari`
WHERE (id_spital ='$spital') and (id_sectie = '$sectie') and (zi_select = '$zi_sel') and (luna_select = '$luna_sel') ";
                   $result = $link->query($sql);             //  echo ;
                   if ($result->num_rows > 0){                  
                       while ($row = $result->fetch_assoc()) {    // sunt programari
                       $ora_se = $row["ora_select"];  // ultima ora selectata dintr_o zi

                       if ($zi_sel == ( date(d)*10 )/10) {   // ziua selectata de user este ziua curenta
                               if ($ora_se <= $ora_rom ) // ultima ora din baza este mai mica sau egala cu ora curenta
                                    $ora_sel = $ora_rom + 2 ;
                                    else{
                        	        $ora_sel = $row["ora_select"] + 1 ;
                                    }                          
                        }
                        else{                                      // nu este ziua curenta
                        	$ora_sel = $row["ora_select"] + 1 ;
                        }                             


                       
                       if ($ora_se > $ora_rom ) {
                            $ora_sel = $ora_se + 1 ;                          
                                                     }     
                   }
                 }




                   else{                                        // nu sunt programari facute

                    if (8 <= $ora_rom and $zi_sel == ( date(d)*10 )/10 ) {      // este ziua curenta
                            $ora_sel = $ora_rom + 2 ;                                   
                    }
                    else if (8 > $ora_rom and $zi_sel == ( date(d)*10 )/10 ) {  // este ziua curenta
                            $ora_sel = 8 ;                          
                    }
                    else
                    	$ora_sel = 8;                                          // nu este ziua curenta
                   }

   

if ($ora_sel >= 19) {        // SA ATINS NUMARUL MAXIM DE PROGRAMARI
	echo "
<legend>
Nu se mai pot face programari pentru ziua '".$zi_sel."' la sectia din cadrul spitalului selectat.
</legend>
<legend>
Va rugam selectatati: <a  href="."welcome.php".">Refrash</a> si selectatati ziua urmatoare.Multumin!
</legend>
";
	die();
}

session_start();
$id_ses = $_SESSION["id"];
                  $sql = "
INSERT INTO programari( id_jud,id_loc, id_spital, id_sectie, ora_select, zi_select, luna_select, an_select, nume,
            prenume, data_zi, data_luna, data_an, telefon, id_sesiune)
VALUES
('$judet', '$localitate', '$spital', '$sectie', '$ora_sel', '$zi_sel', '$luna_sel', '$an_sel',
 '$nume', '$prenume', '$data_zi', '$data_luna', '$data_an', '$nr_tel', '$id_ses')";// $zi_sel, $luna_sel, $an_sel
                  $result = $link->query($sql);                
                  $link->close();

                echo '<script type="text/javascript">
                           window.location.replace("http://localhost/tfop/me.php");
                      </script>';
                }
else{
   $text_err = "Va rugam completati toate campurile!";
echo '<script type="text/javascript">
  alert("'.$text_err.'");
  </script>';
 
   $textt_err = "#Click Programari pentru lista programari";
echo '<script type="text/javascript">
  alert("'.$textt_err.'");     
  </script>';
  
  
}                

     // https://stackoverflow.com/questions/768431/how-to-make-a-redirect-in-php

}


?>

<script>
  // cod pentru select filtru
function showCustomer(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "welcome_select.php?q="+str, true);
  xhttp.send();
}


// efarsit cod select filtru
function showCustomerr(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHintt").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHintt").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "welcome_select_sp.php?q="+str, true);
  xhttp.send();
}


function showCustomerrr(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHinttt").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHinttt").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "welcome_select_sectia.php?q="+str, true);
  xhttp.send();
}

 function zile_luna(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("nastere").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("nastere").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "index_data.php?q="+str, true);
  xhttp.send();
}
</script>
</body>
</html>