<?php
include('dbconnect.php');

// Check if the customer ID is provided in the URL
if(isset($_GET['customerid'])) {
    $cust_id = $_GET['customerid'];

    // Delete the customer with the provided ID from the database
    $sql = "DELETE FROM customerdetails WHERE customerid='$cust_id'";
    if($conn->query($sql) === TRUE) {
        // Redirect back to the customer list page after deletion
        header("Location: customerlist.php");
        exit();
    } else {
        // Handle the error if deletion fails
        echo "Error deleting customer: " . $conn->error;
    }
} else {
    // Redirect to the customer list page if the customer ID is not provided
    header("Location: customerlist.php");
    exit();
}

$conn->close();
?>
