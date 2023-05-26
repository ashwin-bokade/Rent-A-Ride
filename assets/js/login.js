const forms = document.querySelector(".forms"),
     pwShowHide = document.querySelectorAll(".eye-icon"),
     links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
   eyeIcon.addEventListener("click", () => {
       let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

       pwFields.forEach(password => {
           if(password.type === "password"){
               password.type = "text";
               eyeIcon.classList.replace("bx-hide", "bx-show");
               return;
           }
           password.type = "password";
           eyeIcon.classList.replace("bx-show", "bx-hide");
       })

   })
})

jQuery.validator.addMethod("validate_email", function(value, element) {

    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value)) {
        return true;
    } else {
        return false;
    }
});

$('#signup').validate({

  rules:{
    name : "Required",
    email : {
      required : true,
      validate_email : true
    },
    phone : {
      required : true,
      digits: true,
      minlength : 10
    },
    password : {
      required : true,
      minlength : 8
    },
    cpassword : {
      equalTo : "#password"
    }
  },
  messages:{
    name : "*Please enter your name",
    email : "*Please enter a valid email.",
    phone : "*Please enter a valid Phone Number.",
    password : {
      required : "*Please enter your password",
      minlength : "*Password must contain min '8' characters"
    },
    cpassword : "*Please enter the same password"
  },
  submitHandler: function(form) {
    form.submit();
  }
});

$('#login').validate({

  rules:{
    email : {
      required : true,
      validate_email : true
    },
    password : "required"
  },
  messages:{
    email : "*Please enter a valid email.",
    password : "*Please enter your password"
  },
  submitHandler: function(form) {
    form.submit();
  }
});
