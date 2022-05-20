function delete_product() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check connection with server
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("ServerFeedbackItem").innerHTML = responseData;
        }
        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file 
    request.open("POST", "/PHP/CMS/delete_product.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Get value to send to server
    let itemID = document.getElementById("idItem").value;

    //Regex to check if the input is an object
    let objectFormat = /^(?=[a-f\d]{24}$)(\d+[a-f]|[a-f]+\d)/i;

    //Check input is not empty
    if (itemID === "") {

        //Server response
        document.getElementById("ServerFeedbackItem").innerHTML = "Product ID cannot be empty!";

    } else if (!objectFormat.test(itemID)) {

        //Server response
        document.getElementById("ServerFeedbackItem").innerHTML = "Please enter a valid product ID!";

    } else

        //Send input to server
        request.send("&idItem=" + itemID);
}

//Function to delete
function delete_order() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check connection with server
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("ServerFeedbackOrder").innerHTML = responseData;
        }
        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file 
    request.open("POST", "/PHP/CMS/delete_order.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Get value to send to server
    let orderID = document.getElementById("idOrder").value;

    //Regex to check if the input is an object
    let objectFormat = /^(?=[a-f\d]{24}$)(\d+[a-f]|[a-f]+\d)/i;

    //Check input is not empty
    if (orderID === "") {

        //Server response
        document.getElementById("ServerFeedbackOrder").innerHTML = "Order ID cannot be empty!";

    } else if (!objectFormat.test(orderID)) {

        //Server response
        document.getElementById("ServerFeedbackOrder").innerHTML = "Please enter a valid order ID!";

    } else

        //Send input to server
        request.send("&idOrder=" + orderID);
}
