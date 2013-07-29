$(function() {
  $('#invest_quantity').focus().keyup(function() {
    var quantity = $('#invest_quantity').val();
    var per_share = $('#per_share').data('value');
    var result = quantity * per_share;

    $('#result').html('$' + result);
  });

  $(document).on('step4:opened', function() {
    var quantity = $('#invest_quantity').val();
    var per_share = $('#per_share').data('value');
    var result = quantity * per_share;

    $('#quantity1').html(quantity);
    $('#total_investment').html('$' + result);
  });
});

