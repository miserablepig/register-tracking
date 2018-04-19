<?php
require_once '../admin/config.php';
admin_required();

$rid = (int) $_GET['rid'];
$cid = (int) $_GET['cid'];

$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
$sql = "DELETE FROM tbRegistrations WHERE ID='$rid' LIMIT 1";
$stmt = $link->query($sql) or die($link->error);
if($link->affected_rows) {
    $_SESSION['success'] = "Registration deleted.";
} else {
    $_SESSION['error'] = 'Nothing deleted.';
}
header('Location: reg_list.php?cid='.$cid);
