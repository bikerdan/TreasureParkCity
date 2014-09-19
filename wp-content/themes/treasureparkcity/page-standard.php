<?php
/*
Template Name: Standard
*/
?>
<?php get_header(); ?>
<div id="standard-template-body">
    <article id="content">
    	<div class="page-header"><?php strToUpper(the_title()); ?></div>
    	<hr class="gallery-sample-hr" />
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					} 
				?>
				<?php the_content(); ?>
				<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'blankslate' ) . '&after=</div>') ?>
				<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
			</div>
		</div>
	</article>
	<?php include("sidebar.php"); ?>
</div>
<?php get_footer(); ?>