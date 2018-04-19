<?php
require_once '../admin/config.php';

$newsletters = query("SELECT tbCourses.ID AS Course_ID, tbCourseTypes.Course_Type, DATE_FORMAT(STR_TO_DATE(Date_Info, '%d/%m/%y'), '%D %M %Y') AS Date_Info, tbCourses.Time_Info, tbCourses.Title AS Course_Title, tbLocations.Location, tbTrainers.Name AS Trainer FROM tbCourses JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbTrainers ON tbCourses.Trainer_ID = tbTrainers.ID JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID WHERE STR_TO_DATE(tbCourses.Date_Info, '%d/%m/%y') > CURDATE() ORDER BY STR_TO_DATE(tbCourses.Date_Info, '%d/%m/%y')");

$table = '';
foreach($newsletters as $row) {
	$reglink = '<a href="http://netapp.registertracking.com/?cid='.$row['Course_ID'].'" title="Registration Link" ><img src="../img/link.png" alt="edit"/></a>';

	$table .= "<tr><td>".$row['Course_Title']." ".$row['Course_Type']."</td><td>".$row['Location']."</td><td>".$row['Date_Info']."</td><td>".$row['Time_Info']."</td><td>".$row['Trainer']."</td><td class='ac'>$reglink</td></tr>\n";
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
	</tr>
	$table
</table>
EOF;
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>NetApp Course List</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/register.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="course-list" class="clearfix">
            <h1>NetApp Course List</h1>
            <h2>If you would like to register for any of the courses below, please use the register link on the right of the table.</h2>
            <h2><?php echo $content; ?></h2>
        </div>
    </div>

</body>
</html>