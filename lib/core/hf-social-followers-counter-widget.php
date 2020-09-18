<?php

function init_wp_widget_hellofollowers_followers_counter() {
	register_widget( 'HFSocialFollowersCounterWidget' );
}

add_action( 'widgets_init', 'init_wp_widget_hellofollowers_followers_counter' );

class HFSocialFollowersCounterWidget extends WP_Widget {

	public function __construct() {

		$options = array( 'description' => esc_html__( 'Widet to display your social follower counters' , 'hellofollowers' ) );
		parent::__construct( 'hellofollowers' , esc_html__( 'Hello Followers Counter' , 'hellofollowers' ) , $options );
	}
	
	public function form( $instance ) {
	
		$defaults = HFSocialFollowersCounterHelper::default_instance_settings();	
		$instance = wp_parse_args( ( array ) $instance , $defaults );
	
		$widget_settings_fields = HFSocialFollowersCounterHelper::default_options_structure(true, $instance);
		
		foreach ($widget_settings_fields as $field => $options) {
			$field_type = isset($options['type']) ? $options['type'] : 'textbox';
			$field_title = isset($options['title']) ? $options['title'] : '';
			$field_description = isset($options['description']) ? $options['description'] : '';
			$field_values = isset($options['values']) ? $options['values'] : array();
			$field_default_value = isset($options['default_value']) ? $options['default_value'] : '';
			
			if ($field_type == "textbox") {
				$this->generate_textbox_field($field, $field_title, $field_description, $field_default_value);
			}
			if ($field_type == "checkbox") {
				$this->generate_checkbox_field($field, $field_title, $field_description, $field_default_value);
			}
			if ($field_type == "separator") {
				$this->generate_separator($field_title);
			}
			if ($field_type == "select") {
				$this->generate_select_field($field, $field_title, $field_description, $field_default_value, $field_values);
			}
		}
	}
	
	public function update( $new_instance , $old_instance ) {
		$instance = $old_instance;
		
		$widget_settings_fields = HFSocialFollowersCounterHelper::default_options_structure();
		
		foreach ($widget_settings_fields as $field => $options) {
			
			$field_type = isset($options['type']) ? $options['type'] : '';
			
			if ($field_type == 'separator') {
				continue;
			}
			
			if (isset($new_instance[$field])) {
				$instance[$field] = $new_instance[$field];
			}
		}
		
		return $instance;

	}
	
	public function widget( $args , $instance ) {
		
		$before_widget = $args['before_widget'];
		$before_title  = $args['before_title'];
		$after_title   = $args['after_title'];
		$after_widget  = $args['after_widget'];
				
		$title = isset($instance['title']) ? $instance['title'] : '';
		$hide_title = isset($instance['hide_title']) ? $instance['hide_title'] : 0;
		
		if (intval($hide_title) == 1) { $title = ""; }
		
		if (!empty($title)) {
			echo $before_widget . $before_title . $title . $after_title;
		}

		// draw follower buttons with title set to off - this will be handle by the widget setup
		HFSocialFollowersCounterDraw::draw_followers($instance, false);
		
		if (!empty($title)) {
			echo $after_widget;
		}
	}
	
	/*
	 * Widget Settings Draw Functions (Private Access)
	 */

	private function generate_select_field($field, $title, $description, $value, $list_of_values) {
		$output = "";
		
		$output .= '<p>';
		$output .= '<label for="'.esc_attr($this->get_field_id($field)).'">'.esc_html($title).'</label>';
		$output .= '<select name="'.esc_attr($this->get_field_name( $field )).'" id="'.esc_attr($this->get_field_id( $field )).'" class="widefat">';
		
		foreach ($list_of_values as $key => $text) {
			$output .= '<option value="'.esc_attr($key).'" '.($key == $value ? 'selected="selected"' : '').'>'.esc_html($text).'</option>';
		}
		
		$output .= '</select>';
		if (!empty($description)) {
			$output .= '<span class="hf-small-widget-desc"><br /><em>'. esc_html__( $description , 'hellofollowers' ).'</em></span>';
		}
		$output .= '</p>';
		
		echo $output;
	}
	
	private function generate_separator($title) {
		echo '<h5 class="hf-h5-widget-title">'.esc_html($title).'</h5>';
	}
	
	private function generate_textbox_field($field, $title, $description, $value) {
		$output = "";
		
		$output .= '<p>';
		$output .= '<label for="'.esc_attr($this->get_field_id($field)).'">'.esc_html($title).'</label>';
		$output .= '<input type="text" name="'.esc_attr($this->get_field_name( $field )).'" id="'.esc_attr($this->get_field_id( $field )).'" class="widefat" value="'.esc_attr($value).'" />';
		if (!empty($description)) {
			$output .= '<span class="hf-small-widget-desc"><br /><em>'. esc_html__( $description , 'hellofollowers' ).'</em></span>';
		}
		$output .= '</p>';
		
		echo $output;
	}

	private function generate_checkbox_field($field, $title, $description, $value) {
		$output = "";
		
		$output .= '<p>';
		$output .= '<label for="'.esc_attr($this->get_field_id($field)).'">'.esc_html($title).'</label>&nbsp;';
		$output .= '<input type="checkbox" name="'.esc_attr($this->get_field_name( $field )).'" id="'.esc_attr($this->get_field_id( $field )).'" class="widefat" value="1" '.($value == 1 ? ' checked="checked"' : '').' />';
		if (!empty($description)) {
			$output .= '<span class="hf-small-widget-desc"><br /><em>'. esc_html__( $description , 'hellofollowers' ).'</em></span>';
		}
		$output .= '</p>';
		
		echo $output;
	}
}
