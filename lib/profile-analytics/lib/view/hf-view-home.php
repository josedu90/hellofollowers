<?php

$tabs = array ("home" => "Overview", "detailed" => "Profile Report", "period" => "Detailed Report", "comparepreiod" => "Compare Report" );
$default_tab = "home";

global $current_tab;
$current_tab = (empty ( $_GET ['tab'] )) ? $default_tab : sanitize_text_field ( urldecode ( $_GET ['tab'] ) );

$dummy = isset($_REQUEST['dummy']) ? $_REQUEST['dummy'] : '';
$fd = isset($_REQUEST['fd']) ? $_REQUEST['fd'] : '';
$td = isset($_REQUEST['td']) ? $_REQUEST['td'] : '';

if ($dummy == "yes" && !empty($fd) && !empty($td)) {
	HFFollowersCounterBridge::generate_dummy_data($fd, $td);
}

if ($dummy == "reset") {
	HFSPADatabase::reset_data();
}

?>

<div class="wrap">

	<?php 
	$is_installed = true;
	
	if ($is_installed) {
		$default_update = hellofollowers_options_value('expire');
		$default_update = intval($default_update);
		
		if ($default_update > 1440) {
			printf ( '<div class="essb-information-box"><div class="icon blue"><i class="fa fa-database"></i></div><div class="inner">%1$s</div></div>', esc_html__( 'Social Fans Counter update period is set for a value greater than 1 day. To get complete and correct reports please change the update preiod to be 1 day or less.', 'hellofollowers' ));
				
		}
		
		
	}
	
	?>

	<div class="hf-title-panel">
	
<h3>Social Profile Analytics</h3>
	</div>
	<div class="hf-tabs">

		<ul>
    <?php
				$is_first = true;
				foreach ( $tabs as $name => $label ) {
					echo '<li><a href="' . esc_url(admin_url ( 'admin.php?page=hellofollowers_spa&tab=' . $name )) . '" class="hf-nav-tab ';
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
	if ($is_installed) {
		if ($current_tab == "home") {
			include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/view/hf-view-overview.php');
		}
		if ($current_tab == "detailed") {
			include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/view/hf-view-network.php');
		}
		if ($current_tab == "period") {
			include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/view/hf-view-detailed.php');
		}
		if ($current_tab == "comparepreiod") {
			include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/view/hf-view-period-compare.php');
		}
	}
	?>
	
</div>