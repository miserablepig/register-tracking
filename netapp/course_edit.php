<?php 
	require_once '../admin/config.php';
	login_required();


	// Get course data from database
	$id = (int) $_GET['cid'];

	if($id == 0) {
		header('location: courses.php');
	}
	
	$courseinfo = query("SELECT tbCourses.ID AS Course_ID, tbCourseTypes.ID AS Course_Type_ID, tbCourses.Title AS Course_Title, tbCourses.Date_Info, tbCourses.Time_Info, tbLocations.ID as Location_ID, tbCompany.ID AS Company_ID, tbCompany.Name AS Company_Name, tbContacts.ID AS Contact_ID, tbTrainers.ID AS Trainer_ID FROM tbCourses JOIN tbCourseTypes ON tbCourses.Type_ID = tbCourseTypes.ID JOIN tbTrainers ON tbCourses.Trainer_ID = tbTrainers.ID JOIN tbLocations ON tbCourses.Location_ID = tbLocations.ID JOIN tbCompany ON tbCourses.Company_ID = tbCompany.ID JOIN tbContacts ON tbCourses.Contact_ID = tbContacts.ID WHERE tbCourses.ID = '$id' LIMIT 1");
	
	// Quickly validate ID by checking if database query successful
	if(empty($courseinfo[0]['Company_Name'])) {
		echo 'Error - Invalid course ID.';
		exit;
	}
	
	// Init Variables
	$cf = array();
	$sr = false;
	
	if(isset($_SESSION['cf_returndata'])){
		$cf = $_SESSION['cf_returndata'];
		$sr = true;
	}
	
	$contact_options = '';
	$location_options = '';
	$type_options = '';
	$trainer_options = '';
	$contacts = query("SELECT * FROM tbContacts");
	$locations = query("SELECT * FROM tbLocations");
	$types = query("SELECT * FROM tbCourseTypes");
	$trainers = query("SELECT * FROM tbTrainers");

	foreach ($contacts as $row) {
    	$id = $row["ID"];
	    $contact = $row["Name"];

	    if ($id == (($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_contact_id'] : $courseinfo[0]['Contact_ID'])) {
	    	$contact_options .= "<option value='$id' selected='selected'>$contact</OPTION>";
	    } else {
		    $contact_options .= "<option value='$id'>$contact</OPTION>";
	    }
	}
	foreach ($locations as $row) {
    	$id = $row["ID"];
	    $location = $row["Location"];
	    
	    if ($id == (($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_location_id'] : $courseinfo[0]['Location_ID'])) {
	    	$location_options .= "<option value='$id' selected='selected'>$location</OPTION>";
	    } else {
		    $location_options .= "<option value='$id'>$location</OPTION>";
	    }
	}
	foreach ($types as $row) {
    	$id = $row["ID"];
	    $type = $row["Course_Type"];
	    
	    if ($id == (($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_type_id'] : $courseinfo[0]['Course_Type_ID'])) {
	    	$type_options .= "<option value='$id' selected='selected'>$type</OPTION>";
	    } else {
		    $type_options .= "<option value='$id'>$type</OPTION>";
	    }
	}
	foreach ($trainers as $row) {
    	$id = $row["ID"];
	    $trainer = $row["Name"];
	    
	    if ($id == (($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_trainer_id'] : $courseinfo[0]['Trainer_ID'])) {
	    	$trainer_options .= "<option value='$id' selected='selected'>$trainer</OPTION>";
	    } else {
		    $trainer_options .= "<option value='$id'>$trainer</OPTION>";
	    }
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
	
	<title><?php echo $courseinfo[0]['Company_Name']; ?> Course Edit</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/register.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="contact-form" class="clearfix">
            <h1><?php echo $courseinfo[0]['Company_Name']; ?> Course Edit</h1>
            <h2>Please use the form below to edit your selected course.<span class="ar"><a href="admin.php" title="Back"><img src="../img/arrow_left.png" alt="Back"/></a></span></h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">There was a problem saving your course:</li>
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
            <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Your course has been saved!</p>
 
            <form method="post" action="process_edit.php">
            	<input type="hidden" name="course_id" value="<?php echo $courseinfo[0]['Course_ID'] ?>">
            	<input type="hidden" name="company_id" value="<?php echo $courseinfo[0]['Company_ID'] ?>">

            	
                <label for="course_title">Title: <span class="required">*</span></label>
                <input type="text" id="course_title" name="course_title" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_title'] : $courseinfo[0]['Course_Title'] ?>" placeholder="Storage Basics" required autofocus />
                
                <label for="course_type_id">Type: <span class="required">*</span></label>
				<select name="course_type_id" required>Select Type<?php echo $type_options;?></select> 

                <label for="course_date_info">Date: (e.g. 01/01/12) <span class="required">*</span></label>
                <input type="text" id="course_date_info" name="course_date_info" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_date_info'] : $courseinfo[0]['Date_Info'] ?>" placeholder="01/01/01" required />
                
                <label for="course_time_info">Time: (e.g. 9:00am - 12:00pm) <span class="required">*</span></label>
                <input type="text" id="course_time_info" name="course_time_info" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['course_time_info'] : $courseinfo[0]['Time_Info'] ?>" placeholder="9:00am - 5:00pm" required />
                
                <label for="course_contact_id">Contact Name: <span class="required">*</span></label>
				<select name="course_contact_id" required>Select Contact<?php echo $contact_options;?></select> 
				
				<label for="course_location_id">Location: <span class="required">*</span></label>
				<select name="course_location_id" required>Select Location<?php echo $location_options;?></select> 

				<label for="course_trainer_id">Trainer Name: <span class="required">*</span></label>
				<select name="course_trainer_id" required>Select Trainer<?php echo $trainer_options;?></select> 
        
                <span id="loading"></span>
                <input type="submit" value="Save" id="submit-button" />
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