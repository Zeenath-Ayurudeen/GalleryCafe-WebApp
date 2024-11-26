<?php
session_start();
session_destroy(); // Destroy all sessions
header('Location: ../userlogin.php');
exit();
?>
