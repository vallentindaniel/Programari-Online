<?php
session_start();
error_reporting(0);
require_once "config.php";
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page

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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">



  <div class="col-sm">
    <div class="container">
                <ul class="nav nav-tabs">
                    
                    <li><a  href="logout.php">Deconecteaza-te</a></li>
                    <li><a  href="me.php">Structura</a></li>
                    <li><a  href="welcome_j.php">Judete</a></li>
                    <li><a  href="welcome_l.php">Localitați</a></li>
                    <li><a  href="welcome_s.php">Spitale</a></li>
                    <li><a  href="welcome_se.php">Sectii</a></li>
                    <li><a  href="welcome_d_s.php">Doctori-spitale</a></li>
                    <li><a  href="welcome_d_c.php">Doctori-cabinete</a></li>

                </ul>

      <div class="tab-content">
                
             <legend>
	              <h1>Bun venit domnul administrator:<?php print($_SESSION["username"]); ?></h1>
                <h2>Aici puteti introduce noi judete</h2> 
             </legend>
<!-- cod div 1            -->
    <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                    <div class="panel-heading">
                       <legend>Judete noi</legend>
                       <b>Scrie judetul nou si salveaza</b>
                    </div>
                   <div class="panel-body">
                     
  <table class=" table-bordered table">
      <tbody><tr>
        <td>
          <?php
          $nume = $_SESSION["num"];
          $l = intval($nume);
         
           
           echo ord(strtolower($nume["0"]));
          ?>
        </td>
      </tr>
         <tr>
           <td>Judet nou:</td>
           <td><input type="text" name="judet_nou"></td>
         </tr>
         <tr>
           <td>
              <input type="submit" value="Salveaza">
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
if ($_SERVER["REQUEST_METHOD"] == "GET") {

//////////////////////////////////////////
if(empty(trim($_GET["judet_nou"]))){
                     $jud_nou_err = "Te rog scrie un judet.";
              }
                    else{
                   $_SESSION["num"] = $_GET["judet_nou"];
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









