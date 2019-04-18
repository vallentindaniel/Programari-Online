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


    //Nu ma pricep prea bine , cred ca puteau fi setate variabilele astea direct din form fara sa le scriu aici
    //De testat daca parolele se potrivesc (Parola/Confirma parola)
    //De schimbat formatul de la data nasterii
    /*In functions.php o sa mai umblu eu pentru afisarea erorilor , o sa dau un return cu eroarea daca e cazul ( $error = $functon->Register())
    In function Register() sa dau $error = "Eroare"
    */
    //Se mai poate lucra la interfata , ceva cu boostrap , sper sa facem ceva mai ok pana saptamana viitoare
    //Modificarea mesajelor din Register.php si de aici din login , sa apara mai ok cand te inregistrezi/loghezi
    //Welcome.php trebuie refacut tot , sa facem ce am vorbit
   

    // Am modificat in functins.php si index.php te rog nu mai modifica codul. abia am reusit sa-l fac sa nu mai dea erori si sa mearga
    // modificarea de la functia Login prin parametrul $tabel iti permite sa refolosesti functia si la alte conecari
    // atat ca trebuie modificat numele $_SESSION["loggedin"] pentru a nu se loga de pe un cont pe altul 
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $nume = $_POST["nume"];
    $prenume = $_POST["prenume"];
    $tel = $_POST["tel"];
    $data = $_POST["data"];
    $functions->Register($username, $password, $email, $nume, $prenume, $data, $tel);
   
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
        <li ><a href="index.php">Acasa </a></li>
        <li ><a href="index.php">Login </a></li>
        <li class="active"><a href="#">Inregistrare <span class="sr-only">(current)</span></a></li>
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
  <span class="input-group-addon">Username</span>
  <input type="text" name = "username" class="form-control" placeholder="Username">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Parola</span>
  <input type="text" name = "password" class="form-control" placeholder="Parola">
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
<div class="input-group input-group-lg">
  <span class="input-group-addon">Data nasterii</span>
  <input type="date" name = "data" class="form-control" placeholder="Data nasterii" >
</div><br>
<input type="submit" class="btn btn-default" value="Inregistrare">
<a href="http://89.34.100.127/index.php" class="btn btn-info" role="button">Esti deja inregistrat?</a>

 
</div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>