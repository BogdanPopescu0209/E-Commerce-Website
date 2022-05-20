//Function to update products
function find_product() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check connection with server
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("ServerFeedback").innerHTML = responseData;
        }
        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file 
    request.open("POST", "/PHP/CMS/update_product_find.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Get value to send to server
    let itemID = document.getElementById("id").value;

    //Regex to check if the input is an object
    let objectFormat = /^(?=[a-f\d]{24}$)(\d+[a-f]|[a-f]+\d)/i;

    //Check input is not empty
    if (itemID === "") {

        //Server response
        document.getElementById("ServerFeedback").innerHTML = "Product ID cannot be empty!";

    } else if (!objectFormat.test(itemID)) {

        //Server response
        document.getElementById("ServerFeedback").innerHTML = "Please enter a valid product ID!";
    } else

        //Send input to server
        request.send("&id=" + itemID);
}

//Function to save the new details
function save_product() {

    let request = new XMLHttpRequest();

    request.onload = () => {

        //Check connection with server
        if (request.status === 200) {

            let responseData = request.responseText;

            //Output server response
            document.getElementById("ServerFeedback").innerHTML = responseData;
        }
        else

            //Output error if server is not responding
            alert("Error communicating with server: " + request.status);
    };

    //Request to open file 
    request.open("POST", "/PHP/CMS/update_product.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    //Get value to send to server
    let itemID = document.getElementById("id").value;
    let itemName = document.getElementById("name").value;
    let itemDescription = document.getElementById("description").value;
    let itemImageURL = document.getElementById("image_url").value;
    let itemKeywords = document.getElementById("keywords").value;
    let itemContents = document.getElementById("contents").value;
    let itemPrice = document.getElementById("price").value;
    let itemQuantity = document.getElementById("quantity").value;

    //Check if input is empty
    if (itemName === "" || itemDescription === "" || itemKeywords === "" || itemContents === ""
        || itemPrice === "" || itemQuantity === "") {

        //Output server response
        document.getElementById("ServerResponse").innerHTML = "Please fill in all the fields!"

    } else

        //Output server response
        request.send("&id=" + itemID + "&name=" + itemName + "&description=" + itemDescription + "&image_url=" + itemImageURL + "&keywords=" + itemKeywords
            + "&contents=" + itemContents + "&price=" + itemPrice + "&quantity=" + itemQuantity);

}
