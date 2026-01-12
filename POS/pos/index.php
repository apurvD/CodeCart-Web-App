<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Dashboard</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        /* Background styles */
        body {
            background: #f8f9fa; /* Light gray background */
        }

        .container {
            background: #fff; /* White container background */
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .mb-3 select {
            width: 100%;
        }

        /* Card and button styles */
        .card {
            background: #fff; /* White card background */
            border: none; /* Remove the card border */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            color: #343a40; /* Dark text color */
        }

        .card-text {
            color: #6c757d; /* Slightly lighter text color */
        }

        .btn-primary {
            background-color: #007bff; /* Primary button background color */
            border: none; /* Remove button border */
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker background on hover */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Select a Database</h2>
        <form method="post" id="dataForm" onsubmit="return handleFormSubmit();">
            <div class="mb-3">
                <select class="form-select" name="selectedTable" aria-label="Select a Database">
                    <option value="product">product</option>
                    <option value="real_time">real_time</option>
                    <option value="transaction">transaction</option>
                    <option value="user">user</option>
                </select>
                <br>
                <button  id = "Db-id" class="btn btn-primary" type="submit">Select</button>
                
            </div>
        </form>
    </div>

    <div class="container mt-5">
        <p id ="Db-name"class="mb-3"> </p>
    </div>

    

    <?php
    // Start a session to store the selected database value
    #session_start();
    $selectedTable= "";
    // Check if the form has been submitted
    if(isset($_POST['selectedTable'])){
        $_SESSION['selectedTable'] = $_POST['selectedTable'];
        $selectedTable=$_SESSION['selectedTable'];
        //echo '<p>' . $selectedTable . '</p>';
        

        
    }

    ?>

    <div class="container mt-3">
        <form method="post">
            <button type="submit" name="resetSession" class="btn btn-danger">Clear Selection</button>
        </form>
    </div>

    <?php
//session_start();

// Check if the "Reset Session" button has been clicked
if (isset($_POST['resetSession'])) {
    // Unset or destroy the session variable
    unset($_SESSION['selectedTable']);
}

// The rest of your HTML and PHP code...
?>

    <div class="container mt-5">
        <h1 class="display-4 text-center mb-5">Welcome To POS Dashboard</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Insert Records</h2>
                        <p class="card-text">To insert all the records, click on the link below:</p>
                        <a href="insert.php" class="btn btn-primary">Insert Records</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Display Records</h2>
                        <p class="card-text">To insert all the records, click on the link below:</p>
                        <a href="display.php" class="btn btn-primary">Insert Records</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Update Records</h2>
                        <p class="card-text">To insert all the records, click on the link below:</p>
                        <a href="update.php" class="btn btn-primary">Update Records</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Delete Records</h2>
                        <p class="card-text">To insert all the records, click on the link below:</p>
                        <a href="delete.php" class="btn btn-primary">Delete Records</a>
                    </div>
                </div>
            </div>
            
        </div>

    </div>


    <script>
        // document.addEventListener("DOMContentLoaded", function () {
        //     const dataForm = document.getElementById("dataForm");
        //     const selectedDatabaseElement = document.getElementById("Db-name");
        //     //const selectedDatabaseElement = document.getElementById("selectedDatabase");

        //     dataForm.addEventListener("submit", function (e) {
        //         //e.preventDefault();
        //         console.log("Form submitted"); 
        //         const selectedTable = dataForm.elements.selectedTable.value;

        //         // Create a new XMLHttpRequest object
        //         const xhrDatabase = new XMLHttpRequest();

        //         xhrDatabase.open("GET", "get_database.php?selectedTable=" + selectedTable, true);
        //         xhrDatabase.onload = function () {
        //             if (xhrDatabase.status === 200) {
        //                 const databaseName = xhrDatabase.responseText;
        //                 selectedDatabaseElement.textContent = "Selected Database is:  " + databaseName;
        //             } else {
        //                 selectedDatabaseElement.textContent = "Error: Unable to fetch the database name";
        //             }
        //         };

        //         xhrDatabase.send();
        //     });
        // });
    </script>
</body>
</html>
