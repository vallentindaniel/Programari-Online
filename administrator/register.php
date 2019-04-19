

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

  if(!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true){

    header("location: login.php");

    exit;

}



$functions = new functions();





if ($_SERVER["REQUEST_METHOD"] == "POST") {



    $username = $_POST["username"];

    $password = $_POST["password"];

    $email = $_POST["email"];

    $nume = $_POST["nume"];

    $prenume = $_POST["prenume"];

    $tel = $_POST["tel"];



    $link = $functions->Connect();

       

    $functions->RegisterDoctor($username, $password, $nume, $prenume, $tel, $email);

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

        <li><a href="home.php">Acasa </a></li>

        <li class="active"><a href="register.php">Inregistreaza Doctor<span class="sr-only">(current)</span></a></li>

        <li><a href="users.php">Gestioneaza Utilizatori</a></li>

        <li><a href="doctors.php">Gestioneaza Doctori</a></li>

        <li><a href="logout.php">Logout</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>



</div>





<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<div class="container">

<div class="input-group input-group-lg">

  <span class="input-group-addon">Username</span>

  <input type="text" name = "username" class="form-control" placeholder="Username">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Parola</span>

  <input type="password" name = "password" class="form-control" placeholder="Parola">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Email</span>

  <input type="text" name = "email" class="form-control" placeholder="Email">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Nume</span>

  <input type="text" name = "nume" class="form-control" placeholder="Nume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Prenume</span>

  <input type="text" name = "prenume" class="form-control" placeholder="Prenume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Telefon</span>

  <input type="text" name = "tel" class="form-control" placeholder="Telefon">

</div><br>

<input type="submit" class="btn btn-default" value="Inregistrare">

</div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>



</html>