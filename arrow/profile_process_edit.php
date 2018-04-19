<?php
require_once '../admin/config.php';
login_required();

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//form data
	$user_id      = $_POST['user_id'];
	$old_password = $_POST['old_password'];
	$fullname     = trim(htmlspecialchars($_POST['fullname'], ENT_QUOTES));
	$email        = trim(htmlspecialchars($_POST['email'], ENT_QUOTES));
	$password     = $_POST['password'];
	$repassword   = $_POST['repassword'];
	$hashpassword = md5($password);
	
	//validate form data
	//validate new passwords match
	if($password !== $repassword){
		$formok = false;
		$errors[] = "New passwords do not match";
	}
	
	//update contact if checks ok
	if($formok){
		update("UPDATE tbUsers SET Password='".$hashpassword."' WHERE UserID='".$user_id."'");
    	log_event("Password Change", $_SESSION['fullname']." changed their password");
	}
	
	//what we need to return back to our form	
	$returndata = array(
		'posted_form_data' => array(
			'user_id' => $user_id,
			'fullname' => $fullname,
			'email' => $email
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
