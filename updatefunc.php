<?php
include('dbconnect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customerID = $_POST['customerid'];
    $bookingDate = $_POST['booking_date'];
    $bookingTime = $_POST['booking_time'];
    $mejaID = $_POST['mejaid'];

    // Perform update query
    $sql = "UPDATE bookingdetails 
            SET booking_date = '$bookingDate', booking_time = '$bookingTime', mejaid = '$mejaID' 
            WHERE customerid = '$customerID'";

    if ($conn->query($sql) === TRUE) {
        echo "Booking details updated successfully.";
        
        // Redirect back to customerlist.php
        header("Location: customerlist.php");
        exit();
    } else {
        echo "Error updating booking details: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
