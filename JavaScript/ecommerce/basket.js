//Function for basket

function basket() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check server status
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("Basket").innerHTML = responseData;

        }
        else

            //If server not responding output error
            alert("Error communicating with server: " + request.status);
    };

    //Request file to open
    request.open("GET", "/PHP/ecommerce/basket.php");
    request.send();
}