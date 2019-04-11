<?php
require_once "config.php";
session_start();
 //error_reporting(0);
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['sterge'])){
      $id_sterge = $_GET['sterge'];

	    $sql = "DELETE FROM programari WHERE id = '$id_sterge' ";
      $result = $link->query($sql);
 
    }


if(isset($_GET['print'])){

      $_SESSION["id_print"]  = $_GET['print'];
echo '<script type="text/javascript">

                           window.location.replace("http://89.34.100.127/print.php");

                      </script>';

}

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
								<h2>Lista programari </h2> 

						 </legend>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
						 <!-- cod div 1            -->
				<div class="col-sm-14 col-xs-12">
					<div class="panel panel-default text-center">
						<div class="panel-heading">

<input type="text" name="search"  id="myInput" onkeyup="myFunction()" placeholder="Cautare dupa nume..." >
						</div>
						<div class="panel-body">
 							 
	 <table class=" table table-bordered" id="myTable" >
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
$id_were = $_SESSION["id"];

          $sql = "
SELECT nume_jud, nume_loc, nume_sp, sectia, ora_select, zi_select, luna_select, an_select, nume, 
       prenume, data_zi, data_luna, data_an, telefon,id_sesiune,programari.id
FROM programari 
 JOIN judete           ON judete.id         =  programari.id_jud
 JOIN localitati       ON localitati.id     =  programari.id_loc
 JOIN spitale          ON spitale.id        =  programari.id_spital 
 JOIN sectii           ON sectii.id         =  programari.id_sectie 
WHERE 1 ORDER BY programari.id DESC";
                   $result = $link->query($sql);
                   if ($result->num_rows > 0){                  
                   while ($row = $result->fetch_assoc()) {
                   
$tabel = ' 
          <td>'. $row["nume_jud"].'</td>
          <td>'. $row["nume_loc"].'</td>
          <td>'. $row["nume_sp"].'</td>
          <td>'. $row["sectia"].'</td>
          <td>'. $row["ora_select"].'</td>
          <td>'. $row["zi_select"].'/'. $row["luna_select"].'/'. $row["an_select"].'</td>
          <td>'. $row["nume"].'</td>
          <td>'. $row["prenume"].'</td>
          <td>'. $row["data_zi"].'/'. $row["data_luna"].'/'. $row["data_an"].'</td>
          <td>'. $row["telefon"].'</td>  
          <td>
           <button name="sterge" value="'. $row["id"].'" >Sterge</button>
          </td>    
          <td>
           <button name="print" value="'. $row["id"].'" >Print</button>
          </td>             
                            <tr></tr>';
echo $tabel;               
                   }                
                   }
			?>   
		</tbody>
	</table>
</form>


				</div>
				<div class="panel-footer">
				 <!-- Continut suplimentar  -->
				 <?php
                 $x = $_SESSION["x"];
                 echo "Astăzi este: ".$x.' '. date("d.m.Y") . "<br>";
				 ?>
				</div>
			</div>      
		</div> 

</div>
</div>
</div>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];    // 6 este al 7 lea element citit adica nume citirea porneste de la 0
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>