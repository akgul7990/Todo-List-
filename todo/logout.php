<?php 




if (isset($_SESSION['auth'])) {
    header('Location: index.php');
    exit;
    
}
// Initialize the session
session_destroy();

    session_start();//session is a way to store information (in variables) to be used across multiple pages.  
    session_destroy();
    header('Location: login.php');



?>