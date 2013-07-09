$(function () {
  var form = $('#search_form'),
    search = $('#query');

  form.submit(function(event) {
    event.preventDefault();

    $.get('/projects_search', { query: search.val() }, function(data) {
      $('#main').html(data);
    });

    search.addClass('searching').val('');

    setTimeout(function() {
      search.removeClass('searching');
    }, 3600);
  });
});

