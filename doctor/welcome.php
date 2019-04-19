<?php

  require_once "config.php";

  include ("functions.php");

  //pentru debug

  ini_set('display_errors', 1);

  ini_set('display_startup_errors', 1);

  error_reporting(E_ALL);

  session_start();

 if(!isset($_SESSION["doctor"]) || $_SESSION["doctor"] !== true){

    header("location: home.php");

    exit;

}

$functions = new functions();

$link = $functions->Connect();

if ($_SERVER["REQUEST_METHOD"] == "GET") {

  if(isset($_GET['ora'])){

      $ora = $_GET['ora'];

  }

  if(isset($_GET['mod'])){

      $mod = $_GET['mod'];

  }

if (isset($_GET['ora']) and isset($_GET['mod'])) {

$sql = "UPDATE programari SET ora = '$ora', Status = 1  WHERE id ='$mod' ";

  $result = $link->query($sql);

}

}

if (isset($_GET['ref'])) {

    $ref = $_GET['ref'];

    $sql = "DELETE FROM programari WHERE id ='$ref' ";
    
      $result = $link->query($sql);
    
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
            .jumbotron {
                background-color: #2E2D88;
                color: white;
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

                        <li class="active"><a href="welcome.php">Acasa<span class="sr-only">(current)</span> </a></li>

                        <li><a href="pacienti.php">Pacienti</a></li>

                        <li><a href="creaza_reteta.php">Reteta</a></li>

                        <li><a href="print.php">Print</a></li>

                        <li><a href="programari.php">Programari</a></li>

                        <li><a href="logout.php">Logout</a></li>

                        <li><a href="contact.php">Contact</a></li>

                    </ul>

                </div>
                <!-- /.navbar-collapse -->

            </div>
            <!-- /.container-fluid -->

        </nav>

        <div class="container-fluid">        

  <div class="col-sm-14 col-xs-12">

    <div class="panel panel-default text-center">

      <div class="panel-heading">

        <h1>Programarile pacientilor pe ziua de astazi</h1>

      </div>


        <div class="container-fluid">

            <table class="table">

                <thead>

                    <tr>

                        <th>Nume</th>

                        <th>Prenume</th>

                        <th>Data</th>

                        <th>Ora</th>

                        <th>Detalii</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

$functions = new functions();

$link = $functions->Connect();

$id = $_SESSION["id"];
$curDate = new DateTime(date('Y-m-d'));
$curDateStr = $curDate->format('Y-m-d');

$sql = "

SELECT id,status, nume, prenume, telefon, data, id_doctor,DATE_FORMAT(ora, '%H:%i') as 'ora' , detalii FROM programari WHERE id_doctor = '$id' AND data='$curDateStr' ";

$result = $link->query($sql);

if ($result->num_rows > 0){                  

  while ($row = $result->fetch_assoc()) {

    if($row["status"] == 1){

      $color = "#85e085";

      $k = 1;

    }

    else{

      $color = "#ff8080";

      $k=0;

    }

    if ($k == 0) {

      $tabel = ' 

        <form  method="GET">

        <tr style = "background-color : '.$color.'">

        <td>'. $row["nume"].'</td>

        <td>'. $row["prenume"].'</td>

        <td>'. $row["data"].'</td>

        <td>'. $row["ora"].'</td>

        <td>'. $row["detalii"].'</td>

        <td>

         <input type="time" name="ora">

        </td>

        <td>

         <button type="submit" name = "mod" value = "'.$row["id"].'">Accepta</button>

        </td>

        <td>

         <button type="submit" name = "ref" value = "'.$row["id"].'">Refuza</button>

        </td>

        </tr>

        </form>

        ';

    }

    else{

       $tabel = ' 

        <tr style = "background-color : '.$color.'">

        <td>'. $row["nume"].'</td>

        <td>'. $row["prenume"].'</td>

        <td>'. $row["data"].'</td>

        <td>'. $row["ora"].'</td>

        <td>'. $row["detalii"].'</td>
        </tr>

        ';

    }

    echo $tabel;               

    }                

}

    ?>

                </tbody>

            </table>

        </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    </body>

    </html>