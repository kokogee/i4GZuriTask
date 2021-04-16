<?php
session_start();

// Inialize session
session_start();
session_unset();
session_destroy();

// Delete certain session
unset($_SESSION['loggedIn']);

// Delete all session variables
// session_destroy();

// Jump to login page
header("Location: login.php");



?>
