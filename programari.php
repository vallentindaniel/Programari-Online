

<?php
require_once "config.php";
include ("functions.php");

session_start();
 // error_reporting(0);
//O pagina in care sa arate statusul programariilor curente ale userului
//daca sunt acceptate si la ce ora ei sunt asteptati

 if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false)
  header("location: index.php");

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

        <li><a href="welcome.php">Acasa </a></li>

        <li class="active"><a href="programari.php">Programarile mele<span class="sr-only">(current)</span></a></li>

        <li><a href="logout.php">Logout</a></li>

        <li><a href="/contact.php">Contact</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>

</div>


<div class="container">      
  <table class="table">
    <thead>
      <tr>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Data</th>
        <th>Ora</th>
        <th>Doctor</th>
        <th>Detalii</th>
      </tr>
    </thead>
    <tbody>
    <?php
$functions = new functions();
$link = $functions->Connect();
$id = $_SESSION["id"];
$sql = "
SELECT status, nume, prenume, telefon, data, id_doctor,DATE_FORMAT(ora, '%H:%i') as 'ora' , detalii FROM programari WHERE id_user = '$id' ";
$result = $link->query($sql);
if ($result->num_rows > 0){                  
  while ($row = $result->fetch_assoc()) {
    if($row["status"] == 1)
      $color = "#85e085";
    else
      $color = "#ff8080";

    $tabel = ' 
        <tr style = "background-color : '.$color.'">
        <td>'. $row["nume"].'</td>
        <td>'. $row["prenume"].'</td>
        <td>'. $row["data"].'</td>
        <td>'. $row["ora"].'</td>
        <td>'. $functions->GetDocName($row["id_doctor"]).'</td>
        <td>'. $row["detalii"].'</td>             
        <tr></tr>';
    echo $tabel;               
    }                
}


    ?>


    </tbody>
  </table>
</div>

 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>