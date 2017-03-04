<?php
include_once 'mod.php';
User::logout();
header("location:index.php");
exit();
?>
