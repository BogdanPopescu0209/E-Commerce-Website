//Function to output the list of orders
function list_orders() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check connection with server
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("ServerResponse").innerHTML = responseData;
        }
        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file 
    request.open("GET", "/PHP/CMS/list_orders.php");

    request.send();
}