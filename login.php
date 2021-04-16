<?php session_start();

include_once('lib.php'); 

if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
     //redirect to homepage, if already logged in.
     header("Location: authpage.php");
     die;
}
     // include_once('lib.php')
  ?>  
    <a href="logout.php">Logout</a>
    
<h3>Login to continue</h3>
<p>
        <?php 
          if(isset($_SESSION['message']) && !empty($_SESSION['message'])){

          }
        ?>
 </P>
 <h3>Login to continue</h3> 


 <FORM method="post" action="login.php" >
<p> 
          <?php 
          if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
               echo "<span style='color:red'>" . $_SESSION['error'] . "</span>";
                    session_unset();
                    session_destroy();
          }
                
           ?>