<?php
require_once "config.php";
error_reporting(0);
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: welcome.php");
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


    <div class="col-sm">
        <div class="container">
                <ul class="nav nav-tabs">
                    <li><a  href="index.php">Home</a></li>
                    <li><a  href="login.php">Login</a></li>
                    <li><a  href="me.php">Programari</a></li>
                </ul>

                <div class="tab-content">
                    
  
                
<legend>
	<h1>Bun venit!</h1>
    <h2>Aici puteti face programari online la un spital</h2>
    <h3>Va rugam conectativa</h3> 
</legend>

<h5>Plictico-stiri</h5>
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Scanarea PET</h1>
        </div>
        <div class="panel-body">
         <img src="corp-umann.gif" >
        </div>
        <div class="panel-footer">
          <h5>Scanarea PET a unui corp folosind substanta de contrast</h5>
           <h6>Sursa</h6><a href="https://ro.wikipedia.org/wiki/Cronologia_descoperirilor_%C3%AEn_medicin%C4%83">Wikipedia</a>
        </div>
      </div>      
    </div> 

    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h2>Primul stimulator cardiac</h2>
        </div>
        <div class="panel-body">
         <img src="stimulator.jpg" >
        </div>
        <div class="panel-footer">
          <h5>Cunoscut pentru dimensiuni reduse si pentru ca era implantabil</h5>
           <h6>Sursa</h6><a href="https://ro.wikipedia.org/wiki/Cronologia_descoperirilor_%C3%AEn_medicin%C4%83">Wikipedia</a>
        </div>
      </div>      
    </div> 

    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h2>Top 10 descoperiri din lumea medicala</h2>
        </div>
        <div class="panel-body">
         <h6>-Vitaminele</h6>
         <h6>-Teoria Germenilor</h6>
         <h6>-Penicilina</h6>
         <h6>-Vaccinurile</h6>
         <h6>-ADN-ul</h6>
         <h6>-Insulina</h6>
         <h6>...</h6>
        </div>
        <div class="panel-footer">
           <h6>Sursa</h6><a href="https://www.ziaruldesanatate.ro/articole/din-istoria-medicinei/top-10-descoperiri-medicale-care-au-schimbat-lumea/">Ziarul-de-sanatate</a>
        </div>
      </div>      
    </div>   

                         
                    
                </div>
        </div>
    </div>


</body>
</html>