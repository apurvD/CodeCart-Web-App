// JavaScript code within your HTML file
document.addEventListener("DOMContentLoaded", function () {
    const dataForm = document.getElementById("Db-id");
    const resultElement = document.getElementById("Db-name");

    dataForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const data = document.getElementById("data").value;

        // Create a new XMLHttpRequest object
        const xhr = new XMLHttpRequest();
        
        // Define the request (GET or POST) and the URL
        xhr.open("POST", "process.php", true);

        // Set the request header
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Define the callback function to handle the response
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Update the result element with the response
                resultElement.innerHTML = xhr.responseText;
            } else {
                resultElement.innerHTML = "Error: " + xhr.status;
            }
        };

        // Send the request with the data
        xhr.send("data=" + data);
    });
});
