<?php
session_start();
session_destroy();
header('Location: ../userlogin.php');
exit();
?>
