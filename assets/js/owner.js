function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#imagePreview').hide();
      $('#imagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#image").change(function() {
  readURL(this);
});

jQuery.validator.addMethod("validate_email", function(value, element) {

  if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
    return true;
  } else {
    return false;
  }
});

$('#wizard').validate({

  rules: {
    bname: {required: true},
    bemail: {
      required: true,
      validate_email: true
    },
    bphone: {
      required: true,
      digits: true,
      minlength: 10
    },
    baddress: {required: true},
    state: {required: true},
    city: {required: true}
  },
  messages: {
    bname: "*Please enter your name",
    bemail: "*Please enter a valid email.",
    bphone: "*Please enter a valid Phone Number.",
    baddress: "*Please enter Your address",
    state: "*Please select a State",
    city: "*Please select a city/town",
  },
  submitHandler: function(form,e) {
		form.submit();
  }
});
