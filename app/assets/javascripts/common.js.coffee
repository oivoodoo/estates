$ ->
  $("form").validate();

  $(document).bind 'user:signed_in', ->
    # remove bottom notification about the sign up or in if user has already
    # signed up
    $('#nag').remove()

  $(document).trigger('user:signed_in') if Settings.user.signed_in

