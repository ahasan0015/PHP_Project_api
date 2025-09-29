<?php
if(isset($_POST['logout'])) {
unset($_SESSION['userId']);
unset($_SESSION['customerId']);
session_unset();
session_destroy();
header("Location: login");
// exit(header("Location: /login"));
// header("location: login");  
}
?>