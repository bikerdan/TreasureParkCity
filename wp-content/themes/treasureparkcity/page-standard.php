<?php
/*
Template Name: Standard
*/
?>
<?php get_header(); ?>
<div id="standard-template-body">
	<div class="page-header"><?php strToUpper(the_title()); ?></div>
	<hr class="gallery-sample-hr" />
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
	<nav id="sidebar">
		<?php include("dv_sidebar.php"); ?>
		<?php
			$sidebar_gallery_id = get_post_meta( get_the_ID(), 'sidebar_gallery_id', true);
			$sidebar_gallery_link = get_post_meta( get_the_ID(), 'sidebar_gallery_link', true);
			if (empty($sidebar_gallery_id)) {
				$sidebar_gallery_id = 18; // Default to the-club gallery if not set
				$sidebar_gallery_link = '/club-gallery';
			}
			if (!empty($sidebar_gallery_id)) {
				$id = mysql_real_escape_string($sidebar_gallery_id);
				$id = "g.gid = '{$id}'";
				$sql = "SELECT p.filename, p.alttext, g.name, g.path FROM wp_ngg_gallery g INNER JOIN wp_ngg_pictures p ON (g.gid = p.galleryid) WHERE {$id} AND p.exclude = '0' ORDER BY p.sortorder ".($limit?"LIMIT $limit":"");
				$images = $wpdb->get_results( $sql );
				if (!empty($images)) {
					?>
					<div id="events" class="sidebar-section">
						<a href="/galleries">
							<div class="sidebar-section-title">GALLERY</div>
						</a>
						<div id="gallery-thumbs" class="sidebar-section">
						<?php
						foreach ($images as $image){
							echo "<a href='{$sidebar_gallery_link}'><img class='gallery-thumb' height='275' width='275' src='/{$image->path}/{$image->filename}'></a>";
						}
						?>
						</div>
					</div>
					<?php
				}
			}
		?>
		<!--div id="gallery-thumbs" class="sidebar-section">
			<a href="/club-gallery"><img class='gallery-thumb' height="275" width="275" src='/wp-content/gallery/misc/thumbs/thumbs_lobby-275x275.jpg'></a>
			<a href="/residence-gallery"><img class='gallery-thumb' src='/wp-content/gallery/water/res1_homepg.jpg'></a>
			<a href="/lifestyle-gallery"><img class='gallery-thumb' src='/wp-content/gallery/portraits/entertainment_room-275x275.jpg'></a>
			<a href="/amenities-gallery"><img class='gallery-thumb' src='/wp-content/gallery/dan/amen9.jpg'></a>
			<a href="/staff-gallery"><img class='gallery-thumb' src='/wp-content/gallery/staff/staff.jpg'></a>
		</div-->
	</nav>
	<div style="clear:both"></div>
</div>
<?php get_footer(); ?>