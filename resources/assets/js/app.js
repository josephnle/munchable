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

  $(document).keydown(function(e) {
    switch(e.which) {
      case 37: // left
        $('.card').first().addClass('animated fadeOutLeft').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(e) {
          $('.card').first().remove();
        });
        break;

      case 39: // right
        $('.card').first().addClass('animated fadeOutRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(e) {
          $('.card').first().remove();
        });
        break;

      default: return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });
});