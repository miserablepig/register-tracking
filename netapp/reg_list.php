<?php
require_once '../admin/config.php';
reports_required();
	
	// Get course data from database
	$cid = (int) $_GET['cid'];

	if($cid == 0) {
		header('location: admin.php');
	}
	
$courseinfo = query("SELECT tbCourses.ID AS Course_ID, tbCourseTypes.Course_Type, DATE_FORMAT(STR_TO_DATE(Date_Info, '%d/%m/%y'), '%D %M %Y') AS Date_Info, tbCourses.Title AS Course_Title, tbLocations.Location FROM tbCourses JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID WHERE tbCourses.ID = '$cid'");
	
	$course_name = $courseinfo[0]['Course_Title'] . " " . $courseinfo[0]['Course_Type'];
	$course_location = $courseinfo[0]['Location'];
	$course_date = $courseinfo[0]['Date_Info'];
	
$registrations = query("SELECT tbRegistrations.ID AS Reg_ID, tbRegistrations.Name AS Reg_Name, tbRegistrations.Email AS Reg_Email, tbRegistrations.Partner AS Reg_Partner FROM tbRegistrations JOIN tbCourses ON tbCourses.ID = tbRegistrations.Course_ID WHERE tbRegistrations.Course_ID = '$cid' ORDER BY tbRegistrations.ID");

$table = '';

foreach($registrations as $row) {
	$dlink = '<a href="reg_del.php?rid='.$row['Reg_ID'].'&cid='.$cid.'" onclick="return confirm(\'Are you sure you want to delete this registration?\');" title="Delete Registration"><img src="../img/delete.png" alt="Delete Registration"/></a>';
	
	if ($_SESSION['admin']) {
		$table .= "<tr><td>".$row['Reg_Name']."</td><td>".$row['Reg_Email']."</td><td>".$row['Reg_Partner']."</td><td class='ac'>$dlink</td></tr>\n";
	} else {
		$table .= "<tr><td>".$row['Reg_Name']."</td><td>".$row['Reg_Email']."</td><td>".$row['Reg_Partner']."</td></tr>\n";
	}

}

if ($_SESSION['admin']) {
	$content = <<<EOF
	<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Partner</th>
		<th></th>
	</tr>
	$table
	</table>
EOF;
} else { 
	$content = <<<EOF
	<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Partner</th>
	</tr>
	$table
	</table>
EOF;
}

?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Registration List</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/register.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="course-list" class="clearfix">
            <h1>Registration List <?php echo (count($registrations)) ? ' - ' . count($registrations) : '' ?><?php echo ($_SESSION['admin']) ? ' <img src="../img/star.png" alt="Administrator" title="Administrator"/>' : '' ?><span class="ar"><a href="logout.php" title="Logout"><img src="../img/user_go.png" alt="Logout"/></a></a></span></h1>
            <h2><?php echo $course_name . " - " . $course_location . " - " . $course_date; ?><span class="ar"><a href="admin.php" title="Back"><img src="../img/arrow_left.png" alt="Back"/></a></span></h2>
            <h2><?php echo (count($registrations)) ? $content : 'There are no registrations for this course' ?></h2>
        </div>
    </div>

</body>
</html>