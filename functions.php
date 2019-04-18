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
        
        // Attempt insert query execution
        $sql = "INSERT INTO Users (Username, Password, Email, Nume, Prenume, DataNasterii, NrTelefon) VALUES (
            '$username', '$param_password', '$email', '$firstName', '$secondName', '$date', '$tel')";
        if(mysqli_query($link, $sql)){
            $this->Alert("Te-ai inregistrat cu succes!");
        } 
        else{
            //echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
 
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
                            
                            // Redirect user to welcome page
                            $this->Alert("Te-ai logat cu succes!");
                            header("location: welcome.php");
                            
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            $this->Alert("Parola introdusa nu este corecta!");
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                    $this->Alert("Nu exista un cont cu acel username!");
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
        $docId = $this->GetDocId($doc_name);


        $sql = "INSERT INTO Users (nume, prenume, telefon, id_doctor, Data, detalii) VALUES (
            '$nume', '$prenume', '$tel', '$docId', '$date', '$details')";
        if(mysqli_query($link, $sql)){
            echo "Te-ai programat cu succes!";
            echo "Asteapta confirmarea!";
        } 
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
 
        // Close connection
        mysqli_close($link);
    }

    public function GetDocId($doc_name){
        return $doc_name; 
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
