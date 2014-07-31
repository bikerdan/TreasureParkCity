		<div class="header-slideshow">
			<div id="slides" style="display:none;">
				<?php
					$header_gallery_id = get_post_meta( get_the_ID(), 'header_gallery_id', true);

					if (strlen($header_gallery_id) == 0) {
						$id = '7'; // Main page header slideshow gallery
					} else {
        					$id = mysql_real_escape_string($header_gallery_id);
					}

					$id = "g.gid = '{$id}'";
					$sql = "SELECT p.filename, p.alttext, g.name, g.path FROM wp_ngg_gallery g INNER JOIN wp_ngg_pictures p ON (g.gid = p.galleryid) WHERE {$id} AND p.exclude = '0' ORDER BY p.sortorder ".($limit?"LIMIT $limit":"");
					$images = $wpdb->get_results( $sql );

					if (!empty($images)) {
						foreach ($images as $image){
							echo "<img src='/{$image->path}/{$image->filename}'>";
						}
					} else {
						?>
							<img src="/wp-content/themes/treasureparkcity/img/example-slide-1.jpg">
                            <img src="/wp-content/themes/treasureparkcity/img/example-slide-2.jpg">
							<img src="/wp-content/themes/treasureparkcity/img/example-slide-3.jpg">
							<img src="/wp-content/themes/treasureparkcity/img/example-slide-4.jpg">
						<?php
					}
					/*
					*/
				?>
				<img class="slidesjs-previous slidesjs-navigation" src="<?php echo blankslate_relative_path("img/slideshow_left.png"); ?>" />
				<img class="slidesjs-next slidesjs-navigation" src="<?php echo blankslate_relative_path("img/slideshow_right.png"); ?>" />
			</div>
		</div>
		<script>
			$(function() {
				$('#slides').slidesjs({
					width: 940, height: 400,
					navigation: {
						active: false,
						effect: "slide"
					},
					pagination: { active: false },
					effect: {
						fade: { speed: 400 }
					},
					play: {
						active: false,
						auto: true,
						interval: 4000
					}
				});
			});
		</script>