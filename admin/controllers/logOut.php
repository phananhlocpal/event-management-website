<?php
session_start();
session_unset();
session_destroy();
header("Location: ../views/0-login.php");
exit();
?>
