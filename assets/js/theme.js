$(document).ready(function() {

  if (user) {
    $('.Login').addClass('d-none');
    $('a.signup').addClass('d-none');
    $('.dropdown-menu .signup').removeClass('vis');
  } else {
    $('.dropdown-menu .profile').addClass('d-none');
    $('.dropdown-menu .logout').addClass('d-none');
    $('.img-box .login').addClass('d-none');
    $('.img-box ').addClass('tog');
    $('#userDropdown').html('<i class="fa-solid fa-ellipsis-vertical"></i>');
  }



    $('.card').click(function() {
      $('.card').click(function() {
    $('#hidden-form').submit();
  });
    });

  filter_data();

  function filter_data() {
    var action = 'fetch_data';
    var minimum_price = $('#price-range-min').val();
    var maximum_price = $('#price-range-max').val();
    var variant = get_filter('variant');
    var fuel = get_filter('fuel');
    var trans = get_filter('trans');
    var sort = get_filter('sort');
    $.ajax({
      url: 'fetch_data.php',
      method: 'POST',
      data: {action:action,sort:sort,minimum_price:minimum_price, maximum_price:maximum_price,variant:variant,fuel:fuel,trans:trans},
      success: function(data) {
        $('.filter_data').html(data);
      }
    });
  }

  function get_filter(class_name) {
    var filter = [];
    $('.' + class_name + ':checked').each(function() {
      filter.push($(this).val());
    });
    return filter;
  }

  $('.form-check-input').click(function() {
    filter_data();
  });

  $('#price-slider').slider({
    range: true,
          min: 0,
          max: 25800,
          values: [0, 25000],
          slide: function(event, ui) {
            $("#price-range-min").val(ui.values[0]);
            $("#price-range-max").val(ui.values[1]);
            filter_data();
          }
        });
        $("#price-range-min").val($("#price-slider").slider("values", 0));
        $("#price-range-max").val($("#price-slider").slider("values", 1));
        $("#price-range-min").change(function() {
          $("#price-slider").slider("values", 0, $(this).val());
          filter_data();
        });
        $("#price-range-max").change(function() {
          $("#price-slider").slider("values", 1, $(this).val());
          filter_data();
        });
});

function filterr() {
  $('.filter-section').toggleClass('hide');
}

function reset() {
  $('.form-check-input').prop("checked", false);
}
