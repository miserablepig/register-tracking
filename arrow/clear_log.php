<?php
require_once '../admin/config.php';
admin_required();
if($_SESSION['logs'] == 0) {
		header('location: index.php');
}

$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
$sql = "TRUNCATE TABLE tbLog";
$stmt = $link->query($sql) or die($link->error);

log_event("Log Cleared", $_SESSION['fullname']." cleared the log at ".date('d/m/Y - H:ia'));

header('Location: logs.php');

?>

