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

    public function RegisterDoctor($username, $password, $firstName, $secondName, $tel, $email){
        $link = $this->Connect();
        
        //Encrypt password
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Attempt insert query execution
        $sql = "INSERT INTO doctors (Username, Password,  Nume, Prenume, Telefon, Email) VALUES (
            '$username', '$param_password', '$firstName', '$secondName', '$tel', '$email')";
        if(mysqli_query($link, $sql)){
        } 
        else{
            //echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
 
        // Close connection
        mysqli_close($link);
    }

    public function LoginAdmin($username, $password){
        $link = $this->Connect();
        
        $sql = "SELECT username, password FROM administrator WHERE username = '$username'";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["admin"] = true;
                            $_SESSION["username"] = $username;
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                              // echo("The password you entered was not valid.");
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

    public function DeleteUser($id){
        $link = $this->Connect();
        
        // Attempt insert query execution
        $sql = "DELETE FROM Users WHERE Id = '$id'";
        if(mysqli_query($link, $sql)){
        } 
        else{
            //echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
 
        // Close connection
        mysqli_close($link);
    }

    public function DeleteDoctor($id){
        $link = $this->Connect();
        
        // Attempt insert query execution
        $sql = "DELETE FROM doctors WHERE Id = '".$id."'";
        if(mysqli_query($link, $sql)){
        } 
        else{
            //echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
 
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
        header("location: login.php");
        exit;
    }
    
    
    
}
?>
