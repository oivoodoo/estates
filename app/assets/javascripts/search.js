$(function () {
  var form = $('form'),
    search = $('#query');
  
  form.submit(function(e) {
    search.addClass('searching');
    
    setTimeout(function() {
        search.removeClass('searching');
    }, 3600);
  });
  
  /* what's with input padding? :/ */
  if ($.browser.mozilla) {
    search.css('padding', '3px');
  }
});