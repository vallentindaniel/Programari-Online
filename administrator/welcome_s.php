<?php
session_start();

require_once "config.php";
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="col-sm">
    <div class="container">
                <ul class="nav nav-tabs">
                    <li><a  href="welcome_j.php">Administrare site</a></li>
                    <li><a  href="logout.php" >Deconecteaza-te</a></li>
                    <li><a  href="me.php">Structura</a></li>
                    <li><a  href="welcome_l.php">Localitati</a></li>
                    <li><a  href="welcome_sectie.php">Sectii</a></li>
                </ul>

      <div class="tab-content">
                
             <legend>
	              <h1>Bun venit domnul administrator:<?php print($_SESSION["username"]); ?></h1>
                <h2>Aici puteti introduce spitale noi</h2> 
             </legend>

             <!-- cod div 1            -->
    <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                    <div class="panel-heading">
                       <legend>Formular</legend>
                       <b>Datele din formular vor fi salvate in baza de date</b>
                    </div>
                   <div class="panel-body">
                     
      
    
  <table class=" table-bordered table">
      <tbody>
        <tr>
          <td>
            <b>Lista localitati:</b>  
      <select name="id_loc" >
        <option >Click-me:</option>
        <?php                                             
    $sql = "SELECT id, nume_loc FROM localitati";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<option value="'.$row["id"].'">'.$row["nume_loc"].'</option>';

                   echo $sp;
                   }                
                   }
         ?>
      </select>
          </td>
        </tr>
         <tr>
           <td>Spital:</td>
           <td><input type="text" name="spital"></td>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if(empty(trim($_POST["spital"]))){
                     $spital_err = "Te rog scrie un spital.";
              }
                    else{
                   $spital = $_POST["spital"];
              }
              
                 if(empty(trim($_POST["id_loc"]))){
                     $id_loc_err = "Te rog scrie o localitate.";
              }
                    else{
                  $id_loc =  $_POST["id_loc"];
              }  
                   
             
require_once "config.php";
                if( empty($spital_err) and  empty($id_loc_err) ){
                  $sql = " INSERT INTO spitale ( id_loc, nume_sp ) VALUES ('$id_loc', '$spital') ";    
                  $result = $link->query($sql);
                  $link->close();                
                }
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
</script>
</body>
</html>