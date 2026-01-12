<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Product List</h2>
        <?php
         session_start();

         // Check if the selected table name is set in the session
         if (isset($_SESSION['selectedTable'])) {
             $selectedTable = $_SESSION['selectedTable'];
             #echo 'selected table is '.$selectedTable;
         
             // Define an associative array to map table names to their respective columns
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
            }






        function displayProductList($selectedTable){
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

            if ($readResult) {
                echo '<table class="table">
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
                echo '</tbody></table>';
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . mysqli_error($con) . '</div>';
            }
            mysqli_close($con);
        }
        if (isset($selectedTable)) {
            displayProductList($selectedTable);
        }
        else{
            echo '<div class="alert alert-danger mt-3" role="alert">Error: Please Select Table </div>';
        }
            
        ?>

        <div class="mt-3">
            <h3>To close the Record Display, click here:</h3>
            <a href="index.php" class="btn btn-secondary">Go to Index Page</a>
        </div>
    </div>
</body>
</html>
