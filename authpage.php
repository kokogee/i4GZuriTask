<?php

session_start();  //starting the session

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
     //redirect to homepage, if already logged in.
     header("Location: authpage.php");
}
  //include_once("lib.php");



//From your knowledge of PHP forms and files, PHP loops, functions and sessions, 
//create a basic authentication page that does the following:

//1. Register (a new user can register, their details stored in a database file). 
//2. Login (checks in the file and logs them in if they are already registered)
//3. Reset password
//4. Logout

//Initializing our variables
$name = '';
$password ='';
$gender = '';
$color = '';
$languages = [];
$comments = '';
$tc ='';

//if  it's set; the post
if (isset($_POST['submit'])) {
    $ok = true;

   if (!isset($_POST['name']) || $_POST['name'] === ''){
       $ok = false;
   }else {
       $name = $_POST['name'];
   };
   if (!isset($_POST['password']) || $_POST['password'] === ''){
    $ok = false;
    }else {
    $password = $_POST['password'];
   };
   if (!isset($_POST['gender']) || $_POST['gender'] === ''){
    $ok = false;
    }else {
    $gender = $_POST['gender'];
   };
   if (!isset($_POST['color']) || $_POST['color'] === ''){
    $ok = false;
   }else {
    $color = $_POST['color'];
   };
   if (!isset($_POST['languages']) || !is_array($_POST['languages'])
         || count($_POST['languages']) === 0){
    $ok = false;
   }else {
    $languages = $_POST['languages'];
   };
   if (!isset($_POST['comments']) || $_POST['comments'] === ''){
    $ok = false;
   }else {
    $comments = $_POST['comments'];
   };
   if (!isset($_POST['tc']) || $_POST['tc'] === ''){
    $ok = false;
   }else { 
    $tc = $_POST['tc'];
};

if ($ok) {
printf('User name: %s 
     <br>password: %s
     <br>Gender: %s
     <br>Color: %s
     <br>Language(s): %s
     <br>Comments: %s
     <br>T&amp;C: %s',
    htmlspecialchars($name, ENT_QUOTES),
    htmlspecialchars($password, ENT_QUOTES),
    htmlspecialchars($color, ENT_QUOTES),
    htmlspecialchars(implode(' ', $languages), ENT_QUOTES),
    htmlspecialchars($comments, ENT_QUOTES),
    htmlspecialchars($tc, ENT_QUOTES));
 }
}

$userobject = [
    'name' => $name,
    'password' => password_hash($password, PASSWORD_DEFAULT), //password hashing
    'gender' => $gender,
    'color' => $color,
    'languages' => $languages,
    'comments' => $comments,
    'tc' => $tc
];

file_put_contents('files/'. $userobject['name'] . ".json" , json_encode($userobject));


?>
<h3>Register</h3>
     <p><strong> WELCOME GUEST! Register Here.</p></strong>
     <p><b> All fields are required .</b></p>
<form
  action="processregister.php"
  method="post"> 

  <p> 
          <?php 
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
               echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
                    session_unset();
                    session_destroy();
          }
           ?>
       </P>

  Username: <input type="text" name="name" value="<?php 
  echo htmlspecialchars($name, ENT_QUOTES);?>"><br>
  password: <input type="text" name="password"><br>
  Gender:
  <input type="radio" name="gender" value="f">female
  <input type="radio" name="gender" value="m">male
  <input type="radio" name="gender" value="o">others<br />
  favorite color:
  <select name="color">
   <option value="">please select</option>
   <option value="#f00">red</option>
   <option value="#0f0">green</option>
    <option value="00f">blue</option>
   </select><br>
   Languages spoken:
   <select name="languages[]" multiple size="3">
    <option value="en">English</option>
    <option value="fr">French</option>
    <option value="it">Italy</option>
   </select><br>
   Comments: <textarea name="comments"><?php 
   echo htmlspecialchars($comments, ENT_QUOTES);?></textarea><br>
   <input type="checkbox" name="tc" value="ok"<?php 
   if ($tc ===  'ok'){
       echo' checked';
   }
   ?>>
   I accept the T&amp;c<br>
   <input type="submit" name="submit" value="Register">
</form>

