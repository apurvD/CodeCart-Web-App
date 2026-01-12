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

  <?php
    session_start();
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "pos";

    $con = mysqli_connect($server, $username, $password, $database);

    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_SESSION['selectedTable'])) {
      $table_name = $_SESSION['selectedTable'];

      $sql = "SHOW COLUMNS FROM $table_name";
      $result = mysqli_query($con, $sql);
      $value = [];
      $index = 0;

      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          $value[$index] = $row['Field'];
          $index++;
        }
      } else {
        echo "Error: " . mysqli_error($con);
      }
    }
  ?>

  <div class="container mt-5">
    <h2 class="text-center">Add Product</h2>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="mb-5">
      <div class="mb-3">
        <label for="id" class="form-label"><?php echo $value[0]; ?></label>
        <input type="text" class="form-control" id="Value1" name="Value1" required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label"><?php echo $value[1]; ?></label>
        <input type="text" class="form-control" id="Value2" name="Value2" required>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label"><?php echo $value[2]; ?></label>
        <input type="text" class="form-control" id="Value3" name="Value3" required>
      </div>

      <div class="mb-3">
        <label for="quantity" class="form-label"><?php echo $value[3]; ?></label>
        <input type="text" class="form-control" id="Value4" name="Value4" required>
      </div>

      <button type="submit" name="create" class="btn btn-primary">Add Product</button>
      <button type="reset" class="btn btn-secondary">Clear Form</button>
    </form>

        <!-- PHP code to handle CRUD operations -->
        <?php
      
    //session_start();

// Check if the selected table name is set in the session
if (isset($_SESSION['selectedTable'])) {
    $selectedTable = $_SESSION['selectedTable'];
    //echo '<p>selected table is </p>'.$selectedTable;

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

    if (array_key_exists($selectedTable, $tableColumns)) {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "pos";
        $columns = $tableColumns[$selectedTable];
        $con = mysqli_connect($server, $username, $password, $database);

        if (!$con) {
            die("Error: " . mysqli_connect_error());
        }

        // Create (Insert) operation
        if (isset($_POST["create"])) {
            $val1 = $_POST["Value1"];
            $val2 = $_POST["Value2"];
            $val3 = $_POST["Value3"];
            $val4 = $_POST["Value4"];

            $countQuery = "SELECT COUNT(*) AS count FROM `$selectedTable` WHERE `" . $tableColumns[$selectedTable]['column1'] . "` = '$val1'";
            $countResult = mysqli_query($con, $countQuery);
            $countData = mysqli_fetch_assoc($countResult);

            if($countData['count'] == 0){
            $sql = "INSERT INTO `$selectedTable` (`" . implode("`, `", $columns) . "`) VALUES ('$val1', '$val2', '$val3', '$val4');";

            $result = mysqli_query($con, $sql);
            if ($result) {
                echo '<div class="alert alert-success mt-3" role="alert">Product added successfully.</div>';
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . mysqli_error($con) . '</div>';
            }
        }
        else{
            echo '<div class="alert alert-danger mt-3" role="alert">Error: Please enter the correct unique value of the ' . $tableColumns[$selectedTable]['column1'] . '</div>';


        }
    }

        // Close the connection when done.
        mysqli_close($con);
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Invalid table selected.</div>';
    }
} else {
    echo '<div class="alert alert-danger mt-3" role="alert">Table selection is missing.</div>';
}
?>


        <h3 class="mt-3">To go back to the index, click here:</h3>
        <a href="index.php" class="btn btn-secondary">Go to Index Page</a>
    </div>
</body>
</html> 