<?php
  require_once "config.php";
  include ("functions.php");
  
  //pentru debug
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  session_start();
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){
    header("location: login.php");
    exit;
  }
    $functions = new functions();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["btn"];
    $functions->DeleteUser($id);
  
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
        <li><a href="home.php">Acasa</a></li>
        <li><a href="register.php">Inregistreaza Doctor</a></li>
        <li class="active"><a href="users.php">Gestioneaza Utilizatori <span class="sr-only">(current)</span></a></li>
        <li><a href="doctors.php">Gestioneaza Doctori</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="container">      
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Nume</th>
        <th>Prenume</th>
        <th>Data Nasterii</th>
        <th>NrTelefon</th>
      </tr>
    </thead>
    <tbody>
    <?php
$functions = new functions();
$link = $functions->Connect();
$sql = "
SELECT Id, Username, Email, Nume, Prenume, DataNasterii, NrTelefon FROM Users WHERE 1";
$result = $link->query($sql);
if ($result->num_rows > 0){                  
  while ($row = $result->fetch_assoc()) {
    

    $tabel = '
        <tr>
        <td>'. $row["Id"].'</td>
        <td>'. $row["Username"].'</td>
        <td>'. $row["Email"].'</td>
        <td>'. $row["Nume"].'</td>
        <td>'. $row["Prenume"].'</td>
        <td>'. $row["DataNasterii"].'</td>
        <td>'. $row["NrTelefon"].'</td>
        <td><form method="POST"><button name="btn" type="submit" value="'.$row["Id"].'"class="btn btn-danger btn-small">Sterge Cont</button></form></td>        
        <tr></tr></form>';
    echo $tabel;               
    }                
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>