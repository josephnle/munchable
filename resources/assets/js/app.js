// Main JS file
$(document).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.place-slider').slick({
    arrows: false
  });

  $('.toggle-menu').jPushMenu();

  $('.save-place-button').click(function(e) {
    e.preventDefault();
    var elem = this;

    var venue = $(this).data('venue');

    $.post('/api/save', { venue_id: venue }, function() {
      $(elem).html('<i class="fa fa-heart fa-lg"></i>');
    });
  });
});