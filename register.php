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
        <li ><a href="localhost/tfop/index.php">Acasa </a></li>
        <li ><a href="localhost/tfop/index.php">Login </a></li>
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

<div class="container">
<div class="input-group input-group-lg">
  <span class="input-group-addon">Username</span>
  <input type="text" class="form-control" placeholder="Username">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Parola</span>
  <input type="text" class="form-control" placeholder="Parola">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Email</span>
  <input type="text" class="form-control" placeholder="Email">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Nume</span>
  <input type="text" class="form-control" placeholder="Nume">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Prenume</span>
  <input type="text" class="form-control" placeholder="Prenume">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Telefon</span>
  <input type="text" class="form-control" placeholder="Telefon">
</div><br>
<div class="input-group input-group-lg">
  <span class="input-group-addon">Data nasterii</span>
  <input type="date" class="form-control" placeholder="Data nasterii" >
</div><br>
<button type="button" class="btn btn-default">Inregistrare</button>
<a href="http://89.34.100.127/index.php" class="btn btn-info" role="button">Esti deja inregistrat?</a>

 
</div>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>