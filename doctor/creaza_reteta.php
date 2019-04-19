<?php

require_once "config.php";

include ("functions.php");

session_start();

 error_reporting(0);

// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["doctor"]) || $_SESSION["doctor"] !== true){

    header("location: home.php");

    exit;

}

$functions = new functions();
$link = $functions->Connect();

$_SESSION['nr'] = 0;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['nr'])){
          $nr = $_GET['nr'];
          $_SESSION['nr'] = $nr;
        }
  if(isset($_GET['trim'])){
           $ret = 0;   
           $sql = "SELECT * FROM retete";
           $result = $link->query($sql);
          if ($result->num_rows > 0){                  
            while ($row = $result->fetch_assoc()) {
              if ($ret < $row["id_reteta"]) {       
                $ret = $row["id_reteta"] ;         
              }            
            }                
          }
    if(isset($_GET['use'])){
             $id_user = $_GET['use'];
             $id_reteta = $ret + 1;
      for ($i=0; $i < count($_GET['med']) ; $i++) { 
               $med = $_GET['med'][$i];
               $adm = $_GET['adm'][$i];
               $tm_de = $_GET['timp'][$i];
        if ($med != NULL and $adm != NULL and $tm_de != NULL) {
                $sql = "
                INSERT INTO retete( id_reteta,    id_user,      medicament,  administrare,   timp_de)
                VALUES            ('$id_reteta', '$id_user',    '$med',          '$adm',    '$tm_de')";
                $result = $link->query($sql);  
                // echo $med.'  '.$adm.' '.$tm_de;
                echo '<script type="text/javascript">
                           window.location.replace("http://89.34.100.127/doctor/print.php");
                      </script>'; 
        }
      }
    }
  } 
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

<nav class="navbar navbar-default">



  <div class="container-fluid">



    <div class="navbar-header">



      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">



        <span class="sr-only"></span>



        <span class="icon-bar"></span>



        <span class="icon-bar"></span>



        <span class="icon-bar"></span>



      </button>



    </div>



    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">



        <li><a href="welcome.php">Acasa </a></li>
         <li><a href="pacienti.php">Pacienti</a></li>
        <li class="active"><a href="creaza_reteta.php">Reteta<span class="sr-only">(current)</span></a></li>

        <li><a href="print.php">Print</a></li>

        <li><a href="programari.php">Programari</a></li>

        <li><a href="logout.php">Logout</a></li>
        
        <li><a href="contact.php">Contact</a></li>



      </ul>



    </div><!-- /.navbar-collapse -->



  </div><!-- /.container-fluid -->



</nav>
  <br>

  <br><br>
  <div class="col-sm">

    <div class="container">        

      <div class="tab-content">
             <!-- cod div 1            -->

        <div class="col-sm-14 col-xs-12">

          <div class="panel panel-default text-center">

            <div class="panel-heading">

              <h1>Prescriptie medicala</h1>

            </div>

            <div class="panel-body">



  <div class="panel-body">            

  <div class="col-sm-3 col-xs-8">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">

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

                while ($nrr <= 6 ){

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

       <button type="submit" class="btn">Construieste</button>

       </td>

     </th> 

    </tr>
  </thead>
</table>
</form>
  </div>            
</div>
<div class="col-sm-8 col-xs-8">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
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
        <input type="text" name="med[]">
      </td>
      <td>
        <input type="text" name="adm[]">
      </td>
      <td>
       <input type="text" name="timp[]">
      </td>
      <td>
        <input type="button" class="btn btn-danger btn-small" value="X"></input>
      </td>
      </tr> ';
    echo $af;
          $n++;; 
     }   
}
   ?>  
    </tbody>
  </table>

  <table>
    <thead>
      <tr>
        <td>User:</td>
        <td>
          <select name="use">
            <?php
             $sql = "SELECT * FROM Users";
             $result = $link->query($sql);
            if ($result->num_rows > 0){                  
               while ($row = $result->fetch_assoc()) {
                 $sell = ' <option value =" '.$row["Id"].' ">'.$row["Username"].'</option>';
                  echo $sell;          
                }                
            }

            ?>
          </select>
        </td>
      </tr>
    </thead>
  </table>
  <button name="trim" value="1" class="btn btn-primary">Trimite</button>
 </form>
</div>
        </div>
        <div class="panel-footer">
         <!-- Continut suplimentar  -->
        </div>
      </div>      
    </div> 
</div>
</div>
</div>
<script>
  $('input[type="button"]').click(function(e){

   $(this).closest('tr').remove()

})

</script>
</body>

</html>