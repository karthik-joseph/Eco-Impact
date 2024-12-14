document.addEventListener("DOMContentLoaded", (event) => {
  // dob validation 16 year old

  // Set the maximum date for the date of birth input
  const dobInput = document.querySelector('input[name="dob"]');
  const today = new Date();
  const maxDate = new Date(
    today.getFullYear() - 16,
    today.getMonth(),
    today.getDate()
  );

  // Format the date to YYYY-MM-DD
  const year = maxDate.getFullYear();
  const month = String(maxDate.getMonth() + 1).padStart(2, "0"); // Months are 0-based
  const day = String(maxDate.getDate()).padStart(2, "0");
  dobInput.setAttribute("max", `${year}-${month}-${day}`);

  // phone number validation
  const phoneInput = document.querySelector('input[name="phn"]');
  let errormessage = "";

  phoneInput.addEventListener("input", function (e) {
    // Remove any non-digit characters
    this.value = this.value.replace(/\D/g, "");
  });

  // Toggle password visibility
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  togglePassword.addEventListener("click", function (e) {
    // Toggle the type attribute
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // Toggle the eye icon
    this.textContent = type === "password" ? "👁️" : "👁️‍🗨️";
  });

  flatpickr("input[name='dob']", {
    maxDate: new Date().fp_incr(-16 * 365),
    dateFormat: "Y-m-d",
    allowInput: true,
    static: true,
  });
});

$(document).ready(function () {
  jQuery.validator.addMethod(
    "emailCheck",
    function (value, element) {
      var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return regex.test(value);
    },
    "Please enter a valid email address."
  );
});
