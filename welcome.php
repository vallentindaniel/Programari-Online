
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

  $errors = array();
  $required = array("Nume", "Prenume", "Telefon", "Data", "Doctor", "Detalii");  
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
  $nume = $_POST["Nume"];
  $prenume = $_POST["Prenume"];
  $nr_tel = $_POST["Telefon"];
  $data = $_POST["Data"];
  $doctor =  $_POST["Doctor"];
  $detalii =  $_POST["Detalii"];
  $functions = new functions();
  
  $link = $functions->Connect();
       
  $functions->AddProgramare($nume, $prenume, $nr_tel, $data, $doctor, $detalii);
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
<style>
.alert {
   width:5%;
   height:10px;  
}
</style>

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

        <li class="active"><a href="#">Acasa <span class="sr-only">(current)</span></a></li>

        <li><a href="programari.php">Programarile mele</a></li>

        <li><a href="logout.php">Logout</a></li>

        <li><a href="/contact.php">Contact</a></li>

      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>

</div>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


<div class="container">

<div class="input-group input-group-lg">

  <span class="input-group-addon">Nume</span>

  <input type="text" class="form-control" placeholder="Nume" name="Nume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Prenume</span>

  <input type="text" class="form-control" placeholder="Prenume" name="Prenume">

</div><br>

<div class="input-group input-group-lg">

  <span class="input-group-addon">Numar de telefon</span>

  <input type="text" class="form-control" placeholder="Telefon" name="Telefon">

</div><br>

<div class="input-group">
<span class="input-group-addon">Data Programarii</span>
    <div class="input-group-addon">
      <i class="fa fa-calendar">
      </i>
    </div>
    <input class="form-control" id="Data" name="Data" placeholder="DD/MM/YYYY" type="text"/>
</div><br>

<div class="form-group">

      <label for="doc">Doctor:</label>

      <select class="form-control" id="doc" name="Doctor">

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
      <textarea class="form-control" rows="5" id="details" name="Detalii" <?php echo 'placeholder="'.$det.'"; ' ?>></textarea>

</div><br>
<input type="submit" class="btn btn-info" value="Trimite">
 

</div>

 </form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	$(document).ready(function(){
		var date_input=$('input[name="Data"]'); //our date input has the name "date"
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