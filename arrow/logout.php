<?php
require_once '../admin/config.php';
$_SESSION = array();
session_destroy();
header('Location: login.php');
?>