<?php

if ( post_password_required() ) {
	return;
}

function plaxer_comment($comment, $args, $depth) {
    $comment_id = $comment->comment_ID; 
  ?>
  <li <?php comment_class('comment-item clearfix') ?> id="comment-<?php echo esc_attr($comment_id) ?>">
    <a href="#" class="replytocom" data-id="<?php echo esc_html(get_comment_ID()) ?>"><i class="base-icon-reply"></i><span><?php echo esc_html_e( 'reply', 'plaxer' ); ?></span></a>
		<?php if(get_avatar($comment, '300')) { ?>
			<div class="image"><?php echo get_avatar($comment, '300') ?></div>
		<?php } ?>
		<div class="area">
			<div class="top">
        <div class="name"><?php comment_author(); ?></div>
				<div class="time"><?php echo get_comment_date('j M Y, '.get_option( 'time_format' ), $comment_id); ?></div>
			</div>
			<div class="content">
				<?php echo wp_kses($comment->comment_content, 'post') ?>
			</div>
		</div>
	</li>
<?php
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<div class="comment-items-wrap">
			<h5 class="comment-title"><?php echo esc_html__('Comments', 'plaxer') ?></h5>
			<ul class="comment-items">
				<?php wp_list_comments(array('callback' => 'plaxer_comment')); ?>
			</ul>
			<?php if(paginate_comments_links()) { ?>
			<div class="pagination">
				<?php echo paginate_comments_links(); ?>
			</div>
			<?php } ?>
		</div>
	<?php endif;


	
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php echo esc_html_e( 'comments are closed.', 'plaxer' ); ?></p>
	<?php endif;
	
	add_filter('comment_form_fields', 'plaxer_reorder_comment_fields' );
	function plaxer_reorder_comment_fields( $fields ){

		$new_fields = array(); 

		$myorder = array('author','email','url','comment');

		foreach( $myorder as $key ){
			$new_fields[ $key ] = $fields[ $key ];
			unset( $fields[ $key ] );
		}

		if( $fields )
			foreach( $fields as $key => $val )
				$new_fields[ $key ] = $val;

		return $new_fields;
	}

	$post_id = get_the_ID();
	?>

	<div id="commentform-area">
		<?php comment_form(array(
			'fields' => array(
				'author' => '<div class="col-12"><div class="input-row"><input id="author" class="style1" placeholder="'. esc_attr__( 'Your Name','plaxer' ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></div></div>',
				'email'  => '<div class="col-12"><div class="input-row"><input id="email" class="style1" placeholder="'. esc_attr__( 'Your E-mail','plaxer' ) .'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /></div></div>',
				'url'    => '',
			),
			'logged_in_as'         => '<div class="col-12 logged-links"><p>' . sprintf( wp_kses(__( '<a href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">Logged in as %2$s</a> <a href="%3$s" class="logout">Log out</a>','plaxer' ), 'post'), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p></div>',
			'class_form'           => 'comment-form row',
			'comment_field'        => '<div class="col-12"><div class="input-row"><textarea id="comment" class="style1" placeholder="'. esc_attr__( 'Your Comment','plaxer' ) .'" name="comment" rows="4" maxlength="65525" required="required"></textarea></div></div>',
			'label_submit'         => esc_html__( 'Send it Now' ,'plaxer'),
      'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="button-style1"><span>%4$s</span></button>',
			'submit_field'         => '<div class="col-12">%1$s %2$s</div>',
			'comment_notes_before' => '',
			'title_reply_before'   => '<h5 class="comment-title"><span>',
			'title_reply_after'    => '</span></h5>',
			'title_reply'          => esc_html__( 'Leave a Comment', 'plaxer' ),
		)) ?>
	</div>
</div>