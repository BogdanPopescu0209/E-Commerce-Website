//Function to output user details when user is logged in
function outputUserDetails() {

    let request = new XMLHttpRequest();

    request.onload = function () {

        //Check server stats
        if (request.status === 200) {

            //Output server response
            document.getElementById("OutputUserDetails").innerHTML = request.responseText;

        } else

            //Error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Reqyest top open file
    request.open("GET", "/PHP/ecommerce/account.php");
    request.send();
}