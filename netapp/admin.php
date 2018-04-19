<?php
header('location: closed.php');
require_once '../admin/config.php';
login_required();

$newsletters = query("SELECT tbCourses.ID AS Course_ID, tbCourseTypes.Course_Type, (SELECT COUNT(*) FROM tbRegistrations WHERE tbRegistrations.Course_ID = tbCourses.ID) AS Reg_Count, DATE_FORMAT(STR_TO_DATE(Date_Info, '%d/%m/%y'), '%D %M %Y') AS Date_Info, tbCourses.Time_Info, tbCourses.Title AS Course_Title, tbLocations.Location, tbTrainers.Name AS Trainer FROM tbCourses LEFT JOIN tbRegistrations ON tbRegistrations.Course_ID = tbCourses.ID JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbTrainers ON tbCourses.Trainer_ID = tbTrainers.ID JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID GROUP BY tbCourses.ID ORDER BY STR_TO_DATE(tbCourses.Date_Info, '%d/%m/%y')");

$table = '';
foreach($newsletters as $row) {
	$listlink = '<a href="reg_list.php?cid='.$row['Course_ID'].'" title="Show Registrations" ><img src="../img/report.png" alt="Show Registrations"/></a>';
	$reglink = '<a href="http://netapp.registertracking.com/?cid='.$row['Course_ID'].'" title="Registration Link" ><img src="../img/link.png" alt="edit"/></a>';
	$editlink = '<a href="course_edit.php?cid='.$row['Course_ID'].'" title="Edit Course" ><img src="../img/report_edit.png" alt="Edit Course"/></a>';
	
	/* if($row['visible'] == "1") {$visible = '<img src="media/images/bullet_green.png" />';} else {$visible = '<img src="media/images/bullet_red.png" />';} */
/* 	$table .= "<tr><td>".$row['id']."</td><td>".$row['title']."</td><td>".$row['location_id']."</td><td>$visible</td><td>$dlink $elink</td></tr>\n"; */

	
	if ($_SESSION['admin']) {
		$table .= "<tr><td>".$row['Course_Title']." ".$row['Course_Type']."</td><td>".$row['Location']."</td><td>".$row['Date_Info']."</td><td>".$row['Time_Info']."</td><td>".$row['Trainer']."</td><td>".$row['Reg_Count']."</td><td class='ac'>$reglink $listlink $editlink</td></tr>\n";
	} else {
		if ($_SESSION['reports']) {
			$table .= "<tr><td>".$row['Course_Title']." ".$row['Course_Type']."</td><td>".$row['Location']."</td><td>".$row['Date_Info']."</td><td>".$row['Time_Info']."</td><td>".$row['Trainer']."</td><td>".$row['Reg_Count']."</td><td class='ac'>$reglink $listlink</td></tr>\n";
		} else {
			$table .= "<tr><td>".$row['Course_Title']." ".$row['Course_Type']."</td><td>".$row['Location']."</td><td>".$row['Date_Info']."</td><td>".$row['Time_Info']."</td><td>".$row['Trainer']."</td><td>".$row['Reg_Count']."</td><td class='ac'>$reglink</td></tr>\n";
		}
	}
}

$content = <<<EOF
<table>
	<tr>
		<th>Course</th>
		<th>Location</th>
		<th>Date</th>
		<th>Time</th>
		<th>Trainer</th>
		<th></th>
		<th></th>
	</tr>
	$table
</table>
EOF;
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>NetApp - Register Tracking</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/register.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="course-list" class="clearfix">
            <h1>NetApp<?php echo ($_SESSION['admin']) ? ' <img src="../img/star.png" alt="Administrator" title="Administrator"/>' : '' ?><span class="ar"><?php echo ($_SESSION['admin']) ? '<a href="course_new.php" title="Add New Course" ><img src="../img/report_add.png" alt="Add Course"/></a> ' : '' ?><a href="logout.php" title="Logout"><img src="../img/user_go.png" alt="Logout"/></a></span></h1>
            <h2>Welcome to the NetApp Register Tracking Administration Page. This page is for authorised use only!</h2>
            <h2><?php echo $content; ?></h2>
        </div>
    </div>

</body>
</html>