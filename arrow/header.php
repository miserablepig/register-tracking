<?php
require_once '../admin/config.php';

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
	
	<title>Arrow Partner Database</title>
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>

</head>
<body>
	<!-- TOP LINE -->
	<div class="top-line">
		<div class="top-wrapper">
	    	<div class="three-fourth notopmargin">
	            <div class="menu-left left"></div>
		            <ul class="sf-menu left">
		                <li><a href="index.php" class="menu-active">Home</a></li>
						<?php echo (logged_in()) ? '<li><a href="partner_list.php" class="menu-link">Partners</a></li>' : '' ?>
						<?php echo (logged_in()) ? '<li><a href="contact_list.php" class="menu-link">Contacts</a></li>' : '' ?>
						<?php echo (logged_in() && $_SESSION['reports']) ? '<li><a href="reports.php" class="menu-link">Reports</a></li>' : '' ?>
						<?php echo (logged_in() && $_SESSION['logs']) ? '<li><a href="logs.php" class="menu-link">Logs</a></li>' : '' ?>
		               	<li><a <?php echo (logged_in()) ? 'href="logout.php" class="menu-link">Logout' : 'href="login.php" class="menu-link">Login' ?></a></li>
 		            </ul>
	            <div class="menu-right left"></div>
	        </div>
	        
	        <?php echo (logged_in()) ? '
		        <div class="one-fourth last notopmargin">
			        <div class="fullname-header">
			        <span class="dark-text italic">Logged in as <a class="link light" href="profile.php?uid=' .$_SESSION['user_id']. '">' .$_SESSION['fullname']. '</a></span>
			        </div>
	            </div>'
	            : '' ?>
	
	    </div>
	</div>