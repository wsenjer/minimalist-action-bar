<?php

// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

    add_submenu_page('options-general.php', 'DW PromoBar', 'DW PromoBar', 'administrator', 'dw_promobar', 'dwpb_settings_page');

    //call register settings function
    add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	$dwpb_settings_array = array(
		//General Setting
		'dwpb_enable',
		'dwpb_start',
		'dwpb_end',
		'dwpb_close',
		'dwpb_ramain_top',
		'dwpb_push_page',
		'dwpb_show_bottom',

		'dwpb_responsive_extra_small',
		'dwpb_responsive_small',
		'dwpb_responsive_medium',
		'dwpb_responsive_large',

		'dwpb_front_page',
		'dwpb_archives',
		'dwpb_tags',
		'dwpb_single_post',
		'dwpb_single_page',		

		'dwpbcd_use',

		//Configure DW PromoBar coutdown
		'dwpbcd_time_left',
		'dwpbcd_text',
		'dwpbcd_link_text',
		'dwpbcd_link_url',
		'dwpbcd_link_target',

		//Configure DW PromoBar
		'dwpb_bar_text', 
		'dwpb_link_text',
		'dwpb_link_url',
		'dwpb_link_target',

		//Choose the Style
		'dwpb_font_family',
		'dwpb_font_size',
		'dwpb_background_color',
		'dwpb_background_image',
		'dwpb_font_color',
		'dwpb_border_color',
		'dwpb_link_color',
		'dwpb_link_style',
		'dwpb_button_color',

		//Custom
		'dwpb_custon_style'
	);
	foreach ($dwpb_settings_array as $value) {
		register_setting( 'dwpb-settings-group', $value );
	}
}

function dwpb_settings_page() {
?>
<div class="wrap">
<h2>DW PromoBar Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'dwpb-settings-group' ); ?>
    <?php do_settings_sections( 'dwpb-settings-group' ); ?>
	
	<?php do_action( 'dwpb_previvew' ); ?>
    <div id="dwpb-steps">
		<h3><?php _e('General Settings','dwpb') ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Enable DW Promobar?','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_enable = get_option('dwpb_enable');
						$dwpb_enable_select = '';
						if ( $dwpb_enable == 'yes' ) {
							$dwpb_enable_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_enable" value="no" checked><?php _e('No','dwpb') ?></label>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_enable" value="yes" <?php echo $dwpb_enable_select; ?> ><?php _e('Yes','dwpb') ?></label>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Start on','dwpb') ?></th>
				<td>
					<input class="regular-text dwpb_time_picker" type="text" name="dwpb_start" value="<?php echo get_option('dwpb_start'); ?>" />
					<span class="description"><?php _e('Leave blank if you want to start the bar immediately!') ?></span>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Stop on','dwpb') ?></th>
				<td>
					<input class="regular-text dwpb_time_picker" type="text" name="dwpb_end" value="<?php echo get_option('dwpb_end'); ?>" />
					<span class="description"><?php _e('Leave blank if you do not want to close the bar!') ?></span>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><?php _e('Allow to Close PromoBar ?','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_close = get_option('dwpb_close');
						$dwpb_close_select = '';
						if ( $dwpb_close == 'yes' ) {
							$dwpb_close_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_close" value="no" checked><?php _e('No','dwpb') ?></label>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_close" value="yes" <?php echo $dwpb_close_select; ?> ><?php _e('Yes','dwpb') ?></label>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Remain at top of page?','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_ramain_top = get_option('dwpb_ramain_top');
						$dwpb_ramain_top_select = '';
						if ( $dwpb_ramain_top == 'fixtop' ) {
							$dwpb_ramain_top_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input class="ramain-top" type="radio" name="dwpb_ramain_top" value="ramain-top" checked><?php _e('No','dwpb') ?></label>
					<label style="margin-right: 50px;"><input class="fixtop" type="radio" name="dwpb_ramain_top" value="fixtop" <?php echo $dwpb_ramain_top_select; ?> ><?php _e('Yes','dwpb') ?></label>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Push page down?','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_push_page = get_option('dwpb_push_page');
						$dwpb_push_page_select = '';
						if ( $dwpb_push_page == 'push' ) {
							$dwpb_push_page_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input class="no-push" type="radio" name="dwpb_push_page" value="no-push" checked > <?php _e('No','dwpb') ?> </label>

					<label style="margin-right: 50px;"><input class="push-page" type="radio" name="dwpb_push_page" value="push" <?php echo $dwpb_push_page_select; ?> ><?php _e('Yes','dwpb') ?></label>
				</td>
			</tr>

			<!-- <tr>
				<th scope="row"><?php _e('Show promobar at bottom','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_show_bottom = get_option('dwpb_show_bottom'); 
						$dwpb_show_bottom_select = '';
						if ( $dwpb_show_bottom == 'yes' ) {
							$dwpb_show_bottom_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input class="no-push" type="radio" name="dwpb_show_bottom" value="no" checked > <?php _e('No','dwpb') ?> </label>

					<label style="margin-right: 50px;"><input class="push-page" type="radio" name="dwpb_show_bottom" value="yes" <?php echo $dwpb_show_bottom_select; ?> ><?php _e('Yes','dwpb') ?></label>
				</td>
			</tr> -->

			<tr>
				<th scope="row"><?php _e('Hide Promobar','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_responsive_extra_small = get_option('dwpb_responsive_extra_small');
						$dwpb_responsive_extra_small_select = '';
						if ( $dwpb_responsive_extra_small ) {
							$dwpb_responsive_extra_small_select = 'checked';
						}

						$dwpb_responsive_small = get_option('dwpb_responsive_small');
						$dwpb_responsive_small_select = '';
						if ( $dwpb_responsive_small ) {
							$dwpb_responsive_small_select = 'checked';
						}

						$dwpb_responsive_medium = get_option('dwpb_responsive_medium');
						$dwpb_responsive_medium_select = '';
						if ( $dwpb_responsive_medium ) {
							$dwpb_responsive_medium_select = 'checked';
						}

						$dwpb_responsive_large = get_option('dwpb_responsive_large');
						$dwpb_responsive_large_select = '';
						if ( $dwpb_responsive_large ) {
							$dwpb_responsive_large_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_responsive_extra_small" value="true" <?php echo $dwpb_responsive_extra_small_select; ?> > <?php _e('Phones < 768px','dwpb') ?> </label>

					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_responsive_small" value="true" <?php echo $dwpb_responsive_small_select; ?> ><?php _e('768px &le; Tablets < 992px ','dwpb') ?></label>

					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_responsive_medium" value="true" <?php echo $dwpb_responsive_medium_select; ?> ><?php _e('992 &le; Desktops < 1200 ','dwpb') ?></label>

					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_responsive_large" value="true" <?php echo $dwpb_responsive_large_select; ?> ><?php _e('Desktops (≥1200px)','dwpb') ?></label>
				</td>
			</tr>
			<tr>
				<td style="padding-top: 0; padding-bottom: 0; "></td>
				<td style="padding-top: 0; padding-bottom: 0; "><span class="description"><?php _e('Don\'t select any if you want to display the bar on all devices') ?></span>
				</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Show Promobar on','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_front_page = get_option('dwpb_front_page');
						$dwpb_front_page_select = '';
						if ( $dwpb_front_page ) {
							$dwpb_front_page_select = 'checked';
						}

						$dwpb_archives = get_option('dwpb_archives');
						$dwpb_archives_select = '';
						if ( $dwpb_archives ) {
							$dwpb_archives_select = 'checked';
						}

						$dwpb_tags = get_option('dwpb_tags');
						$dwpb_tags_select = '';
						if ( $dwpb_tags ) {
							$dwpb_tags_select = 'checked';
						}

						$dwpb_single_post = get_option('dwpb_single_post');
						$dwpb_single_post_select = '';
						if ( $dwpb_single_post ) {
							$dwpb_single_post_select = 'checked';
						}

						$dwpb_single_page = get_option('dwpb_single_page');
						$dwpb_single_page_select = '';
						if ( $dwpb_single_page ) {
							$dwpb_single_page_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_front_page" value="true" <?php echo $dwpb_front_page_select; ?> > <?php _e('Front Page','dwpb') ?> </label>

					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_archives" value="true" <?php echo $dwpb_archives_select; ?> ><?php _e('Archives','dwpb') ?></label>

					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_tags" value="true" <?php echo $dwpb_tags_select; ?> ><?php _e('Tags','dwpb') ?></label>
					
					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_single_post" value="true" <?php echo $dwpb_single_post_select; ?> ><?php _e(' Single Posts','dwpb') ?></label>

					<label style="margin-right: 50px;"><input type="checkbox" name="dwpb_single_page" value="true" <?php echo $dwpb_single_page_select; ?> ><?php _e('Single Pages','dwpb') ?></label>
				</td>
			</tr>
			<tr>
				<td style="padding-top: 0; padding-bottom: 0; "></td>
				<td style="padding-top: 0; padding-bottom: 0; "><span class="description"><?php _e('Don\'t select any if you want to display the bar on all pages') ?></span>
				</td>
			</tr>
		</table>

		<h3><?php _e('Text Message Settings','dwpb') ?></h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><?php _e('Text Message','dwpb') ?></th>
				<td>
					<input class="regular-text" type="text" name="dwpb_bar_text" placeholder="<?php _e('Hello. Add your message here.','dwpb'); ?>" value="<?php echo get_option('dwpb_bar_text'); ?>" />
				</td>
			</tr>
			
			<tr>
				<th scope="row"><?php _e('Link Text','dwpb') ?></th>
				<td>
					<input class="regular-text" type="text" name="dwpb_link_text" placeholder="<?php _e('Add your link text here.','dwpb'); ?>" value="<?php echo get_option('dwpb_link_text'); ?>" />
				</td>
			</tr>

			<tr class="dwpb-link-url">
				<th scope="row"><?php _e('Link URL','dwpb') ?></th>
				<td>
					<input class="regular-text" type="text" name="dwpb_link_url" placeholder="<?php _e('http://yoursite.com','dwpb'); ?>" value="<?php echo get_option('dwpb_link_url'); ?>" />
				</td>
			</tr>

			<tr class="dwpb-link-target">
				<th scope="row"><?php _e('Open link in a new tab?','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_link_target = get_option('dwpb_link_target');
						$dwpb_link_target_select = '';
						if ( $dwpb_link_target == '_blank' ) {
							$dwpb_link_target_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_link_target" value="_self" checked> <?php _e('No','dwpb'); ?> </label>

					<label style="margin-right: 50px;"><input type="radio" name="dwpb_link_target" value="_blank" <?php echo $dwpb_link_target_select; ?>> <?php _e('Yes','dwpb'); ?> </label>
				</td>
			</tr>
		</table>
		
		<h3><?php _e('Countdown Settings','dwpb') ?></h3>
		<table class="form-table">
			<tr>
				<th scope="row"><?php _e('Use Countdown?','dwpb') ?></th>
				<td>
					<?php 
						$dwpbcd_use = get_option('dwpbcd_use');
						$dwpbcd_use_select = '';
						if ( $dwpbcd_use == 'yes' ) {
							$dwpbcd_use_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="radio" name="dwpbcd_use" value="no" checked> <?php _e('No','dwpb'); ?> </label>

					<label style="margin-right: 50px;"><input type="radio" name="dwpbcd_use" value="yes" <?php echo $dwpbcd_use_select; ?> > <?php _e('Yes','dwpb'); ?> </label>
				</td>
			</tr>
			

			<?php 
				$dwpbcd_hide = 'hide';
				if (get_option('dwpbcd_use') == 'yes') {
					$dwpbcd_hide = '';
				} 
			?>
			<tr valign="top" class="dwpbcd <?php echo $dwpbcd_hide ?>">
				<th scope="row"><?php _e('Countdown Time to','dwpb') ?></th>
				<td>
					<input class="regular-text dwpb_time_picker" type="text" name="dwpbcd_time_left" value="<?php echo get_option('dwpbcd_time_left'); ?>" />
					<span class="description"><?php _e('This time is based on the server time of your site!') ?></span>
				</td>
			</tr>

			<tr valign="top" class="dwpbcd <?php echo $dwpbcd_hide ?>">
				<th scope="row"><?php _e('Countdown Text','dwpb') ?></th>
				<td>
					<input class="regular-text" type="text" name="dwpbcd_text" placeholder="<?php _e('Hello. Add your message here.','dwpb'); ?>" value="<?php echo get_option('dwpbcd_text'); ?>" />
				</td>
			</tr>

			<tr valign="top" class="dwpbcd <?php echo $dwpbcd_hide ?>">
				<th scope="row"><?php _e('Countdown Link Text','dwpb') ?></th>
				<td>
					<input class="regular-text" type="text" name="dwpbcd_link_text" placeholder="<?php _e('Add your link text here.','dwpb'); ?>" value="<?php echo get_option('dwpbcd_link_text'); ?>" />
				</td>
			</tr>

			<tr valign="top" class="dwpbcd <?php echo $dwpbcd_hide ?>">
				<th scope="row"><?php _e('Countdown Link URL','dwpb') ?></th>
				<td>
					<input class="regular-text" type="text" name="dwpbcd_link_url" placeholder="<?php _e('http://yoursite.com','dwpb'); ?>" value="<?php echo get_option('dwpbcd_link_url'); ?>" />
				</td>
			</tr>

			<tr class="dwpb-link-target dwpbcd <?php echo $dwpbcd_hide ?>">
				<th scope="row"><?php _e('Open link in a new tab?','dwpb') ?></th>
				<td>
					<?php 
						$dwpbcd_link_target = get_option('dwpbcd_link_target');
						$dwpbcd_link_target_select = '';
						if ( $dwpbcd_link_target == '_blank' ) {
							$dwpbcd_link_target_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="radio" name="dwpbcd_link_target" value="_self" checked> <?php _e('No','dwpb'); ?> </label>
					<label style="margin-right: 50px;"><input type="radio" name="dwpbcd_link_target" value="_blank" <?php echo $dwpbcd_link_target_select; ?>> <?php _e('Yes','dwpb'); ?> </label>
				</td>
			</tr>
		</table>

		<h3><?php _e('Style settings','dwpb') ?></h3>
		<table class="form-table">
			<tr valign="top">
				<?php
					$dwpb_font_size = get_option('dwpb_font_size');
					if ( $dwpb_font_size == '' ) {
						$dwpb_font_size = '16';
					}
				?>
				<th scope="row"><?php _e('Font size','dwpb') ?></th>
				<td><input class="small-text dwpb_font_size" type="text" name="dwpb_font_size" value="<?php echo $dwpb_font_size; ?>" />px</td>
			</tr>

			<tr>
				<th scope="row"><?php _e('Font family','dwpb') ?></th>
				<td>
					<?php 
					function dwpb_get_gfonts(){
					    $fontsSeraliazed = wp_remote_fopen(DWPB_PATH.'assets/font/gfonts_v2.txt');
					    $fontArray = unserialize( $fontsSeraliazed );
					    return $fontArray->items;
					}
					$fonts = dwpb_get_gfonts();
					?>
					<select name="dwpb_font_family">
						<option value="0"></option>
						<?php foreach($fonts as $font) { 
							$font_value = $font->family.':dw:'.$font->files->regular;
							$selected = '';
							if($font_value == get_option('dwpb_font_family')) {
							$selected = 'selected';
						}
						?>
						<option value="<?php echo $font_value ?>" <?php echo $selected ?>><?php echo $font->family ?></option>
					<?php } ?>
					</select>
				</td>
			</tr>

			<tr valign="top">
				<?php
					$dwpb_background_color = get_option('dwpb_background_color');
					if ( $dwpb_background_color == '' ) {
						$dwpb_background_color = '#f7682c';
					}
				?>
				<th scope="row"><?php _e('Background Color','dwpb') ?></th>
				<td><input class="regular-text color_picker dwpb_background_color" type="text" name="dwpb_background_color" value="<?php echo $dwpb_background_color; ?>" /></td>
			</tr>

			<tr valign="top">
				<?php
					$dwpb_background_image = get_option('dwpb_background_image');
					if ( $dwpb_background_image == '' ) {
						$dwpb_background_image = '';
					}
				?>
				<th scope="row"><?php _e('Background Image','dwpb') ?></th>
				<td>
					<input class="regular-text dwpb_background_image" type="text" name="dwpb_background_image" value="<?php echo $dwpb_background_image; ?>" placeholder="<?php _e('http://www.yoursite.com/image.jpg','dwpb'); ?>" />
					<span class="description"><?php _e('Support image formats:: jpg, png, gif') ?></span>
				</td>
			</tr>

			<tr valign="top">
				<?php
					$dwpb_font_color = get_option('dwpb_font_color');
					if ( $dwpb_font_color == '' ) {
						$dwpb_font_color = '#fff';
					}
				?>
				<th scope="row"><?php _e('Text Color','dwpb') ?></th>
				<td><input class="regular-text color_picker dwpb_font_color" type="text" name="dwpb_font_color" value="<?php echo $dwpb_font_color; ?>" /></td>
			</tr>

			<tr valign="top">
				<?php
					$dwpb_border_color = get_option('dwpb_border_color');
					if ( $dwpb_border_color == '' ) {
						$dwpb_border_color = '';
					}
				?>
				<th scope="row"><?php _e('Bar Border Color','dwpb') ?></th>
				<td><input class="regular-text color_picker dwpb_border_color" type="text" name="dwpb_border_color" value="<?php echo $dwpb_border_color; ?>" /></td>
			</tr>
			
			<tr valign="top" class="dwpb-link-color"> 
				<?php
					$dwpb_link_color = get_option('dwpb_link_color');
					if ( $dwpb_link_color == '' ) {
						$dwpb_link_color = '#fff';
					}
				?>
				<th scope="row"><?php _e('Link Color','dwpb') ?></th>
				<td><input class="regular-text color_picker dwpb_link_color" type="text" name="dwpb_link_color" value="<?php echo $dwpb_link_color; ?>" /></td>
			</tr>

			<tr class="dwpb-link-style">
				<th scope="row"><?php _e('Link style','dwpb') ?></th>
				<td>
					<?php 
						$dwpb_link_style = get_option('dwpb_link_style');
						$dwpb_link_style_select = '';
						if ( $dwpb_link_style == '' ) {
							$dwpb_link_style_select = 'checked';
						}
					?>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_link_style" value="dwpb-button" checked ><?php _e('Button','dwpb') ?></label>
					<label style="margin-right: 50px;"><input type="radio" name="dwpb_link_style" value="" <?php echo $dwpb_link_style_select; ?> ><?php _e('Hyperlink','dwpb') ?></label>
				</td>
			</tr>

			<?php 
				$dwpb_button_color_hide = 'hide';
				if (get_option('dwpb_link_style') != '') {
					$dwpb_button_color_hide = '';
				} 
			?>
				
			<tr valign="top" class="dwpb-button-color <?php echo $dwpb_button_color_hide; ?>">
				<?php
					$dwpb_button_color = get_option('dwpb_button_color');
					if ( $dwpb_button_color == '' ) {
						$dwpb_button_color = '#333';
					}
				?>
				<th scope="row"><?php _e('Button Color','dwpb') ?></th>
				<td><input class="regular-text color_picker dwpb_button_color" type="text" name="dwpb_button_color" value="<?php echo $dwpb_button_color; ?>" /></td>
			</tr>

			<tr valign="top">
				<th scope="row"><?php _e('Custom style','dwpb') ?></th>
				<td>
					<textarea name="dwpb_custon_style" rows="5" cols="100"><?php echo get_option('dwpb_custon_style'); ?></textarea>
				</td>
			</tr>
		</table>
	</div>
    <?php submit_button(); ?>
    <p class="submit">
    	<input type="button" id="dwpb_reset_cookie" class="button"  value="<?php _e('Reset Cookie') ?>" data-nonce="<?php echo wp_create_nonce( '_dwpb_reset_cookie' ); ?>">
    	<span class="ajax-load">
    		<span><?php _e('Success') ?></span>
    		<img src="<?php echo DWPB_PATH . 'assets/img/ajax-loader.gif' ?>">
    	</span>
    </p>
</form>
</div>
<?php } 

// Ajax
if( ! function_exists('dwpb_reset_cookie') ) {
	function dwpb_reset_cookie() {
		$ajax_referer = check_ajax_referer( '_dwpb_reset_cookie', 'nonce', false );
		if( ! wp_verify_nonce( $_POST['nonce'], '_dwpb_reset_cookie' ) || ! $ajax_referer ) {
			wp_send_json_error( __('Are you cheating huh?','dwpb') );
		}

		$dwpb_reset_cookie_value = get_option( 'dwpb_reset_cookie', 2 );
		if ( $dwpb_reset_cookie_value >= 2 ) {
			$dwpb_reset_cookie_value = intval($dwpb_reset_cookie_value) + 1;
			update_option( 'dwpb_reset_cookie', $dwpb_reset_cookie_value );
		}

		wp_send_json_success( $dwpb_reset_cookie_value );
	}
	add_action( 'wp_ajax_dwpb-reset-cookie', 'dwpb_reset_cookie' );
}

?>