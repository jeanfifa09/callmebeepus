<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$object = json_decode(file_get_contents('php://input'), true);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $response = new \stdClass();
    // Validate username
    // Prepare a select statement
    $sql = "SELECT id FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($link, $sql)){
      // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $object["username"];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $response->check = 2; //username taken
                }
            } else{
                $response->check = 404; //mysql error
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);


    $flag = true;
    if(empty($object["password"]) || empty($object["confirm_password"]))
    {
      $response->check = 200;
      $flag = false;
    }


    $password = $object["password"];
    $confirm_password = $object["confirm_password"];
    $passflag = ($password == $confirm_password);

    // Check input errors before inserting in database
    if($flag && $passflag){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $object["username"];
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $response->check = 1;
                // Redirect to login page
                //header("location: login.php");
            } else{
                $response->check = 405;
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);

    echo json_encode($response);
}
?>
