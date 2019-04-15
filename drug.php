<?php
require_once "config.php";
include ("functions.php");
session_start();
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page

        $host = DB_SERVER;
        $user = DB_USERNAME;
        $pass = DB_PASSWORD;
        $db = DB_NAME;
$link = mysqli_connect($host, $user, $pass,$db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nr'])){
      $nr = $_POST['nr'];

      $_SESSION['nr'] = $nr;
       
     
    }


for ($i=0; $i < count($_POST['nume_med']) ; $i++) { 
  $med = $_POST['nume_med'][$i];
  $adm = $_POST['adm'][$i];
  $tm_de = $_POST['timp'][$i];
 if ($med != NULL and $adm != NULL and $tm_de != NULL) {
  $sql = "
INSERT INTO medicamente( medicament, administrare, timp_de)
VALUES ('$med','$adm', '$tm_de')";
                  $result = $link->query($sql);  
echo $med.'  '.$adm.' '.$tm_de;
 }

}


 /*
var_dump($_POST['nume_med']);
var_dump($_POST['adm']);
var_dump($_POST['timp']);
*/

}






?>
<!DOCTYPE html>
<html>
<head>
		
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
	#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}
</style>
<body>
	<br>
	<br><br>
	<div class="col-sm">

		<div class="container">

								
			<div class="tab-content">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
						 <!-- cod div 1            -->
				<div class="col-sm-14 col-xs-12">
					<div class="panel panel-default text-center">
						<div class="panel-heading">
              <h1>Prescriptie medicala</h1>
						</div>
						<div class="panel-body">

  <div class="panel-body">            
  <div class="col-sm-3 col-xs-8">

<table class=" table table-bordered" id="myTable">
  <thead>
    <tr>
      <th>
        Numar medicamente:
      </th>
      <th>
        <big>
          <select name="nr" >
         <?php                      //// DATA NASTERII: AN
               

               $nrr=1;
                while ($nrr <= 10 ){
                  $sell = ' <option value =" '.$nrr.' ">'.$nrr.'</option>';
                  echo $sell;
                  $nrr = $nrr + 1;  
                }
                
          ?>
        </select>
        </big>
      </th>
     <th>
       <td>
         <button>Construieste</button>
       </td>
     </th> 
    </tr>
  </thead>
</table>

  </div>            
</div>

<div class="col-sm-8 col-xs-8">

<table class=" table table-bordered" id="myTable" >
    <thead>
      <tr>
        <th>Medicament:</th>
        <th>Administrare:</th>
        <th>Timp de:</th>
     </tr>
    </thead>
    <tbody>
   <?php
     

      


     if ($_SESSION['nr'] != NULL) {
        $nr = $_SESSION['nr'];
       $n = 0;
     
     while($n < $nr){
       $af = '
         <tr>
      <td>

         <input list="browsers" type="text" name="nume_med[]">
         <datalist id="browsers">';
         echo $af;
                  $sql = "SELECT id,medicament FROM medicament";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<option value="'.$row["id"].'">'.$row["medicament"].'</option>';

                   echo $sp;
                   }                
                   }      
      $ad = '</datalist>
      </td>
      <td>
        <input type="text" name="adm[]">
      </td>
      <td>
       <input type="text" name="timp[]">
      </td>
      
           ';
    echo $ad;
          $n++;;
     
     }
     
     echo '<input type="reset" name="">   </tr>';






    
}
   ?>

  
   


    </tbody>
  </table>


</div>

	 


<div class="container">
  
  <div style="
  position: absolute;
  top: 82%;
  left: 10%;
  transform: translate(-50%, -50%);

  ">Semnatura pacient </div>
  <div style="
  position: absolute;
  top: 82%;
  left: 75%;
  transform: translate(-50%, -50%);

  ">Semnatura si parafa medic </div>
  
</div>

</form>


				</div>
				<div class="panel-footer">
				 <!-- Continut suplimentar  -->
				 <?php
                
                 echo "Data: ". date("d.m.Y") . "<br>";
				 ?>
				</div>
			</div>      
		</div> 

</div>
</div>
</div>

</body>
</html>