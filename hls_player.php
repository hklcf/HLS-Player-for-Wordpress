<?php
/*
Plugin Name: HLS Player
Plugin URI:  https://github.com/hklcf/HLS-Player-for-Wordpress
Description: Embed hls stream to WordPress using JW Player
Version:     1.2
Author:      HKLCF
Author URI:  https://eservice-hk.net/
License:     GPL3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: hlsp
Domain Path: /languages
*/

function add_hlsp_menu() {
	add_plugins_page('HLS Player Setting', 'HLS Player', 'administrator', 'hlsp-setting', 'hlsp_setting_function');
	$option_group = 'hlsp_setting';
	$option_name = 'hlsp_player_option';
	$setting_section = 'hlsp_setting_section';
	register_setting( $option_group, $option_name );

	add_settings_section( $setting_section, 'Setting', 'hlsp_setting_section_function', $option_group );
	function hlsp_setting_section_function() {
		echo 'HLS Player Setting';
	}

	add_settings_field( 'hlsp_player_version', '<label for="hlsp_player_option[version]">JW Player Version</label>', 'hlsp_player_version_function', $option_group, $setting_section );
	function hlsp_player_version_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<input class="regular-text" id="hlsp_player_option[version]" name="hlsp_player_option[version]" type="text" value="'.$hlsp_player_option['version'].'" placeholder="8.12.5">';
	}

	add_settings_field( 'hlsp_player_key', 'JW Player License Key', 'hlsp_player_key_function', $option_group, $setting_section );
	function hlsp_player_key_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<input class="regular-text" name="hlsp_player_option[key]" type="text" value="'.$hlsp_player_option['key'].'" placeholder="License Key">';
		echo '<p class="description">Certain JW Player features may require a specific license.</p>';
	}

	add_settings_field( 'hlsp_player_id', 'Player ID', 'hlsp_player_id_function', $option_group, $setting_section );
	function hlsp_player_id_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<input class="regular-text" name="hlsp_player_option[id]" type="text" value="'.$hlsp_player_option['id'].'" placeholder="player">';
	}

	add_settings_field( 'hlsp_player_size', 'Player Size', 'hlsp_player_size_function', $option_group, $setting_section );
	function hlsp_player_size_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<label for="hlsp_player_option[height]">Height </label><input class="small-text" id="hlsp_player_option[height]" name="hlsp_player_option[height]" type="text" value="'.$hlsp_player_option['height'].'" placeholder="100%">';
		echo '&nbsp;';
		echo '<label for="hlsp_player_option[width]">Width </label><input class="small-text" id="hlsp_player_option[width]" name="hlsp_player_option[width]" type="text" value="'.$hlsp_player_option['width'].'" placeholder="100%">';
	}

	add_settings_field( 'hlsp_player_ratio', 'Player Ratio', 'hlsp_player_ratio_function', $option_group, $setting_section );
	function hlsp_player_ratio_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<input class="regular-text" name="hlsp_player_option[ratio]" type="text" value="'.$hlsp_player_option['ratio'].'" placeholder="16:9">';
	}

	add_settings_field( 'hlsp_player_preload', 'Video Preload', 'hlsp_player_preload_function', $option_group, $setting_section );
	function hlsp_player_preload_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		$preload = $hlsp_player_option['preload'];
		echo '<select name="hlsp_player_option[preload]">';
		echo '<option value="none" '.selected( $preload, 'none' ).'>none</option><option value="metadata" '.selected( $preload, 'metadata' ).'>metadata</option><option value="auto" '.selected( $preload, 'auto' ).'>auto</option>';
		echo '</select>';
	}

	add_settings_field( 'hlsp_player_playbackratecontrols', 'Video Playback Rate Controls', 'hlsp_player_playbackratecontrols_function', $option_group, $setting_section );
	function hlsp_player_playbackratecontrols_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		$playbackratecontrols = $hlsp_player_option['playbackratecontrols'];
		echo '<select name="hlsp_player_option[playbackratecontrols]">';
		echo '<option value="false" '.selected( $playbackratecontrols, 'false' ).'>false</option><option value="true" '.selected( $playbackratecontrols, 'true' ).'>true</option>';
		echo '</select>';
	}

	add_settings_field( 'hlsp_player_thumbnail', 'Video Thumbnail', 'hlsp_player_thumbnail_function', $option_group, $setting_section );
	function hlsp_player_thumbnail_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<label><input name="hlsp_player_option[thumbnail]" type="checkbox" value="1" ';
		echo checked( $hlsp_player_option['thumbnail'], 1 ).'> featured image</label>';
	}

	add_settings_field( 'hlsp_player_logo', 'Player Logo', 'hlsp_player_logo_function', $option_group, $setting_section );
	function hlsp_player_logo_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		$logo_position = $hlsp_player_option['logo_position'];
		echo '<input class="regular-text" name="hlsp_player_option[logo]" type="text" value="'.$hlsp_player_option['logo'].'" placeholder="Logo URL">';
		echo '<p class="description">Location of an external JPG, PNG or GIF image to be used as watermark (e.g. /assets/logo.png). We recommend using 24 bit PNG images with transparency, since they blend nicely with the video.</p>';
		echo '<br>';
		echo '<input class="regular-text" name="hlsp_player_option[logo_link]" type="text" value="'.$hlsp_player_option['logo_link'].'" placeholder="http://">';
		echo '<p class="description">The HTTP URL which will load when your watermark image is clicked. (e.g. http://www.mywebsite.com/). If this is not set, a click on the watermark will not do anything.</p>';
		echo '<br>';
		echo '<label for="hlsp_player_option[logo_position]">Position </label><select id="hlsp_player_option[logo_position]" name="hlsp_player_option[logo_position]">';
		echo '<option value="top-right" '.selected( $logo_position, 'top-right' ).'>top-right</option><option value="top-left" '.selected( $logo_position, 'top-left' ).'>top-left</option><option value="bottom-right" '.selected( $logo_position, 'bottom-right' ).'>bottom-right</option><option value="bottom-left" '.selected( $logo_position, 'bottom-left' ).'>bottom-left</option>';
		echo '</select>';
	}

	add_settings_field( 'hlsp_player_right_click', 'Setting the Right-click', 'hlsp_player_right_click_function', $option_group, $setting_section );
	function hlsp_player_right_click_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<input class="regular-text" name="hlsp_player_option[abouttext]" type="text" value="'.$hlsp_player_option['abouttext'].'" placeholder="About Text">';
		echo '<p class="description">Additional text which will display in the right-click menu. This must be set in order to use aboutlink.</p>';
		echo '<br>';
		echo '<input class="regular-text" name="hlsp_player_option[aboutlink]" type="text" value="'.$hlsp_player_option['aboutlink'].'" placeholder="http://">';
		echo '<p class="description">The URL then will open when a user clicks on abouttext. If this is not set, custom text will redirect to http://www.jwplayer.com/learn-more/.</p>';
	}

	add_settings_field( 'hlsp_player_advertising', 'Advertising', 'hlsp_player_advertising_function', $option_group, $setting_section );
	function hlsp_player_advertising_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		$advertising_client = $hlsp_player_option['advertising_client'];
		echo '<label for="hlsp_player_option[advertising_client]">Client </label><select id="hlsp_player_option[advertising_client]" name="hlsp_player_option[advertising_client]">';
		echo '<option value="none" '.selected( $advertising_client, 'none' ).'>none</option><option value="vast" '.selected( $advertising_client, 'vast' ).'>vast</option><option value="googima" '.selected( $advertising_client, 'googima' ).'>googima</option><option value="freewheel" '.selected( $advertising_client, 'freewheel' ).'>freewheel</option>';
		echo '</select>';
		echo '<br><br>';
		echo '<input class="regular-text" name="hlsp_player_option[advertising_tag]" type="text" value="'.$hlsp_player_option['advertising_tag'].'" placeholder="http://">';
		echo '<p class="description">The URL of the VAST tag to display, or custom string of the Freewheel tag to display</p>';
	}

	add_settings_field( 'hlsp_player_encode', 'Script Encode', 'hlsp_player_encode_function', $option_group, $setting_section );
	function hlsp_player_encode_function() {
		$hlsp_player_option = get_option( 'hlsp_player_option' );
		echo '<label><input name="hlsp_player_option[encode]" type="checkbox" value="1" ';
		echo checked( $hlsp_player_option['encode'], 1 ).'> encode the video source</label>';
	}
}
add_action( 'admin_menu', 'add_hlsp_menu' );

function hlsp_setting_function() {
	$option_group = 'hlsp_setting';
	echo '<h1>HLS Player</h1>';
	echo '<form method="post" action="options.php">';
	settings_fields( $option_group );
	do_settings_sections( $option_group );
	submit_button();
	echo '</form>';
}

function hlsp_video_func( $atts, $link = '' ) {
	$hlsp_player_option = get_option( 'hlsp_player_option' );
	$thumbnail = $hlsp_player_option['thumbnail'] === '1' ? get_the_post_thumbnail_url('','full') : '';
	$advertising = $hlsp_player_option['advertising_client'] === 'none' ? '' : ',"advertising":{"client":"'.$hlsp_player_option['advertising_client'].'","tag":"'.$hlsp_player_option['advertising_tag'].'"}';
	$source = $link;
	$atts = shortcode_atts(
		array(
			'id' => $hlsp_player_option['id'],
		), $atts, 'hls' );
	$player_div = '<div id="'.esc_html($atts['id']).'"></div><script src="https://ssl.p.jwpcdn.com/player/v/'.$hlsp_player_option['version'].'/jwplayer.js"></script>';
	$player = '<script>jwplayer.key="'.$hlsp_player_option['key'].'";jwplayer("'.esc_html($atts['id']).'").setup({"aspectratio":"'.$hlsp_player_option['ratio'].'","image":"'.$thumbnail.'","file":"'.$source.'","height":"'.$hlsp_player_option['height'].'","width":"'.$hlsp_player_option['width'].'","preload":"'.$hlsp_player_option['preload'].'","playbackRateControls":"'.$hlsp_player_option['playbackratecontrols'].'","logo":{"file":"'.$hlsp_player_option['logo'].'","link":"'.$hlsp_player_option['logo_link'].'","position":"'.$hlsp_player_option['logo_position'].'"},"abouttext":"'.$hlsp_player_option['abouttext'].'","aboutlink":"'.$hlsp_player_option['aboutlink'].'"'.$advertising.'});</script>';
	if($hlsp_player_option['encode'] === '1') {
		return $player_div.'<script>document.write(window.atob("'.base64_encode($player).'"));</script>';
	} else {
		return $player_div.$player;
	}
}
add_shortcode( 'hls', 'hlsp_video_func' );

function hlsp_video_quicktags() {
	if(wp_script_is('quicktags')) {
?>
		<script type="text/javascript">
			QTags.addButton( 'hls', 'hls', '[hls]', '[/hls]', '', 'HLS Player', 201 );
		</script>
<?php
	}
}
add_action( 'admin_print_footer_scripts', 'hlsp_video_quicktags' );
?>
