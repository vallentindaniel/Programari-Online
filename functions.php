<?php
    //pentru debug
    include("config.php");
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
            echo "Te-ai inregistrat cu succes!";
        } 
        else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
 
        // Close connection
        mysqli_close($link);
    }

    public function Login($username, $password){
        $link = $this->Connect();
        
        $sql = "SELECT Id, Username, Password FROM Users WHERE Username = '$username'";
        
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
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                            echo("The password you entered was not valid.");
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                    echo("No account found with that username.");
                }
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
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
    
    
    
}
?>
