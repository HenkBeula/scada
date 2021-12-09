function validateForm() {
    //["address"]["contact"]
    var username = document.forms["client_registration"]["username"].value;
    var address = document.forms["client_registration"]["address"].value;
    var contact = document.forms["client_registration"]["contact"].value;
    var password = document.forms["client_registration"]["contact"].value;
    if (username == "") {
        alert("Username must be filled out");
        return false;
      }
      else if (address == "") {
          alert("Address must be filled out");
          return false;
      }
      else if (contact == "") {
          alert("Contact must be filled out");
          return false;
      }
      else if (password == "") {
          alert("Password must be filled out");
          return false;
      }
  }

function checkFormValidity(){
      var pass = new document.getElementById("password");
      var conf_pass = new document.getElementById("confirm-password");
      if(pass != conf_pass){
          alert()
      } else {
        document.write("");
      } 
}

function transationStatus(){
    var sucess = document.getElementById("sucess_message");
    var finalize_pay = document.getElementById("finalize_pay");

    //When the user clicks on the proceguir button, show the message box on next page
    finalize_pay.onsubmit = function() {
    document.getElementById("sucess_message").style.display = "block !important";
    }
}

function passFormValidity(){
    var myInput = document.getElementById("password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var conf_pass = document.getElementById("confirm-password");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }

    }

    conf_pass.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(conf_pass.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(conf_pass.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if(conf_pass.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if(conf_pass.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }

    }

    
}