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

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $password = $_POST["password"];
    $functions->Login($username, $password);
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

<div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
            <h1>Login</h1>
        </div>
        <div class="panel-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nume Utilizator</label>
                <input type="text" name="username" class="form-control" >
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Parola</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Logare">
                 <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
        </div>
        <div class="panel-footer">
          
        </div>
      </div>      
    </div> 
                         
                    
                </div>
        </div>
    </div>


</body>
</html>