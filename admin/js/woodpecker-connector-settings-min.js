jQuery(document).ready(function(o){var e=o("#woodpecker-connector-api_key").val(),c=o("#woodpecker-connector-gform_email").val(),r=o("#woodpecker-connector-gform_first").val(),n=o("#woodpecker-connector-gform_last").val(),t=o("#woodpecker-connector-gform_company").val(),s=o("#woodpecker-connector-gform_submit").val(),a=o("#woodpecker-connector-gform_first_hide").is(":checked"),i=o("#woodpecker-connector-gform_last_hide").is(":checked"),d=o("#woodpecker-connector-gform_company_hide").is(":checked"),p=o("#woodpecker-connector-color_submit").val(),l=o("#woodpecker-connector-color_submit_bg").val(),k=o("#woodpecker-connector-color_submit_b_-hover").val(),_=o("#woodpecker-connector-gform_default_style").is(":checked"),m=o("#woodpecker-connector-message_success").val(),f=o("#woodpecker-connector-message_error").val(),w=o("#woodpecker-connector-message_exist").val(),g=o("#woodpecker-connector-privacy_policy").val();b(),u(),h(),y();let v=new URLSearchParams(window.location.search);function b(){o("#woodpecker-connector-gform_first_hide").is(":checked")?(o("#woodpecker-connector-gform_first_hide").parent().parent().removeClass("disable"),o("#woodpecker-connector-gform_first").prop("disabled",!1)):(o("#woodpecker-connector-gform_first_hide").parent().parent().addClass("disable"),o("#woodpecker-connector-gform_first").prop("disabled",!0))}function u(){o("#woodpecker-connector-gform_last_hide").is(":checked")?(o("#woodpecker-connector-gform_last_hide").parent().parent().removeClass("disable"),o("#woodpecker-connector-gform_last").prop("disabled",!1)):(o("#woodpecker-connector-gform_last_hide").parent().parent().addClass("disable"),o("#woodpecker-connector-gform_last").prop("disabled",!0))}function h(){o("#woodpecker-connector-gform_company_hide").is(":checked")?(o("#woodpecker-connector-gform_company_hide").parent().parent().removeClass("disable"),o("#woodpecker-connector-gform_company").prop("disabled",!1)):(o("#woodpecker-connector-gform_company_hide").parent().parent().addClass("disable"),o("#woodpecker-connector-gform_company").prop("disabled",!0))}function y(){o("#woodpecker-connector-gform_default_style").is(":checked")?o("#picker-panel").slideDown():o("#picker-panel").slideUp()}function x(){o("#synchronization-box").hide(),o("#synchronization").removeClass("active"),o("#form-settings-box").hide(),o("#form-settings").removeClass("active"),o("#messages-box").hide(),o("#messages").removeClass("active"),o("#privacy-policy-box").hide(),o("#privacy-policy").removeClass("active"),C()}function C(){o("#woodpecker-connector-api_key").val(e),o("#woodpecker-connector-gform_email").val(c),o("#woodpecker-connector-gform_first").val(r),o("#woodpecker-connector-gform_last").val(n),o("#woodpecker-connector-gform_company").val(t),o("#woodpecker-connector-gform_submit").val(s),o("#woodpecker-connector-gform_first_hide").prop("checked",a),o("#woodpecker-connector-gform_last_hide").prop("checked",i),o("#woodpecker-connector-gform_company_hide").prop("checked",d),o("#woodpecker-connector-color_submit").wpColorPicker().val(p),o("#woodpecker-connector-color_submit_bg").wpColorPicker().val(l),o("#woodpecker-connector-color_submit_b_-hover").wpColorPicker().val(k),o("#woodpecker-connector-gform_default_style").prop("checked",_),o("#woodpecker-connector-gform_default_style").is(":checked")?o("#picker-panel").slideDown():o("#picker-panel").slideUp(),o("#woodpecker-connector-message_success").val(m),o("#woodpecker-connector-message_error").val(f),o("#woodpecker-connector-message_exist").val(w),o("#woodpecker-connector-privacy_policy").val(g),o("#woodpecker-connector-color_submit-box").find("button").css("background-color",p),o("#woodpecker-connector-color_submit_bg-box").find("button").css("background-color",l),o("#woodpecker-connector-color_submit_b_-hover-box").find("button").css("background-color",k),o(".save-box").removeClass("active")}function P(){c==o("#woodpecker-connector-gform_email").val()&&r==o("#woodpecker-connector-gform_first").val()&&n==o("#woodpecker-connector-gform_last").val()&&t==o("#woodpecker-connector-gform_company").val()&&s==o("#woodpecker-connector-gform_submit").val()&&p==o("#woodpecker-connector-color_submit").wpColorPicker().val()&&l==o("#woodpecker-connector-color_submit_bg").wpColorPicker().val()&&k==o("#woodpecker-connector-color_submit_b_-hover").wpColorPicker().val()&&a==o("#woodpecker-connector-gform_first_hide").is(":checked")&&i==o("#woodpecker-connector-gform_last_hide").is(":checked")&&d==o("#woodpecker-connector-gform_company_hide").is(":checked")&&_==o("#woodpecker-connector-gform_default_style").is(":checked")?o(".save-box").removeClass("active"):o(".save-box").addClass("active")}function z(){m==o("#woodpecker-connector-message_success").val()&&f==o("#woodpecker-connector-message_error").val()&&w==o("#woodpecker-connector-message_exist").val()?o(".save-box").removeClass("active"):o(".save-box").addClass("active")}"form-settings-box"==v.get("subtab")?(x(),o("#form-settings").addClass("active"),o("#form-settings-box").show()):"messages-box"==v.get("subtab")?(x(),o("#messages").addClass("active"),o("#messages-box").show()):"privacy-policy-box"==v.get("subtab")?(x(),o("#privacy-policy").addClass("active"),o("#privacy-policy-box").show()):(x(),o("#synchronization").addClass("active"),o("#synchronization-box").show()),o("#woodpecker-connector-gform_first_hide:checkbox").change(function(){b()}),o("#woodpecker-connector-gform_last_hide:checkbox").change(function(){u()}),o("#woodpecker-connector-gform_company_hide:checkbox").change(function(){h()}),o("#woodpecker-connector-gform_default_style").on("click",function(){y()}),o("#synchronization").on("click",function(){window.location.search="?page=woodpecker-connector&tab=settings&subtab=synchronization-box"}),o("#form-settings").on("click",function(){window.location.search="?page=woodpecker-connector&tab=settings&subtab=form-settings-box"}),o("#messages").on("click",function(){window.location.search="?page=woodpecker-connector&tab=settings&subtab=messages-box"}),o("#privacy-policy").on("click",function(){window.location.search="?page=woodpecker-connector&tab=settings&subtab=privacy-policy-box"}),o(".save-box__close").on("click",function(){C()}),o("#woodpecker-connector-api_key").on("keyup",function(c){o("#woodpecker-connector-api_key").val()==e?o(".save-box").removeClass("active"):o(".save-box").addClass("active")}),o("#woodpecker-connector-gform_email").on("keyup",function(o){P()}),o("#woodpecker-connector-gform_first").on("keyup",function(o){P()}),o("#woodpecker-connector-gform_last").on("keyup",function(o){P()}),o("#woodpecker-connector-gform_company").on("keyup",function(o){P()}),o("#woodpecker-connector-gform_submit").on("keyup",function(o){P()}),o("#woodpecker-connector-color_submit").wpColorPicker({change:function(o,e){P()}}),o("#woodpecker-connector-color_submit_bg").wpColorPicker({change:function(o,e){P()}}),o("#woodpecker-connector-color_submit_b_-hover").wpColorPicker({change:function(o,e){P()}}),o("#woodpecker-connector-gform_first_hide").on("click",function(o){P()}),o("#woodpecker-connector-gform_last_hide").on("click",function(o){P()}),o("#woodpecker-connector-gform_company_hide").on("click",function(o){P()}),o("#woodpecker-connector-gform_default_style").on("click",function(o){P()}),o("#woodpecker-connector-message_success").on("keyup",function(o){z()}),o("#woodpecker-connector-message_error").on("keyup",function(o){z()}),o("#woodpecker-connector-message_exist").on("keyup",function(o){z()}),o("#woodpecker-connector-privacy_policy").on("keyup",function(e){g==o("#woodpecker-connector-privacy_policy").val()?o(".save-box").removeClass("active"):o(".save-box").addClass("active")});var U,D,j=o("#sticky-footer").offset().top;function L(e){U=o(window).scrollTop(),D=o(window).height()-116,U+D<j?o("#sticky-footer").addClass("fixed"):o("#sticky-footer").removeClass("fixed")}o(window).ready(L).resize(L).scroll(L)});