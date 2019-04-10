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
                    <li><a  href="welcome_j.php">Home</a></li>
                    <li><a  href="logout.php" >Deconecteaza-te</a></li>
                    <li><a  href="reg_d.php">Doctori</a></li>
                </ul>

      <div class="tab-content">
                    
  
                
             <legend>
                <h1>Bun venit:<?php print($_SESSION["username"]); ?></h1>
                <h2>Stabilire relatie Doctor-Sectie</h2> 
             </legend>

             <!-- cod div 1            -->
        <div class="col-sm-10 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-heading">
                <h2>Filtre</h2>
            </div>
            <div class="panel-body">
               
  <div>  
    <form action=""> 
      <b>Lista judete:</b>  
      <select name="judet" onchange="showCustomer(this.value)">
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






<!-- cod div 3            -->
    <div class="col-sm-10 col-xs-12">
            <div class="panel panel-default text-center">
                    <div class="panel-heading">
                       <legend>Formular</legend>
                    </div>
                   <div class="panel-body">
  <table class=" table-bordered table">
      <tbody>
        
         
         <tr>
           <b>Lista Doctori:</b>  
      <select name="doctor">
        <option value="">Click-me:</option>
        <?php                                                     // cod afisare lista judete
    $sql = "SELECT id, username FROM doctori";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<option value="'.$row["id"].'">'.$row["username"].'</option>';

                   echo $sp;
                   }                
                   }
                                 // COD PENTRU SALVARE DATE SPITAL SI SECTIE DIN CADRU SPITAL
  
         ?>
      </select>
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

$judet = $_GET["judet"];
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
if(empty(trim($_GET["doctor"]))){                                         ///
                     $doctor_err = "Te rog selecteaza un doctor.";
              }
                    else{
                    $doctor = $_GET["doctor"];  
              }



if( empty($spital_err) && empty($sectie_err) && empty($doctor_err) ){
                 

                  $sql = "UPDATE sectii 
             SET id_doctor ='$doctor' 
             WHERE id = $sectie";   
                  $result = $link->query($sql);
                  $link->close();

           /*

                echo '<script type="text/javascript">
                           window.location.replace("http://localhost/pr/1/TFOP/tfop/me.php");
                      </script>';
                */





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

 
</script>
</body>
</html>