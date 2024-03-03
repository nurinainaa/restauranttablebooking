<?php
include('dbconnect.php');

$i=0;
$sqlcust="SELECT * FROM customerdetails";
$resultcust=$conn->query($sqlcust);

$sqlbook="SELECT * FROM bookingdetails";
$resultbook=$conn->query($sqlbook);
	  
$conn->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>

</head>

<body>
<form id="form1" name="form1" method="post" action="deletemultiple.php">
  <h1 align="center">CUSTOMER LIST</h1>
    <table align="center" width="540" height="60" border="1">
        <tr>
              <th width="44" scope="col">Select</th>
            <th width="69" height="54" scope="col">Customer ID</th>
            <th width="180" scope="col"><div align="center">Name</div></th>
            <th width="88" scope="col">Email</th>
            <th width="125" scope="col">Update</th>
        </tr>
        <?php
            if ($resultcust->num_rows > 0) {
                while ($rows = $resultcust->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input name='checked_id[]' type='checkbox' value='" . $rows['customerid'] . "'></td>";
                    echo "<td align='center'>" . $rows["customerid"] . "</td>";
                    echo "<td align='center'>" . $rows["name"] . "</td>";
                    echo "<td align='center'>" . $rows["email"] . "</td>";
                    echo "<td>";
                    echo "<div align='center'><a href='deletefunc.php?customerid=" . $rows["customerid"] . "'>Delete</a></div>";
                    echo "</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }
            ?>
    </table>
  </form>
</body>

        </table>
    </form>
</body>

  </table>
  <strong>
  <h2 align="center">BOOKING DETAILS</strong>
  </h2>
  <table align="center" width="464" height="60" border="1">
    <tr class="text">
        <th height="24">Customer ID</th>
        <th>Table Number</th>
        <th>Book Date</th>
        <th>Book Time</th>
        <th>Update</th> <!-- New column for update and delete links -->
    </tr>
    <?php
    if ($resultbook->num_rows > 0) {
        while ($rows = $resultbook->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $rows["customerid"] . "</td>";
            echo "<td>" . $rows["mejaid"] . "</td>";
            echo "<td>" . $rows["booking_date"] . "</td>";
            echo "<td>" . $rows["booking_time"] . "</td>";
            echo "<td>";
            echo "<div align='center'><a href='updatecustbook.php?customerid=" . $rows["customerid"] . "'>Update</a></div>";
            echo "<div align='center'><a href='deletebookdetails.php?customerid=" . $rows["customerid"] . "'>Delete</a></div>";
            echo "</td>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='5'>0 results</td></tr>";
    }
    ?>
</table>

  </table>
  <label></label>
</form>
<?php
include('dbconnect.php');

// Check if form is submitted
if(isset($_POST['submit'])) 
{
    // Retrieve form data
    $customerID = $_POST['customerid'];
    $bookingDate = $_POST['booking_date'];
    $bookingTime = $_POST['booking_time'];
    $mejaID = $_POST['mejaid'];

    // Perform update query with prepared statement
    $sqlUpdate = "UPDATE bookingdetails 
                  SET booking_date = '$bookingDate', booking_time = '$bookingTime', mejaid = '$mejaID' 
                  WHERE customerid = '$customerID'";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("ssii", $bookingDate, $bookingTime, $mejaID, $customerID);

    if ($stmt->execute()) {
        // Delete old data with prepared statement
        $sqlDelete = "DELETE FROM bookingdetails WHERE customerid = ? AND booking_date != ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("is", $customerID, $bookingDate);
        
        if ($stmtDelete->execute()) {
            // Redirect back to customerlist.php
            header("Location: customerlist.php");
            exit();
        } else {
            // Error deleting old data
            $errorDelete = "Error deleting old data: " . $conn->error;
        }
    } else {
        // Error updating booking details
        $errorUpdate = "Error updating booking details: " . $conn->error;
    }

    // Close prepared statements
    $stmt->close();
    $stmtDelete->close();
}

// Close database connection
$conn->close();
?>
</body>
</html>
