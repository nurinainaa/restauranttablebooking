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
      <!--header section start --> 
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
                     
                  </ul> 
               </div> 
            </nav> 
         </div> 
      </div> 
      <!--header section end --> 
      <!-- contact section start --> 
	   <form  id="form1" name="form1" method="post" action="detail.html">
      <div class="contact_section layout_padding"> 
         <div class="container"> 
            <h1 class="contact_text">&nbsp;</h1>
            <h1 class="contact_text">YOUR BOOKING DETAILS</h1>
         </div> 
      </div> 
      <div class="contact_section_2 layout_padding"> 
         <div class="container-fluid"> 
            <div class="row">
              <div class="col-md-6 padding_0 col-lg-12"> 
                 <div class="mail_section">
				
				<form id="form1" name="form1" method="post" action="details.php"><label></label>
						<div align="center">
					<table width="514" border="1">
					  <tr>
						<th width="35" scope="row"><div align="center">No.</div></th>
						<td width="103"><div align="center">Date</div></td>
						<td width="93"><div align="center">Time</div></td>
						<td width="93"><div align="center">Pax </div></td>
						<td width="75"><div align="center">Total Price </div></td>

					  </tr>
					<?php
include('dbconnect.php');
$i = 0;
$sum = 0;
//$bookid = isset($_GET['BOOK_ID']) ? $_GET['BOOK_ID'] : null; // Retrieve BOOK_ID from URL

//if ($bookid !== null) {
    $sql = "SELECT * FROM booking WHERE sessionid='$_COOKIE[PHPSESSID]'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($rows = $result->fetch_assoc()) {
            $i++;
            $sum += $rows['totalprice'];
?>
						 <tr>
                <td height="46"><div align="center"><?php echo $i;?></div></td>
                <td><div align="center"><?php echo $rows['BOOK_DATE'];?></div></td>
                <td><div align="center">RM<?php echo $rows['BOOK_TIME'];?></div></td>
                <td><div align="center"><?php echo $rows['Pax'];?></div></td>
                <td><div align="center">RM<?php echo $rows['totalprice'];?></div></td>
            </tr>

					
					  <tr>
						<th colspan="4" scope="row"><div align="right">Overall Total: 
						  <input type="hidden" name="hiddenField" />
						</div></th>
						<td scope="row">RM<?php echo $sum;?><input name="total" type="hidden" id="total" value="<?php echo $sum;?>"></td>

					  </tr>
					  </table>
				  </div>		
				 
         <div class="email_text"> 
                     <div class="send_btn"> 
						  <label>
							<div align="center">
							  <input type="submit" name="Submit2" value="Confirm Order" />
							</label>
                            </form>
        
                           </div> 
                      </div> 
                   </div> 
                </div> 
              </div> 
 
 
      </div> 
               </div> 
            </div>
	   </form>
                
      
	<div class="footer_section layout_padding">
         <div class="container">
            <div class="row">
               <div class="col-sm-6 col-lg-4">
                  <h3 class="useful_text">About</h3>
                  <p class="footer_text">At wingNbutter, we’re passionate about wings, butter, and creating unforgettable dining experiences. We’re not just feeding appetites, we’re feeding souls with flavor-filled memories.</p>
               </div>
               <div class="col-sm-6 col-lg-4 offset-lg-0">
                  <h3 class="useful_text">Menu</h3>
                  <div class="footer_menu">
                     <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="services.html">Services</a></li>
                        <li><a href="book.html">Reservation</a></li>
                     </ul>
                  </div>
               </div>
               
               <div class="col-sm-6 col-lg-4">
                  <h1 class="useful_text">Contact Us</h1>
                  <div class="location_text">
                     <ul>
                        <li>
                           <a href="#">
                           <i class="fa fa-map-marker" aria-hidden="true"></i><span class="padding_left_10">Address : Simpang Kanan,Johore</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left_10">Call : +60139858046</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left_10">Email : wingButter01@gmail.com</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
   </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2024 All Rights Reserved. By HazeRiNa</p>
         </div>
      </div>
      <!-- copyright section end --> 
      <!-- Javascript files--> 
   <script src="js/jquery.min.js"></script> 
   <script src="js/popper.min.js"></script> 
   <script src="js/bootstrap.bundle.min.js"></script> 
   <script src="js/jquery-3.0.0.min.js"></script> 
   <script src="js/plugin.js"></script> 
      <!-- sidebar --> 
   <script src="js/custom.js"></script>  
   </body> 
</html>