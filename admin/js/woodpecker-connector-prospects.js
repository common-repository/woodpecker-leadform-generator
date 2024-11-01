jQuery(document).ready(function($){
  jQuery('#page').keyup(function (e) {
    if (e.which == 13) {
      var page = parseInt(jQuery("#page").val());
      var lastPage = parseInt(jQuery("#lastPage").val());
      var redirectUrl = jQuery('#redirectUrl').val();

      if (page <= lastPage && page > 0) {
        window.location.replace(redirectUrl + "" + page);
      } else {
        jQuery("#page").val(1)
        window.location.replace(redirectUrl + "1");
      }
    }
  });

  jQuery('.popupTooltip__content--item__text').live( 'mouseover',  function() {
    var $this = jQuery(this);

    if(this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
      $this.parent().prepend('<div class="tooltip">' + $this.text() + '</div>');
    }
  }).live( 'mouseout', function() {
    var $this = jQuery(this);

    $this.parent().find('.tooltip').remove();
  });
});
