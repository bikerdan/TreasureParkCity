<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
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
			<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'blankslate' ) . '&after=</div>') ?>
			<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
		</div>
	</div>
</article>
<?php get_footer(); ?>