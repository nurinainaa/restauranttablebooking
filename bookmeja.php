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
        header("Location: payment2.php");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Customer not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 
   <head> 
      <!-- basic --> 
      <meta charset="utf-8"> 
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <!-- mobile metas --> 
      <meta name="viewport" content="width=device-width, initial-scale=1"> 
      <meta name="viewport" content="initial-scale=1, maximum-scale=1"> 
      <!-- site metas --> 
      <title>Contact</title> 
      <meta name="keywords" content=""> 
      <meta name="description" content=""> 
      <meta name="author" content=""> 
      <!-- bootstrap css --> 
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
      <!-- style css --> 
      <link rel="stylesheet" type="text/css" href="css/style.css"> 
      <!-- Responsive--> 
      <link rel="stylesheet" href="css/responsive.css"> 
      <!-- fevicon --> 
      <link rel="icon" href="images/fevicon.png" type="image/gif" /> 
      <!-- Scrollbar Custom CSS --> 
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css"> 
      <!-- Tweaks for older IEs--> 
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"> 
      <!-- owl stylesheets -->  
      <link rel="stylesheet" href="css/owl.carousel.min.css"> 
      <link rel="stylesheet" href="css/owl.theme.default.min.css"> 
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> 
      <style type="text/css"> 
      body,td,th { 
 font-size: 10px; 
} 
      body { 
 margin-left: 10px; 
 margin-right: 0px; 
} 
      </style> 
   </head> 
   <body> 
      <div class="header_section">
         <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div class="logo"><a href="index.html"><img src="images/logo2.png"></a></div>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link" href="index.html">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="about.html">About Us</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="gallery.html">Gallery</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="services.html">Services</a>
					  </li>
                     <li class="nav-item">
                        <a class="nav-link" href="detail.html">Reservation</a>
					  </li>
                  </ul>
               </div>
            </nav>
         </div>
      </div>
      <!--header section end --> 
 
</head>
<body>
<h2 align="center" >Book Table</h2>
<form align="center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
        <input type="submit" value="Book Table">
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