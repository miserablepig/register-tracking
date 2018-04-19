<?php 
	header('location: closed.php');
	require_once '../admin/config.php';

	// Get course data from database
	$id = (int) $_GET['cid'];

	if($id == 0) {
		header('location: courses.php');
		exit;
	}
	
	$courseinfo = query("SELECT tbCourseTypes.Course_Type, tbCourses.Title, DATE_FORMAT(STR_TO_DATE(Date_Info, '%d/%m/%y'), '%D %M %Y') AS Date_Info, tbCourses.Time_Info, tbLocations.Location, tbLocations.Address, tbCompany.Name AS Company_Name, tbContacts.Name AS Contact_Name, tbContacts.Email AS Contact_Email FROM tbCourses JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbCompany ON tbCourses.Company_ID = tbCompany.ID JOIN tbContacts ON tbCourses.Contact_ID = tbContacts.ID WHERE tbCourses.ID = '$id' LIMIT 1");
	
	// Quickly validate ID by checking if database query successful
	if(empty($courseinfo[0]['Company_Name'])) {
		header('location: notfound.php');
		exit;	
	}

	$course_date = date('m/d/y', strtotime($courseinfo[0]['Date_Info']));
	$today_date = date('m/d/y');
	
/* 	echo $course_date . " " . $today_date; */

	if($course_date <= $today_date) {
		header('location: expired.php');
		exit;
	} 
	
	// Init Variables
	$cf = array();
	$sr = false;
	
	if(isset($_SESSION['cf_returndata'])){
		$cf = $_SESSION['cf_returndata'];
		$sr = true;
	}
?>

<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title><?php echo $courseinfo[0]['Company_Name']; ?> Session Registration</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/register.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="contact-form" class="clearfix">
            <h1><?php echo $courseinfo[0]['Company_Name']; ?> Session Registration</h1>
            <h2>Please complete the details requested below to register for your selected session.</h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">There was a problem with your registration:</li>
                <?php 
				if(isset($cf['errors']) && count($cf['errors']) > 0) :
					foreach($cf['errors'] as $error) :
				?>
                <li><?php echo $error ?></li>
                <?php
					endforeach;
				endif;
				?>
            </ul>
            <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Your registration has been successful!</p>
            <h2>Course: <?php echo $courseinfo[0]['Title']; ?> - <?php echo $courseinfo[0]['Course_Type']; ?></h2>
            <h2>Location: <?php echo $courseinfo[0]['Location']; ?></h2>
            <h2>Date: <?php echo $courseinfo[0]['Date_Info']; ?></h2>
            <h2>Time: <?php echo $courseinfo[0]['Time_Info']; ?></h2>
            <form method="post" action="process_register.php">
            	<input type="hidden" name="course_id" value="<?php echo $id ?>">
               	<input type="hidden" name="course_type" value="<?php echo $courseinfo[0]['Course_Type'] ?>">
            	<input type="hidden" name="course_title" value="<?php echo $courseinfo[0]['Title'] ?>">
            	<input type="hidden" name="course_location" value="<?php echo $courseinfo[0]['Location'] ?>">
            	<input type="hidden" name="course_address" value="<?php echo $courseinfo[0]['Address'] ?>">
            	<input type="hidden" name="course_date_info" value="<?php echo $courseinfo[0]['Date_Info'] ?>">
            	<input type="hidden" name="course_time_info" value="<?php echo $courseinfo[0]['Time_Info'] ?>">
            	<input type="hidden" name="course_company" value="<?php echo $courseinfo[0]['Company_Name'] ?>">
            	<input type="hidden" name="contact_name" value="<?php echo $courseinfo[0]['Contact_Name'] ?>">
            	<input type="hidden" name="contact_email" value="<?php echo $courseinfo[0]['Contact_Email'] ?>">
                <label for="name">Name: <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['name'] : '' ?>" placeholder="John Doe" required autofocus />
                
                <label for="email">Email Address: <span class="required">*</span></label>
                <input type="email" id="email" name="email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['email'] : '' ?>" placeholder="johndoe@example.com" required />
                
                <label for="partner">Partner: <span class="required">*</span></label>
                <input type="text" id="partner" name="partner" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner'] : '' ?>" placeholder="ABC Partner Ltd" required />
                
                <span id="loading"></span>
                <input type="submit" value="Register" id="submit-button" />
                <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
            </form>
            <?php unset($_SESSION['cf_returndata']); ?>
        </div>
    </div>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="../js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
<!--
	<script src="../js/plugins.js"></script>
	<script src="../js/script.js"></script>
-->
	
	
	
	<!--[if lt IE 7 ]>
	<script src="../js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>