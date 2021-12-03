<?php
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 430)) {
    session_unset(); 
    session_destroy(); 
    echo "Session destroyed";
    header("Location: login.html");
    die; 
}
$_SESSION['start'] = time();
?>