function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#uimagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#uimagePreview').hide();
      $('#uimagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#uimage").change(function() {
  readURL(this);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#bimagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#bimagePreview').hide();
      $('#bimagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#bimage").change(function() {
  readURL(this);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#aimagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#aimagePreview').hide();
      $('#aimagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#aimage").change(function() {
  readURL(this);
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#eimagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#eimagePreview').hide();
      $('#eimagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#eimage").change(function() {
  readURL(this);
});


$(document).ready(function() {

  $(".edit").click(function() {

    $("#user-details input").attr("readonly", false);
    $("#business-details input").attr("readonly", false);
    $(".edit").toggleClass('d-none');
    $(".save").toggleClass('d-none');
  });


  $('.carTable').DataTable({
    scrollY: 400,
    scrollX: true,
    scrollCollapse: true,
    processing: true,
    serverSide: true,
    order: [],
    "columnDefs": [
         { "sortable": false, "targets": 9 },
      ],
    ajax: 'fetch.php'
  });

  // Activate tooltip
  $('[data-toggle="tooltip"]').tooltip();
});


$('#add-form').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: "manage_vehicle.php",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function() {
      var oTable = $('.carTable').dataTable();
      oTable.fnDraw(false);
      $('#addvehicle').modal('hide');
      $('#add-form').trigger("reset");
    }
  });
});

$('body').on('click', '.carTable .btn-edit', function() {
  var regno = $(this).data('regno');
  $.ajax({
    url: "manage_vehicle.php",
    type: "POST",
    data: {
      regno: regno,
      mode: 'edit'
    },
    dataType: 'json',
    success: function(result) {
      $('#editvehicle #brand').val(result.vbrand);
      $('#editvehicle #name').val(result.vname);
      $('#editvehicle #regno').val(result.regno);
      $('#editvehicle #type option[value="' + result.type + '"]').attr('selected', 'selected');
      $('#editvehicle #variant option[value="' + result.variant + '"]').attr('selected', 'selected');
      $('#editvehicle #trans option[value="' + result.trans + '"]').attr('selected', 'selected');
      $('#editvehicle #fuel option[value="' + result.fuel + '"]').attr('selected', 'selected');
      $('#editvehicle #rate').val(result.rate);
      $('#editvehicle #details').val(result.details);
      $('#editvehicle').modal('show');
      $('#eimagePreview').css('background-image', 'url(' + result.imgurl + ')');

    }
  });
});

$('#update-form').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);

  $.ajax({
    url: "manage_vehicle.php",
    type: "POST",
    data: formData,
    processData: false,
  contentType: false,
    success: function() {
      var oTable = $('.carTable').dataTable();
      oTable.fnDraw(false);
      $('#editvehicle').modal('hide');
      $('#update-form').trigger("reset");
    }
  });
});

$('body').on('click', '.carTable .btn-delete', function() {
  var regno = $(this).data('regno');
  if (confirm("Are You sure want to delete !")) {
    $.ajax({
      url: "manage_vehicle.php",
      type: "POST",
      data: {
        regno: regno,
        mode: 'delete'
      },
      dataType: 'json',
      success: function(result) {
        var oTable = $('.carTable').dataTable();
        oTable.fnDraw(false);
      }
    });
  }
  return false;
});
