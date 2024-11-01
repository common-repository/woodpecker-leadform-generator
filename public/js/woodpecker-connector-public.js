(function( $ ) {
	'use strict';
	$( document ).ready(function() {
		jQuery("input[name=woodpecker-connector-accept_policy]").on('click', function () {
			var form = getFormId(this);
			var thisInput = jQuery(this);
			var checkbox = jQuery(form).find("div.woodpecker-connector-checkbox");

			if(checkbox.hasClass("invalid")){
				checkbox.removeClass("invalid");
			}

			if (thisInput.is(":checked")){
				thisInput.val("1");
			} else {
				thisInput.val("0");
			}
		});

		jQuery("div.woodpecker-connector-email").on("keyup", function() {
			var form = getFormId(this);
			if(jQuery(form).find("div.woodpecker-connector-email").hasClass("invalid")){
				jQuery(this).removeClass("invalid");
				jQuery(form).find('.woodpecker-connector-response-container').slideUp();
			}
		});

		jQuery(".woodpecker-connector-trigger").on('click', function () {
			event.preventDefault();
			var parameters = [];
			var thisform = getFormId(this);

			jQuery(thisform).find('.woodpecker-connector-response-container').slideUp().html('')
			jQuery(thisform).find('input').each(function(){
				var par_name = jQuery(this).attr("name");
				var par_value = jQuery(this).val();
				var item = {}
				item['name'] = par_name;
				item['val'] = par_value;
				parameters.push(item);
				jQuery(this).removeClass('woodpecker-connector-input-danger');
			});
			var parametersString = parameters;

			var data = {
				action: 'add_prospect_to_campaing',
				parameters: parametersString
			};

			var ajaxurl = jQuery(this).data('ajaxurl');
			var responseContainer = jQuery(thisform).find('.woodpecker-connector-response-container');

			jQuery.post(ajaxurl, data, function (response) {
				if(response == 0){
					responseContainer.html('Sorry no response');
				}else{
					var data = jQuery.parseJSON(response);
					var shortcodeInputs = thisform.parents('div.woodpecker-connector-shortcode').find('input');

					if(data.action == 'ERROR'){
						if(data.code == 'POLICY'){
							jQuery(thisform).find("div.woodpecker-connector-checkbox").addClass("invalid");
							responseContainer.html('<div class="alert alert-danger woodpecker-connector-danger">' + data.message + '</div>').slideDown();
							shortcodeInputs.each(function(){
								jQuery(this).addClass('woodpecker-connector-input-danger');
							});
						} else {
							jQuery(thisform).find("div.woodpecker-connector-email").addClass("invalid");
							responseContainer.html('<div class="alert alert-danger woodpecker-connector-danger">' + data.message + '</div>').slideDown();
							shortcodeInputs.each(function(){
								jQuery(this).addClass('woodpecker-connector-input-danger');
							});
						}
					}else if(data.action == 'DUPLICATE'){
						responseContainer.html('<div class="alert alert-success woodpecker-connector-success">' + data.message + '</div>').slideDown();
						shortcodeInputs.each(function(){
							jQuery(this).val('')
						});
					}else{
						responseContainer.html('<div class="alert alert-success woodpecker-connector-success">' + data.message + '</div>').slideDown();
						shortcodeInputs.each(function(){
							jQuery(this).val('')
						});
					}
				}
			}).done(function () {
				})
				.fail(function () {
					jQuery(thisform).find('.woodpecker-connector-response-container').html('Error');
				})
				.always(function () {
				});
		});

		function clearInputs() {
			$("input[name=woodpecker-connector-accept_policy]").prop("checked", false);
		}

		function getFormId(element) {
			return $(element).closest("form");
		}
	});

})( jQuery );
