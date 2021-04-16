<?php session_start();
//collecting the data
$errorCount = 0; //checking for error messages.
//**verifying the data, validating each of the increase, because all the fields are required, if it's not filled, 
//then we increase our error message and ...*/
$name = $_POST['name'] != "" ? $_POST['name'] : $errorcount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorcount++;
$color = $_POST['color'] != "" ? $_POST['color'] : $errorCount++;
$languages = $_POST['languages'] != "" ? $_POST['languages'] : $errorCount++;
$comments = $_POST['comments'] != "" ? $_POST['comments'] : $errorCount++;
$tc = $_POST['tc'] != "" ? $_POST['tc'] : $errorCount++;


$_SESSION['name'] = $firstname;
$_SESSION['color'] = $color;
$_SESSION['languages'] = $languages;
$_SESSION['gender'] = $gender;
$_SESSION['comments'] = $comments;
$_SESSION['tc'] = $tc;
//display proper error messages to the user.
//Give more accurate feedback to the user.
if($errorCount > 0){
    //..if the error is greater than Zero, then there's an error somewhere..
    //...let it be sent back to the registration page with the error message.
    $Session_error = "You have " . $errorCount . " error";
        if($errorCount > 1) {
            $Session_error .= "s";
    }
    $Session_error .=   " in your Form Submission";
    $_SESSION["error"] = $Session_error ;
   
   
    if($errorCount > 1) {
        $Session_error .= "s";
    }
    $Session_error .=   " in your Form Submission";
    $_SESSION["error"] = $Session_error ;
    header("Location: authpage.php");
}else{
    //count all users
    $allUsers = scandir("files/"); //return @array (2 filled)   
    $countAllUsers = count($allUsers);


    //Assign the next newUserId to the new user
    $newUserId = ($countAllUsers-1);
    $userobject = [
    'name' => $name,
    'password' => password_hash($password, PASSWORD_DEFAULT), //password hashing
    'gender' => $gender,
    'color' => $color,
    'languages' => $languages,
    'comments' => $comments,
    'tc' => $tc
    ];

    
    //check if the user already exist in a db or file
        //** Look into the allUser array and check if the email already exist using their email..we'll do this using loop
        for ($counter = 0; $counter < $countAllUsers ; $counter++) {
            $currentUser = $allUsers[$counter]; //current user we are testing if it already exists

                if($currentUser == $userobject . ".json"){
                    $_SESSION["error"] = "Registration Failed, User already esist "; 
                    $_SESSION["error"] = "Registration Failed, User already exist "; 
                    header("Location: authpage.php");
                    die();
                }
            }
    
  //Here, we save them in a database and return them to the login page; if the user does not exist. Have a folder for Admin and different users.  
  file_put_contents("files/". $userobject . ".json", json_encode($userObject));
  $_SESSION["message"] = "Registration Completed. You can now Login  " . $userobject; 
  header("Location: login.php");
  
}                                       
?>