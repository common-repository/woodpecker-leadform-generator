jQuery(document).ready(function(e){jQuery("#page").keyup(function(e){if(13==e.which){var t=parseInt(jQuery("#page").val()),i=parseInt(jQuery("#lastPage").val()),o=jQuery("#redirectUrl").val();t<=i&&t>0?window.location.replace(o+""+t):(jQuery("#page").val(1),window.location.replace(o+"1"))}}),jQuery(".popupTooltip__content--item__text").live("mouseover",function(){var e=jQuery(this);this.offsetWidth<this.scrollWidth&&!e.attr("title")&&e.parent().prepend('<div class="tooltip">'+e.text()+"</div>")}).live("mouseout",function(){jQuery(this).parent().find(".tooltip").remove()})});