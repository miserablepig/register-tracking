<?php
require_once '../admin/config.php';
login_required();

if( isset($_POST) ){
	
	//form validation vars
	$formok = true;
	$errors = array();
	
	//form data
	$partner_name    = trim(htmlspecialchars($_POST['partner_name'], ENT_QUOTES));
	$partner_status  = trim(htmlspecialchars($_POST['partner_status'], ENT_QUOTES));
	$partner_website = trim(htmlspecialchars($_POST['partner_website'], ENT_QUOTES));
	$bdm_id          = trim(htmlspecialchars($_POST['bdm_id'], ENT_QUOTES));
	$partner_note    = trim(htmlspecialchars($_POST['partner_note'], ENT_QUOTES));


	//validate form data
	//validate partner name is not empty
	if(empty($partner_name)){
		$formok = false;
		$errors[] = "You must enter a partner name";
	}
	
	//insert partner if all ok
	if($formok){
		insert("INSERT INTO tbPartners (Name, Status, Website, BDM_ID, Note) VALUES ( '".$partner_name."' , '".$partner_status."' , '".$partner_website."' , '".$bdm_id."' , '".$partner_note."')");
		log_event("Partner Created", $_SESSION['fullname']." created partner ".$partner_name);
	}
	
	//what we need to return back to our form	
	$returndata = array(
		'posted_form_data' => array(
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
