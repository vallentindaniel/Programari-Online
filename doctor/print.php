<?php

require_once "config.php";

include ("functions.php");

session_start();

 error_reporting(0);

// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["doctor"]) || $_SESSION["doctor"] !== true){
    header("location: home.php");
    exit;
}
$functions = new functions();
$link = $functions->Connect();


if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if(isset($_GET['ret'])){
    $_SESSION["reteta"] = $_GET['ret'];
    echo '<script type="text/javascript">
                           window.location.replace("http://89.34.100.127/doctor/print1.php");
                      </script>'; 
  }
}



?>



<!DOCTYPE html>

<html>

<head>

    

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



<!-- jQuery library -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<!-- Latest compiled JavaScript -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<style>

  #myInput {

  background-image: url('/css/searchicon.png');

  background-position: 10px 10px;

  background-repeat: no-repeat;

  width: 100%;

  font-size: 16px;

  padding: 12px 20px 12px 40px;

  border: 1px solid #ddd;

  margin-bottom: 12px;

}

</style>

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

         <li><a href="pacienti.php">Pacienti</a></li>



        <li><a href="creaza_reteta.php">Reteta</a></li>



        <li class="active"><a href="print.php">Print<span class="sr-only">(current)</span></a></li>

         <li><a href="programari.php">Programari</a></li>

        <li><a href="logout.php">Logout</a></li>    
        <li><a href="contact.php">Contact</a></li>



      </ul>



    </div><!-- /.navbar-collapse -->



  </div><!-- /.container-fluid -->



</nav>
  <br>

  <br><br>
  <div class="col-sm">

    <div class="container">        

      <div class="tab-content">
             <!-- cod div 1            -->

        <div class="col-sm-14 col-xs-12">

          <div class="panel panel-default text-center">

            <div class="panel-heading">

              <h1>Print</h1>

            </div>

            <div class="panel-body">



  <div class="panel-body">            

  <div class="col-sm-3 col-xs-8">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">

<table class=" table table-bordered" id="myTable">

  <thead>

    <tr>

      <th>

        Reteta:

      </th>

      <th>

        <big>

         <select name="ret">
            <?php
            $dif = 0;
             $sql = "SELECT * FROM retete ORDER BY id_reteta DESC";
             $result = $link->query($sql);
            if ($result->num_rows > 0){                  
               while ($row = $result->fetch_assoc()) {
                  if ($dif != $row["id_reteta"]) {
                      $dif = $row["id_reteta"];
                      $sell = ' <option value =" '.$row["id_reteta"].' ">Reteta:'.$row["id_reteta"].'</option>';
                    echo $sell; 
                  }         
                }                
            }

            ?>
          </select>

        </big>

      </th>

     <th>

       <td>

       <button type="submit" class="btn btn-primary">Print</button>

       </td>

     </th> 

    </tr>
  </thead>
</table>
</form>
  </div>            
</div>
<div class="col-sm-8 col-xs-8">



</div>
        </div>
        <div class="panel-footer">
         <!-- Continut suplimentar  -->
        </div>
      </div>      
    </div> 
</div>
</div>
</div>
<script>
  $('input[type="button"]').click(function(e){

   $(this).closest('tr').remove()

})

</script>
</body>

</html>