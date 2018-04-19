<?php
require_once '../admin/config.php';

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//sumbission data
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	$date = date('d/m/Y');
	$time = date('H:i:s');
	
	//form data
	$id = $_POST['course_id'];	
	$name =  trim(ucwords($_POST['name']));	
	$email = trim(strtolower($_POST['email']));
	$partner = trim($_POST['partner']);
	$course_type = $_POST['course_type'];
	$course_title = $_POST['course_title'];
	$course_location = $_POST['course_location'];
	$course_address = $_POST['course_address'];
	$course_date_info = $_POST['course_date_info'];
	$course_time_info = $_POST['course_time_info'];
	$course_company = $_POST['course_company'];
	$contact_name = $_POST['contact_name'];
	$contact_email = $_POST['contact_email'];

	//validate form data
	
	//validate name is not empty
	if(empty($name)){
		$formok = false;
		$errors[] = "You have not entered a name";
	}
	//validate email address is not empty
	if(empty($email)){
		$formok = false;
		$errors[] = "You have not entered an email address";
	//validate email address is valid
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$formok = false;
		$errors[] = "You have not entered a valid email address";
	}
	//validate partner is not empty
	if(empty($partner)){
		$formok = false;
		$errors[] = "You have not entered a partner";
	}
	
	//confirm registration does not already exist	
	$emailquery = query("SELECT tbRegistrations.ID FROM tbRegistrations WHERE tbRegistrations.Email = '$email' AND tbRegistrations.Course_ID = '$id' LIMIT 1");
	if(!empty($emailquery[0]['ID'])) {
		$formok = false;
		$errors[] = "That email is already registered";
	}
	
	//send email if all is ok
	if($formok){
	
		insert("INSERT INTO tbRegistrations (Course_ID, Name, Email, Partner) VALUES ( '".$id."' , '".$name."' , '".$email."' , '".$partner."')");

		
		$headers = "From: do_not_reply@registertracking.com" . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		$emailbody = "<p>You have received a new registration.</p>
					  <p><strong>Information</strong></p>
					  <p><strong>Name: </strong> {$name} <br>
					     <strong>Email: </strong> {$email} <br>
					     <strong>Partner: </strong> {$partner} </p>     
					  <p><strong>Course Details</strong></p>
					  <p><strong>Course: </strong> {$course_company} {$course_type} {$course_title} <br>
					     <strong>Location: </strong> {$course_location} <br>
					     <strong>Date: </strong> {$course_date_info} </p>
					  <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";
		
		mail($contact_email,"New Registration",$emailbody,$headers);
		
		$emailbody = "<p>Your registration has been successful!</p>
					  <p><strong>Your Information</strong></p>
					  <p><strong>Name: </strong> {$name} <br>
					     <strong>Email: </strong> {$email} <br>
					     <strong>Partner: </strong> {$partner} </p>     
					  <p><strong>Course Details</strong></p>
					  <p><strong>Course: </strong> {$course_company} {$course_type} {$course_title} <br>
					     <strong>Address: </strong> {$course_address} <br>
					     <strong>Date: </strong> {$course_date_info} </p>
					  <p>If you have any questions regarding your registration, or wish to cancel, please contact {$contact_name} at {$contact_email}</p>
					  <p>Thank you</p>";
		
		mail($email,"Registration Successful",$emailbody,$headers);
	}
	
	//what we need to return back to our form
	$returndata = array(
		'posted_form_data' => array(
			'name' => $name,
			'email' => $email,
			'partner' => $partner,
			'course_type' => $course_type,
			'course_title' => $course_title,
			'course_location' => $course_location,
			'course_date_info' => $course_date_info,
			'course_time_info' => $course_time_info,
			'course_company' => $course_company,
			'contact_name' => $contact_name,
			'contact_email' => $contact_email
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
