<?php
if (isset($_SESSION['start']) && (time() - $_SESSION['start'] > 450)) {
    session_unset(); 
    session_destroy(); 
    echo "session destroyed";
    header("Location: login.html");
    die; 
}
$_SESSION['start'] = time();
?>