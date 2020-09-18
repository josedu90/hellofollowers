<?php
/**
 * Shortcode Generator Interface
 * 
 * @author appscreo
 * @package HelloFollowers
 *
 */
class HelloFollowersCodeGenerator {
	
	public $shortcodeOptions;
	public $shortcode = "";
	public $shortcodeTitle = "";
	
	public $optionsGroup = "shortcode";
	private $counterPositions;
	private $templates;
	private $totalCounterPosition;
	private $buttonStyle;
	
	function __construct() {
		
		$this->shortcodeOptions = array();
	
	}
	
	function register($param, $options) {
		$this->shortcodeOptions[$param] = $options;
	}
	
	function renderNavigation() {
		echo '<li id="hf-menu-1" class="hf-menu-item"><a href="#"
						onclick="return false;">'.$this->shortcodeTitle.'</a></li>';
		
		$sectionCount = 1;
		
		foreach ($this->shortcodeOptions as $param => $settings) {
			$type = isset($settings['type']) ? $settings['type'] : 'textbox';
		}
	}
	
	function render() {
		
		$required_js = "";
		
		echo '<table border="0" cellpadding="5" cellspacing="0" width="100%">
						<col width="25%" />
						<col width="75%" />';
		
		echo '<tr class="table-border-bottom">';
		echo '<td colspan="2" class="sub">'.esc_html($this->shortcodeTitle).'</td>';
		echo '</tr>';
		
		$cnt = 0;
		$sectionCount = 1;
		
		foreach ($this->shortcodeOptions as $param => $settings) {
			$type = isset($settings['type']) ? $settings['type'] : 'textbox';
			switch ($type) {
				case "section":
					$this->renderSection($param, $settings, $sectionCount);
					$sectionCount++;
					break;
				case "subsection":
					$this->renderSubSection($param, $settings);
					break;
				case "textbox" :
					$this->renderTextbox($param, $settings, $cnt);
					break;
				case "checkbox":
					$this->renderCheckbox($param, $settings, $cnt);
					break; 
				case "dropdown":
					$this->renderDropDown($param, $settings, $cnt);
					break;
			}
			
			$cnt++;
		}
		
		echo '</table>';
		
	}

	function renderSection($param, $settings, $cnt) {
		$text = isset($settings['text']) ? $settings['text'] : '';
		
		echo '<tr class="table-border-bottom">';
		
		echo '<td class="sub2" colspan="2" id="hf-submenu-'.esc_attr($cnt).'">'.esc_html($text).'</td>';
		
		echo '</tr>';
	}
	
	function renderSubSection($param, $settings) {
		$text = isset($settings['text']) ? $settings['text'] : '';
	
		echo '<tr class="table-border-bottom">';
	
		echo '<td class="sub4" colspan="2">'.esc_html($text).'</td>';
	
		echo '</tr>';
	}
	
	function renderTextbox($param, $settings, $cnt) {
		$text = isset($settings['text']) ? $settings['text'] : '';
		$comment = isset($settings['comment']) ? $settings['comment'] : '';
		$default_value = isset($settings['value']) ? $settings['value'] : '';
		$fullwidth = isset($settings["fullwidth"]) ? $settings["fullwidth"] : "";
		
		$cssClass = ($cnt % 2 == 0) ? "even" : "odd";
		
		echo '<tr class="'.esc_attr($cssClass).' table-border-bottom">';
		echo '<td class="bold" valign="top">'.esc_html($text).'<br/><span class="label">'.esc_html($comment).'</span></td>';
		echo '<td class="essb_general_options">';
		echo '<input id="'.esc_attr($param).'" type="text" name="'.$this->optionsGroup.'['.esc_attr($param).']" value="' . esc_attr($default_value) . '" class="input-element '.($fullwidth == "true" ? "stretched" : "").'" />';
		echo '</td>';
		echo '</tr>';		
	}
	
	function renderCheckbox($param, $settings, $cnt) {
		$text = isset($settings['text']) ? $settings['text'] : '';
		$comment = isset($settings['comment']) ? $settings['comment'] : '';
		$default_value = isset($settings['value']) ? $settings['value'] : '';
		
		$cssClass = ($cnt % 2 == 0) ? "even" : "odd";
		
		echo '<tr class="'.esc_attr($cssClass).' table-border-bottom">';
		echo '<td class="bold" valign="top">'.esc_html($text).'<br/><span class="label">'.esc_html($comment).'</span></td>';
		echo '<td class="essb_general_options">';
		echo '<input id="'.esc_attr($param).'" type="checkbox" name="'.$this->optionsGroup.'['.esc_attr($param).']" value="' . esc_attr($default_value) . '" />';
		echo '</td>';
		echo '</tr>';
	}
	
	function renderDropDown($param, $settings, $cnt) {
		$text = isset($settings['text']) ? $settings['text'] : '';
		$comment = isset($settings['comment']) ? $settings['comment'] : '';
		$default_value = isset($settings['value']) ? $settings['value'] : '';
		$fullwidth = isset($settings["fullwidth"]) ? $settings["fullwidth"] : "";
		$values = isset($settings['sourceOptions']) ? $settings['sourceOptions'] : array();
		
		$cssClass = ($cnt % 2 == 0) ? "even" : "odd";
		
		echo '<tr class="'.esc_attr($cssClass).' table-border-bottom">';
		echo '<td class="bold" valign="top">'.esc_html($text).'<br/><span class="label">'.esc_html($comment).'</span></td>';
		echo '<td class="essb_general_options">';
		echo '<select id="'.esc_attr($param).'" name="'.$this->optionsGroup.'['.esc_attr($param).']" class="input-element '.($fullwidth == "true" ? "stretched" : "").'">';
		
		foreach ($values as $key => $single) {
				printf('<option value="%s" %s>%s</option>', esc_attr($key), ($key == $value ? 'selected' : ''), esc_html($single));
		}
		
		echo '</select>';
		echo '</td>';
		echo '</tr>';
	}
	
	

	public function generate($options) {
		$output = "";
		$output .= '['.$this->shortcode;
		
		$exist_url = false;
		
		foreach ($this->shortcodeOptions as $param => $settings) {
			$value = isset($options[$param]) ? $options[$param] : '';
			$type = isset($settings['type']) ? $settings['type'] : 'textbox';
			if ($type == "section") { continue; }
			
			if ($type == "networks" || $type == "networks_sp" || $type == "networks_sfce") {
				
				if (count($value) > 0 && $value != '') {
				$network_list = "";
				foreach ( $value as $nw ) {
					if ($network_list != '') {
						$network_list .= ",";
					}
					$network_list .= $nw;
				}
				
				if ($network_list == "") {
					$network_list = "no";
				}
				
				$value = $network_list;
				}
			}
			
			if ($type == "network_names") {
				$networks = preg_split('#[\s+,\s+]#', $value);
				$network_list = "";
				
				foreach ($networks as $k) {
					$text_for_network = isset($options[$k.'_text'])	? $options[$k.'_text'] : '';
					
					if ($text_for_network != '') {
						if ($network_list != '' ) { $network_list .= ' '; }
						$network_list .= $k.'_text="'.$text_for_network.'"';
					}
				}
				
				$value = $network_list;
			}
			
			if ($param == "counters" && $value == '') { $value = '0'; }
			if ($param == "url" && trim($value) != '') { $exist_url = true; }
			
			if ($value != '') {
				
				if ($param == "counters") {
					$output .= ' '.$param.'='.$value.'';
				}
				else if ($param == "network_names") {
					$output .= ' '.$value;
				}
				else {
					$output .= ' '.$param.'="'.$value.'"';
				}
			}
		}
		
		$output .= ']';
		
		echo '<div class="hf-shortcode-title">Your generated shortcode is</div>';
		echo '<div class="hf-shortcode">';
		echo $output;
		echo '</div>';
		
		echo '<div class="hf-shortcode-title">Include your shortcode into template files using this sample code</div>';
		echo '<div class="hf-shortcode-code"><code>';
		echo '&lt;?php&nbsp;';
		echo 'echo do_shortcode(\''.$output.'\');&nbsp;';
		echo '?&gt;&nbsp;</code>';

	}
	
	// initialize shortcodes
	public function activate($shortcode = 'hello-followers') {
		$this->shortcodeOptions = array();
		if ($shortcode == 'hello-followers') {
			$this->includeOptionsForEasyFans();
		}
		
		if ($shortcode == 'hello-total-followers') {
			$this->includeOptionsForTotalFollowers();
		}
	}
	
	private function includeOptionsForTotalFollowers() {
		$this->shortcode = 'hello-total-followers';
		$this->shortcodeTitle = '[hello-total-followers] Shortcode - shortcode does not have additional options';
		
	}
	
	private function includeOptionsForEasyFans() {
		$this->shortcode = 'hello-followers';
		$this->shortcodeTitle = '[hello-followers] Shortcode';

		
		$default_shortcode_setup = HFSocialFollowersCounterHelper::default_instance_settings();
		$shortcode_settings = HFSocialFollowersCounterHelper::default_options_structure(true, $default_shortcode_setup);
		foreach ($shortcode_settings as $field => $options) {
			$description = isset($options['description']) ? $options['description'] : '';
			$options['comment'] = $description;
			$title = isset($options['title']) ? $options['title'] : '';
			$options['text'] = $title;
			
			$type = isset($options['type']) ? $options['type'] : '';
			if ($type == "textbox") { 
				$options['fullwidth'] = 'true';
			}
			if ($type == "separator") { 
				$options['type'] = "subsection";
			}
			
			$values = isset($options['values']) ? $options['values'] : array();
			
			if ($type == "select") {
				$options['type'] = "dropdown";
				$options['sourceOptions'] = $values;
			}
			
			$default_value = isset($options['default_value']) ? $options['default_value'] : '';
			if (!empty($default_value) && $type != 'checkbox') { 
				$options['value'] = $default_value;
			}
			else {
				if ($type == 'checkbox') {
					$options['value'] = '1';
				}
			}
			
			$this->register($field, $options);
		}
		
		
	}
	
}

?>