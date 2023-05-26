  $("#contactForm")
  .on("submit", function (event) {

    event.preventDefault();

    const serviceID = "service_wbwt88v";
    const templateID = "template_de6dy14";

    // send the email here
    emailjs.sendForm(serviceID, templateID, this).then(
      (response) => {
        console.log("SUCCESS!", response.status, response.text);
        $("#contactForm")[0].reset();
        swal("Message Sent", "Thank You for contacting Us.", "success");
      },
      (error) => {
        console.log("FAILED...", error);
      }
    );
  });
