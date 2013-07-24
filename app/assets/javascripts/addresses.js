$(document).ready(function() {
  $(document).on('step4:opened', function() {
    var street1 = $('#street1').val();
    var street2 = $('#street2').val();
    var address = (street1 + street2);
    $('#address').html(address);

    var city = $('#city').val();
    $('#city1').html(city);

    var state = $('#state').val();
    $('#state1').html(state);

    var zip_code = $('#zip').val();
    $('#zip1').html(zip_code);

    var phoneAreaCode = $('#phoneAreaCode').val();
    var phonePrefix = $('#phonePrefix').val();
    var phoneLastFour = $('#phoneLastFour').val();
    var result = [phoneAreaCode, phonePrefix, phoneLastFour].join('-');
    $('#phone_number').html(result);
  });
});
