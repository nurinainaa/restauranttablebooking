<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>
/* Bordered form */
form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
</style>
</head>

<body>
	<body>
	<form action="customerlist.php" method="post">

  <div class="container">
    <label for="uname"><b>ADMIN LOGIN<br>
      <br>
    Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <!-- Add a hidden field to store the admin's ID -->
    <input type="hidden" name="admin_id" value="0">

    <button type="submit">Login</button>
  </div>
</form>
</body>

<?php
// Connect to the database
include('dbconnect.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the submitted username and password
  $username = $_POST["uname"];
  $password = $_POST["psw"];

  // Query the database to check if the admin's credentials match
  $query = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  // If a row was returned, then the admin's credentials match
  if (mysqli_num_rows($result) > 0) {
    // Get the admin's ID from the row
    $row = mysqli_fetch_assoc($result);
    $admin_id = $row["id"];

    // Store the admin's ID in the hidden field
    echo "<script>document.getElementsByName('admin_id')[0].value = '$admin_id';</script>";
  }
}
?>
</html>