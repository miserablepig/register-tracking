<?php
require_once '../admin/config.php';
login_required();

if($_SESSION['admin']) {
	$pid = (int) $_GET['pid'];
	$cid = (int) $_GET['cid'];
	$contact = $_GET['contact'];

	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$sql = "DELETE FROM tbContacts WHERE Contact_ID = '$cid' LIMIT 1";
	$stmt = $link->query($sql) or die($link->error);
	if($link->affected_rows) {
	    $_SESSION['success'] = "Contact deleted.";
	    log_event("Contact Deleted", $_SESSION['fullname']." deleted contact ".$contact);
	} else {
	    $_SESSION['error'] = 'Nothing deleted.';
	}
	header('Location: contact_list.php?pid='.$pid);
} else { 
	header('Location: contact_list.php?pid='.$pid); 
}

?>

