<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Update Product</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="id" class="form-label">Enter reference column of the table</label>
            <input type="text" class="form-control" id="Value1" name="Value1" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Enter the value of reference Column which you want to update</label>
            <input type="text" class="form-control" id="Value2" name="Value2" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Enter the Column name which you want to update</label>
            <input type="text" class="form-control" id="Value3" name="Value3" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Enter the value with you want to update</label>
            <input type="text" class="form-control" id="Value4" name="Value4" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update the Product</button>
    </form>






    <h3 class="mt-4 text-center">To display the records, click here:</h3>
    <div class="text-center">
        <form method="post">
            <button type="submit" name="Display" class="btn btn-primary">Display Product</button>
        </form>
    </div>
</div>







<?php
session_start();


if (isset($_SESSION['selectedTable'])) {
    $selectedTable = $_SESSION['selectedTable'];
    
    $tableColumns = array(
        'product' => array(
            'column1' => 'id',
            'column2' => 'Name',
            'column3' => 'price',
            'column4' => 'quantity'
        ),
        'real_time' => array(
            'column1' => 'id',
            'column2' => 'Name',
            'column3' => 'price',
            'column4' => 'quantity'
        ),
        'transaction' => array(
            'column1' => 'Bill_ID',
            'column2' => 'Amt',
            'column3' => 'Time',
            'column4' => 'Method'
        ),
        'user' => array(
            'column1' => 'id',
            'column2' => 'Name',
            'column3' => 'phone',
            'column4' => 'quantity'
        )
    );
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        $reference_col = $_POST["Value1"];
        $reference_value = $_POST["Value2"];
        $column_name = $_POST["Value3"];
        $updation_value = $_POST["Value4"];
        updateTable($reference_col, $column_name, $updation_value, $selectedTable, $reference_value);
    }
    
    if (isset($_POST["Display"])) {
        displayProductList($selectedTable);
    } else {
        echo '<div class="container mt-4">
                    <div class="alert alert-warning text-center" role="alert">Please Select A Table To Display and Update</div>
               </div>';
    }
} else {
    echo '<div class="container mt-4">
                    <div class="alert alert-warning text-center" role="alert">Please Select A Table To Display and Update</div>
               </div>';
}

function updateTable($reference_col, $column_name, $updation_value, $selectedTable, $reference_value) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos";
    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
        die("Error" . mysqli_connect_error());
    }

    $updation_value = mysqli_real_escape_string($con, $updation_value);
    $reference_value = mysqli_real_escape_string($con, $reference_value);

    $readSql = "UPDATE `$selectedTable` SET `$column_name`='$updation_value' WHERE `$reference_col`='$reference_value'";
    $readResult = mysqli_query($con, $readSql);

    if ($readResult) {
        echo '<p> data Successfully Updated </p>';
    } else {
        echo '<div class="container mt-4">
                    <div class="alert alert-warning text-center" role="alert">No records were updated</div>
                  </div>';
    }

    // Close the connection when done.
    mysqli_close($con);
}

function displayProductList($selectedTable) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos";
    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
        die("Error" . mysqli_connect_error());
    }

    $readSql = "SELECT * FROM `$selectedTable`";
    $readResult = mysqli_query($con, $readSql);

    if ($readResult && mysqli_num_rows($readResult) > 0) {
        echo '<div class="container mt-4">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>';

        while ($row = mysqli_fetch_assoc($readResult)) {
            echo '<tr>
                    <th scope="row">' . $row['id'] . '</th>
                    <td>' . $row['Name'] . '</td>
                    <td>' . $row['price'] . '</td>
                    <td>' . $row['quantity'] . '</td>
                  </tr>';
        }

        echo '</tbody></table></div>';
    } else {
        echo '<div class="container mt-4">
                <div class="alert alert-warning text-center" role="alert">No records found in this table.</div>
              </div>';
    }

   
    mysqli_close($con);
}
?>

    <h3 class="mt-3">To go back to the index, click here:</h3>
        <a href="index.php" class="btn btn-secondary">Go to Index Page</a>



    

</body>
</html>
