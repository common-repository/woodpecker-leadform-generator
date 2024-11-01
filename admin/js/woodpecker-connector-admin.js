(function ($) {
    'use strict';

    jQuery(function() {
        jQuery('.color-field').wpColorPicker();
    });

    jQuery( document ).ready(function(){
        jQuery('#woodpecker-options .woodpecker-help-trigger').on('click', function(){
                jQuery(this).toggleClass('opened');
                jQuery('#woodpecker-options .woodpecker-help').slideToggle();
        });
    });
})(jQuery);

function showHideApi(){
    var x = jQuery('.api_key_input').prop('type');

    if (x === "password") {
        jQuery('.api_key_input').prop('type', 'text');
    } else {
        jQuery('.api_key_input').prop('type', 'password');
    }
}

function openPopupTooltip(element, object) {
  hideAllPopup();

  var position = jQuery(object).position();

  jQuery(document).mouseup(function (e){
    if (element == 'status'){
      value = jQuery('#popupTooltipStatus');
    } else if(element == 'campaign_status') {
      value = jQuery('#popupTooltipCampaignStatus');
    } else if(element == 'send_from') {
      value = jQuery('#popupTooltipSendFrom');
    } else {
      value = jQuery('#popupTooltipCampaign' + element);
    }

    if (!jQuery(value).is(e.target) && jQuery(value).has(e.target).length === 0) {
      jQuery(value).hide();
    }
  });

  if (element == 'status'){
    jQuery("#popupTooltipStatus").find('.popupTooltip__arrow').css({
      left: jQuery(".linkLabel:lt(1)").width() / 2
    });
    jQuery("#popupTooltipStatus").css({
        top: position.top + 37 + "px",
        left: position.left  + "px"
    });
    jQuery('#popupTooltipStatus').toggle();
  } else if(element == 'campaign_status') {
    jQuery("#popupTooltipCampaignStatus").find('.popupTooltip__arrow').css({
      left: jQuery(".linkLabel:lt(1)").width() / 2
    });
    jQuery("#popupTooltipCampaignStatus").css({
        top: position.top + 37 + "px",
        left: position.left + "px"
    });
    jQuery('#popupTooltipCampaignStatus').toggle();
  } else if(element == 'send_from') {
    jQuery("#popupTooltipSendFrom").find('.popupTooltip__arrow').css({
      left: jQuery(".linkLabel:lt(2)").width() / 2
    });
    jQuery("#popupTooltipSendFrom").css({
        top: position.top + 37 + "px",
        left: position.left + "px"
    });
    jQuery('#popupTooltipSendFrom').toggle();
  } else {
    var halfWidth =  jQuery(object).width() / 2 + 25;
    var leftPosition = position.left - 50;

    jQuery("#popupTooltipCampaign" + element).find('.popupTooltip__arrow').css({
      left: halfWidth
    });
    jQuery("#popupTooltipCampaign" + element).css({
        top: position.top + 37 + "px",
        left: leftPosition + "px"
    });
    jQuery("#popupTooltipCampaign" + element).toggle();
  }
}

function openDropdown(object) {
  hideAllPopup();

  jQuery(document).mouseup(function (e){
    if (!jQuery('.pagination-section__rows--block').is(e.target) && jQuery('.pagination-section__rows--block').has(e.target).length === 0) {
      jQuery('.pagination-section__rows--block').hide();
    }
  });
  jQuery('.pagination-section__rows--block').toggle();
}


function hideAllPopup() {
  jQuery('#popupTooltipStatus').hide();
  jQuery('#popupTooltipCompany').hide();
  jQuery('#popupTooltipImported').hide();
  jQuery('.pagination-section__rows--block').hide();
}
