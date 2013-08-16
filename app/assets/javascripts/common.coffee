$ ->
  $(document).bind 'page:load user:signed_in', ->
    debugger
    # remove bottom notification about the sign up or in if user has already
    # signed up
    if Settings.user.signed_in
      $('#nag').remove()
    window.load()
    window.drawCharts()

  $(document).trigger('user:signed_in') if Settings.user.signed_in

