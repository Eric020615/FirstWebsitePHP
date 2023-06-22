<?php
// need to start the session then only can use session
session_start();
// destroy all the session
session_destroy();
header("Location: index.php");
exit;
?>