<?php 
	require_once '../admin/config.php';
	admin_required();
	
	// Init Variables
	$cf = array();
	$sr = false;
	
	if(isset($_SESSION['cf_returndata'])){
		$cf = $_SESSION['cf_returndata'];
		$sr = true;
	}
	
	$bdm_options = '';
	$bdms = query("SELECT BDM_ID, Firstname, Surname FROM tbBDMs ORDER BY Surname");

	foreach ($bdms as $row) {
    	$id = $row["BDM_ID"];
	    $bdm = $row["Firstname"]." ".$row["Surname"];

		    $bdm_options .= "<option value='$id'>$bdm</OPTION>";
	}
?>

<?php include 'header.php'; ?>
    <!-- MAIN CONTENT -->
	<div class="wrapper on-light"> 
        <div id="contact-form" class="clearfix">
            <h1>New Partner</h1>
            <div class="inner-dot-separator notopmargin"></div>
            <h2>Please use the form below to create your new partner.<span class="ar"><a href="partner_list.php" title="Back"><img src="../img/arrow_left.png" alt="Back"/></a></span></h2>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">There was a problem creating your partner:</li>
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
            <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Your partner has been created!</p>
 
	 		<div id="area-left">
	            <form method="post" action="partner_process_new.php">	            	
	                <label for="partner_name">Partner Name: <span class="required">*</span></label>
	                <input type="text" id="partner_name" name="partner_name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_name'] : $courseinfo[0]['Partner_Name'] ?>" placeholder="Acme Ltd" required autofocus />
	                
	                <label for="partner_status">Status:</label>
	                <input type="text" id="partner_status" name="partner_status" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_status'] : $courseinfo[0]['Partner_Status'] ?>" placeholder="Silver" />
	        </div>
            
            <div id="area-right">
	                <label for="partner_website">Website:</label>
	                <input type="text" id="partner_website" name="partner_website" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_website'] : $courseinfo[0]['Partner_Website'] ?>" placeholder="www.example.com" />
	                
                	<label for="bdm_id">Business Development Manager: <span class="required">*</span></label>
					<select name="bdm_id" required>Select BDM<?php echo $bdm_options;?></select> 
            </div>
		          	<label for="partner_note">Notes:</label>
	                <textarea rows="10" class="memo" type="text" id="partner_note" name="partner_note" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['partner_note'] : '' ?>" placeholder="Notes about this partner"></textarea>
		
		            <div class="clear"></div>
		            <div class="inner-dot-separator"></div>
		            <input type="submit" value="Save" id="submit-button" />
		            <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>
	            </form>
	            <?php unset($_SESSION['cf_returndata']); ?>
		</div>
	    <div class="one left">
	    	<h4>Information Accuracy</h4>
	    	<p>All changes are tracked and your user details are stored. Please do your best to ensure the information you enter is accurate and up-to-date. Should you have any doubts regarding the accuracy of your information, please contact the Arrow Business Development Manager aligned to the relevant partner.</p>
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