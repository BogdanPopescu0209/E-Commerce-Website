//Register function
function register() {

  let request = new XMLHttpRequest();

  request.onload = () => {

    //Check connection with server 
    if (request.status === 200) {

      let responseData = request.responseText;

      //Output feedback
      document.getElementById("RegisterFeedback").innerHTML = responseData;
    }
    else

      //If server not responding output error
      alert("Error communicating with server: " + request.status);
  };

  //Request to open file
  request.open("POST", "/PHP/ecommerce/registration.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  //Get input
  let userFullName = document.getElementById("full_name").value;
  let userEmail = document.getElementById("email").value;
  let userAddress = document.getElementById("address").value;
  let userTelephone = document.getElementById("telephone").value;
  let userPassword = document.getElementById("password").value;

  //Regex for email 
  let mailFormat = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

  //Regex for telephone
  let telephoneFormat = /((\+44(\s\(0\)\s|\s0\s|\s)?)|0)7\d{3}(\s)?\d{6}/g;

  //Regex for password
  let passwordFormat = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

  //Check if input is empty
  if (userFullName === "" || userEmail === "" || userAddress === "" || userTelephone === "" || userPassword === "") {

    //Output response
    document.getElementById("RegisterFeedback").innerHTML = "Please fill in all the fields!"

    //Check email format
  } else if (!mailFormat.test(userEmail)) {

    //Output response
    document.getElementById("RegisterFeedback").innerHTML = "Invalid email!"

    //Check telephone
  } else if (!telephoneFormat.test(userTelephone)) {

    //Output response
    document.getElementById("RegisterFeedback").innerHTML = "Invalid telephone number!"

    //Check password
  } else if (!passwordFormat.test(userPassword)) {

    //Output response
    document.getElementById("RegisterFeedback").innerHTML = "Password 8 or more characters, 1 uppercase and 1 special character!"

  } else

    //Send input to server
    request.send("&full_name=" + userFullName + "&email=" + userEmail + "&address=" + userAddress + "&telephone=" +
      userTelephone + "&password=" + userPassword);
}

//Function login
function login() {

  let request = new XMLHttpRequest();

  request.onload = function () {

    //Check server connection
    if (request.status === 200) {

      var responseData = request.responseText;

      //Check server response
      if (responseData === "Welcome!") {

        //Output response
        document.getElementById("ServerFeedbackLogin").innerHTML = request.responseText;

      } else {

        //Output response
        document.getElementById("ServerFeedbackLogin").innerHTML = request.responseText;
      }

    } else

      //Output error
      alert("Error communicating with server: " + request.status);
  }

  //Request to open file
  request.open("POST", "/PHP/ecommerce/customer_login.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  //Get input values
  let userEmail = document.getElementById("email").value;
  let userPassword = document.getElementById("password").value;

  //Check if input is empty
  if (userEmail === "" || userPassword === "") {

    //Output response
    document.getElementById("ServerFeedbackLogin").innerHTML = "Username or password cannot be empty!"

  } else

    //Send input to server
    request.send("&email=" + userEmail + "&password=" + userPassword);
}

//Function logout
function logout() {

  let request = new XMLHttpRequest();
  
  //Request to open file
  request.open("GET", "/PHP/ecommerce/customer_logout.php");
  request.send();
}


