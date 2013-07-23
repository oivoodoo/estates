$(function() {
   $('#quantity').focus().keyup(function() {
      var quantity = $('#quantity').val();
      var per_share = $('#per_share').data();
      var result = (quantity * per_share);

      $("#result").html(result);
   });
});
