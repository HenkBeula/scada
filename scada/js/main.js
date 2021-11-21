function validateForm() {
    //["address"]["contact"]
    var username = document.forms["client_registration"]["username"].value;
    var address = document.forms["client_registration"]["address"].value;
    var contact = document.forms["client_registration"]["contact"].value;
    var password = document.forms["client_registration"]["contact"].value;
    /*if (username == "" && address == "" && contact == "" && password == "") {
      alert("All fields must be filled out");
      return false;
    }
    else if (username == "" && address != "" && contact != "") {
        alert("Username must be filled out");
        return false;
    }
    else if (username != "" && address == "" && contact != "") {
        alert("Address must be filled out");
        return false;
    }
    else if (username != "" && address != "" && contact == "") {
        alert("Contact must be filled out");
        return false;
    }
    else if (username == "" && address == "" && contact != "") {
        alert("Username and address must be filled out");
        return false;
    }
    else if (username == "" && address != "" && contact == "") {
        alert("Username and contact must be filled out");
        return false;
    }
    else if (username != "" && address == "" && contact == "") {
        alert("Address and contact must be filled out");
        return false;
    }else if (password == ""){
        alert("Password must be filled out");
        return false;
    }*/
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

  /*function checkFormValidity(){
      var inpObj = new document.getElementById("contact");
      if(!inpObj.checkValidity()){
          document.getElementsByTagName(placeholder).innerHTML = inpObj.validationMessage;
      } else {
        document.write("");
      } 
  }*/