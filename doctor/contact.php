



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



        <li><a href="logout.php">Logout</a></li>



        <li class="active"><a href="contact.php">Contact<span class="sr-only">(current)</span></a></li>





        <li class="dropdown">



          



          



        </li>



      </ul>



    </div><!-- /.navbar-collapse -->



  </div><!-- /.container-fluid -->



</nav>



</div>





<div class="container">    

<legend>Doctori</legend>  

  <table class="table">

    <thead>

      <tr>

        <th>Nume</th>

        <th>Prenume</th>

        <th>Telefon</th>

        <th>Email</th>

      </tr>

    </thead>

    <tbody>

    <?php

$functions = new functions();

$link = $functions->Connect();

$id = $_SESSION["id"];

$sql = "

SELECT Nume, Prenume,Telefon,Email FROM doctors WHERE 1";

$result = $link->query($sql);

if ($result->num_rows > 0){                  

  while ($row = $result->fetch_assoc()) {

    



    $tabel = ' 

        <tr>

        <td>'. $row["Nume"].'</td>

        <td>'. $row["Prenume"].'</td>

        <td>'. $row["Telefon"].'</td>

        <td>'. $row["Email"].'</td>         

        </tr>';

    echo $tabel;               

    }                

}





    ?>

  </table>



</div>


<div class="container">    

<legend>Cabinet</legend> 
<p1><b>Adresa</b></p1><br>
<p1>Jud.AG, Mun. Pitesti, Strada , Nr.</p1><br>
<p1><b>Numar de telefon</b></p1><br>
<p1>074xxxxxxx</p1><br>
<p1><b>Email</b></p1><br>
<p1>Cabinet@domeniu.com</p1>


 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>

</html>