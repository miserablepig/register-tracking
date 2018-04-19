<?php
require_once '../admin/config.php';
login_required();
if($_SESSION['logs'] == 0) {
        header('location: index.php');
}

/* $mainlist = query("SELECT tbCourses.ID AS Course_ID, tbCourseTypes.Course_Type, (SELECT COUNT(*) FROM tbRegistrations WHERE tbRegistrations.Course_ID = tbCourses.ID) AS Reg_Count, DATE_FORMAT(STR_TO_DATE(Date_Info, '%d/%m/%y'), '%D %M %Y') AS Date_Info, tbCourses.Time_Info, tbCourses.Title AS Course_Title, tbLocations.Location, tbTrainers.Name AS Trainer FROM tbCourses LEFT JOIN tbRegistrations ON tbRegistrations.Course_ID = tbCourses.ID JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbTrainers ON tbCourses.Trainer_ID = tbTrainers.ID JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID GROUP BY tbCourses.ID ORDER BY STR_TO_DATE(tbCourses.Date_Info, '%d/%m/%y')"); */

$mainlist = query("SELECT * FROM tbLog ORDER BY Log_ID");


$table = '';
foreach($mainlist as $row) {
	$table .= "<tr><td>".$row['Type']."</td><td>".$row['Event']."</td></tr>\n";
}

$content = <<<EOF
<table>
	<tr>
		<th>Type</th>
		<th>Details</th>
	</tr>
	$table
</table>
EOF;
?>

<?php include 'header.php'; ?>

    <!-- MAIN CONTENT -->
	<div class="wrapper on-light"> 		
        <div id="partner-list" class="clearfix">
            <h1>Arrow Partner Database - Logs
            <?php echo ($_SESSION['admin']) ? ' <img src="../img/star.png" alt="Administrator" title="Administrator"/>' : '' ?>
            <span class="ar">
            	<?php echo ($_SESSION['admin']) ? '<a href="clear_log.php" onclick="return confirm(\'Are you sure you want to clear the log?\');" title="Clear Log"><img src="../img/delete.png" alt="Clear Log"/></a> ' : '' ?>
            </span></h1>
            <div class="inner-dot-separator"></div>
            <h2><?php echo (count($mainlist)) ? $content : 'The log is empty.' ?></h2>
        </div>
    	<div class="inner-dot-separator"></div>
	</div>

    <div class="clear"></div>
	<!-- END FOOTER -->
    </body>
</html>
