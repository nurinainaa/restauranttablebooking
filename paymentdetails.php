<?php
// Start session
session_start();

// Database connection
include('dbconnect.php');

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Process the payment here
    // For simplicity, let's assume the payment is successful
    // You would typically handle payment processing using a payment gateway

    // Display a success message
    echo '<script type="text/javascript"> alert("Payment Successful! Your receipt will be sent to your email."); window.location="index.html"; </script>';
} else {
    // Display a failure message
    echo '<script type="text/javascript"> alert("Payment Unsuccessful."); window.location="index.html"; </script>';
}
?>
