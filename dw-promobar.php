<?php
/*
Plugin Name: DW PromoBar
Plugin URI: 
Description:  Custom promotion bar for your wordpress site.
Version: 1.0.4
Author: DesignWall
Author URI: http://www.designwall.com
*/

if ( ! function_exists('dwpb')) {

	define( 'DWPB_FOLDER', plugin_dir_path(__FILE__) );
	define( 'DWPB_PATH', plugin_dir_url(__FILE__) );

	include_once DWPB_FOLDER . 'dw-promobar-option.php';

	if ( ! function_exists( 'dwpb_get_option' )) {
		function dwpb_get_option( $option_name, $default = '' ) {
			$options = get_option( $option_name );
			if( $options != '' ) {
				return $options;
			}
			return $default; 
		}	
	}

	if ( ! function_exists( 'dwpb_body_class' )) {
		function dwpb_body_class($classes) {
			$dwpb_push_page = dwpb_get_option('dwpb_push_page');
			$dwpb_ramain_top = dwpb_get_option('dwpb_ramain_top');
			$dwpb_show_bottom = dwpb_get_option('dwpb_show_bottom');

			$dwpb_close = dwpb_get_option('dwpb_close');

			$dwpb_responsive_extra_small = dwpb_get_option('dwpb_responsive_extra_small');
			$dwpb_responsive_small = dwpb_get_option('dwpb_responsive_small');
			$dwpb_responsive_medium = dwpb_get_option('dwpb_responsive_medium');
			$dwpb_responsive_large = dwpb_get_option('dwpb_responsive_large');

			$current_theme = wp_get_theme();

			if ( $dwpb_push_page == 'push') {
				$classes[] = 'dwpb-push-page';
			} else {
				$classes[] = 'dwpb-cover-page';
			}

			if ( $dwpb_close == 'yes' ) {
				$classes[] = 'dwpb-allow-close';
			}

			if ( $dwpb_show_bottom == 'yes') {
				$classes[] = 'dwpb-show-bottom'; 
			}

			if ( $current_theme == 'Twenty Fourteen' ) {
				$classes[] = 'dwpb-twenty-fourteen'; 	
			}

			if ( $dwpb_ramain_top == 'ramain-top' ) $classes[] = 'dwpb-ramain-top';

			if ($dwpb_responsive_extra_small) $classes[] = 'dwpb_responsive_extra_small';
			if ($dwpb_responsive_small) $classes[] = 'dwpb_responsive_small';
			if ($dwpb_responsive_medium) $classes[] = 'dwpb_responsive_medium';
			if ($dwpb_responsive_large) $classes[] = 'dwpb_responsive_large';




			return $classes;
		}
		add_filter('body_class','dwpb_body_class');
	}

	function dwpb() {
		$current_theme = wp_get_theme();
		$is_front_page = dwpb_get_option('dwpb_front_page', false);
		$is_archives = dwpb_get_option('dwpb_archives', false);
		$is_tags = dwpb_get_option('dwpb_tags', false);
		$is_single_post = dwpb_get_option('dwpb_single_post', false);
		$is_single_page = dwpb_get_option('dwpb_single_page', false);
		if ( 
			( $is_front_page && is_front_page() ) || 
			( $is_archives && is_archive() ) || 
			( $is_tags && is_tag() ) ||
			( $is_single_post && is_single() ) ||
			( $is_single_page && is_page() ) ||
			( ! $is_front_page && ! $is_archives && ! $is_tags && ! $is_single_post && ! $is_single_page ) || 
			is_admin()
		) :

		$dwpb_ramain_top = dwpb_get_option('dwpb_ramain_top');
		$dwpbcd_use = dwpb_get_option('dwpbcd_use');

		$dwpbcd_link_text = dwpb_get_option('dwpbcd_link_text');
		$dwpbcd_link_url = dwpb_get_option('dwpbcd_link_url');
		$dwpbcd_link_target = dwpb_get_option('dwpbcd_link_target');

		$dwpb_link_text = dwpb_get_option('dwpb_link_text');
		$dwpb_link_url = dwpb_get_option('dwpb_link_url');
		$dwpb_link_target = dwpb_get_option('dwpb_link_target');

		$dwpb_font_family = dwpb_get_option('dwpb_font_family');
		$dwpb_font_size = dwpb_get_option('dwpb_font_size');
		$dwpb_background_color = dwpb_get_option('dwpb_background_color');
		$dwpb_background_image = dwpb_get_option('dwpb_background_image');
		$dwpb_font_color = dwpb_get_option('dwpb_font_color');
		$dwpb_border_color = dwpb_get_option('dwpb_border_color');
		$dwpb_link_color = dwpb_get_option('dwpb_link_color');
		$dwpb_link_style = dwpb_get_option('dwpb_link_style');
		$dwpb_button_color = dwpb_get_option('dwpb_button_color');

		$dwpb_custon_style = dwpb_get_option('dwpb_custon_style');

		$dwpb_link = '';
		if ( $dwpb_link_text != '' ) {
			$dwpb_link = ' <a class="'. $dwpb_link_style .'" href="'.$dwpb_link_url.' " target="'. $dwpb_link_target .'"" >'.$dwpb_link_text.'</a>';
		}

		$dwpbcd_link = '';
		if ( $dwpbcd_link_text != '' ) {
			$dwpbcd_link = ' <a class="'. $dwpb_link_style .'" href="'.$dwpbcd_link_url.' " target="'. $dwpbcd_link_target .'"" >'.$dwpbcd_link_text.'</a>';
		}
	?>
		<style>
			<?php 
				if( $dwpb_font_family != '' ) : 
				$font_family = explode(':dw:', $dwpb_font_family );
			?>
			@font-face {
        font-family: "<?php echo $font_family[0]; ?>";
        src: url('<?php echo $font_family[1] ?>');
      }
			#dwpb {
				font-family: <?php echo $font_family[0] ?>;
			}
			<?php endif; ?>

			<?php if( $dwpb_background_color != '' ) : ?>
			#dwpb,
			.dwpb-action {
				background-color: <?php echo $dwpb_background_color; ?>;
			}
			<?php endif; ?>

			<?php if( $dwpb_background_image != '' ) : ?>
			#dwpb {
				background-image: url(<?php echo $dwpb_background_image; ?>);
				background-position: center;
				background-size: 100% auto;
			}
			<?php endif; ?>

			<?php if( $dwpb_font_color != '' ) : ?>
			#dwpb,
			.dwpb-action,
			body.dwpb-allow-close.dwpb-open .dwpb-close {
				color: <?php echo $dwpb_font_color; ?>;
			}
			<?php endif; ?>

			<?php if( $dwpb_font_size != '' ) : ?>
			#dwpb {
				font-size: <?php echo $dwpb_font_size; ?>px;
			}
			<?php endif; ?>

			<?php if( $dwpb_font_size > 20 ) : ?>
			#dwpb {
				line-height: 1.2;
			}
			<?php endif; ?>

			<?php if( $dwpb_border_color != '' ) : ?>
			#dwpb {
				border-color: <?php echo $dwpb_border_color; ?>;
			}
			<?php endif; ?>

			<?php if( $dwpb_border_color == '' ) : ?>
			#dwpb {
				border-width: 0;
			}
			<?php endif; ?>

			<?php if( $dwpb_link_color != '' ) : ?>
			#dwpb a {
				color: <?php echo $dwpb_link_color; ?>;
			}
			<?php endif; ?>

			<?php if( $dwpb_button_color != '' ) : ?>
			#dwpb .dwpb-button {
				background-color: <?php echo $dwpb_button_color; ?>;
			}
			<?php endif; ?>

			<?php if( $dwpb_custon_style != '' ) : ?>
				<?php echo $dwpb_custon_style ?>
			<?php endif; ?>
		</style>
		
		<div id="dwpb" class=" <?php echo $dwpb_ramain_top; ?> ">
			<div class="dwpb-inner">
				<?php 
					$dwpbcd_hide = 'hide';
					$dwpb_hide = '';
					if ($dwpbcd_use == 'yes') {
						$dwpbcd_hide = '';
						$dwpb_hide = 'hide';
					}

					$dwpb_bar_text = dwpb_get_option('dwpb_bar_text');
					if ( $dwpb_bar_text == '' ) {
						$dwpb_bar_text = __('Hello. Add your message here.','dwpb');
					}

					$dwpbcd_text = dwpb_get_option('dwpbcd_text');
					if ( $dwpbcd_text == '' ) {
						$dwpbcd_text = __('Hello. Add your message here.','dwpb');
					}
				?>

				<div class="dwpb-message <?php echo $dwpb_hide; ?>">
					<span class="dwpb-content"><?php echo $dwpb_bar_text; ?></span>
					<?php echo $dwpb_link; ?>
				</div>
					
				<div class="dwpb-countdown <?php echo $dwpbcd_hide; ?>">
					<div class="dwpb-counter"></div>
					<span class="dwpbcd-content"><?php echo $dwpbcd_text; ?></span>
					<?php echo $dwpbcd_link; ?>
				</div>
			</div>
		</div>
		<?php 
			$dwpb_close = dwpb_get_option('dwpb_close');
			$dwpb_action_class = 'dwpb-action';
			if ($dwpb_close == 'yes') {
				$dwpb_action_class = 'dwpb-close';
			}
		?>
		<span class="<?php echo $dwpb_action_class; ?>"></span>
	<?php

	endif; // Show on
	}

	$dwpb_enable = dwpb_get_option('dwpb_enable');
	$dwpb_start = strtotime(dwpb_get_option('dwpb_start'));
	$dwpb_end = strtotime(dwpb_get_option('dwpb_end'));	
	$dwpb_timezone = strtotime(date_i18n('Y-m-d G:i:s'));

	if ( ( $dwpb_start < $dwpb_timezone && ( $dwpb_timezone < $dwpb_end || $dwpb_end == '' ) ) && $dwpb_enable == 'yes' ) {
		add_action( 'wp_footer', 'dwpb', 100);
	}
	add_action( 'dwpb_previvew', 'dwpb');

	// Enqueue scripts
	function dwpb_scripts() {
		$is_front_page = dwpb_get_option('dwpb_front_page', false);
		$is_archives = dwpb_get_option('dwpb_archives', false);
		$is_tags = dwpb_get_option('dwpb_tags', false);
		$is_single_post = dwpb_get_option('dwpb_single_post', false);
		$is_single_page = dwpb_get_option('dwpb_single_page', false);
		if ( 
			( $is_front_page && is_front_page() ) || 
			( $is_archives && is_archive() ) || 
			( $is_tags && is_tag() ) ||
			( $is_single_post && is_single() ) ||
			( $is_single_page && is_page() ) ||
			( ! $is_front_page && ! $is_archives && ! $is_tags && ! $is_single_post && ! $is_single_page )
		) :

		// Front end
		wp_enqueue_style( 'dwpb_style', DWPB_PATH . 'assets/css/main.css');

		if ( ! wp_script_is( 'jquery', 'enqueued' )) {
			wp_enqueue_script( 'jquery');
		}

		if ( ! wp_script_is( 'jquery.countdown.js', 'enqueued' )) {
			wp_enqueue_script( 'dwpb_countdown', DWPB_PATH . 'assets/js/vendor/jquery.countdown.js',true);
		}

		if ( ! wp_script_is( 'jquery.cookie.js', 'enqueued' )) {
			wp_enqueue_script( 'dwpb_cookie', DWPB_PATH . 'assets/js/vendor/jquery.cookie.js',true);
		}

		if ( ! wp_style_is( 'dashicons', 'enqueued' ))  {
			wp_enqueue_style( 'dashicons' );
		}

		wp_enqueue_script( 
			'dwpb_script', 
			DWPB_PATH . 'assets/js/main.js', 
			array(
				'jquery',
				'dwpb_countdown',
				'dwpb_cookie'
			),
			'1.0',
			true
		);

		$timeleft = '';
		if ( dwpb_get_option('dwpbcd_time_left') != '' ) {
			$timeleft = dwpb_get_option('dwpbcd_time_left');
		}

		$timezone_format = _x('Y-m-d G:i:s', 'timezone date format');
		$dwpb_reset_cookie_value = get_option( 'dwpb_reset_cookie', 2 );

		wp_localize_script( 'dwpb_countdown', 'dwpb', array(
			'timeleft'	=> strtotime($timeleft) - strtotime(date_i18n($timezone_format)),
			'reset_cookie' => $dwpb_reset_cookie_value
		));

		endif; // Show on
	}
	if ( ( $dwpb_start < $dwpb_timezone && ( $dwpb_timezone < $dwpb_end || $dwpb_end == '' ) ) && $dwpb_enable == 'yes' ) {
		add_action( 'wp_footer', 'dwpb_scripts');
	}

	// Enqueue admin scripts
	function dwpb_admin_scripts() {
		if ( ! wp_script_is( 'jquery', 'enqueued' )) {
			wp_enqueue_script( 'jquery');
		}

		// Front end
		wp_enqueue_style( 'dwpb_style', DWPB_PATH . 'assets/css/main.css');
		
		if ( ! wp_script_is( 'jquery.countdown.js', 'enqueued' )) {
			wp_enqueue_script( 'dwpb_countdown', DWPB_PATH . 'assets/js/vendor/jquery.countdown.js',true);
		}

		$timeleft = '';
		if ( dwpb_get_option('dwpbcd_time_left') != '' ) {
			$timeleft = dwpb_get_option('dwpbcd_time_left');
		}

		$timezone_format = _x('Y-m-d G:i:s', 'timezone date format');
		wp_localize_script( 'dwpb_countdown', 'dwpb', array(
			'timeleft'	=> strtotime($timeleft) - strtotime(date_i18n($timezone_format)),
			'ajax_url'               => admin_url( 'admin-ajax.php' ),
		));

		// Back end
		if ( ! wp_style_is( 'wp-color-picker', 'enqueued' )) {
			wp_enqueue_style( 'wp-color-picker' );
		}

		if ( ! wp_script_is( 'jquery.datetimepicker.css', 'enqueued' )) {
			wp_enqueue_script( 'datetimepicker_jquery', DWPB_PATH . 'assets/js/vendor/datetimepicker/jquery.datetimepicker.js',true);
		}

		if ( ! wp_style_is( 'jquery.datetimepicker.css', 'enqueued' )) {
			wp_enqueue_style( 'datetimepicker_style', DWPB_PATH . 'assets/js/vendor/datetimepicker/jquery.datetimepicker.css',true);
		}

		wp_enqueue_style( 'dwpb_admin_style', DWPB_PATH . 'assets/css/admin.css');
		
		wp_enqueue_script( 
			'dwpb_admin_script', 
			DWPB_PATH . 'assets/js/admin.js',
			array(
				'jquery',
				'datetimepicker_jquery',
				'wp-color-picker',
				'dwpb_countdown'
			),
			'1.0',
			true
		);
	}
	add_action('admin_enqueue_scripts','dwpb_admin_scripts');
}
?>