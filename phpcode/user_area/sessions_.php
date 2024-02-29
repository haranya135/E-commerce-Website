<?php
session_start();
$_SESSION['username']="Me";
$_SESSION['password']="password";
$_SESSION['email']="memyself@gmail.com"
echo "Session data saved";
?>