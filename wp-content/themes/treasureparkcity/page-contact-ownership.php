<?php
/*
Template Name: Contact Ownership
*/
?>
<?
	// HANDLE FORM SUBMISSION
	if (!empty($_REQUEST['dv_submit'])){

		if (empty($_REQUEST['dv_from_name']) || empty($_REQUEST['dv_from_email']) || empty($_REQUEST['dv_message'])) {
			$dv_message = "Please complete all required fields.";
		} else {
			$to = 'mike@lormikpromotions.com';
			$subject = "Message from TreasureParkCity Contact Ownership page";
			$from_name = $_REQUEST['dv_from_name'];
			$from_email = $_REQUEST['dv_from_email'];
			$phone = $_REQUEST['dv_phone'];
			$address = $_REQUEST['dv_address'];
			$city_state_zip = $_REQUEST['dv_city_state_zip'];
			$heard_about = $_REQUEST['dv_heard_about'];
			$message = <<<MSG
				Name: $from_name\n
				Email: $from_email\n
				Phone: $phone\n
				Address: $address\n
				City State Zip: $city_state_zip\n
				Heard About: $heard_about\n
				Message: $message\n
			 	{$_REQUEST['dv_message']}
MSG;
			$headers = array(
				"From: $from_name <$from_email>"
			);
			$result = wp_mail( $to, $subject, $message, $headers);
			if ($result) {
				$dv_message = "Message successfully sent!";
			}	
		}
	}
?>
<?php get_header(); ?>
<div id="contact-template-body">
	<div class="page-header"><?php strToUpper(the_title()); ?></div>
	<hr class="gallery-sample-hr" />
	<div id="contact-form">
		<article id="content" style="width: 750px; font-size: 16px;">
			<?php the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} 
					?>
					<?php the_content(); ?>
				</div>
			</div>
		</article>
		<br>
		<h1>Request More Information</h1>
		<br>
		<form action="<?php the_permalink(); ?>" method="POST">
		   Your name:<span class="required_symbol">*</span><br>
		   <input type="text" id="name" name="dv_from_name" value="<?=$_REQUEST['dv_from_name']?>"/><br>
		   Your email address:<span class="required_symbol">*</span><br>
		   <input type="text" id="name" name="dv_from_email" value="<?=$_REQUEST['dv_from_email']?>" /><br>
		   Your phone number:<br>
		   <input type="text" id="name" name="dv_phone" value="<?=$_REQUEST['dv_phone']?>" /><br>
		   Your address:<br>
		   <input type="text" id="name" name="dv_address" value="<?=$_REQUEST['dv_address']?>" /><br>
		   City, State, Zip Code:<br>
		   <input type="text" id="name" name="dv_city_state_zip" value="<?=$_REQUEST['dv_city_state_zip']?>" /><br>
		   How did you hear about us:<br>
		   <select id="name" name="dv_heard_about">
		   		<option value="word of mouth" value="<? echo ($_REQUEST['dv_heard_about'] == 'word_of_mouth' ? 'selected' : '') ?>">Word of Mouth</option>
		   </select><br>
		   Comments/Questions:<span class="required_symbol">*</span><br>
		   <textarea type="text" id="message" name="dv_message"><?=$_REQUEST['dv_message']?></textarea><br>
		   <input type="submit" id="submit" name="dv_submit" value="SUBMIT&nbsp;&nbsp;&nbsp;&gt;"></input>
		   <br>
		   <span class="required_symbol">*</span> Indicates a required field
		</form>
	</div>
	<nav id="sidebar">
		<?php include("dv_sidebar.php"); ?>
	</nav>
	<div style="clear:both"></div>
</div>
<script>
	var dv_message = '<? echo $dv_message ?>';
	if (dv_message) {
		alert(dv_message);
	}
</script>
<?php get_footer(); ?>