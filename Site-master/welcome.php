<?php
session_start();
error_reporting(0);
include ("functions.php");
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
  <div class="col-sm">
    <div class="container">
                <ul class="nav nav-tabs">
                    <li><a  href="index.php">Home</a></li>
                    <li><a  href="logout.php" >Deconecteaza-te</a></li>
                </ul>

      <div class="tab-content">
                    

<!-- cod div 3            -->
    <div class="col-sm-4 col-xs-12">
            <div class="panel panel-default text-center">
                    <div class="panel-heading">
                       <legend>Formular</legend>
                       <b>Datele din formular vor apartine strict persoanei ce se prezinta la spital</b>
                    </div>
                   <div class="panel-body">
  <table class=" table-bordered table">
      <tbody>
         <tr>
           <td>Nume:</td>
           <td><input type="text" name="nume" placeholder="EX:Ionescu"></td>
         </tr>
         <tr>
           <td>Prenume:</td>
           <td><input type="text" name="prenume" placeholder="EX:Cristina"></td>
         </tr>
         <tr>
           <td>Data nasterii:</td>
           <td>
             <table>
          <td>
             <select name="data_an">
              <?php                      //// DATA NASTERII: AN
                $m_an=date("Y") - 1;
                while ($m_an >= date("Y")-100) {
                  $sell = '<option value ="'.$m_an.'">'.$m_an.'</option>';
                  echo $sell;
                  $m_an = $m_an - 1;  
                }
               ?>
             </select>
          </td>
          <td>
            <select name="data_luna" onchange="zile_luna(this.value)">
                <?php  
                  $functions = new functions();
                  $functions->data(); 

               ?>
             </select>
          </td>   
          <td>   
             <div id="nastere">
              <?php
                  
              ?>
              <select name="data_zi">
                 <?php

                  $xd = 1;                       // cod pentru afisare zile din luna ianuarie
                  while ($xd <= 31) {
                    $m_lu = '<option value="'.$xd.'">'.$xd.'</option>';
                    echo $m_lu;
                    $xd = $xd + 1;
                  }
                 ?>
               </select>
             </div>
            
          </td>
          
             </table>
           </td>
         </tr>
         <tr>
           <td>Telefon:</td>
           <td><input type="text" name="nr_tel" placeholder="Ex:0725359566" ></td>
         </tr>
         <tr>
           <td>
              <input type="submit" value="Submit">
           </td>
         </tr>         
     </tbody>
  </table>
 
                  </div>
        <div class="panel-footer">

        </div>
      </div>      
    </div>   
               
      </div>
    </div>
  </div>
</form> 

<script src="script.js"></script>
</body>
</html>