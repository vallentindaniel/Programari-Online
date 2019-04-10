<?php
error_reporting(0);
session_start();
require_once "config.php";
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
}

$data_l = (date("d")*10)/10;
$oral_l = date("H") + 2 ;
$sql = "DELETE FROM programari WHERE zi_select = '$data_l' and ora_select < '$oral_l'";
if (mysqli_query($link, $sql)) {
    echo "";
} else {
    echo "" ;
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
	<div class="col-sm">

		<div class="container">

								<ul class="nav nav-tabs">
										<li><a  href="welcome_j.php">Home</a></li>
										<li><a  href="logout.php" >Deconecteaza-te</a></li>
										<li><a  href="me.php">Programari</a></li>
								</ul>

			<div class="tab-content">
										
	
								
						 <legend>
								<h1>Bun venit:<?php print($_SESSION["username"]); ?></h1>
								<h2>Lista programari </h2> 

						 </legend>

						 <!-- cod div 1            -->
				<div class="col-sm-12 col-xs-12">
					<div class="panel panel-default text-center">
						<div class="panel-heading">

						</div>
						<div class="panel-body">
							 
	 <table class=" table table-bordered" >
		<thead>
			<tr>
				<th>Judet</th>
				<th>Localitate</th>
				<th>Spital</th>
				<th>Secție</th>
				<th>Ora</th>
				<th>zi/luna/an</th>
				<th>Nume</th>
				<th>Prenume</th>
				<th>Data Nașterii</th>
				<th>Nr Telefon</th>
		 </tr>
		</thead>
		<tbody>
				<?php            //https://www.dofactory.com/sql/join
$idd = $_SESSION["id"];


           $sql = "
SELECT nume_jud, nume_loc, nume_sp, sectia, ora_select, zi_select, luna_select, an_select, nume, 
       prenume, data_zi, data_luna, data_an, telefon
FROM programari 
 JOIN judete           ON judete.id         =  programari.id_jud
 JOIN localitati       ON localitati.id     =  programari.id_loc
 JOIN spitale          ON spitale.id        =  programari.id_spital  
 JOIN sectii           ON sectii.id         =  programari.id_sectie 
WHERE 1 ";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   
$tabel = '<td>'. $row["nume_jud"].'</td>
          <td>'. $row["nume_loc"].'</td>
          <td>'. $row["nume_sp"].'</td>
          <td>'. $row["sectia"].'</td>
          <td>'. $row["ora_select"].'</td>
          <td>'. $row["zi_select"].'/'. $row["luna_select"].'/'. $row["an_select"].'</td>
          <td>'. $row["nume"].'</td>
          <td>'. $row["prenume"].'</td>
          <td>'. $row["data_zi"].'/'. $row["data_luna"].'/'. $row["data_an"].'</td>
          <td>'. $row["telefon"].'</td>                
                            <tr></tr>';
echo $tabel;               
                   }                
                   }
			?>   
		</tbody>
	</table>


				</div>
				<div class="panel-footer">
				 <!-- Continut suplimentar  -->
				 <?php
                   echo "Astăzi este: ". date("d.m.Y") . "<br>";
                   echo "Ora ". date("H") . "<br>";
                 ?> 
				</div>
			</div>      
		</div> 

</div>
</div>
</div>.
</body>
</html>