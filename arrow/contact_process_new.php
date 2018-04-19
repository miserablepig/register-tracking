<?php
require_once '../admin/config.php';
login_required();

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//form data
	$contact_firstname = trim(htmlspecialchars($_POST['contact_firstname'], ENT_QUOTES));
	$contact_surname   = trim(htmlspecialchars($_POST['contact_surname'], ENT_QUOTES));
	$partner_id        = trim(htmlspecialchars($_POST['partner_id'], ENT_QUOTES));
	$contact_email     = trim(htmlspecialchars(strtolower($_POST['contact_email']), ENT_QUOTES));
	$contact_mobile    = trim(htmlspecialchars($_POST['contact_mobile'], ENT_QUOTES));
	$contact_role      = trim(htmlspecialchars($_POST['contact_role'], ENT_QUOTES));
	$contact_note      = trim(htmlspecialchars($_POST['contact_note'], ENT_QUOTES));

	//validate form data
	//validate firstname is not empty
	if(empty($contact_firstname)){
		$formok = false;
		$errors[] = "You must enter a contact firstname";
	}
	//validate surname is not empty
	if(empty($contact_surname)){
		$formok = false;
		$errors[] = "You must enter a contact surname";
	}
	
	//update course if checks ok
	if($formok){
		insert("INSERT INTO tbContacts (Firstname, Surname, Partner_ID, Email, Mobile, Role, Note, Created_By) VALUES ( '".$contact_firstname."' , '".$contact_surname."' , '".$partner_id."' , '".$contact_email."' , '".$contact_mobile."' , '".$contact_role."' , '".$contact_note."' , '".$_SESSION['fullname']."')");
    	log_event("Contact Created", $_SESSION['fullname']." created contact ".$contact_firstname." ".$contact_surname);
	}
	
	//what we need to return back to our form	
	$returndata = array(
		'posted_form_data' => array(
			'contact_firstname' => $contact_firstname,
			'contact_surname' => $contact_surname,
			'partner_id' => $partner_id,
			'contact_email' => $contact_email,
			'contact_mobile' => $contact_mobile,
			'contact_role' => $contact_role,
			'contact_note' => $contact_note
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
