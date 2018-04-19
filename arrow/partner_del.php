<?php
require_once '../admin/config.php';
login_required();

if($_SESSION['admin']) {
	$pid = (int) $_GET['pid'];

	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$sql = "DELETE FROM tbPartners WHERE Partner_ID = '$pid' LIMIT 1";
	$stmt = $link->query($sql) or die($link->error);
	if($link->affected_rows) {
	    $_SESSION['success'] = "Partner deleted.";
	    log_event("Partner Deleted", $_SESSION['fullname']." deleted partner ID: ".$pid);
	} else {
	    $_SESSION['error'] = 'Nothing deleted.';
	}
	header('Location: partner_list.php');
} else {
	header('Location: partner_list.php');
}

?>

