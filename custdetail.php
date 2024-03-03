<?php
include('dbconnect.php');


if(isset($_POST['submit']))
{
    $custname = $_POST['name'];
    $custemail = $_POST['email'];
    $phonenum = $_POST['number'];
    
    // Insert data into database
    $sql = "INSERT INTO customerdetails (customerid,name,email,phone) VALUES ('','$custname', '$custemail', '$phonenum')";
    
    if($conn->query($sql) === TRUE)
    {
        header("location: bookmeja.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
