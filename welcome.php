<?php
session_start();
error_reporting(0);
require_once "config.php";
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



require_once "config.php";
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
                    <li><a  href="me.php">Programari</a></li>
                </ul>

      <div class="tab-content">
                    
  
                
             <legend>
	              <h1>Bun venit:<?php print($_SESSION["username"]); ?></h1>
                <h2>Aici puteti face programari online la un spital la alegere din lista cu filtre</h2> 
             </legend>

             <!-- cod div 1            -->
        <div class="col-sm-4 col-xs-12">
          <div class="panel panel-default text-center">
            <div class="panel-heading">
                <h2>Filtre</h2>
            </div>
            <div class="panel-body">
               
  <div>  
    <form action=""> 
      <b>Lista judete:</b>  
      <select name="judete" onchange="showCustomer(this.value)">
        <option value="">Click-me:</option>
        <?php                                                     // cod afisare lista judete
    $sql = "SELECT id, nume_jud FROM judete";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   $sp = '<option value="'.$row["id"].'">'.$row["nume_jud"].'</option>';

                   echo $sp;
                   }                
                   }
                                 // COD PENTRU SALVARE DATE SPITAL SI SECTIE DIN CADRU SPITAL
  
         ?>
      </select>
    </form>
<br>

                  <div id="txtHint">
                    
                  </div>
</div>    
        </div>
        <div class="panel-footer">
         <!-- Continut suplimentar  -->
        </div>
      </div>      
    </div> 




<!-- cod div 2            -->
    
<div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h4>Programarea se face prin completarea tuturor cerintelor:...</h4>
        </div>
        
         <b>Selectati o zi</b>
          <legend>7-DAYS</legend>
  
       <table class=" table-bordered table" >
    <thead>
      <tr>
  <?php
require_once "config.php";

if (date("l")=="Monday") {
  $x = "Luni";
   saptamana(0);  
}
else if (date("l")=="Tuesday") {
  $x="Marti";
   saptamana(1);  
}
else if (date("l")=="Wednesday") {
  $x="Miercuri";
   saptamana(2);  
}
else if (date("l")=="Thursday") {
  $x="Joi";
   saptamana(3);  
}
else if (date("l")=="Friday") {
  $x="Vineri";
   saptamana(4);  
}
else if (date("l")=="Saturday") {
  $x="Sambata";
   saptamana(5);  
}
else if (date("l")=="Sunday") {
  $x="Duminica";
   saptamana(6);           
}

session_start();
$_SESSION["x"] = $x;

$zi_curenta=(date(d)*10)/10;

  $zi = $zi_curenta;
  $luna = date(m);
  $an = date(Y);
echo "
 </tr>
    </thead>
 <tbody>
      <tr>";
 
   
    $d=date(m);
    $sql = "SELECT id, nr_zile FROM lunile_anului WHERE id = '$d' ";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                    $nr_zile = $row["nr_zile"];
                   }                
                   }


  $nr = 1;

if ($zi+6 <= $nr_zile and $nr <= 7) {
  while ( $nr <= 7) {
    echo "<td>".$zi."<input type="."radio"." name="."zi_sel"." value=".$zi."></td>";
    $nr = $nr + 1;
    $zi = $zi + 1;
  }
}

else if ($zi+6 > $nr_zile and $nr <= 7) {
  while ( $zi <= $nr_zile and $nr <= 7) {
    echo "<td>".$zi."<input type="."radio"." name="."zi_sel"." value=".$zi."></td>";
    $nr = $nr + 1;
    $zi = $zi + 1;
  }

}
if($nr < 7){

$zi1 = 1;
  while ( $nr <= 7 ) {
    echo "<td>".$zi1."<input type="."radio"." name="."zi_sel"." value=".$zi1."></td>";
    $nr = $nr + 1;
    $zi1 = $zi1 + 1;
  }

}

$zi_curenta=(date(d)*10)/10;
$zi = $zi_curenta;

if ( $_GET["zi_sel"] >= $zi and $_GET["zi_sel"] <= $nr_zile ) {  // COD PENTRU SALVARE VALOARE ZI/ORA/LUNA  PENTRU PROGRAMARI
    $luna_sel = date(m);      // ziua selectata este din luna curenta
    $an_sel = date(Y);           
  }

else{                               // ziua selectata nu este din luna curenta
      if ( date(m) == 12 ){
         $luna_sel = 1;                // decembrie --> ianuarie,an+1;
         $an_sel = date(Y) + 1;
      }
      else{                          // rezulta luna+1
         $luna_sel = date(m)+1;
         $an_sel = date(Y);
      }
}


 ?>
      </tr>    
    </tbody>
  </table>
    <div class="panel-footer">
<?php
echo "Astăzi este: ".$x.' '. date("d.m.Y") . "<br>";
?>
        </div>
        </div>

       
           
    </div> 

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
                    require_once "config.php";

                   $sql = "SELECT id, nr_zile, luna FROM `lunile_anului`";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                  $m_luna = '<option value="'.$row['luna'].'">'.$row['luna'].'</option>';
                    echo $m_luna;
                   }                
                   }

               ?>
             </select>
          </td>   
          <td>   
             <div id="nastere">
              <select name="data_zi">
                 <?php
                  $xd = 1;
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

<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {

$judet = $_GET["judete"];
$localitate = $_GET["localitati"];

if(empty(trim($_GET["spital"]))){
                     $spital_err = "Te rog selecteaza un spital.";
              }
                    else{
                   $spital = $_GET["spital"];
              }
if(empty(trim($_GET["sectii"]))){
                     $sectie_err = "Te rog selecteaza o sectie.";
              }
                    else{
                   $sectie = $_GET["sectii"];
              } 
if(empty(trim($_GET["zi_sel"]))){                                         ///
                     $zi_err = "Te rog selecteaza o zi.";
              }
                    else{
                    $zi_sel = $_GET["zi_sel"];  
              }
if(empty(trim($_GET["nume"]))){
                     $nume_err = "Te rog introdu numele.";
              }
                    else{
                  $nume = $_GET["nume"];
              } 
                if ($nume["0"] == 'a'  ) 
                $nume["0"] = 'A';

              if ($nume["0"] == 'b'  ) 
                $nume["0"] = 'B';

              if ($nume["0"] == 'c'  ) 
                $nume["0"] = 'C';

              if ($nume["0"] == 'd'  ) 
                $nume["0"] = 'D';

              if ($nume["0"] == 'e'  ) 
                $nume["0"] = 'E';

              if ($nume["0"] == 'f'  ) 
                $nume["0"] = 'F';

               if ($nume["0"] == 'g'  ) 
                $nume["0"] = 'G';

              if ($nume["0"] == 'h'  ) 
                $nume["0"] = 'H';

              if ($nume["0"] == 'i'  ) 
                $nume["0"] = 'I';

              if ($nume["0"] == 'j'  ) 
                $nume["0"] = 'J';

              if ($nume["0"] == 'k'  ) 
                $nume["0"] = 'K';

              if ($nume["0"] == 'l'  ) 
                $nume["0"] = 'L';

               if ($nume["0"] == 'm'  ) 
                $nume["0"] = 'M';

              if ($nume["0"] == 'n'  ) 
                $nume["0"] = 'N';

              if ($nume["0"] == 'o'  ) 
                $nume["0"] = 'O';

              if ($nume["0"] == 'p'  ) 
                $nume["0"] = 'P';

              if ($nume["0"] == 'q'  ) 
                $nume["0"] = 'Q';

              if ($nume["0"] == 'r'  ) 
                $nume["0"] = 'R';

              if ($nume["0"] == 's'  ) 
                $nume["0"] = 'S';

              if ($nume["0"] == 't'  ) 
                $nume["0"] = 'T';

              if ($nume["0"] == 'u'  ) 
                $nume["0"] = 'U';

              if ($nume["0"] == 'v'  ) 
                $nume["0"] = 'V';

              if ($nume["0"] == 'w'  ) 
                $nume["0"] = 'W';

              if ($nume["0"] == 'x'  ) 
                $nume["0"] = 'X';
              
              if ($nume["0"] == 'y'  ) 
                $nume["0"] = 'Y';

              if ($nume["0"] == 'z'  ) 
                $nume["0"] = 'Z';
              
     


if(empty(trim($_GET["prenume"]))){
                     $prenume_err = "Te rog introdu prenumele.";
              }
                    else{
                   $prenume = $_GET["prenume"];
              } 

              if ($prenume["0"] == 'a'  ) 
                $prenume["0"] = 'A';

              if ($prenume["0"] == 'b'  ) 
                $prenume["0"] = 'B';

              if ($prenume["0"] == 'c'  ) 
                $prenume["0"] = 'C';

              if ($prenume["0"] == 'd'  ) 
                $prenume["0"] = 'D';

              if ($prenume["0"] == 'e'  ) 
                $prenume["0"] = 'E';

              if ($prenume["0"] == 'f'  ) 
                $prenume["0"] = 'F';

               if ($prenume["0"] == 'g'  ) 
                $prenume["0"] = 'G';

              if ($prenume["0"] == 'h'  ) 
                $prenume["0"] = 'H';

              if ($prenume["0"] == 'i'  ) 
                $prenume["0"] = 'I';

              if ($prenume["0"] == 'j'  ) 
                $prenume["0"] = 'J';

              if ($prenume["0"] == 'k'  ) 
                $prenume["0"] = 'K';

              if ($prenume["0"] == 'l'  ) 
                $prenume["0"] = 'L';

               if ($prenume["0"] == 'm'  ) 
                $prenume["0"] = 'M';

              if ($prenume["0"] == 'n'  ) 
                $prenume["0"] = 'N';

              if ($prenume["0"] == 'o'  ) 
                $prenume["0"] = 'O';

              if ($prenume["0"] == 'p'  ) 
                $prenume["0"] = 'P';

              if ($prenume["0"] == 'q'  ) 
                $prenume["0"] = 'Q';

              if ($prenume["0"] == 'r'  ) 
                $prenume["0"] = 'R';

              if ($prenume["0"] == 's'  ) 
                $prenume["0"] = 'S';

              if ($prenume["0"] == 't'  ) 
                $prenume["0"] = 'T';

              if ($prenume["0"] == 'u'  ) 
                $prenume["0"] = 'U';

              if ($prenume["0"] == 'v'  ) 
                $prenume["0"] = 'V';

              if ($prenume["0"] == 'w'  ) 
                $prenume["0"] = 'W';

              if ($prenume["0"] == 'x'  ) 
                $prenume["0"] = 'X';
              
              if ($prenume["0"] == 'y'  ) 
                $prenume["0"] = 'Y';

              if ($prenume["0"] == 'z'  ) 
                $prenume["0"] = 'Z';

$data_an = $_GET["data_an"];
$data_luna = $_GET["data_luna"];
$data_zi = $_GET["data_zi"];

if(empty(trim($_GET["nr_tel"]))){
                     $nr_tel_err = "Te rog introdu numarul de telefon.";
              }
                    else {
                  $nr_tel =  $_GET["nr_tel"];
              } 
/////////////////////////////////////////////////
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
if(empty(trim($_GET["zi_sel"]))){                                         
                     $zi_err = "Te rog selecteaza o zi.";
              }
                    else{
                    $zi_sel = $_GET["zi_sel"];  
              }
if(empty($zi_err)){
 $ora_rom = date("H") + 2;  // Ora  curenta din Romania
$sql =" SELECT   ora_select, zi_select, luna_select 
FROM `programari`
WHERE  (zi_select = '$zi_sel') and (luna_select = '$luna_sel') ";
                   $result = $link->query($sql);             
                   if ($result->num_rows > 0){                  
                       while ($row = $result->fetch_assoc()) {    
                          
                   }
                 }
                   

}
}

/////////////////////////////////////////////////
if(empty($spital_err) && empty($sectie_err) && empty($nume_err) && 
   empty($prenume_err) && empty($_tel_err) && ($k == 0) ){

 $ora_rom = date("H") + 2 ;                  // Ora  curenta din Romania

$sql =" SELECT  id_spital, id_sectie, ora_select, zi_select, luna_select, an_select 
FROM `programari`
WHERE (id_spital ='$spital') 
and (id_sectie = '$sectie') 
and (zi_select = '$zi_sel') 
and (luna_select = '$luna_sel')
and (an_select = '$an_sel')
 ";
                   $result = $link->query($sql);             //  echo ;
                   if ($result->num_rows > 0){                   // sunt programari            
                    $nr_programari = 0;
                       while ($row = $result->fetch_assoc()) {    
                      $ora_se = $row["ora_select"];  

                       if ($zi_sel == ( date(d)*10 )/10) {   
                               if ($ora_se <= $ora_rom ) 
                                    $ora_sel = $ora_rom + 2 ;
                                    else
                                     $ora_sel = $row["ora_select"] + 1 ;
                                                              
                        }
                        else
                        {                                     
                          $ora_sel = $row["ora_select"] + 1 ;
                        }                              
                       if ($ora_se > $ora_rom ) 
                       {
                            $ora_sel = $ora_se + 1 ;                          
                       }    
                   }
                }

            else{                                       
                    if (8 <= $ora_rom and $zi_sel == ( date(d)*10 )/10 ) {     
                            $ora_sel = $ora_rom + 2 ;                                   
                    }
                    else if (8 > $ora_rom and $zi_sel == ( date(d)*10 )/10 ) {  
                            $ora_sel = 8 ;                          
                    }
                    else
                      $ora_sel = 8;                                          
                   }

                

if ($ora_sel >= 17) {        // SA ATINS NUMARUL MAXIM DE PROGRAMARI
	echo "
<legend>
Nu se mai pot face programari pentru ziua '".$zi_sel."' la sectia din cadrul spitalului selectat.
</legend>
<legend>
Va rugam selectatati: <a  href="."welcome.php".">Refrash</a> si selectatati ziua urmatoare.Multumin!
</legend>
";
	die();
}


$sql =" SELECT   id, id_spital, sectia, id_doctor 
FROM `sectii`
WHERE  id = '$sectie' ";
                   $result = $link->query($sql);             
                   if ($result->num_rows > 0){                  
                       while ($row = $result->fetch_assoc()) {    
                      $id_doctorr = $row["id_doctor"]  ;   
                   }
                 }








session_start();
$id_ses = $_SESSION["id"];
                  $sql = "
INSERT INTO programari( id_jud,id_loc, id_spital, id_sectie, ora_select, zi_select, luna_select, an_select, nume,
            prenume, data_zi, data_luna, data_an, telefon, id_sesiune, id_doctor)
VALUES
('$judet', '$localitate', '$spital', '$sectie', '$ora_sel', '$zi_sel', '$luna_sel', '$an_sel',
 '$nume', '$prenume', '$data_zi', '$data_luna', '$data_an', '$nr_tel', '$id_ses','$id_doctorr')";// $zi_sel, $luna_sel, $an_sel
                  $result = $link->query($sql);                
                  $link->close();

                echo '<script type="text/javascript">
                           window.location.replace("http://89.34.100.127/tfop/me.php");
                      </script>';
                }
else{
   $text_err = "Va rugam completati toate campurile!";
echo '<script type="text/javascript">
  alert("'.$text_err.'");
  </script>';
 
   $textt_err = "#Click Programari pentru lista programari";
echo '<script type="text/javascript">
  alert("'.$textt_err.'");     
  </script>';
  
  
}                

     // https://stackoverflow.com/questions/768431/how-to-make-a-redirect-in-php

}


?>

<script>
  // cod pentru select filtru
function showCustomer(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "welcome_select.php?q="+str, true);
  xhttp.send();
}


// efarsit cod select filtru
function showCustomerr(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHintt").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHintt").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "welcome_select_sp.php?q="+str, true);
  xhttp.send();
}


function showCustomerrr(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("txtHinttt").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHinttt").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "welcome_select_sectia.php?q="+str, true);
  xhttp.send();
}

 function zile_luna(str) {
  var xhttp;  
  if (str == "") {
    document.getElementById("nastere").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("nastere").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "index_data.php?q="+str, true);
  xhttp.send();
}
</script>
</body>
</html>