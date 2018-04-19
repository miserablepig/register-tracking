<?php
require_once '../admin/config.php';
login_required();

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//form data
	$course_id = $_POST['course_id'];	
	$company_id = $_POST['company_id']; 
	$course_title = $_POST['course_title'];
	$course_type_id = $_POST['course_type_id'];
	$course_date_info = $_POST['course_date_info'];
	$course_time_info = strtolower($_POST['course_time_info']);
	$course_contact_id = $_POST['course_contact_id'];
	$course_location_id = $_POST['course_location_id'];
	$course_trainer_id = $_POST['course_trainer_id'];

	//validate form data
	//validate course title is not empty
	if(empty($course_title)){
		$formok = false;
		$errors[] = "You must enter a course title";
	}
	//validate date information
	if(empty($course_date_info)){
		$formok = false;
		$errors[] = "You have not entered a valid course date";
	} else {
		if (!preg_match('/^[0-9]{2}\/[0-9]{2}\/[0-9]{2}$/', $course_date_info)) {
    		$formok = false;
			$errors[] = "You must use a valid course date format";
		}
	}
	//validate time information
	if(empty($course_time_info)){
		$formok = false;
		$errors[] = "You have not entered a valid course time";
	} else {
		if (!preg_match('/^(([1-9])|([1-9][0-9]))\:(([1-9])|([0-9][0-9]))(am|pm)\s-\s(([1-9])|([1-9][0-9]))\:(([1-9])|([0-9][0-9]))(am|pm)$/', $course_time_info)) {
    		$formok = false;
			$errors[] = "You must use a valid course time format";
		}
	}
	
	//update course if all ok
	if($formok){
	
	update("UPDATE tbCourses SET Title='".$course_title."', Type_ID='".$course_type_id."', Date_Info='".$course_date_info."', Time_Info='".$course_time_info."', Contact_ID='".$course_contact_id."', Location_ID='".$course_location_id."', Trainer_ID='".$course_trainer_id."' WHERE ID=$course_id");

	}
	
	//what we need to return back to our form	
	$returndata = array(
		'posted_form_data' => array(
			'course_id' => $course_id,
			'company_id' => $company_id,
			'course_title' => $course_title,
			'course_type_id' => $course_type_id,
			'course_date_info' => $course_date_info,
			'course_time_info' => $course_time_info,
			'course_contact_id' => $course_contact_id,
			'course_location_id' => $course_location_id,
			'course_trainer_id' => $course_trainer_id
		),
		'form_ok' => $formok,
		'errors' => $errors
	);
	
	//if this is not an ajax request
	if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest'){
		//set session variables
		session_start();
		$_SESSION['cf_returndata'] = $returndata;
		
		//redirect back to form
		header('location: ' . $_SERVER['HTTP_REFERER']);
	}
}
