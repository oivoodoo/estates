$(document).ready(function() {
  $(document).on('step4:opened', function() {
    var address1 = $('#address1').val();
    var address2 = $('#address2').val();
    var address = address1 + ', ' + address2;
    $('#address').html(address);

    var city = $('#city').val();
    $('#city1').html(city);

    var country = $('#invest_country').val();
    $('#country').html(country);

    var state = $('#invest_state').val();
    $('#state').html(state);

    var zip_code = $('#zip').val();
    $('#zip1').html(zip_code);

    var phoneAreaCode = $('#phoneAreaCode').val();
    var phonePrefix = $('#phonePrefix').val();
    var phoneLastFour = $('#phoneLastFour').val();
    var result = [phoneAreaCode, phonePrefix, phoneLastFour].join('-');
    $('#phone_number').html(result);
  });

  $('#invest_country').change(function() {
    var country = $('#invest_country').val();

    if (country == 'United States') {
      $('#hidden_state').show();
      $('#hidden_field_state').show();
    } else {
      $('#hidden_state').hide();
      $('#hidden_field_state').hide();
    };
  });
});
