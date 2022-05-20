//Function to output customer orders
function output_orders() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check server status
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("OutputOrders").innerHTML = responseData;
        }
        else

            //If server is not responding output error
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file
    request.open("GET", "/PHP/ecommerce/customer_orders.php");

    request.send();
}