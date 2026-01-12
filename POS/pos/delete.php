<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <!-- <div class="container mt-5">
        <h2 class="text-center">Add Product</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="id" class="form-label">Product ID:</label>
                <input type="number" class="form-control" id="id" name="id" required>
            </div>
            <button type="submit" name="create" class="btn btn-primary">DELETE Product</button>
        </form> -->

        <div class="container mt-5">
    <h2 class="text-center">Delete Product</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="id" class="form-label">Enter reference column of the table</label>
            <input type="text" class="form-control" id="Value1" name="Value1" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Enter the value of reference Column which you want to delete</label>
            <input type="text" class="form-control" id="Value2" name="Value2" required>
        </div>

        <!-- <div class="mb-3">
            <label for="name" class="form-label">Enter the Column name which you want to delete</label>
            <input type="text" class="form-control" id="Value3" name="Value3" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Enter the value with you want to delete</label>
            <input type="text" class="form-control" id="Value4" name="Value4" required>
        </div> -->

        <button type="submit" name="update" class="btn btn-primary">Delete the Product</button>
    </form>

        <!-- PHP code to handle CRUD operations -->
        <?php
        session_start();
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
   


            $server = "localhost";
            $username = "root";
            $password = "";
            $database = "pos";
            $con = mysqli_connect($server, $username, $password, $database);

            if (!$con) {
                die("Error: " . mysqli_connect_error());
            }


            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        
                $reference_col = $_POST["Value1"];
                $reference_value=$_POST["Value2"];
                // $column_name = $_POST["Value3"];
                // $updation_value=$_POST["Value4"];   
            
                
            



            // Create (Delete) operation
           
                //$id = $_POST["id"];
                  
                //$updation_value = mysqli_real_escape_string($con, $updation_value);
                $reference_value = mysqli_real_escape_string($con, $reference_value);
    
                $readSql = "DELETE FROM  `$selectedTable`WHERE `$reference_col`='$reference_value'";
                
                //$sql=$sql = "DELETE FROM `$selectedTable` WHERE `$selectedTable`.`id` = '$id'";///////////
               
                //$result = mysqli_query($con, $sql);
                $readResult = mysqli_query($con, $readSql);
                if ($readResult) {
                    echo '<div class="alert alert-success mt-3" role="alert">Product deleted successfully.</div>';
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . mysqli_error($con) . '</div>';
                }
                mysqli_close($con);
            
            }
            
            
        ?>
        <h3 class="mt-3">To display the records, click here:</h3>
        <form method="post">

            <button type="submit" name="Display" class="btn btn-primary">Display Product</button>
        </form>
        
        <?php
        //session_start();
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


        if(isset($_POST["Display"])){
            displayProductList($selectedTable);
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
            } 
            else {
                echo '<div class="container mt-4">
                        <div class="alert alert-warning text-center" role="alert">No records found in this table.</div>
                      </div>';
            }
        }
    }

    else{
        echo '<div class="container mt-4">
                        <div class="alert alert-warning text-center" role="alert">Please Select A Table</div>
                      </div>';

    }
            
        
        //
        ?>
        <h3 class="mt-3">To go back to the index, click here:</h3>
        <a href="index.php" class="btn btn-secondary">Go to Index Page</a> 
    </div>
</body>
</html>
