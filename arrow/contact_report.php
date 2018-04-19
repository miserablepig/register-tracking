<?php
require_once '../admin/config.php';
login_required();
if($_SESSION['reports'] == 0) {
        header('location: index.php');
}

$mainlist = query("SELECT tbContacts.Contact_ID AS Contact_ID, tbContacts.Partner_ID AS Partner_ID, tbPartners.Name AS Partner, tbContacts.Firstname, tbContacts.Surname, tbContacts.Email, tbContacts.Mobile, tbContacts.Role FROM tbContacts JOIN tbPartners ON tbContacts.Partner_ID = tbPartners.Partner_ID ORDER BY Partner, tbContacts.Surname");

$content = '';
$table = '';
foreach($mainlist as $row) {
	
	$table .= "\n".$row['Firstname']."\t".$row['Surname']."\t".$row['Partner']."\t".$row['Email'];

}

$content = $table;

?>
<?php
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=contact_export.xls");

	echo (count($mainlist)) ? $content : 'There are no contacts saved.' 
?>