<?php

//Log Events
function log_event($type, $event) {
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	$sql = "INSERT INTO tbLog (Type, Event) VALUES ( '".$type."' , '".$event."')";
	$stmt = $link->query($sql) or die($link->error);
	$stmt->close;
}

// Authentication
function validate_user($username, $pw) {
	$_SESSION['error'] = "";
	if(check_username_and_pw($username, $pw)) {
/* 		header('Location: registrations.php'); */
		header('location: ' . $_SERVER['HTTP_REFERER']);
		log_event("Successful Login", $_SESSION['fullname']." logged in at ".date('d/m/Y - H:ia'));
	} else {
		$_SESSION['error'] = "Login failed.";
		header('Location: login.php');
	}
}
function logged_in() {
	if($_SESSION['authorized'] == true) {
		return true;
	} else {
		return false;
	}
}
function admin_required() {
	if(logged_in() && $_SESSION['admin']) {
		return true;
	} else {
		header('Location: index.php');
	}
}
function login_required() {
	if(logged_in()) {
		return true;
	} else {
		header('Location: login.php');
	}
}
// MySQL
function query($sql) {
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	
	$stmt = $link->prepare($sql) or die('error');
	$stmt->execute();
	$meta = $stmt->result_metadata();

	while ($field = $meta->fetch_field()) {
		$parameters[] = &$row[$field->name];
	}

	$results = array();
	call_user_func_array(array($stmt, 'bind_result'), $parameters);

	while ($stmt->fetch()) {
		foreach($row as $key => $val) {
			$x[$key] = $val;
		}
		$results[] = $x;
	}

	return $results;
	$results->close();
	$link->close();
}

function insert($sql) {
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	
	$stmt = $link->query($sql) or die($link->error);
	$stmt->close;
}

function update($sql) {
    $link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');

    $stmt = $link->query($sql) or die($link->error);
    $stmt->close;
}

function count_query($query) {
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	if($stmt = $link->prepare($query)) {
		$stmt->execute();
	    $stmt->bind_result($result);
	    $stmt->fetch();
		return $result;
		$stmt->close();
	}
	$link->close();
}

function check_username_and_pw($u, $pw) {
	$link = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database.');
	
	$query = "SELECT * FROM tbUsers WHERE username = ? AND password = ? LIMIT 1";
	if($stmt = $link->prepare($query)) {
		$p = md5($pw);
		$stmt->bind_param('ss', $u, $p);
		$stmt->execute();
		$stmt->bind_result($id, $username, $pw, $fullname, $email, $admin, $reports, $logs);
		if($stmt->fetch()) {
			$_SESSION['authorized'] = true;
			$_SESSION['user_id'] = $id;
			$_SESSION['username'] = $username;
			$_SESSION['fullname'] = $fullname;
			$_SESSION['email'] = $email;
			$_SESSION['admin'] = $admin;
			$_SESSION['reports'] = $reports;
			$_SESSION['logs'] = $logs;
			return true;
		} else {
			return false;
		}
		$stmt->close();		
	}
	$link->close();
}

// Render error messages
function error_messages() {
    $message = '';
    if($_SESSION['success'] != '') {
        $message = '<span class="success" id="message">'.$_SESSION['success'].'</span>';
        $_SESSION['success'] = '';
    }
    if($_SESSION['error'] != '') {
        $message = '<span class="error" id="message">'.$_SESSION['error'].'</span>';
        $_SESSION['error'] = '';
    }
    return $message;
}