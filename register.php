<?php

  require_once "config.php";

  include ("functions.php");

  

  //pentru debug

  ini_set('display_errors', 1);

  ini_set('display_startup_errors', 1);

  error_reporting(E_ALL);

  

  session_start();

  // Check if the user is already logged in, if yes then redirect him to welcome page

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

  header("location: welcome.php");

  exit;

  }



  $password_err = "";

  $username_err = "";



  $functions = new functions();



  if ($_SERVER["REQUEST_METHOD"] == "POST") {



    $errors = array();

    $required = array("Username", "Password", "Email", "Nume", "Prenume", "Telefon", "DataNasterii");  

    foreach($_POST as $key=>$value)

    {

        if(!empty($value))

        {

            $$key = $value;

        }

        else

        {

             if(in_array($key, $required))

             {

                 array_push($errors, $key);

             }

        }        

    

    }

    if(empty($errors))

  {

    $username = $_POST["Username"];

    $password = $_POST["Password"];

    $email = $_POST["Email"];

    $nume = $_POST["Nume"];

    $prenume = $_POST["Prenume"];

    $tel = $_POST["Telefon"];

    $data = $_POST["DataNasterii"];

    $functions->Register($username, $password, $email, $nume, $prenume, $data, $tel);

  }

  else

  {

      //display errors

      echo "<ul>";

      echo "<li>Urmatoarele campuri au valori invalide :</li>";

      foreach($errors as $error)

      {

          echo "<li>" . $error . "</li>";

      }

      echo "</ul>";

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

<!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->

<script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>



<!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->

<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />



<!--Font Awesome (added because you use icons in your prepend/append)-->

<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />



<!-- Inline CSS based on choices in "Settings" tab -->

<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>





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

        <li ><a href="index.php">Acasa </a></li>

        <li ><a href="index.php">Login </a></li>

        <li class="active"><a href="#">Inregistrare <span class="sr-only">(current)</span></a></li>

        <li><a href="/contact.php">Contact</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>

</div>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

<div class="container">

<div class="input-group input-group-lg">

  <span class="input-group-addon">Username</span>

  <input type="text" name = "Username" class="form-control" placeholder="Username">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Parola</span>

  <input type="password" name = "Password" class="form-control" placeholder="Parola">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Email</span>

  <input type="text" name = "Email" class="form-control" placeholder="Email">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Nume</span>

  <input type="text" name = "Nume" class="form-control" placeholder="Nume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Prenume</span>

  <input type="text" name = "Prenume" class="form-control" placeholder="Prenume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Telefon</span>

  <input type="text" name = "Telefon" class="form-control" placeholder="Telefon">

</div><br>

<div class="input-group input-group-lg">

<span class="input-group-addon">Data Nasterii</span>

    <div class="input-group-addon">

      <i class="fa fa-calendar">

      </i>

    </div>

    <input class="form-control" id="date" name="DataNasterii" placeholder="DD/MM/YYYY" type="text"/>

</div><br>

<input type="submit" class="btn btn-default" value="Inregistrare">

<a href="http://89.34.100.127/index.php" class="btn btn-info" role="button">Esti deja inregistrat?</a>



 

</div>

</form>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



<script>

	$(document).ready(function(){

		var date_input=$('input[name="DataNasterii"]'); //our date input has the name "date"

		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";

		date_input.datepicker({

			format: 'dd/mm/yyyy',

			container: container,

			todayHighlight: true,

			autoclose: true,

		})

	})

</script>

</body>

</html>