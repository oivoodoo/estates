$(document).ready(function() {
  $(document).on('step4:opened', function() {
    var address1 = $('#invest_address_line_1').val();
    var address2 = $('#invest_address_line_2').val();
    var address = address1 + ', ' + address2;
    $('#address').html(address);

    var city = $('#invest_city').val();
    $('#city1').html(city);

    var country = $('#invest_country').val();
    $('#country').html(country);

    var state = $('#invest_state').val();
    $('#state').html(state);

    var zip_code = $('#invest_zip_code').val();
    $('#zip1').html(zip_code);

    var phoneAreaCode = $('#invest_phone_area_code').val();
    var phonePrefix = $('#invest_phone_prefix').val();
    var phoneLastFour = $('#invest_phone_last_four').val();
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
  $(document).ready(function(){
    $('#id-upload').show();
    
    $('#invest_identification_now').change(function(){
      var invest = $('#invest_identification_now').val();
      if (invest = "now"){
        $('#id-upload').show();
      };
    });
    $('#invest_identification_later').change(function(){
      var invest = $('#invest_identification_later').val();
      if (invest = "later"){
        $('#id-upload').hide();
      };
    });
  });
});
