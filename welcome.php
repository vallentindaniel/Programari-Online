
<?php
  require_once "config.php";
  include ("functions.php");
  error_reporting(0);
  //pentru debug
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

        $host = DB_SERVER;
        $user = DB_USERNAME;
        $pass = DB_PASSWORD;
        $db = DB_NAME;



if ($_SERVER["REQUEST_METHOD"] == "POST") {


if(empty(trim($_POST["nume"]))){
                     $nume_err = "Te rog introdu numele.";
              }
                    else{
                  $nume = $_POST["nume"];
              }
if(empty(trim($_POST["prenume"]))){
                     $prenume_err = "Te rog introdu prenumele.";
              }
                    else{
                   $prenume = $_POST["prenume"];
              } 
if(empty(trim($_POST["nr_tel"]))){
                     $nr_tel_err = "Te rog introdu numarul de telefon.";
              }
                    else{
                   $nr_tel = $_POST["nr_tel"];
              } 


if(empty(trim($_POST["data"]))){
                     $data_err = "Te rog introdu data.";
              }
                    else {
                  $data = $_POST["data"];
              } 

if(empty(trim($_POST["doctor"]))){
                     $doctor_err = "Te selecteaza un doctor.";
              }
                    else {
                  $doctor =  $_POST["doctor"];
              } 

if(empty(trim($_POST["detalii"]))){
                     $detalii_err = "Te rog scrie detalii";
              }
                    else {
                  $detalii =  $_POST["detalii"];
              } 
$functions = new functions();

 $link = $functions->Connect();
     
if( empty($nume_err) && empty($prenume_err) && empty($nr_tel_err) && empty($data_err) && empty($doctor_err) and empty($detalii_err) ){
 $id_user = $_SESSION["id"];

 $sql = "
INSERT INTO programari( id_user, nume, prenume, telefon, data, id_doctor, detalii)
VALUES('$id_user','$nume', '$prenume', '$nr_tel','$data','$doctor', '$detalii')";
                  $result = $link->query($sql);                
                  $link->close();


   echo '<script type="text/javascript">
                           window.location.replace("http://89.34.100.127/programari.php");
                      </script>';                

}
else if( empty($nume_err) && empty($prenume_err) && empty($nr_tel_err) && empty($data_err) && empty($doctor_err) ){
 $id_user = $_SESSION["id"];

 $sql = "
INSERT INTO programari( id_user, nume, prenume, telefon, data, id_doctor)
VALUES('$id_user','$nume', '$prenume', '$nr_tel','$data','$doctor')";
                  $result = $link->query($sql);                
                  $link->close();

                  echo '<script type="text/javascript">
                           window.location.replace("http://89.34.100.127/programari.php");
                      </script>';
                                                     // http://localhost/tfop/programari.php

}


}







?>
<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

 



<meta http-equiv="X-UA-Compatible" content="IE=edge">

 



<meta name="viewport" content="width = device-width, initial-scale = 1">

<title>Welcome user</title>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

 

<style>

.jumbotron{

    background-color:#2E2D88;

    color:white;

}



.tab-content {

    border-left: 4px solid #ddd;

    border-right: 4px solid #ddd;

    border-bottom: 4px solid #ddd;

    padding: 10px;

}

.nav-tabs {

    margin-bottom: 0;

}

</style>

 

</head>

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

        <li class="active"><a href="#">Acasa <span class="sr-only">(current)</span></a></li>

        <li><a href="programari.php">Programarile mele</a></li>

        <li><a href="logout.php">Logout</a></li>

        <li class="dropdown">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contact <span class="caret"></span></a>

          <ul class="dropdown-menu">

            <li><a href="#">Telefon</a></li>

            <li><a href="#">Email</a></li>

            <li role="separator" class="divider"></li>

            <li><a href="#">Adresa</a></li>

          </ul>

        </li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>

</div>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


<div class="container">

<div class="input-group input-group-lg">

  <span class="input-group-addon">Nume</span>

  <input type="text" class="form-control" placeholder="Nume" name="nume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Prenume</span>

  <input type="text" class="form-control" placeholder="Prenume" name="prenume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Numar de telefon</span>

  <input type="text" class="form-control" placeholder="Telefon" name="nr_tel">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Data</span>
  <input type="date" class="form-control"  name="data">

</div><br>

<div class="form-group">

      <label for="doc">Doctor:</label>

      <select class="form-control" id="doc" name="doctor">

        <option value="">Selecteaza-ma:</option>
        <?php     
        $link =  mysqli_connect($host, $user, $pass, $db);      
    $sql = "SELECT Id, Username FROM doctors";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<option value="'.$row["Id"].'">'.$row["Username"].'</option>';

                   echo $sp;
                   }                
                   }
                                 // COD PENTRU SALVARE DATE SPITAL SI SECTIE DIN CADRU SPITAL
  
         ?>

      </select>

</div><br>

<div class="form-group">

      <label for="details">Detalii:</label>
<?php 
$det = 'EX: Dureri de cap puternice,febra,lipsa poftei de mancare...';

?>
      <textarea class="form-control" rows="5" id="details" name="detalii" <?php echo 'placeholder="'.$det.'"; ' ?>></textarea>

</div><br>
<input type="submit" name="Trimite">
 

</div>

 </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>