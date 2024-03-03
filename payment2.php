<?php 
// Start session 
session_start(); 
 
// Database connection 
include('dbconnect.php'); 
 
// Retrieve latest booking details 
$sql_booking_details = "SELECT bd.*, cd.email 
                        FROM bookingdetails bd 
                        JOIN customerdetails cd ON bd.customerid = cd.customerid 
                        ORDER BY bd.id DESC LIMIT 1"; // Assuming the latest booking 
$result_booking_details = $conn->query($sql_booking_details); 
 
if ($result_booking_details->num_rows > 0) { 
    $booking = $result_booking_details->fetch_assoc(); 
} else { 
    echo "No booking details found!"; 
    exit; // Exit if no booking details found 
} 
 
// Calculate total price based on the number of seats 
$total_seats = $booking['price'] / 10; // Assuming price per seat is RM 10 
$total_price = $booking['price']; // Total price from the booking 
?> 

<!DOCTYPE html> 
<html> 
<head> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
  <style> 
body { 
  font-family: Arial; 
  font-size: 17px; 
  padding: 8px; 
} 
 
* { 
  box-sizing: border-box; 
} 
 
.row { 
  display: -ms-flexbox; /* IE10 */ 
  display: flex; 
  -ms-flex-wrap: wrap; /* IE10 */ 
  flex-wrap: wrap; 
  margin: 0 -16px; 
} 
 
.col-25 { 
  -ms-flex: 25%; /* IE10 */ 
  flex: 25%; 
} 
 
.col-50 { 
  -ms-flex: 50%; /* IE10 */ 
  flex: 50%; 
} 
 
.col-75 { 
  -ms-flex: 75%; /* IE10 */ 
  flex: 75%; 
} 
 
.col-25, 
.col-50, 
.col-75 { 
  padding: 0 16px; 
} 
 
.container { 
  background-color: #f2f2f2; 
  padding: 5px 20px 15px 20px; 
  border: 1px solid lightgrey; 
  border-radius: 3px; 
} 
 
input[type=text] { 
  width: 80%; 
  margin-bottom: 10px; 
  padding: 10px; 
  border: 1px solid #ccc; 
  border-radius: 3px; 
} 
 
label { 
  margin-bottom: 10px; 
  display: block; 
} 
 
.icon-container { 
  margin-bottom: 20px; 
  padding: 7px 0; 
  font-size: 24px; 
} 
 
.btn { 
  background-color: #04AA6D; 
  color: white; 
  padding: 12px; 
  margin: 10px 0; 
  border: none; 
  width: 100%; 
  border-radius: 3px; 
  cursor: pointer; 
  font-size: 17px; 
} 
 
.btn:hover { 
  background-color: #45a049; 
} 
 
a { 
  color: #2196F3; 
} 
 
hr { 
  border: 1px solid lightgrey; 
} 
 
span.price { 
  float: right; 
  color: grey; 
} 
</style> 
</head> 
<body>
<h2>Payment Details for <?php echo $booking['email']; ?></h2> 
<div class="row"> 
  <div class="col-75"> 
    <div class="container"> 
      <form id="paymentForm" method="post" action="paymentdetails.php"> 
       
       <div class="row"> 
          <div class="col-50"> 
              <h3>&nbsp;</h3> 
            <label for="fname"><i class="fa fa-user"></i> Full Name</label> 
            <input type="text" id="fname" name="fullname" placeholder=""> 
			  
            <label for="email"><i class="fa fa-envelope"></i> Phone Number</label> 
            <input type="text" id="email" name="email" placeholder="eg:012xxxxxxx"> 
           
			  <p>Date:</p><p> <input type="text" id="fname" name="bookdate" placeholder="" value="<?php echo $booking['booking_date']; ?>"> </p> 
				<p>Time:</p><p> <input type="text" id="fname" name="booktime" placeholder="" value="<?php echo $booking['booking_time']; ?>"></p>  
			<p>Total Seats: </p><p><input type="text" id="fname" name="number_of_seats" placeholder="" value="<?php echo $total_seats; ?>"></p> 
				<p>Total Price:  </p><p> <input type="text" id="fname" name="total_price" placeholder="" value="RM<?php echo $total_price; ?>"></p>
						<div class="row"> 
               
              
            </div> 
          </div> 
 
          <div class="col-50"> 
            <h3>Payment</h3> 
            <label for="fname">Accepted Cards</label> 
            <div class="icon-container"> 
              <i class="fa fa-cc-visa" style="color:navy;"></i> 
              <i class="fa fa-cc-amex" style="color:blue;"></i> 
              <i class="fa fa-cc-mastercard" style="color:red;"></i> 
              <i class="fa fa-cc-discover" style="color:orange;"></i> 
            </div> 
            <label for="cname">Name on Card</label> 
            <input type="text" id="cname" name="cardname" placeholder=""> 
            <label for="ccnum">Credit card number</label> 
            <input type="text" id="ccnum" name="cardnumber" placeholder="XXXX-XXXX-XXXX-XXXX"> 
            <label for="expmonth">Exp Month</label> 
            <input type="text" id="expmonth" name="expmonth" placeholder=""> 
            <div class="row"> 
              <div class="col-50"> 
                <label for="expyear">Exp Year</label> 
                <input type="text" id="expyear" name="expyear" placeholder=""> 
              </div> 
              <div class="col-50"> 
                <label for="cvv">CVV</label> 
                <input type="text" id="cvv" name="cvv" placeholder=""> 
              </div> 
            </div> 
          </div>
      </div>
       <div class="col-50"></div> 
      
        <p align="center"> 
        <label> 
          <input class="btn" type="submit" name="submit" value="PAY"> 
          </label></p> 
      </form> 
    </div> 
  </div> 
</div> 
</body> 
</html>