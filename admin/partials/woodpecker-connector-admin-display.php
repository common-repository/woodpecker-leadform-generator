<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      2.0.0
 * @author     Woodpecker Team
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/admin/partials
 */

$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'howitworks';

settings_fields($this->plugin_name);
$options = get_option($this->plugin_name);

$getconnectcampaign = new Woodpecker_Connector_Curl('/rest/v1/me', $options['api_key']);
$getjsoncampaign = $getconnectcampaign->getJson();
$getstatus = $getjsoncampaign->status;
?>

<div id="woodpecker-options" class="woodpecker-options-wrap">
    <?php
      define('Woodpecker_Connector_Admin', TRUE);
    ?>
    <div class="woodpecker-header">
        <div class="woodpecker-header__logo">
            <img src="<?php _e($this->url . 'admin/images/app-logo.svg'); ?>" alt="Woodpecker">
            <div class="woodpecker-header__logo--text">
                <?php _e('Woodpecker for WordPress', $this->plugin_name); ?>
            </div>
        </div>
        <div class="woodpecker-header-content">
            <div  class="nav-tab-wrapper">
                <a href="?page=woodpecker-connector&tab=howitworks"
                   class="nav-tab <?php echo $active_tab == 'howitworks' ? 'nav-tab-active' : ''; ?>"><?php _e('How it works', $this->plugin_name); ?></a>
                <?php if ($getstatus->status != 'ERROR' && $options['api_key'] != '') : ?>
                  <a href="?page=woodpecker-connector&tab=campaigns"
                     class="nav-tab <?php echo $active_tab == 'campaigns' ? 'nav-tab-active' : ''; ?>"><?php _e('Shortcodes', $this->plugin_name); ?></a>
                  <a href="?page=woodpecker-connector&tab=prospects"
                     class="nav-tab <?php echo $active_tab == 'prospects' ? 'nav-tab-active' : ''; ?>"><?php _e('Prospects', $this->plugin_name); ?></a>
                <?php endif; ?>
                <a href="?page=woodpecker-connector&tab=settings"
                   class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php _e('Settings', $this->plugin_name); ?></a>
            </div>
        </div>
    </div>

    <?php
      if ($active_tab == '' || $active_tab == 'howitworks') :
          include_once( 'woodpecker-connector-admin-display-how-it-works.php' );
      endif;

      if ($active_tab == 'campaigns') :
          include_once( 'woodpecker-connector-admin-display-shortcodes.php' );
      endif;

      if ($active_tab == 'prospects') :
          include_once( 'woodpecker-connector-admin-display-prospects.php' );
      endif;

      if ($active_tab == 'settings') :
          include_once( 'woodpecker-connector-admin-display-settings.php' );
      endif;
    ?>

</div>
