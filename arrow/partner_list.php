<?php
require_once '../admin/config.php';
login_required();

/* $mainlist = query("SELECT tbCourses.ID AS Course_ID, tbCourseTypes.Course_Type, (SELECT COUNT(*) FROM tbRegistrations WHERE tbRegistrations.Course_ID = tbCourses.ID) AS Reg_Count, DATE_FORMAT(STR_TO_DATE(Date_Info, '%d/%m/%y'), '%D %M %Y') AS Date_Info, tbCourses.Time_Info, tbCourses.Title AS Course_Title, tbLocations.Location, tbTrainers.Name AS Trainer FROM tbCourses LEFT JOIN tbRegistrations ON tbRegistrations.Course_ID = tbCourses.ID JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbTrainers ON tbCourses.Trainer_ID = tbTrainers.ID JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID GROUP BY tbCourses.ID ORDER BY STR_TO_DATE(tbCourses.Date_Info, '%d/%m/%y')"); */

$mainlist = query("SELECT tbPartners.Partner_ID AS Partner_ID, tbBDMs.BDM_ID, tbBDMs.Firstname AS BDM_Firstname, tbBDMs.Surname AS BDM_Surname, tbPartners.Name AS Partner_Name, tbPartners.Status AS Partner_Status, tbPartners.Website AS Partner_Website, tbPartners.BDM_ID AS Partner_BDM FROM tbPartners LEFT JOIN tbBDMs ON tbPartners.BDM_ID = tbBDMs.BDM_ID ORDER BY Partner_Name");


$table = '';
foreach($mainlist as $row) {
	$viewlink = '<a href="partner_view.php?pid='.$row['Partner_ID'].'" title="View Partner Details" ><img src="../img/report_magnify.png" alt="View Partner Details"/></a>';
	$editlink = '<a href="partner_edit.php?pid='.$row['Partner_ID'].'" title="Edit Partner" ><img src="../img/report_edit.png" alt="Edit Partner"/></a>';
	$dellink = '<a href="partner_del.php?pid='.$row['Partner_ID'].'" onclick="return confirm(\'Are you sure you want to delete this partner?\');" title="Delete Partner"><img src="../img/delete.png" alt="Delete Partner"/></a>';
	
	if ($_SESSION['admin']) {
		$table .= "<tr><td>".$row['Partner_Name']."</td><td>".$row['Partner_Status']."</td><td>".$row['BDM_Firstname']." ".$row['BDM_Surname']."</td><td class='linkscol'>$editlink</td></tr>\n";
	} else {
		$table .= "<tr><td>".$row['Partner_Name']."</td><td>".$row['Partner_Status']."</td><td>".$row['BDM_Firstname']." ".$row['BDM_Surname']."</td><td class='linkscol'>$viewlink</td></tr>\n";
	}
}

$content = <<<EOF
<table>
	<tr>
		<th>Partner</th>
		<th>Status</th>
		<th>BDM</th>
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
            <h1>Partner List
            <?php echo ($_SESSION['admin']) ? ' <img src="../img/star.png" alt="Administrator" title="Administrator"/>' : '' ?>
            <span class="ar">
            	<?php echo ($_SESSION['admin']) ? '<a href="partner_new.php" title="Add New Partner" ><img src="../img/report_add.png" alt="Add New Partner"/></a> ' : '' ?>
            </span></h1>
            <div class="inner-dot-separator"></div>

            <h2>Welcome to the Arrow Partner Database. This page is for authorised use only!</h2>
            <h2><?php echo (count($mainlist)) ? $content : 'There are no partners saved.' ?></h2>
        </div>
    	<div class="inner-dot-separator"></div>
	</div>

    <div class="clear"></div>
	<!-- END FOOTER -->
    </body>
</html>
