<?php
//DELETE SESSION
session_destroy();
setcookie("Window", "", time() - 3600);
setcookie("Distance", "", time() - 3600);
header("Location:index.php");
?>
