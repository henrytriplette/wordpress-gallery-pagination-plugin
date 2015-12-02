<?php
add_action('admin_menu', 'pg_create_menu');

function pg_create_menu() {
	//create new top-level menu
	add_options_page('Wordpress Paginated Gallery - Settings', 'Wordpress Paginated Gallery', 'manage_options', 'pg_settings', 'pg_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_pgsettings' );
}


function register_pgsettings() {
	//register our settings
	register_setting( 'pg-settings-group', 'thumbnails_per_page' );
	register_setting( 'pg-settings-group', 'use_gallery_shortcode' );
}

function pg_settings_page() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page. Fuck off.') );
	}
	?>
	<div class="wrap">
		<h2>Paginated Gallery</h2>
		<form method="post" action="options.php">
		    <?php settings_fields( 'pg-settings-group' ); ?>
		    <?php //do_settings( 'pg-settings-group' ); ?>
		    <table class="form-table">
		        <tr valign="top">
			        <th scope="row">Thumbnails Per Page</th>
			        <td><input type="text" name="thumbnails_per_page" value="<?php echo get_option('thumbnails_per_page'); ?>" /></td>
		        </tr>
		        <tr valign="top">
			        <th scope="row">Use standard [gallery] shortcode?</th>
			        <td><input type="checkbox" name="use_gallery_shortcode" value="use_gallery_shortcode" <?php if(get_option('use_gallery_shortcode') == TRUE) {?> checked="checked" <?php } ?> /></td>
		        </tr>
		    </table>

		    <p class="submit">
			    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		    </p>
		</form>
	</div>
	<?php
}
?>
