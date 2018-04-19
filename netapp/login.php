<?php
require_once '../admin/config.php';
if(logged_in()) {header('Location: admin.php');}

if($_POST && (!empty($_POST['username'])) && (!empty($_POST['password']))) {
	validate_user($_POST['username'], $_POST['password']);
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
	
	<title>Login</title>
	<link rel="shortcut icon" href="../favicon.ico">
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/register.css">

	<script src="../js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="contact-form" class="clearfix">
            <h1>Login</h1>
            <h2>Access to this page is restricted - please login.</h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">Login unsuccessful:</li>
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
            <form method="post" action="login.php">
                <label for="username">Username: <span class="required">*</span></label>
                <input type="text" id="username" name="username" value="" required autofocus />
                
                <label for="password">Password: <span class="required">*</span></label>
                <input type="password" id="password" name="password" value="" required />
     
                
                <span id="loading"></span>
                <input type="submit" value="Login" id="submit-button" />
                <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
            </form>
        </div>
    </div>

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