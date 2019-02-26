<?php
/**
 * Create meta options for the slides post type
 *
 * @since 1.0
 */
 
function wpex_slides_meta_array() {
	$prefix = 'wpex_';
	return array(
		'id' => 'att-slides-meta-box-slider',
		'title' =>  __('Post Options', 'fresh-clean'),
		'page' => 'slides',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => __('Video URL','fresh-clean'),
				'desc' =>  __('Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'fresh-clean') .' <a href="http://codex.wordpress.org/Embeds" target="_blank">'. __('Learn More', 'fresh-clean'),
				'id' => $prefix . 'slides_video',
				'type' => 'text',
				'std' => ''
			),
			array(
				'name' => __('Link URL','fresh-clean'),
				'desc' =>  __('Enter a URL to link this slide to. Example: http://authenticthemes.com', 'fresh-clean') .'</a>',
				'id' => $prefix . 'slides_url',
				'type' => 'text',
				'std' => ''
			),
			array(
				'name' => __('Link Target','fresh-clean'),
				'desc' =>  __('Select a target for the URL.', 'fresh-clean') .'</a>',
				'id' => $prefix . 'slides_url_target',
				'type' => 'select',
				'std' => 'self',
				'options' => array(
					'self' => 'self',
					'blank' => 'blank'
				)
			)
		),
	);
}

/*-----------------------------------------------------------------------------------*/
// Display meta box in edit slides page
/*-----------------------------------------------------------------------------------*/
function wpex_add_box_slides_settings() {
	$settings = wpex_slides_meta_array();
	add_meta_box( $settings['id'], $settings['title'], 'wpex_show_box_slides_settings', $settings['page'], $settings['context'], $settings['priority']);

}
add_action( 'add_meta_boxes', 'wpex_add_box_slides_settings' );

/*-----------------------------------------------------------------------------------*/
//	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function wpex_show_box_slides_settings( $post ) {
	$settings = wpex_slides_meta_array();
	
	// Use nonce for verification
	echo '<input type="hidden" name="wpex_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ( $settings['fields'] as $field ) {
		
		// get current post meta data & set default value if empty
		$meta = get_post_meta( $post->ID, $field['id'], true);
		
		if ( empty ( $meta ) ) {
			$meta = $field['std']; 
		}
		
		switch ($field['type']) {
 
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:50%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;
				
			//If upload		
			case 'upload':
				
				echo '<tr>',
					'<th style="width:50%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
					'<td>';
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:65%; margin-right: 20px; float:left;" />';
				echo '<input style="float: left;" type="button" class="wpex_meta_upload button-secondary" button" id="', $field['id'],'_button" value="Upload Image" />';
				
				echo '</td>';
				
				break;
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			
			//If Textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#777; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			

		}

	}
 
	echo '</table>';
}

/*-----------------------------------------------------------------------------------*/
//	Save data when slides is edited
/*-----------------------------------------------------------------------------------*/
 
function wpex_save_data_slides( $post_id ) {
	$settings = wpex_slides_meta_array();
	
	if ( ! isset($_POST['wpex_meta_box_nonce'])) $_POST['wpex_meta_box_nonce'] = "undefine";
 
	// verify nonce
	if (! wp_verify_nonce($_POST['wpex_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	//Save fields
	foreach ($settings['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

}
add_action( 'save_post', 'wpex_save_data_slides' );

/*-----------------------------------------------------------------------------------*/
/*	Queue Scripts
/*-----------------------------------------------------------------------------------*/
function wpex_slides_meta_scripts( $hook ) {
	if ( $hook == 'post.php' || $hook == 'post-new.php') {
		wp_enqueue_script( 'wpex-meta-upload', get_template_directory_uri() . '/functions/meta/js/upload_meta.js', array( 'jquery','media-upload', 'thickbox' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'wpex_slides_meta_scripts', 10, 1 );