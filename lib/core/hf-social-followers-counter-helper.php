<?php

class HFSocialFollowersCounterHelper {
	
	/**
	 * default_instance_settings
	 * 
	 * Create default instance options used in shortcodes and widgets
	 * 
	 * @return multitype:string number
	 * @since 3.4
	 */
	public static function default_instance_settings() {
		$defaults = array();
		$defaults['title'] = "Social Followers";
		$defaults['new_window'] = 1;
		$defaults['nofollow'] = 1;
		$defaults['hide_title'] = 0;
		$defaults['show_total'] = 0;
		$defaults['total_type'] = 'text_before';
		$defaults['columns'] = 3;
		$defaults['template'] = 'flat';
		$defaults['customizer'] = '';
		$defaults['animation'] = '';
		$defaults['bgcolor'] = '';
		$defaults['nospace'] = 0;
		
		// cover box styles
		$defaults['cover'] = 0;
		$defaults['cover_bgcolor'] = '';
		$defaults['cover_bgimage'] = '';
		$defaults['cover_title'] = '';
		$defaults['cover_text'] = '';
		$defaults['cover_image'] = '';
		$defaults['cover_style'] = '';
		$defaults['cover_image_style'] = '';
		
		$defaults['networks'] = '';
		
		return $defaults;
	}
	
	/**
	 * default_options_structure
	 * 
	 * Default widget or shortcode settings fields
	 * 
	 * @param boolean $apply_defaults
	 * @return multitype:multitype:string  multitype:string multitype:string
	 * @since 3.4
	 */
	public static function default_options_structure($apply_defaults = false, $custom_defaults = array()) {
		$structure = array();
		$structure['title'] = array('type' => 'textbox', 'title' => 'Title', 'description' => 'Display title over the widget');
		$structure['hide_title'] = array('type' => 'checkbox', 'title' => 'Hide widget title', 'description' => 'Activate this option if you wish to hide widget title');
		$structure['new_window'] = array('type' => 'checkbox', 'title' => 'Open links in new window', 'description' => '(recommended) Activate this option to open links to social profiles in new window');
		$structure['nofollow'] = array('type' => 'checkbox', 'title' => 'Add nofollow to links', 'description' => '(recommended) Activate this option to add nofollow state of outgoing links');
		$structure['separator1'] = array('type' => 'separator', 'title' => 'Total followers setup');
		$structure['show_total'] = array('type' => 'checkbox', 'title' => 'Display total followers', 'description' => 'Activate this option if you wish to display total number of followers');
		$structure['total_type'] = array('type' => 'select', 'title' => 'Total followers type', 'description' => 'Choose total followers display type for this widget', 'values' => array('text_before' => 'Display as text before buttons', 'text_after' => 'Display as text after buttons', 'button_single' => 'Button with width of single button'));
		$structure['separator2'] = array('type' => 'separator', 'title' => 'Visual setup');
		$structure['columns'] = array('type' => 'select', 'title' => 'Columns', 'description' => 'Choose number of columns', 'values' => array('1' => '1 Column', '1-big' => '1 Column (Big Blocks)', '2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns', '5' => '5 Columns', '6' => '6 Columns', 'row' => 'Without automatic column split', 'user1' => 'Custom Layout #1', 'user2' => 'Custom Layout #2', 'user3' => 'Custom Layout #3', 'user4' => 'Custom Layout #4', 'user5' => 'Custom Layout #5'));
		$structure['template'] = array('type' => 'select', 'title' => 'Template', 'description' => 'Choose template for this widget', 'values' => array('color' => 'Color icons', 'roundcolor' => 'Round Color Icons', 'outlinecolor' => 'Outline Color Icons', 'grey' => 'Grey icons', 'roundgrey' => 'Round Grey Icons', 'outlinegrey' => 'Outline Grey Icons', 'light' => 'Light Icons', 'roundlight' => 'Round Light Icons', 'outlinelight' => 'Outline Light Icons', 'metro' => 'Metro', 'flat' => 'Flat', 'dark' => 'Dark', 'tinycolor' => 'Tiny Color', 'tinygrey' => 'Tiny Grey', 'tinylight' => 'Tiny Light', 'modern' => "Modern"));
		$structure['customizer'] = array('type' => 'select', 'title' => 'Use template customizer', 'description' => 'Apply template customizer over selected template', 'values' => array('' => 'No', 'mono' => 'Single Color Scheme', 'color' => 'Multi Color Scheme'));
		$structure['animation'] = array('type' => 'select', 'title' => 'Animation', 'description' => 'Animate buttons on hover', 'values' => array('' => 'Without animation', 'pulse' => "Pulse", "down" => "Down", "up" => "Up", "pulse-grow" => "Pulse Grow", "pop" => "Pop", "wobble-horizontal" => "Wobble Horizontal", "wobble-vertical" => "Wobble Vertical", "buzz-out" => "Buzz Out"));
		$structure['nospace'] = array('type' => 'checkbox', 'title' => 'Without space between buttons', 'description' => 'Activate this option if you wish to remove space between single buttons');
		$structure['bgcolor'] = array('type' => 'textbox', 'title' => 'Custom background color', 'description' => 'Provide custom background color for followers counter area');
		
		$structure['separator4'] = array('type' => 'separator', 'title' => 'Custom network list');
		$structure['networks'] = array('type' => 'textbox', 'title' => 'Custom list of networks', 'description' => 'Provide customized list of networks that you wish to display on this followers counter instance delimited with , (example: facebook,twitter,google)');
		
		$structure['separator3'] = array('type' => 'separator', 'title' => 'Cover box');
		$structure['cover'] = array('type' => 'checkbox', 'title' => 'Display cover box', 'description' => 'Activate this option if you wish to display cover box');
		$structure['cover_bgcolor'] = array('type' => 'textbox', 'title' => 'Custom background color', 'description' => 'Provide custom background color for cover box area');
		$structure['cover_bgimage'] = array('type' => 'textbox', 'title' => 'Custom background image', 'description' => 'Provide custom background image fro cover box area');
		$structure['cover_title'] = array('type' => 'textbox', 'title' => 'Cover title', 'description' => 'Title text inside cover box. {TOTAL} - you can use this variable to display total followers.');
		$structure['cover_text'] = array('type' => 'textbox', 'title' => 'Additional text below title', 'description' => 'Text below title in cover box. {TOTAL} - you can use this variable to display total followers.');
		$structure['cover_image'] = array('type' => 'textbox', 'title' => 'Cover image', 'description' => 'Display cover image');

		$structure['cover_style'] = array('type' => 'select', 'title' => 'Cover style', 'description' => 'Choose cover style', 'values' => array('light' => 'Light', 'light-left' => "Light with left positioned cover box elements", "dark" => "Dark", "dark-left" => "Dark with left align cover box elements"));
		$structure['cover_image_style'] = array('type' => 'select', 'title' => 'Cover image style', 'description' => 'Choose shape of cover image', 'values' => array('round' => 'Round', 'square' => "Square", "round-edge" => "Rounded Edges"));

		
		
		if ($apply_defaults) {
			if (isset($custom_defaults)) {
				$default_options = $custom_defaults;
			}
			else {
				$default_options = self::default_instance_settings();
			}
			foreach ($default_options as $key => $value) {
				$structure[$key]['default_value'] = $value;
			}
		}
		
		return $structure;
	}
	
	public static function default_columns() {
		$values = array('2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns', '5' => '5 Columns', '6' => '6 Columns');
		return $values;
	}
	
	public static function defalut_block_size() {
		$values = array("1" => "Default Column Size", "2" => "2 Blocks", "3" => "3 Blocks", "4" => "4 Blocks", "5" => "5 Blocks", "6" => "6 Blocks");
		return $values;
	}
	
	/**
	 * 
	 * @param unknown_type $option
	 * @param unknown_type $default
	 * @return Ambigous <string, unknown>
	 */
	public static function get_option($option, $default = '') {	
		$value = hellofollowers_options_value($option);
		if ($value == "-") {
			$value = "";
		}

		if (empty($value)) {
			$value = $default;
		}
	
		return $value;
	}
	
	public static function get_active_networks_for_layout($layout_id) {
		$network_list = self::get_option('networks_layout'.$layout_id);
		return $network_list;
	}
	
	public static function get_active_networks_for_layout_order($layout_id) {
		$network_order = self::get_option('networks_layout'.$layout_id.'_order');
		
		$network_order = self::simplify_order_list($network_order);
		
		return $network_order;
	}
	
	public static function get_active_networks() {
		$network_list = self::get_option('networks');
	
		return $network_list;
	}
	
	public static function get_active_networks_order() {
		$network_order = self::get_option('networks_order');
	
		if (is_array($network_order)) {
			$network_order = self::simplify_order_list($network_order);
		}
	
		return $network_order;
	}
	
	public static function simplify_order_list($order) {
		$result = array();
		foreach ($order as $network) {
			$network_details = explode('|', $network);
			$result[] = $network_details[0];
		}
	
		return $result;
	}
	
	public static function available_social_networks ($display_total = true) {
	
		$socials = array ();
		$socials['facebook'] = 'Facebook';
		$socials['twitter'] = 'Twitter';
		$socials['google'] = 'Google';
		$socials['pinterest'] = 'Pinterest';
		$socials['linkedin'] = 'LinkedIn';
		$socials['github'] = 'GitHub';
		$socials['vimeo'] = 'Vimeo';
		$socials['dribbble'] = 'Dribbble';
		$socials['envato'] = 'Envato';
		$socials['soundcloud'] = 'SoundCloud';
		$socials['behance'] = 'Behance';
		$socials['foursquare'] = 'Foursquare';
		$socials['forrst'] = 'Forrst';
		$socials['mailchimp'] = 'MailChimp';
		$socials['delicious'] = 'Delicious';
		$socials['instgram'] = 'Instagram';
		$socials['youtube'] = 'YouTube';
		$socials['vk'] = 'VK';
		$socials['rss'] = 'RSS';
		$socials['vine'] = 'Vine';
		$socials['tumblr'] = 'Tumblr';
		$socials['slideshare'] = 'SlideShare';
		$socials['500px'] = '500px';
		$socials['flickr'] = 'Flickr';
		$socials['wp_posts'] = 'WordPress Posts';
		$socials['wp_comments'] = 'WordPress Comments';
		$socials['wp_users'] = 'WordPress Users';
		$socials['audioboo'] = 'Audioboo';
		$socials['steamcommunity'] = 'Steam';
		$socials['weheartit'] = 'WeHeartit';
		$socials['feedly'] = 'Feedly';
		$socials['love'] = 'Love Counter';
		$socials['mailpoet'] = 'MailPoet';
		$socials['mymail'] = 'Mailster';
		$socials['spotify'] = 'Spotify';
		$socials['twitch'] = 'Twitch';
			
		if ($display_total) {
			$socials['total'] = 'Total Followers Counter';
		}
	
		return $socials;
	}
	
	public static function available_cache_periods () {
	
		$periods = array ();
		$periods[0] = 'Use Default';
		$periods[60] = '1 Hour';
		$periods[120] = '3 Hours';
		$periods[600] = '6 Hours';
		$periods[540] = '9 Hours';
		$periods[720] = '12 Hours';
		$periods[1440] = '1 Day';
		$periods[4320] = '3 Days';
		$periods[7200] = '5 Days';
		$periods[10800] = '7 Days';
		$periods[20160] = '14 Days';
		$periods[43200] = '1 Month';
	
		return $periods;
	}
	
	public static function available_number_formats () {
	
		$format = array ();
		$format['full'] = '1,000, 10,000'; 
		$format['short'] = '1k, 10k, 100k, 1m'; 
	
		return $format;
	}
	
	public static function options_structure() {
		$settings = array ();
		
		$settings['facebook']['id'] = array('type' => 'textbox', 'text' => 'Page ID/Name or profile');
		$settings['facebook']['account_type'] = array('type' => 'select', 'text' => 'Account type', 'values' => array('page' => 'Page', 'followers' => 'Followers'), 'default' => 'page');
		$settings['facebook']['access_token'] = array('type' => 'textbox', 'text' => 'Access token', 'description' => 'Access token is optional parameter. Generate and fill this parameter only if you are not able to see followers counter without it (usually this is required to be filled when Facebook page has limitation set - for age, country or other). To generate access token please visit this link and follow instructions: <a href="http://tools.creoworx.com/facebook/" target="_blank">http://tools.creoworx.com/facebook/</a>', 'authfield' => true);
		$settings['facebook']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Fans');
		$settings['facebook']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['twitter']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['twitter']['consumer_key'] = array('type' => 'textbox', 'text' => 'Consumer key', 'authfield' => true);
		$settings['twitter']['consumer_secret'] = array('type' => 'textbox', 'text' => 'Consumer secret', 'authfield' => true);
		$settings['twitter']['access_token'] = array('type' => 'textbox', 'text' => 'Access token', 'authfield' => true);
		$settings['twitter']['access_token_secret'] = array('type' => 'textbox', 'text' => 'Access token secret', 'authfield' => true);
		$settings['twitter']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['twitter']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['google']['id'] = array('type' => 'textbox', 'text' => 'Page ID/Name');
		$settings['google']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'authfield' => true);
		$settings['google']['value_type'] = array('type' => 'select', 'text' => 'Google+ display value type', 'values' => array("circledByCount+plusOneCount" => "circledByCount+plusOneCount", "circledByCount" => "circledByCount", "plusOneCount" => "plusOneCount"));
		$settings['google']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['google']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['pinterest']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['pinterest']['text'] = array('type' => 'textbox', 'text' => 'Fans text', 'default' => 'Followers');
		$settings['pinterest']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['linkedin']['id'] = array('type' => 'textbox', 'text' => 'LinkedIn Company or Profile ID', "description" => "");
		$settings['linkedin']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['linkedin']['account_type'] = array('type' => 'select', 'text' => 'Profile type', 'description' => 'Choose your profile type.', 'values' => array('company' => 'Company Profile (does not require access token key)', 'user' => 'Personal Profile (requires to generate and fill access token key)'));
		$settings['linkedin']['api_key'] = array('type' => 'textbox', 'text' => 'Access Token Key', 'description' => 'Access token key is required to get data for number of connections', 'authfield' => true);
		$settings['linkedin']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['github']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['github']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['github']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['vimeo']['id'] = array('type' => 'textbox', 'text' => 'Channel name/Username');
		$settings['vimeo']['account_type'] = array('type' => 'select', 'text' => 'Profile type', 'values' => array('channel' => 'Channel', 'user' => 'User'));
		$settings['vimeo']['access_token'] = array('type' => 'textbox', 'text' => 'Access token', 'description' => 'Access token key is required only if you display information for user. To generate this key you need to go to Vimeo Developer Center and create application <a href="https://developer.vimeo.com/" target="_blank">https://developer.vimeo.com/</a>', 'authfield' => true);
		$settings['vimeo']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Subscribers');
		$settings['vimeo']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['dribbble']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['dribbble']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['dribbble']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['envato']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['envato']['site'] = array('type' => 'select', 'text' => 'Envato site', 'values' => array('themeforest' => 'Themeforest', 'codecanyon' => 'Codecanyon', '3docean' => '3docean', 'activeden' => 'Activeden', 'audiojungle' => 'Audiojungle', 'graphicriver' => 'Graphicriver', 'photodune' => 'Photodune', 'videohive' => 'Videohive'));
		$settings['envato']['ref'] = array('type' => 'textbox', 'text' => 'Referral username', 'description' => 'Provide different username that will appear in the ref link to site');
		$settings['envato']['text'] =array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['envato']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['soundcloud']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['soundcloud']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'authfield' => true);
		$settings['soundcloud']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)','default' => 'Followers');
		$settings['soundcloud']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['behance']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['behance']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'authfield' => true);
		$settings['behance']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['behance']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['foursquare']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$settings['foursquare']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)','default' => 'Followers');
		$settings['foursquare']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['forrst']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['forrst']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['forrst']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['mailchimp']['list_id'] = array('type' => 'textbox', 'text' => 'List ID');
		$settings['mailchimp']['api_key'] = array('type' => 'textbox', 'text' => 'API Key');
		$settings['mailchimp']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Subscribers');
		$settings['mailchimp']['list_url'] = array('type' => 'textbox', 'text' => 'List URL address', 'description' => 'Provide subscribe form address where users will be redirected when click on button');
		$settings['mailchimp']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['delicious']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['delicious']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['delicious']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['instgram']['id'] = array('type' => 'textbox', 'text' => 'User ID');
		$settings['instgram']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['instgram']['api_key'] = array('type' => 'textbox', 'text' => 'Access Token', 'authfield' => true);
		$settings['instgram']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['instgram']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['youtube']['id'] = array('type' => 'textbox', 'text' => 'Channel/User');
		$settings['youtube']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Subscribers');
		$settings['youtube']['account_type'] = array('type' => 'select', 'text' => 'Account Type', 'values' => array('channel' => 'Channel', 'user' => 'User'));
		$settings['youtube']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'description' => 'If you have set a Google+ API key you can use it same here - all you need is to enable access to YouTube API in Google Console.', 'authfield' => true);
		$settings['youtube']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['vk']['id'] = array('type' => 'textbox', 'text' => 'Your VK.com ID number or Community ID/Name');
		$settings['vk']['account_type'] = array('type' => 'select', 'text' => 'Profile type', 'values' => array('profile' => 'Profile', 'community' => 'Community ID/Name'));
		$settings['vk']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['vk']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['rss']['link'] = array('type' => 'textbox', 'text' => 'URL address of your feed');
		$settings['rss']['count'] = array('type' => 'textbox', 'text' => 'Value of subsribers');
		$settings['rss']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Subscribers');
		$settings['rss']['feedblitz'] = array('type' => 'textbox', 'text' => 'feedblitz.com counter address', 'description' => 'Optional. If you have feedblitz account and wish to display automatically value of subscribers fill here the counter address.');
		
		$settings['vine']['email'] = array('type' => 'textbox', 'text' => 'Email');
		$settings['vine']['password'] = array('type' => 'textbox', 'text' => 'Password');
		$settings['vine']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['vine']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['vine']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['tumblr']['basename'] = array('type' => 'textbox', 'text' => 'Blog basename', 'description' => 'Your blog base name looks like appscreo.tumblr.com');
		$settings['tumblr']['api_key'] = array('type' => 'textbox', 'text' => 'Consumer Key', 'authfield' => true);
		$settings['tumblr']['api_secret'] = array('type' => 'textbox', 'text' => 'Consumer Secret', 'authfield' => true);
		$settings['tumblr']['access_token'] = array('type' => 'textbox', 'text' => 'Access Token', 'authfield' => true);
		$settings['tumblr']['access_token_secret'] = array('type' => 'textbox', 'text' => 'Access Token Secret', 'authfield' => true);
		$settings['tumblr']['text'] = array('type' => 'textbox','text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['tumblr']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['slideshare']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['slideshare']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)','default' => 'Followers');
		$settings['slideshare']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['500px']['username'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['500px']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'authfield' => true);
		$settings['500px']['api_secret'] = array('type' => 'textbox', 'text' => 'API Secret', 'authfield' => true);
		$settings['500px']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['500px']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['flickr']['id'] = array('type' => 'textbox', 'text' => 'Group slug');
		$settings['flickr']['api_key'] = array('type' => 'textbox', 'text' => 'API Key', 'authfield' => true);
		$settings['flickr']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)','default' => 'Followers');
		$settings['flickr']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['wp_posts']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)','default' => 'Posts');
		$settings['wp_posts']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		$settings['wp_posts']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on total button');
		
		$settings['wp_comments']['text'] = array('type' => 'textbox','text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Comments');
		$settings['wp_comments']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		$settings['wp_comments']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on total button');
		
		$settings['wp_users']['text'] = array('type' => 'textbox','text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Users');
		$settings['wp_users']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		$settings['wp_users']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on total button');
		
		$settings['audioboo']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['audioboo']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['audioboo']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['steamcommunity']['id'] = array('type' => 'textbox', 'text' => 'Social network profile ID');
		$settings['steamcommunity']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['steamcommunity']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['weheartit']['id'] = array('type' => 'textbox', 'text' => 'Username');
		$settings['weheartit']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['weheartit']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['feedly']['url'] = array('type' => 'textbox', 'text' => 'Feedly URL address');
		$settings['feedly']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Subscribers');
		$settings['feedly']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['total']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on total button');
		$settings['total']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Total followers');
		
		$settings['love']['url'] = array('type' => 'textbox', 'text' => 'URL address when user click on love button');
		$settings['love']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Loves');
		$settings['love']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['spotify']['id'] = array('type' => 'textbox', 'text' => 'Spotify URI');
		$settings['spotify']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['spotify']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$settings['twitch']['id'] = array('type' => 'textbox', 'text' => 'Channel Name');
		$settings['twitch']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['twitch']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');

		$settings['mymail']['id'] = array('type' => 'select', 'text' => 'Choose List', 'values' => self::mymail_get_lists());
		$settings['mymail']['url'] = array('type' => 'textbox', 'text' => 'List URL');
		$settings['mymail']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Subscribers');
		$settings['mymail']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
		
		$mailpoet_lists = self::mailpoet_get_lists();
		$mailpoet_lists = array_merge( array( array( 'list_id' => 'all', 'name' => esc_html__(' Total Subscribers', 'hellofollowers' ))), $mailpoet_lists);
		$mailpoet_lists = array_merge( array( array( 'list_id' => '', 'name' => esc_html__(' ', 'hellofollowers' ))), $mailpoet_lists);
		
		$parsed_lists = array();
		foreach ($mailpoet_lists as $list) {
			$list_id = isset($list['list_id']) ? $list['list_id'] : '';
			$list_name = isset($list['name']) ? $list['name'] : '';
			$parsed_lists[$list_id] = $list_name;
		}
		$settings['mailpoet']['id'] = array('type' => 'select', 'text' => 'Choose List', 'values' => $parsed_lists);
		$settings['mailpoet']['url'] = array('type' => 'textbox', 'text' => 'List URL');
		$settings['mailpoet']['text'] = array('type' => 'textbox', 'text' => 'Text below number', 'description' => 'Text that will appear below number of followers (fans, likes, subscribers, followers and etc.)', 'default' => 'Followers');
		$settings['mailpoet']['uservalue'] = array('type' => 'textbox', 'text' => 'Manual user value of followers');
				

		
		return $settings;
	}
	

	public static function create_default_options_from_structure($options) {
		$structure = self::options_structure();
		
		foreach ($structure as $network => $data) {
			$base_network_option_id = "hellofollowers_".$network."_";
			foreach ($data as $key => $setup) {
				$default_text = isset($setup['default']) ? $setup['default'] : '';
				
				if (!empty($default_text)) {
					$options[$base_network_option_id.$key] = $default_text;
				}
			}
		}
		
		$options['hellofollowers_update'] = 1440;
		$options['hellofollowers_format'] = 'short';
		
		return $options;
	}
		
	public static function mailpoet_total_subscribers(){
		if( class_exists( 'WYSIJA' ) ){
			$config = WYSIJA::get('config','model');
			$result = $config->getValue('total_subscribers');
			return $result;
		}
	}
	
	//Get Mail Lists
	public static function mailpoet_get_lists(){
		if( class_exists( 'WYSIJA' ) ){
			$helper_form_engine = WYSIJA::get('form_engine', 'helper');
			$lists = $helper_form_engine->get_lists();
			return $lists ;
		}
		else {
			return array();
		}
	}
	
	//Get Subscribers of Specific List
	public static function mailpoet_get_list_users( $list ){
		if( class_exists( 'WYSIJA' ) ){
			$model_user_list = WYSIJA::get('user_list', 'model');$query = 'SELECT COUNT(*) as count
			FROM ' . '[wysija]' . $model_user_list->table_name . '
			WHERE list_id = ' . $list ;
	
			$result = $model_user_list->query('get_res', $query);
			return $result[0][ 'count' ];
		}
	}
	
	public static function mymail_get_lists() {
		if (function_exists('mailster')) {
			$lists = mailster('lists')->get();
			foreach ($lists as $list) {
				$result[$list->ID] = $list->name;
			}
					
			return $result;
		}
		else {
			return array();
		}
	}
	
	
	
}