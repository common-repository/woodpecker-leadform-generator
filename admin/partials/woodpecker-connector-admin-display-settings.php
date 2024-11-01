<?php
/**
 * Admin backend for Settings
 *
 * @link       #
 * @since      2.0.0
 * @author     Woodpecker Team
 * @package    Woodpecker_Connector
 * @subpackage Woodpecker_Connector/admin/partials
 */

if (!defined('Woodpecker_Connector_Admin')) :
    die('Direct access not permitted');
endif;
?>

<form method="post" name="woodpecker-options" action="options.php" enctype="multipart/form-data">
  <div class="col-container">
    <div class="col-container__margin">
      <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);

        $getconnectcampaign = new Woodpecker_Connector_Curl('/rest/v1/me', $options['api_key']);
        $getjsoncampaign = $getconnectcampaign->getJson();
        $getstatus = $getjsoncampaign->status;
        $error = false;

        if ($getstatus->status == 'ERROR' || $options['api_key'] == '') :
          $error = true;
        endif;
      ?>

        <div class="settings-container">
          <div class="settings-container__menu">
            <ul>
              <li id="synchronization"><?php esc_attr_e('Synchronization', $this->plugin_name); ?></li>
              <li id="form-settings"><?php esc_attr_e('Form settings', $this->plugin_name); ?></li>
              <li id="messages"><?php esc_attr_e('Messages', $this->plugin_name); ?></li>
              <li id="privacy-policy"><?php esc_attr_e('Privacy policy', $this->plugin_name); ?></li>
            </ul>
          </div>
          <div class="settings-container__content">
            <div id="synchronization-box" style="display: none;">
                <div>
                  <label class="settings-container__content--label"><?php esc_attr_e('api key', $this->plugin_name); ?></label>
                  <input type="text"
                    class="settings-container__content--input api <?php _e(($error == true ? "error" : "")); ?>"
                    id="<?php _e($this->plugin_name); ?>-api_key"
                    name="<?php _e($this->plugin_name); ?>[api_key]"
                    placeholder="<?php _e('API key', $this->plugin_name); ?>"
                    value="<?php _e($options['api_key']); ?>"
                    autocomplete="off"/>

                  <?php if ($error == true) : ?>
                    <span class="error"><?php esc_attr_e(' The API key is incorrect or no longer valid. You can generate a new key in your Woodpecker account in "Settings".', $this->plugin_name); ?></span>
                  <?php else: ?>
                    <span class="info"><?php esc_attr_e('Generate in Woodpecker Settings', $this->plugin_name); ?></span>
                  <?php endif; ?>

                </div>
            </div>

          <div id="form-settings-box" style="display: none;">
            <div>
              <div class="settings-container__content--box">
                <span class="settings-container__content--span"><?php esc_attr_e('Email label:', $this->plugin_name); ?></span>
                <input type="text"
                  class="settings-container__content--input"
                  placeholder="<?php esc_attr_e('Email...', $this->plugin_name); ?>"
                  id="<?php _e($this->plugin_name); ?>-gform_email"
                  name="<?php _e($this->plugin_name); ?>[gform_email]"
                  value="<?php _e($options['gform_email']); ?>"
                  autocomplete="off"/>
              </div>
              <div class="settings-container__content--box">
                <span class="settings-container__content--span"><?php esc_attr_e('First name label:', $this->plugin_name); ?></span>
                <input type="text"
                  class="settings-container__content--input"
                  placeholder="<?php esc_attr_e('First name...', $this->plugin_name); ?>"
                  id="<?php _e($this->plugin_name); ?>-gform_first"
                  name="<?php _e($this->plugin_name); ?>[gform_first]"
                  value="<?php _e($options['gform_first']); ?>"
                  autocomplete="off"/>
                  <div class="settings-container__content--checkbox">
                    <input type="checkbox"
                      class="settings-container__content--checkbox__input"
                      id="<?php _e($this->plugin_name); ?>-gform_first_hide"
                      name="<?php _e($this->plugin_name); ?>[gform_first_hide]"
                      value="1" <?php checked($options['gform_first_hide'], 1); ?>/> Show
                      <span class="custom-checkbox"></span>
                  </div>
                </div>
                <div class="settings-container__content--box">
                  <span class="settings-container__content--span"><?php esc_attr_e('Last name label:', $this->plugin_name); ?></span>
                  <input type="text"
                      class="settings-container__content--input"
                      placeholder="<?php esc_attr_e('Last name...', $this->plugin_name); ?>"
                      id="<?php _e($this->plugin_name); ?>-gform_last"
                      name="<?php _e($this->plugin_name); ?>[gform_last]"
                      value="<?php _e($options['gform_last']); ?>"
                      autocomplete="off"/>
                  <div class="settings-container__content--checkbox">
                    <input type="checkbox"
                        class="settings-container__content--checkbox__input"
                        id="<?php _e($this->plugin_name); ?>-gform_last_hide"
                        name="<?php _e($this->plugin_name); ?>[gform_last_hide]"
                        value="1" <?php checked($options['gform_last_hide'], 1); ?>/> Show
                      <span class="custom-checkbox"></span>
                  </div>
                </div>
                <div class="settings-container__content--box">
                  <span class="settings-container__content--span"><?php esc_attr_e('Company label:', $this->plugin_name); ?></span>
                  <input type="text"
                      class="settings-container__content--input"
                      placeholder="<?php esc_attr_e('Company...', $this->plugin_name); ?>"
                      id="<?php _e($this->plugin_name); ?>-gform_company"
                      name="<?php _e($this->plugin_name); ?>[gform_company]"
                      value="<?php _e($options['gform_company']); ?>"
                      autocomplete="off"/>
                  <div class="settings-container__content--checkbox">
                    <input type="checkbox"
                        class="settings-container__content--checkbox__input"
                        id="<?php _e($this->plugin_name); ?>-gform_company_hide"
                        name="<?php _e($this->plugin_name); ?>[gform_company_hide]"
                        value="1" <?php checked($options['gform_company_hide'], 1); ?>/> Show
                        <span class="custom-checkbox"></span>
                  </div>
                </div>
                <div class="settings-container__content--box">
                  <span class="settings-container__content--span"><?php esc_attr_e('Button label:', $this->plugin_name); ?></span>
                  <input type="text"
                      class="settings-container__content--input"
                      placeholder="<?php esc_attr_e('Button...', $this->plugin_name); ?>"
                      id="<?php _e($this->plugin_name); ?>-gform_submit"
                      name="<?php _e($this->plugin_name); ?>[gform_submit]"
                      value="<?php _e($options['gform_submit']); ?>"
                      autocomplete="off"/>
                </div>
              </div>

              <div class="settings-container__content--selector">
                <div class="settings-container__content--selector__box">
                  <span class="settings-container__content--selector__span"><?php esc_attr_e('Button style', $this->plugin_name); ?></span>
                  <div class="woodpecker-connector-switch">
                    <div class="switch-widget">
                      <div class="sw-cont">
                        <input type="checkbox"
                            id="<?php _e($this->plugin_name); ?>-gform_default_style"
                            name="<?php _e($this->plugin_name); ?>[gform_default_style]"
                            value="1" <?php checked((!isset($options['gform_default_style']) ? 1 : $options['gform_default_style']), 1); ?> />
                        <div class="sw-icon">
                          <div></div>
                        </div>
                        <div class="sw-label" style="display: none;" ></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="picker-panel">
                  <div id="<?php _e($this->plugin_name); ?>-color_submit-box" class="settings-container__content--pickers__box">
                    <span class="settings-container__content--pickers__span"><?php esc_attr_e('Font color:', $this->plugin_name); ?></span>
                    <input type="text"
                        class="<?php _e($this->plugin_name); ?>-color-picker color-field"
                        id="<?php _e($this->plugin_name); ?>-color_submit"
                        name="<?php _e($this->plugin_name); ?>[color_submit]"
                        value="<?php _e($options['color_submit']); ?>" />
                  </div>
                  <div id="<?php _e($this->plugin_name); ?>-color_submit_bg-box" class="settings-container__content--pickers__box">
                    <span class="settings-container__content--pickers__span"><?php esc_attr_e('Button color:', $this->plugin_name); ?></span>
                    <input type="text"
                        class="<?php _e($this->plugin_name); ?>-color-picker color-field"
                        id="<?php _e($this->plugin_name); ?>-color_submit_bg"
                        name="<?php _e($this->plugin_name); ?>[color_submit_bg]"
                        value="<?php _e($options['color_submit_bg']); ?>" />
                  </div>
                  <div id="<?php _e($this->plugin_name); ?>-color_submit_b_-hover-box" class="settings-container__content--pickers__box">
                    <span class="settings-container__content--pickers__span"><?php esc_attr_e('Button hover:', $this->plugin_name); ?></span>
                    <input type="text"
                        class="<?php _e($this->plugin_name); ?>-color-picker color-field"
                        id="<?php _e($this->plugin_name); ?>-color_submit_b_-hover"
                        name="<?php _e($this->plugin_name); ?>[color_submit_bg_hover]"
                        value="<?php _e($options['color_submit_bg_hover']); ?>" />
                  </div>
                </div>
              </div>
          </div>

          <div id="messages-box" style="display: none;">
              <div>
                <label class="settings-container__content--label"><?php esc_attr_e('success message', $this->plugin_name); ?></label>
                <textarea
                    class="settings-container__content--textarea"
                    id="<?php _e($this->plugin_name); ?>-message_success"
                    name="<?php _e($this->plugin_name); ?>[message_success]"
                    autocomplete="off"><?php _e($options['message_success']); ?></textarea>

                <label class="settings-container__content--label"><?php esc_attr_e('error message:', $this->plugin_name); ?></label>
                <textarea
                    class="settings-container__content--textarea"
                    id="<?php _e($this->plugin_name); ?>-message_error"
                    name="<?php _e($this->plugin_name); ?>[message_error]"
                    autocomplete="off"><?php _e($options['message_error']); ?></textarea>

                <label class="settings-container__content--label"><?php esc_attr_e('email already exist’ message:', $this->plugin_name); ?></label>
                <textarea
                    class="settings-container__content--textarea"
                    id="<?php _e($this->plugin_name); ?>-message_exist"
                    name="<?php _e($this->plugin_name); ?>[message_exist]"
                    autocomplete="off"><?php _e($options['message_exist']); ?></textarea>
              </div>
          </div>

          <div id="privacy-policy-box" style="display: none;">
              <div>
                <label class="settings-container__content--label"><?php esc_attr_e('privacy policy', $this->plugin_name); ?></label>
                <textarea
                    class="settings-container__content--textarea"
                    id="<?php _e($this->plugin_name); ?>-privacy_policy"
                    name="<?php _e($this->plugin_name); ?>[privacy_policy]"
                    autocomplete="off"><?php _e($options['privacy_policy']); ?></textarea>

                <span class="info"><?php esc_attr_e('You can add a privacy policy link by using HTML attribute', $this->plugin_name); ?></span>
              </div>
          </div>
          <input type="hidden" value="<?php _e($options['box_name']); ?>"  id="box-name" name="<?php _e($this->plugin_name); ?>[box_name]">
          <div class="settings-container__footer">
            <div id="sticky-footer" class="save-box">
              <?php submit_button(__('Save', $this->plugin_name), 'btn-woodpecker', 'submit', TRUE); ?>
              <span class="save-box__close"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript" src="<?php _e(plugin_dir_url( __FILE__ )); ?>../js/woodpecker-connector-settings-min.js?ver=2.1"></script>
