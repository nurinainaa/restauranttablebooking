<?php
// Start session
session_start();

// Database connection
include('dbconnect.php');

// Retrieve available tables from the database
$sql = "SELECT * FROM availabletables WHERE tblstatus = 'available'";
$result = $conn->query($sql);
$tables = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tables[] = $row;
    }
}

// Calculate total price based on the number of seats selected
$total_price = 0;
foreach ($tables as $table) {
    $table_id = $table['mejaid'];
    if (isset($_POST['meja_ids']) && in_array($table_id, $_POST['meja_ids'])) {
        $total_seats = $table['number_of_seats'];
        $total_price += $total_seats * 10; // Assuming price per seat is $10
    }
}

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $booking_date = isset($_POST['booking_date']) ? $_POST['booking_date'] : '';
    $booking_time = isset($_POST['booking_time']) ? $_POST['booking_time'] : '';
    $meja_ids = isset($_POST['meja_ids']) ? $_POST['meja_ids'] : [];

    // Retrieve customer ID from customerdetails table based on some criteria (e.g., customer name)
    $customer_email = isset($_POST['customer_email']) ? $_POST['customer_email'] : '';
    $sql_custid = "SELECT customerid FROM customerdetails WHERE email = '$customer_email'";
    $result_custid = $conn->query($sql_custid);

    if ($result_custid->num_rows > 0) {
        $row = $result_custid->fetch_assoc();
        $cust_id = $row['customerid'];
$price =$_POST['total_price'];
        // Insert booking details into BookingDetails table
        foreach ($meja_ids as $meja_id) {
            // Insert booking details into BookingDetails table
            $sql_insert_booking = "INSERT INTO bookingdetails (booking_date, booking_time, mejaid, customerid,price)
                                   VALUES ('$booking_date', '$booking_time', '$meja_id', '$cust_id','$price')";
            if ($conn->query($sql_insert_booking) !== TRUE) {
                echo "Error: " . $sql_insert_booking . "<br>" . $conn->error;
            }

            // Update status of the table to 'unavailable' in availabletables table
            $sql_update_status = "UPDATE availabletables SET tblstatus = 'unavailable' WHERE mejaid = '$meja_id'";
            if ($conn->query($sql_update_status) !== TRUE) {
                echo "Error updating status: " . $conn->error;
            }
        }

        // Redirect to payment page after booking
        header("Location: customerlist.php");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Customer not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table</title>
</head>
<body>
<h2>Book Table</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <p>
        <label for="booking_date">Date:</label><br>
        <input type="date" id="booking_date" name="booking_date" required><br>
        <label for="booking_time">Time:</label><br>
        <input type="time" id="booking_time" name="booking_time" required><br><br>
        
        <label for="customer_email">Customer Email:</label><br>
        <input type="text" name="customer_email" id="customer_email"><br>
    </p>
    <h3>Select Tables:</h3>
    <p>
        <?php if (!empty($tables)): ?>
            <?php foreach ($tables as $table): ?>
            <input type="checkbox" name="meja_ids[]" value="<?php echo $table['mejaid']; ?>" class="table-checkbox">
            Table <?php echo $table['mejaid']; ?> (Seats: <?php echo $table['number_of_seats']; ?>)
            Status: <?php echo $table['tblstatus'];?><br>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tables available.</p>
        <?php endif; ?>
    </p>
    <p>Total Price: RM
        <input type="text" name="total_price" id="total_price" readonly>
    </p>
    <p>
        <input type="submit" value="UPDATE BOOKING">
    </p>
</form>
<script>
// Function to calculate total price and update the text field
function calculateTotalPrice() {
    var checkboxes = document.querySelectorAll('.table-checkbox');
    var totalPrice = 0;
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            var tableId = checkbox.value;
            var numberOfSeats = <?php echo json_encode(array_column($tables, 'number_of_seats', 'mejaid')); ?>[tableId];
            if (numberOfSeats !== undefined) {
                totalPrice += numberOfSeats * 10; // Assuming price per seat is RM 10
            }
        }
    });
    document.getElementById('total_price').value = totalPrice;
}

// Add event listener to checkboxes to calculate total price when checkbox state changes
var checkboxes = document.querySelectorAll('.table-checkbox');
checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', calculateTotalPrice);
});
</script>

</form>
</body>
</html>