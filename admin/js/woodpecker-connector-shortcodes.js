jQuery(document).ready(function($){
  var searchArray = [];
  var statusArray = [];
  var sendFromArray = [];
  var allRows = jQuery(".shortcodes-content__table--row__content .shortcodes-content__table--row__content--row").toArray();
  var currentView = [];

  if (jQuery('#howElement').val() <= 10) {
    jQuery('.last').addClass('disabled');
    jQuery('.next').addClass('disabled');
  } else {
    jQuery('.last').removeClass('disabled');
    jQuery('.next').removeClass('disabled');
  }

  jQuery('.row-table__text').live( 'mouseover',  function() {
    var $this = jQuery(this);

    if(this.offsetWidth < this.scrollWidth && !$this.attr('title')){
      $this.append('<div class="tooltip">' + $this.text() + '</div>');
    }
  }).live( 'mouseout', function() {
    var $this = jQuery(this);

    $this.find('.tooltip').remove();
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

  jQuery('.row-table__code').live( 'mouseover',  function() {
    var $this = jQuery(this);
    var position = $this.parent().position();
    $this.parent().append('<div id="blackTooltipShortcode" class="tooltip">copy shortcode</div>');
  }).live( 'mouseout', function() {
    var $this = jQuery(this);

    $this.parent().find('.tooltip').remove();
  });

  jQuery('.code-copy').live( 'mouseover',  function() {
    var $this = jQuery(this);
    $this.append('<div id="blackTooltipShortcodeMain" class="tooltip">copy shortcode</div>');
  }).live( 'mouseout', function() {
    var $this = jQuery(this);

    $this.parent().find('.tooltip').remove();
  });

  jQuery('.popupTooltip__content--item').on('click', function(e) {
    filterBy(jQuery(this).attr('rel'), jQuery(this).find('.popupTooltip__content--item__text').text());
  });

  jQuery('.empty-filter-panel__btn').on('click', function(e) {
    clearFilters();
  });

  jQuery('.pagination-section__rows--block__value').on('click', function(e) {
    var perPage = jQuery(this).text();
    var page = 1;
    var howElement = jQuery("#howElement").val();
    var lastPage = Math.ceil(howElement / perPage);

    goToPage(page, perPage, howElement, lastPage);

    jQuery("#page").val(1)
    jQuery("#perPage").val(perPage);
    jQuery('.pagination-section__rows').text(perPage);
    jQuery('.pagination-section__rows--block').hide();
  });

  jQuery('#page').keyup(function (e) {
    var page = jQuery("#page").val();
    var perPage = jQuery("#perPage").val();
    var howElement = jQuery("#howElement").val();
    var lastPage = Math.ceil(howElement / perPage);

    if (e.which == 13) {
      if ( page <= lastPage && page > 0) {
        goToPage(page, perPage, howElement, lastPage);
      } else {
        jQuery("#page").val(1)
        goToPage(1, perPage, howElement, lastPage);
      }
    }
  });

  jQuery('.prev').on("click", function() {
    var page = jQuery("#page").val();
    var perPage = jQuery("#perPage").val();
    var howElement = jQuery("#howElement").val();
    var lastPage = Math.ceil(howElement / perPage);

    if (page > 1) {
      page--;
      jQuery("#page").val(page);
      goToPage(page, perPage, howElement, lastPage);
    }
  });

  jQuery('.next').on("click", function() {
    var page = jQuery("#page").val();
    var perPage = jQuery("#perPage").val();
    var howElement = jQuery("#howElement").val();
    var lastPage = Math.ceil(howElement / perPage);

    if (page < lastPage) {
      page++;
      jQuery("#page").val(page);
      goToPage(page, perPage, howElement, lastPage);
    }
  });

  jQuery('.first').on("click", function() {
    var perPage = jQuery("#perPage").val();
    var howElement = jQuery("#howElement").val();
    var lastPage = Math.ceil(howElement / perPage);
    jQuery("#page").val(1);

    goToPage(1, perPage, howElement, lastPage);
  });

  jQuery('.last').on("click", function() {
    var perPage = jQuery("#perPage").val();
    var howElement = jQuery("#howElement").val();
    var lastPage = Math.ceil(howElement / perPage);
    jQuery("#page").val(lastPage);

    goToPage(lastPage, perPage, howElement, lastPage);
  });

  jQuery('.row-table__code').on("click", function() {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    jQuery(this).parent().parent().find(".copied-text").delay(300).fadeIn();
    jQuery(this).parent().parent().find(".copied-text").delay(3000).fadeOut();
    $temp.val(jQuery(this).find('.code-input').val()).select();
    document.execCommand("copy");
    $temp.remove();
  });

  jQuery('.code-copy ').on("click", function() {
    var $temp = jQuery("<input>");
    jQuery("body").append($temp);
    jQuery(".code").find(".copied-text").delay(300).fadeIn();
    jQuery(".code").find(".copied-text").delay(3000).fadeOut();
    $temp.val(jQuery(this).find('#main-shortcode-input').val()).select();
    document.execCommand("copy");
    $temp.remove();
  });

  jQuery("#searchBox").on("keyup", function(e) {
    if (e.which == 13) {
      var value = jQuery(this).val().toLowerCase();

      if(value.trim() != ""){
        jQuery("#page").val(1);
        jQuery("#searchBox").val("");
        jQuery(".shortcodes-content__table--row__content--row").hide();
        filterBy('search', value);
      }
    }
  });


  function clearFilters(){
    allRows.length = 0;
    searchArray.length = 0;
    statusArray.length = 0;
    sendFromArray.length = 0;

    allRows = jQuery(".shortcodes-content__table--row__content .shortcodes-content__table--row__content--row").toArray();

    var perPage = jQuery("#perPage").val();
    var howElement = allRows.length;
    var lastPage = Math.ceil(howElement / perPage);

    jQuery(".tags-panel").html('');
    jQuery("#page").val(1);
    jQuery("#howElement").val(howElement);

    toggleEmptyPanel(false);

    goToPage(1, perPage, allRows.length, lastPage);
  }

  function hideAllTooltip(){
    jQuery('#popupTooltipCampaignStatus').hide();
    jQuery('#popupTooltipSendFrom').hide();
  }

  function filterBy(text, value){
    hideAllTooltip();
    value = value.toLowerCase();
    exist = 0;

    jQuery("#page").val(1);
    jQuery("#searchBox").val("");
    jQuery(".shortcodes-content__table--row__content--row").hide();

    if (text == "status") {
      if (jQuery.inArray(value, statusArray) == -1) {
        statusArray.push(value);
        name = 'status';
      } else {
        exist = 1;
      }
    } else if(text == "send_from") {
      if (jQuery.inArray(value, sendFromArray) == -1) {
        sendFromArray.push(value);
        name = 'send from';
      } else {
        exist = 1;
      }
    } else if (text == "search") {
      if (jQuery.inArray(value, searchArray) == -1) {
        searchArray.push(value);
        name = 'search';
      } else {
        exist = 1;
      }
    }

    if(exist === 0) {
      $('.tags-panel').append(function() {
        var tag = $('<div class="tags-panel__tag"><span class="tags-panel__tag--close close"></span><span class="tags-panel__tag--status">' + name + ' : </span><span class="tags-panel__tag--text">' + value + '</span></div>');
        $(this).append(tag);
        $(this).find(tag).find('.tags-panel__tag--close').on("click", function() {
          removeTag(jQuery(this).parent(), value, text);
        });
      })
    }

    currentView = [];
    currentView = runFilter();
    jQuery("#howElement").val(currentView.length);

    var perPage = jQuery("#perPage").val();
    var lastPage = Math.ceil(currentView.length / perPage);
    goToPage(1, perPage, currentView.length, lastPage);

  }

  function runFilter(){
    var tempArray = [];

    if(searchArray.length > 0) {
      jQuery.each(searchArray, function( key1, value1 ) {
        if (statusArray.length > 0) {
          jQuery.each(statusArray, function( key2, value2 ) {
            if (sendFromArray.length > 0) {
              jQuery.each(sendFromArray, function( key3, value3 ) {
                jQuery.merge(tempArray, getFilterTable(allRows, value1, value2, value3));
              });
            } else {
              jQuery.merge(tempArray, getFilterTable(allRows, value1, value2, ''));
            }
          });
        } else {
            if (sendFromArray.length > 0) {
              jQuery.each(sendFromArray, function( key3, value3 ) {
                jQuery.merge(tempArray, getFilterTable(allRows, value1, '', value3));
              });
            } else {
                jQuery.merge(tempArray, getFilterTable(allRows, value1, '', ''));
            }
          }
        });
      } else {
        if (statusArray.length > 0) {
          jQuery.each(statusArray, function( key2, value2 ) {
            if (sendFromArray.length > 0) {
              jQuery.each(sendFromArray, function( key3, value3 ) {
                jQuery.merge(tempArray, getFilterTable(allRows, '', value2, value3));
              });
            } else {
              jQuery.merge(tempArray, getFilterTable(allRows, '', value2, ''));
            }
          });
        } else {
          if (sendFromArray.length > 0) {
            jQuery.each(sendFromArray, function( key3, value3 ) {
              jQuery.merge(tempArray, getFilterTable(allRows, '', '', value3));
            });
          } else {
            jQuery.merge(tempArray, getFilterTable(allRows, '', '', ''));
          }
        }
      }

      tempArray = tempArray.filter(function(elem, index, self) {
        return index === self.indexOf(elem);
      });

      return tempArray;
    }

    function getFilterTable(tableToReduce, searchValue, statusValue, sendValue){
      var filterTable = [];
      jQuery.each(tableToReduce, function( key, value ) {
        if(searchValue != '' && statusValue != '' && sendValue != ''){
          if (jQuery(value).text().toLowerCase().indexOf(searchValue) > -1 && jQuery(value).find('.status').text().toLowerCase().indexOf(statusValue) > -1 && jQuery(value).find('.send_from').text().toLowerCase().indexOf(sendValue) > -1) {
            filterTable.push(value);
          }
        } else if(searchValue != '' && statusValue != ''){
          if (jQuery(value).text().toLowerCase().indexOf(searchValue) > -1 && jQuery(value).find('.status').text().toLowerCase().indexOf(statusValue) > -1) {
            filterTable.push(value);
          }
        } else if(searchValue != '' && sendValue != '') {
          if (jQuery(value).text().toLowerCase().indexOf(searchValue) > -1 && jQuery(value).find('.send_from').text().toLowerCase().indexOf(sendValue) > -1) {
            filterTable.push(value);
          }
        } else if(statusValue != '' && sendValue != ''){
          if (jQuery(value).find('.status').text().toLowerCase().indexOf(statusValue) > -1 && jQuery(value).find('.send_from').text().toLowerCase().indexOf(sendValue) > -1) {
            filterTable.push(value);
          }
        } else if(statusValue != '' && sendValue == '' && searchValue == ''){
          if (jQuery(value).find('.status').text().toLowerCase().indexOf(statusValue) > -1) {
            filterTable.push(value);
          }
        } else if(sendValue != '' && statusValue == '' && searchValue == ''){
          if (jQuery(value).find('.send_from').text().toLowerCase().indexOf(sendValue) > -1) {
            filterTable.push(value);
          }
        } else if(searchValue != '' && statusValue == '' && sendValue == ''){
          if (jQuery(value).text().toLowerCase().indexOf(searchValue) > -1) {
            filterTable.push(value);
          }
        } else if (searchValue == '' && statusValue == '' && sendValue == '') {
            filterTable.push(value);
        }
      });

      return filterTable;
    }

    function goToPage(page, perPage, howElement, lastPage) {
      if (searchArray.length == 0 && sendFromArray.length == 0 && statusArray.length == 0) {
        var show = (page * perPage) - perPage + 1;
        var toShow = (page * perPage);
        var lt = page * perPage;
        var gt = (lt - perPage) - 1;

        if (toShow > lastPage && page == lastPage) {
          toShow = howElement;
          jQuery('.last').addClass('disabled');
          jQuery('.next').addClass('disabled');
        } else {
          jQuery('.last').removeClass('disabled');
          jQuery('.next').removeClass('disabled');
        }

        if(howElement <= 0) {
          toggleEmptyPanel(true);
        } else {
          toggleEmptyPanel(false);
        }

        jQuery('.pagination-section__max-pages').text('out of ' + lastPage);
        jQuery(".shortcodes-content__table--row__content--row").hide();

        if (page == 1) {
          jQuery(".shortcodes-content__table--row__content--row:lt(" + lt + ")").show();
          jQuery('.first').addClass('disabled');
          jQuery('.prev').addClass('disabled');
        } else {
          jQuery(".shortcodes-content__table--row__content--row:lt(" + lt + "):gt(" + gt + ")").show();
          jQuery('.first').removeClass('disabled');
          jQuery('.prev').removeClass('disabled');
        }

        jQuery(".pagination-section__direct--current-pages").text(show + "-" + toShow + " of " + howElement);

      } else {

        jQuery(".shortcodes-content__table--row__content--row").hide();
        var show = (page * perPage) - perPage + 1;
        var toShow = (page * perPage);

        var lt = page * perPage;
        var gt = (lt - perPage);

        if (toShow > lastPage && page == lastPage) {
          toShow = howElement;
          jQuery('.last').addClass('disabled');
          jQuery('.next').addClass('disabled');
        } else {
          jQuery('.last').removeClass('disabled');
          jQuery('.next').removeClass('disabled');
        }

        jQuery('.pagination-section__max-pages').text('out of ' + lastPage);

        if(currentView == "") {
          toggleEmptyPanel(true);
        } else {
          toggleEmptyPanel(false);

          if (page == 1) {
            for(var i = 0; i < lt; i++) {
              jQuery(currentView[i]).show();
            }

            jQuery('.first').addClass('disabled');
            jQuery('.prev').addClass('disabled');
          } else {
            for(var i = gt; i < lt; i++) {
              jQuery(currentView[i]).show();
          }

          jQuery('.first').removeClass('disabled');
          jQuery('.prev').removeClass('disabled');
        }

        jQuery(".pagination-section__direct--current-pages").text(show + "-" + toShow + " of " + howElement);
      }
    }
  }

  function toggleEmptyPanel(status){
    if(status == true) {
      jQuery('.empty-filter-panel').addClass('show');
      jQuery('.pagination-section').hide();
      jQuery('.shortcodes-content__table').hide();
    } else {
      jQuery('.empty-filter-panel').removeClass('show');
      jQuery('.pagination-section').show();
      jQuery('.shortcodes-content__table').show();
    }
  }

  function removeTag(parentToRemove, removeItem, type) {
    var perPage = jQuery("#perPage").val();
    jQuery(parentToRemove).remove();

    if(type == 'search') {
      searchArray = jQuery.grep(searchArray, function(value) {
        return value != removeItem;
      });
    } else if (type == 'status') {
      statusArray = jQuery.grep(statusArray, function(value) {
        return value != removeItem;
      });
    } else if (type == 'send_from') {
      sendFromArray = jQuery.grep(sendFromArray, function(value) {
        return value != removeItem;
      });
    }

    jQuery(".shortcodes-content__table--row__content--row").hide();
    jQuery("#page").val(1);

    currentView = [];
    currentView = runFilter();
    if (currentView == null) {
      howElement = 0;
    } else {
      howElement = currentView.length;
    }

    jQuery("#howElement").val(howElement);
    var lastPage = Math.ceil(howElement / perPage);

    goToPage(1, perPage, howElement, lastPage);
  }
});
