<?php
require_once '../admin/config.php';
login_required();

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//form data
	$partner_id      = trim(htmlspecialchars($_POST['partner_id'], ENT_QUOTES));
	$partner_name    = trim(htmlspecialchars($_POST['partner_name'], ENT_QUOTES));
	$partner_status  = trim(htmlspecialchars($_POST['partner_status'], ENT_QUOTES));
	$partner_website = trim(htmlspecialchars($_POST['partner_website'], ENT_QUOTES));
	$bdm_id          = trim(htmlspecialchars($_POST['bdm_id'], ENT_QUOTES));
	$partner_note    = trim(htmlspecialchars($_POST['partner_note'], ENT_QUOTES));

/*
	$course_date_info = $_POST['course_date_info'];
	$course_time_info = strtolower($_POST['course_time_info']);
	$course_contact_id = $_POST['course_contact_id'];
	$course_location_id = $_POST['course_location_id'];
	$course_trainer_id = $_POST['course_trainer_id'];
*/

	//validate form data
	//validate course title is not empty
	if(empty($partner_name)){
		$formok = false;
		$errors[] = "You must enter a partner name";
	}
/*
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
*/
	
	//update course if all ok
	if($formok){
		update("UPDATE tbPartners SET Name='".$partner_name."', Status='".$partner_status."', Website='".$partner_website."', BDM_ID='".$bdm_id."', Note='".$partner_note."' WHERE Partner_ID='".$partner_id."'");
    	log_event("Partner Edit", $_SESSION['fullname']." edited partner ".$partner_name);
	}
	
	//what we need to return back to our form	
	$returndata = array(
		'posted_form_data' => array(
			'partner_id' => $partner_id,
			'partner_name' => $partner_name,
			'partner_status' => $partner_status,
			'partner_website' => $partner_website,
			'bdm_id' => $bdm_id,
			'partner_note' => $partner_note

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
