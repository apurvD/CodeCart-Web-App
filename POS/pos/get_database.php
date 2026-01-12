<!-- <?php

if (isset($_GET["selectedTable"])) {
    $selectedTable = $_GET["selectedTable"];
    $databaseName = getDatabaseName($selectedTable);
    echo $databaseName;
    
} else {
    echo "Error: Database name not found.";
}

function getDatabaseName($selectedTable) {
    $databases = [
        "product" => "Product Database",
        "real_time" => "Real Time Database",
        "transaction" => "Transaction Database",
        "user" => "User Database"
    ];

    return isset($databases[$selectedTable]) ? $databases[$selectedTable] : "Unknown Database";
}
?> -->
