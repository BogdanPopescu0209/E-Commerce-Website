//Output products
function load_products() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check server connection
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("OutputProducts").innerHTML = responseData;

        }

        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Rewquest to open file
    request.open("GET", "/PHP/ecommerce/products.php");
    request.send();
}

//Function to find products
function find_product() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check server status
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("OutputProducts").innerHTML = responseData;
        }
        else

            //Output error if server not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file
    request.open("POST", "/PHP/ecommerce/find_product.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Get input from customer
    let itemName = document.getElementById("SearchInput").value;
    let ItemNameUpperCase = itemName.toUpperCase();

    //Send input
    request.send("&name=" + ItemNameUpperCase);
}

//Sort function from low to high
function sort_low_high() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check server status
        if (request.status === 200) {

            //Output server feedback
            document.getElementById("OutputProducts").innerHTML = request.responseText;
        }
        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file
    request.open("GET", "/PHP/ecommerce/sort_low_high.php");
    request.send();
}

//Sort function from high to low
function sort_high_low() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check server status
        if (request.status === 200) {

            //Output server response
            document.getElementById("OutputProducts").innerHTML = request.responseText;
        }
        else
            
            //Output error message
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file
    request.open("GET", "/PHP/ecommerce/sort_high_low.php");
    request.send();
}