<?php

    //pentru debug

    require_once "config.php";

    ini_set('display_errors', 1);

    ini_set('display_startup_errors', 1);

    error_reporting(E_ALL);

    







class functions{

    public function Connect(){

        $host = DB_SERVER;

        $user = DB_USERNAME;

        $pass = DB_PASSWORD;

        $db = DB_NAME;



        $connection = mysqli_connect($host, $user, $pass);

        if(!$connection){

            die("Database Connection Failed" . mysqli_error($connection));

        }



        $select_db = mysqli_select_db($connection, $db);

        if(!$select_db){

            die("Database Selection Failed" . mysqli_eror($connection));

        }

        

        return $connection;

    } 



    public function Register($username, $password, $email, $firstName, $secondName, $date, $tel){

        $link = $this->Connect();

        

        //Encrypt password

        $param_password = password_hash($password, PASSWORD_DEFAULT);



        //Check Date

        $curDate = new DateTime(date('d-m-Y'));

        $startDate = DateTime::createFromFormat('d/m/Y', '01/01/1900');

        $newDate = DateTime::createFromFormat('d/m/Y', $date);



        if($newDate<$curDate && $newDate > $startDate){

            

            // Attempt insert query execution

            $sql = "INSERT INTO Users (Username, Password, Email, Nume, Prenume, DataNasterii, NrTelefon) VALUES (

            '$username', '$param_password', '$email', '$firstName', '$secondName', '$date', '$tel')";

            if(mysqli_query($link, $sql)){

            // echo "Te-ai inregistrat cu succes!";

            $this->Alert("Te-ai inregistrat cu succes!");

            } 

            else{

                //echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);

                $this->Alert("Username deja inregistrat!");

            }

        }

        else

            $this->Alert("Data invalida!");

        // Close connection

        mysqli_close($link);

        

    }



    public function Login($username, $password, $tabel){

        $link = $this->Connect();

        

        $sql = "SELECT Id, Username, Password FROM ".$tabel." WHERE Username = '$username'";

        

        if($stmt = mysqli_prepare($link, $sql)){

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Store result

                mysqli_stmt_store_result($stmt);

                

                // Check if username exists, if yes then verify password

                if(mysqli_stmt_num_rows($stmt) == 1){                    

                    // Bind result variables

                    

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){

                        if(password_verify($password, $hashed_password)){

                            // Password is correct, so start a new session

                            session_start();

                            

                            // Store data in session variables

                            $_SESSION["loggedin"] = true;

                            $_SESSION["id"] = $id;

                            $_SESSION["username"] = $username;

                            $_SESSION["nume"] = 

                            

                            // Redirect user to welcome page

                            header("location: welcome.php");

                        } else{

                            // Display an error message if password is not valid

                            $password_err = "The password you entered was not valid.";

                              // echo("The password you entered was not valid.");

                        }

                    }

                } else{

                    // Display an error message if username doesn't exist

                    $username_err = "No account found with that username.";

                       // echo("No account found with that username.");

                }

            }

        }

        

        // Close statement

        mysqli_stmt_close($stmt);



        // Close connection

        mysqli_close($link);

    }



    public function AddProgramare($nume, $prenume, $tel, $date, $doc_name, $details){

        $link = $this->Connect();

        $id = $_SESSION["id"];



        //Check Date

        $curDate = new DateTime(date('d-m-Y'));

        $newDate = DateTime::createFromFormat('d/m/Y', $date);

        if($newDate>$curDate){



            $sql = "INSERT INTO programari (id_user, nume, prenume, telefon, data, id_doctor, detalii) VALUES (

                '$id', '$nume', '$prenume', '$tel', STR_TO_DATE('$date', '%d/%m/%Y'), '$doc_name', '$details')";

            if(mysqli_query($link, $sql)){

                $this->Alert( "Te-ai programat cu succes!");

                $this->Alert( "Asteapta confirmarea!");

            } 

            else{

                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

            }

        }

        else

        {

            $this->Alert("Data Invalida!");

        }

 

        // Close connection

        mysqli_close($link);

    }

    



public function GetDocName($id){

        $link = $this->Connect();

        $sql = "SELECT nume, prenume FROM doctors WHERE Id = '$id' ";

        $result = $link->query($sql);

        if ($result->num_rows > 0){

            while ($row = $result->fetch_assoc()) {              

                $docName = $row["nume"]." ".$row["prenume"];

                return $docName;

            }

        }                

}



    public function Logout(){

        session_start();

 

        // Unset all of the session variables

        $_SESSION = array();

 

        // Destroy the session.

        session_destroy();

 

        // Redirect to login page

        header("location: index.php");

        exit;

    }

    

    public function Alert($msg) {

        echo "<script type='text/javascript'>alert('$msg');</script>";

    }

    

}

?>

