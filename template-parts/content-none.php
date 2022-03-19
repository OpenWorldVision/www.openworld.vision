<section class="no-results not-found">

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p class="text-t1">' . wp_kses(
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'plaxer' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p class="text-t1"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'plaxer' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p class="text-t1"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'plaxer' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div>
</section>
