<?php
/*
Template Name: Newsletter
*/
?>
<?
	// HANDLE FORM SUBMISSION
	if (!empty($_REQUEST['dv_submit'])){
		$to = 'janderson@treasureparkcity.com, jbennett@treasureparkcity.com';
		$subject = "Message from TreasureParkCity Newsletter page";
		$from_name = $_REQUEST['dv_from_name'];
		$from_email = $_REQUEST['dv_from_email'];
		$message = "Request for newsletter:\n\n";
		$message .= "FROM:  ".$from_name."\n";
		$message .= "EMAIL:  ".$from_email."\n";
		$headers = array(
			"From: $from_name <$from_email>",
			"Cc: jbennett@treasureparkcity.com"
		);
		$result = wp_mail( $to, $subject, $message, $headers);
		if ($result) {
			$dv_message = "Message successfully sent!";
		}
	}
?>
<?php get_header(); ?>
<div id="contact-template-body">
	<div class="page-header"><?php strToUpper(the_title()); ?></div>
	<hr class="gallery-sample-hr" />
	<div id="contact-form">
		<form action="<?php the_permalink(); ?>" method="POST">
		   Name:<br>
		   <input type="text" id="name" name="dv_from_name" /><br>
		   Email:<br>
		   <input type="text" id="name" name="dv_from_email" /><br>
		   Message:<br>
		   <textarea type="text" id="message" name="dv_message"></textarea><br>
		   <input type="submit" id="submit" name="dv_submit" value="SUBMIT&nbsp;&nbsp;&nbsp;&gt;"></input>
		</form>
	</div>
	<nav id="sidebar">
		<?php include("dv_sidebar.php"); ?>
	</nav>
	<div style="clear:both"></div>
	<article id="content">
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					} 
				?>
				<?php the_content(); ?>
				<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
			</div>
		</div>
	</article>
</div>
<script>
	var dv_message = '<? echo $dv_message ?>';
	if (dv_message) {
		alert(dv_message);
	}
</script>
<?php get_footer(); ?>