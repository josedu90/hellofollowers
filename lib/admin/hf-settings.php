<?php


global $hellofollowers_navigation_tabs, $hellofollowers_sidebar_sections, $hellofollowers_section_options;

$tab_1 = 'social';

global $current_tab;
$current_tab = (empty ( $_GET ['tab'] )) ? $tab_1 : sanitize_text_field ( urldecode ( $_GET ['tab'] ) );


$tabs = $hellofollowers_navigation_tabs;
$section = $hellofollowers_sidebar_sections [$current_tab];
$options = $hellofollowers_section_options [$current_tab];

?>
<div class="wrap">

	<div class="hf-title-panel">
	
	
	<?php 
		
	?>
		
	<div class="hf-title-panel-buttons">
	<?php echo '<a href="http://support.creoworx.com" target="_blank" text="' . esc_html__( 'Need Help? Click here to visit our support center', 'hellofollwers' ) . '" class="button float_right"><i class="fa fa-question"></i>&nbsp;' . esc_html__( 'Support Center', 'hellofollwers' ) . '</a>'; ?>
	<?php echo '<a href="http://demo.creoworx.com/hellofollowers/documentation/" target="_blank" text="' . esc_html__( 'Plugin Documentation', 'hellofollwers' ) . '" class="button float_right"><i class="fa fa-book"></i>&nbsp;' . esc_html__( 'Documentation', 'hellofollwers' ) . '</a>'; ?>
	</div>
	<div class="hf-title-panel-inner">
	
	<h3>Hello Followers - Social Counter Plugin for WordPress</h3>
		<p>
			Version <strong><?php echo HFOLLOW_VERSION;?></strong>. 
		</p>
		</div>
	</div>


	<div class="hf-tabs">

		<ul>
    <?php
				$is_first = true;
				foreach ( $tabs as $name => $label ) {
					$tab_sections = isset ( $hellofollowers_sidebar_sections [$name] ) ? $hellofollowers_sidebar_sections [$name] : array ();
					$hidden_tab = isset ( $tab_sections ['hide_in_navigation'] ) ? $tab_sections ['hide_in_navigation'] : false;
					if ($hidden_tab) {
						continue;
					}
					
					$options_handler = 'hellofollowers';
					echo '<li><a href="' . esc_url(admin_url ( 'admin.php?page=' . $options_handler . '&tab=' . $name )) . '" class="hf-nav-tab ';
					if ($current_tab == $name)
						echo 'active';
					echo '">' . $label . '</a></li>';
					$is_first = false;
				}
				
				?>
    </ul>

	</div>
	<div class="hf-clear"></div>
	
	<?php
	
		if ($current_tab != 'shortcode') {
	
			HelloFollowersOptionsInterface::draw_form_start ();
			
			HelloFollowersOptionsInterface::draw_header ( $section ['title'], $section ['hide_update_button'], $section ['wizard_tab'] );
			HelloFollowersOptionsInterface::draw_sidebar ( $section ['fields'] );
			HelloFollowersOptionsInterface::draw_content ( $options );
			
			HelloFollowersOptionsInterface::draw_form_end ();
			
			HelloFollowersOptionsFramework::register_color_selector ();
		}
		else {
			include_once HFOLLOW_PLUGIN_ROOT. 'lib/admin/hf-shortcode-generator.php';
		}
		
		?>

	
</div>