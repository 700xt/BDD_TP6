<?php
session_start();
$_SESSION['isConnected'] = false;
session_destroy();
header("Location: index.php");
exit();
?>