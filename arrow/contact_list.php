<?php
require_once '../admin/config.php';
login_required();

	// Get partner data from database
	$pid = (int) $_GET['pid'];

	if($pid == 0) {
		$mainlist = query("SELECT Partner_ID, Name FROM tbPartners ORDER BY Name LIMIT 1");
		$pid = $mainlist[0]['Partner_ID'];
	}
	
	$mainlist = query("SELECT tbPartners.Partner_ID AS Partner_ID FROM tbPartners WHERE tbPartners.Partner_ID = '$pid'");

	// Quickly validate ID by checking if database query successful
	if(empty($mainlist[0]['Partner_ID'])) {
		echo 'Error - Partner not found.';
		exit;
	}

	$mainlist = query("SELECT tbContacts.Contact_ID AS Contact_ID, tbContacts.Partner_ID AS Partner_ID, tbPartners.Name AS Partner, tbContacts.Firstname, tbContacts.Surname, tbContacts.Email, tbContacts.Mobile, tbContacts.Role FROM tbContacts JOIN tbPartners ON tbContacts.Partner_ID = tbPartners.Partner_ID WHERE tbContacts.Partner_ID = '$pid' ORDER BY tbContacts.Surname");


	$partner_list = '';
	$partners = query("SELECT Partner_ID, Name FROM tbPartners ORDER BY Name");

	foreach ($partners as $row) {
    	$id = $row["Partner_ID"];
	    $partner = $row["Name"];

		if ($id == $pid) {
	    	$partner_list .= "<option value='$id' selected='selected'>$partner</OPTION>";
	    } else {
		    $partner_list .= "<option value='$id'>$partner</OPTION>";
	    }
	}

$table = '';
foreach($mainlist as $row) {
	$viewlink = '<a href="contact_view.php?cid='.$row['Contact_ID'].'" title="View Contact Details" ><img src="../img/report_magnify.png" alt="View Contact Details"/></a>';
	$editlink = '<a href="contact_edit.php?cid='.$row['Contact_ID'].'" title="Edit Contact" ><img src="../img/report_edit.png" alt="Edit Contact"/></a>';
	$dellink = '<a href="contact_del.php?pid='.$pid.'&cid='.$row['Contact_ID'].'&contact='.urlencode($row['Firstname'].' '.$row['Surname']).'" onclick="return confirm(\'Are you sure you want to delete this contact?\');" title="Delete Contact"><img src="../img/delete.png" alt="Delete Partner"/></a>';
	

	if ($_SESSION['admin']) {
		$table .= "<tr><td>".$row['Firstname']."</td><td>".$row['Surname']."</td><td>".$row['Role']."</td><td><a href='mailto:".$row['Email']."'>".$row['Email']."</a></td><td class='linkscol'>$editlink $dellink</td></tr>\n";
	} else {
		$table .= "<tr><td>".$row['Firstname']."</td><td>".$row['Surname']."</td><td>".$row['Role']."</td><td><a href='mailto:".$row['Email']."'>".$row['Email']."</a></td><td class='linkscol'>$editlink $dellink</td></tr>\n";
	}
}

$content = <<<EOF
<table>
	<tr>
		<th>Firstname</th>
		<th>Surname</th>
		<th>Role</th>
		<th>Email</th>
		<th class='linkscol'></th>
	</tr>
	$table
</table>
EOF;
?>

<?php include 'header.php'; ?>

    <!-- MAIN CONTENT -->
	<div class="wrapper on-light"> 		
        <div id="partner-list" class="clearfix">
            <h1>Contact List
            <?php echo ($_SESSION['admin']) ? ' <img src="../img/star.png" alt="Administrator" title="Administrator"/>' : '' ?>
            <span class="ar">
            	<a href="contact_new.php" title="Add New Contact" ><img src="../img/report_add.png" alt="Add New Contact"/></a>
            </span></h1>
            <div class="inner-dot-separator"></div>
  	        <h2>
  	        <form action="contact_list.php">
  	        	<select name="pid" id="pid">Partner<?php echo $partner_list;?></select>
				<input type="submit" value="View" id="submit-button" />
			</form>   		
           	</h2>
			<h2><?php echo (count($mainlist)) ? $content : 'There are no contacts saved for this partner.' ?></h2>        
		</div>
    	<div class="inner-dot-separator"></div>
	</div>

    <div class="clear"></div>
	<!-- END FOOTER -->
    </body>
</html>
