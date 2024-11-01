<?php

/**
 * Shortcode view [openimmo_objects] & [openimmo_slider]
 * partial elemnt to send email from page
 *
 * @link       #
 * @since      2.0.0
 *
 * @package    Im_Xml
 * @subpackage Im_Xml/public/partials
 */

if (!defined('woodpecker-shortcode')) {
    die('Direct access not permitted');
}
$options = get_option($this->plugin_name);

?>

<?php
    if(!$options['gform_default_style']) {
?>
  <div class="woodpecker-connector-shortcode">
<?php } else { ?>
  <div class="woodpecker-connector-shortcode-default">
  <style>
      .woodpecker-connector-form input[type="submit"].woodpecker-connector-btn{
          color: <?php echo $options['color_submit']; ?>;
          background-color: <?php echo $options['color_submit_bg']; ?>;
      }
      .woodpecker-connector-form input[type="submit"].woodpecker-connector-btn:hover,
      .woodpecker-connector-form input[type="submit"].woodpecker-connector-btn:active{
          background-color: <?php echo $options['color_submit_bg_hover']; ?>;
      }
  </style>
<?php } ?>


    <form id="<?php echo $atts['form_name']; ?>" method="post" class="woodpecker-connector-form" action="">
      <input name="<?php echo $this->plugin_name ?>-campaign" type="hidden" value="<?php echo $atts['id']; ?>">
      <input name="<?php echo $this->plugin_name ?>-form-name" type="hidden" value="<?php echo $atts['form_name']; ?>">

      <?php
        if($options['gform_first_hide']) {
      ?>
          <div class="woodpecker-connector-group form-group">
            <label><?php _e($options['gform_first'], $this->plugin_name); ?></label>
            <input name="<?php echo $this->plugin_name ?>-first_name" type="text" class="form-control woodpecker-connector-control">
          </div>
      <?php
        }

        if($options['gform_last_hide']) {
      ?>
          <div class="form-group woodpecker-connector-group">
            <label><?php _e($options['gform_last'], $this->plugin_name); ?></label>
            <input name="<?php echo $this->plugin_name ?>-last_name" type="text" class="form-control woodpecker-connector-control">
          </div>
      <?php
        }

        if($options['gform_company_hide']) {
      ?>
          <div class="form-group woodpecker-connector-group">
            <label><?php _e($options['gform_company'], $this->plugin_name); ?></label>
            <input name="<?php echo $this->plugin_name ?>-company" type="text" class="form-control woodpecker-connector-control">
          </div>
      <?php
        }
      ?>

      <div class="form-group woodpecker-connector-group">
        <label><?php _e($options['gform_email'], $this->plugin_name); ?></label>
        <div class="woodpecker-connector-email">
          <input name="<?php echo $this->plugin_name ?>-email" type="email" class="form-control woodpecker-connector-control">
        </div>
      </div>

      <div class="woodpecker-connector-response-container"></div>

      <div class="form-group woodpecker-connector-group">
        <input value="<?php _e($options['gform_submit'], $this->plugin_name); ?>" class="btn btn-default woodpecker-connector-btn woodpecker-connector-trigger" type="submit" data-sub-id="<?php echo $atts['id']; ?>" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>">
      </div>

      <div class="form-group woodpecker-connector-group woodpecker-connector-privacy_policy">
        <div class="woodpecker-connector-checkbox">
          <input type="checkbox" name="<?php echo $this->plugin_name ?>-accept_policy" value="0">
          <span class="custom-checkbox"></span>
        </div>
        <?php _e($options['privacy_policy'], $this->plugin_name); ?>
      </div>
      <input name="<?php echo $this->plugin_name ?>-tags" value="wordpress" type="hidden">
    </form>
</div>
