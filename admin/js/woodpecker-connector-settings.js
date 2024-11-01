jQuery(document).ready(function($){
  var apiKey = $("#woodpecker-connector-api_key").val();

  var emailForm = $("#woodpecker-connector-gform_email").val();
  var firstNameForm = $("#woodpecker-connector-gform_first").val();
  var lastNameForm = $("#woodpecker-connector-gform_last").val();
  var companyForm = $("#woodpecker-connector-gform_company").val();
  var submitForm = $("#woodpecker-connector-gform_submit").val();
  var showFirstName = $("#woodpecker-connector-gform_first_hide").is(':checked');
  var showLastName = $("#woodpecker-connector-gform_last_hide").is(':checked');
  var showCompanyName = $("#woodpecker-connector-gform_company_hide").is(':checked');

  var colorSubmit = $("#woodpecker-connector-color_submit").val();
  var bgColorSubmit = $("#woodpecker-connector-color_submit_bg").val();
  var colorSubmitHover = $("#woodpecker-connector-color_submit_b_-hover").val();
  var defaultStyle = $("#woodpecker-connector-gform_default_style").is(':checked');

  var messageSuccess = $("#woodpecker-connector-message_success").val();
  var messageError = $("#woodpecker-connector-message_error").val();
  var messageAlreadyExist = $("#woodpecker-connector-message_exist").val();
  var privacyPolicy = $("#woodpecker-connector-privacy_policy").val();

  firstNameHide();
  lastNameHide();
  companyHide();
  setPanel();
 let searchParams = new URLSearchParams(window.location.search);

  if(searchParams.get('subtab') == 'form-settings-box') {
    showFormSettings();
  } else if(searchParams.get('subtab') == 'messages-box') {
    showMessages();
  } else if(searchParams.get('subtab') == 'privacy-policy-box') {
    showPrivacyPolicy();
  } else {
    showSynchronization();
  }

  $('#woodpecker-connector-gform_first_hide:checkbox').change(function() {
    firstNameHide();
  });

  $('#woodpecker-connector-gform_last_hide:checkbox').change(function() {
    lastNameHide();
  });

  $('#woodpecker-connector-gform_company_hide:checkbox').change(function() {
    companyHide();
  });

  function firstNameHide() {
    if(!$('#woodpecker-connector-gform_first_hide').is(':checked')) {
      $('#woodpecker-connector-gform_first_hide').parent().parent().addClass('disable');
      $('#woodpecker-connector-gform_first').prop( "disabled", true);
    } else {
      $('#woodpecker-connector-gform_first_hide').parent().parent().removeClass('disable');
      $('#woodpecker-connector-gform_first').prop( "disabled", false);
    }
  }

  function lastNameHide() {
    if(!$('#woodpecker-connector-gform_last_hide').is(':checked')) {
      $('#woodpecker-connector-gform_last_hide').parent().parent().addClass('disable');
      $('#woodpecker-connector-gform_last').prop( "disabled", true);
    } else {
      $('#woodpecker-connector-gform_last_hide').parent().parent().removeClass('disable');
      $('#woodpecker-connector-gform_last').prop( "disabled", false);
    }
  }

  function companyHide() {
    if(!$('#woodpecker-connector-gform_company_hide').is(':checked')) {
      $('#woodpecker-connector-gform_company_hide').parent().parent().addClass('disable');
      $('#woodpecker-connector-gform_company').prop( "disabled", true);
    } else {
      $('#woodpecker-connector-gform_company_hide').parent().parent().removeClass('disable');
      $('#woodpecker-connector-gform_company').prop( "disabled", false);
    }
  }

  $("#woodpecker-connector-gform_default_style").on('click', function() {
    setPanel();
  });

  function showSynchronization() {
    hideAll();
    $('#synchronization').addClass('active');
    $('#synchronization-box').show();
  }

  function showFormSettings() {
    hideAll();
    $('#form-settings').addClass('active');
    $('#form-settings-box').show();
  }

  function showMessages() {
    hideAll();
    $('#messages').addClass('active');
    $('#messages-box').show();
  }

  function showPrivacyPolicy() {
    hideAll();
    $('#privacy-policy').addClass('active');
    $('#privacy-policy-box').show();
  }

  $('#synchronization').on('click', function() {
    var newurl = '?page=woodpecker-connector&tab=settings&subtab=synchronization-box';
    window.location.search = newurl;
  });

  $('#form-settings').on('click', function() {
    var newurl =  '?page=woodpecker-connector&tab=settings&subtab=form-settings-box';
    window.location.search = newurl;
  });

  $('#messages').on('click', function() {
    var newurl = '?page=woodpecker-connector&tab=settings&subtab=messages-box';
    window.location.search = newurl;
  });

  $('#privacy-policy').on('click', function() {
    var newurl = '?page=woodpecker-connector&tab=settings&subtab=privacy-policy-box';
    window.location.search = newurl;
  });

  $('.save-box__close').on('click', function() {
    resetAll();
  });

  function setPanel() {
    if($("#woodpecker-connector-gform_default_style").is(':checked')) {
      $('#picker-panel').slideDown();
    } else {
      $('#picker-panel').slideUp();
    }
  }

  function hideAll() {
    $('#synchronization-box').hide();
    $('#synchronization').removeClass('active');
    $('#form-settings-box').hide();
    $('#form-settings').removeClass('active');
    $('#messages-box').hide();
    $('#messages').removeClass('active');
    $('#privacy-policy-box').hide();
    $('#privacy-policy').removeClass('active');

    resetAll();
  }

  function resetAll() {
    $("#woodpecker-connector-api_key").val(apiKey);

    $("#woodpecker-connector-gform_email").val(emailForm);
    $("#woodpecker-connector-gform_first").val(firstNameForm);
    $("#woodpecker-connector-gform_last").val(lastNameForm);
    $("#woodpecker-connector-gform_company").val(companyForm);
    $("#woodpecker-connector-gform_submit").val(submitForm);
    $("#woodpecker-connector-gform_first_hide").prop('checked', showFirstName);
    $("#woodpecker-connector-gform_last_hide").prop('checked', showLastName);
    $("#woodpecker-connector-gform_company_hide").prop('checked', showCompanyName);

    $("#woodpecker-connector-color_submit").wpColorPicker().val(colorSubmit);
    $("#woodpecker-connector-color_submit_bg").wpColorPicker().val(bgColorSubmit);
    $("#woodpecker-connector-color_submit_b_-hover").wpColorPicker().val(colorSubmitHover);
    $("#woodpecker-connector-gform_default_style").prop('checked', defaultStyle);

    if($("#woodpecker-connector-gform_default_style").is(':checked')) {
      $('#picker-panel').slideDown();
    } else {
      $('#picker-panel').slideUp();
    }

    $("#woodpecker-connector-message_success").val(messageSuccess);
    $("#woodpecker-connector-message_error").val(messageError);
    $("#woodpecker-connector-message_exist").val(messageAlreadyExist);

    $("#woodpecker-connector-privacy_policy").val(privacyPolicy);

    $("#woodpecker-connector-color_submit-box").find("button").css("background-color", colorSubmit);
    $("#woodpecker-connector-color_submit_bg-box").find("button").css("background-color", bgColorSubmit);
    $("#woodpecker-connector-color_submit_b_-hover-box").find("button").css("background-color", colorSubmitHover);

    $('.save-box').removeClass('active');
  }

  $("#woodpecker-connector-api_key").on("keyup", function(e) {
    checkClass($("#woodpecker-connector-api_key").val(), apiKey);
  });

  $("#woodpecker-connector-gform_email").on("keyup", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_first").on("keyup", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_last").on("keyup", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_company").on("keyup", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_submit").on("keyup", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-color_submit").wpColorPicker({
      change: function(event, ui) {
        showSaveBoxFormSettings();
      }
  });

  $("#woodpecker-connector-color_submit_bg").wpColorPicker({
      change: function(event, ui) {
        showSaveBoxFormSettings();
      }
  });

  $("#woodpecker-connector-color_submit_b_-hover").wpColorPicker({
      change: function(event, ui) {
        showSaveBoxFormSettings();
      }
  });

  $("#woodpecker-connector-gform_first_hide").on("click", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_last_hide").on("click", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_company_hide").on("click", function(e) {
    showSaveBoxFormSettings();
  });

  $("#woodpecker-connector-gform_default_style").on("click", function(e) {
    showSaveBoxFormSettings();
  });

  function showSaveBoxFormSettings(){
    if(emailForm == $("#woodpecker-connector-gform_email").val() && firstNameForm == $("#woodpecker-connector-gform_first").val() && lastNameForm == $("#woodpecker-connector-gform_last").val()
    && companyForm == $("#woodpecker-connector-gform_company").val() && submitForm == $("#woodpecker-connector-gform_submit").val() && colorSubmit == $("#woodpecker-connector-color_submit").wpColorPicker().val() && bgColorSubmit == $("#woodpecker-connector-color_submit_bg").wpColorPicker().val()
    && colorSubmitHover == $("#woodpecker-connector-color_submit_b_-hover").wpColorPicker().val() && showFirstName == $("#woodpecker-connector-gform_first_hide").is(':checked') && showLastName == $("#woodpecker-connector-gform_last_hide").is(':checked')
    && showCompanyName == $("#woodpecker-connector-gform_company_hide").is(':checked')  && defaultStyle == $("#woodpecker-connector-gform_default_style").is(':checked')) {
      $('.save-box').removeClass('active');
    } else {
      $('.save-box').addClass('active');
    }
  }

  $("#woodpecker-connector-message_success").on("keyup", function(e) {
    showSaveBoxMessages();
  });

  $("#woodpecker-connector-message_error").on("keyup", function(e) {
    showSaveBoxMessages();
  });

  $("#woodpecker-connector-message_exist").on("keyup", function(e) {
    showSaveBoxMessages();
  });

  function showSaveBoxMessages(){
    if(messageSuccess == $("#woodpecker-connector-message_success").val() && messageError == $("#woodpecker-connector-message_error").val() && messageAlreadyExist == $("#woodpecker-connector-message_exist").val()) {
      $('.save-box').removeClass('active');
    } else {
      $('.save-box').addClass('active');
    }
  }

  $("#woodpecker-connector-privacy_policy").on("keyup", function(e) {
    if(privacyPolicy == $("#woodpecker-connector-privacy_policy").val()) {
      $('.save-box').removeClass('active');
    } else {
      $('.save-box').addClass('active');
    }
  });


  function checkClass(inputValue, inputOldValue) {
    if(inputValue == inputOldValue) {
      $('.save-box').removeClass('active');
    } else {
      $('.save-box').addClass('active');
    }
  }

  var ipos = $('#sticky-footer').offset().top;
  var wpos, space;

  function h(e) {
    wpos = $(window).scrollTop();
    space = $(window).height() - 116;

    if (wpos + space < ipos ) {
        $('#sticky-footer').addClass('fixed');
    } else {
        $('#sticky-footer').removeClass('fixed');
    }
  }

  $(window).ready(h).resize(h).scroll(h);
});
