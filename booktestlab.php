<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>

<?php
include 'connection/connection.php';
$labName;
$labemail;
$labPhoneNo;

// Assuming you have a 'did' parameter in the URL
if (isset($_GET['id'])) {
  $labId = $_GET['id'];

  // Query to retrieve the driver's information
  $query = "SELECT * FROM labs WHERE lab_id = '$labId'";
  $result = mysqli_query($con, $query);

  // Check if the query was successful
  if ($result) {
    // Fetch the driver's information
    $labData = mysqli_fetch_assoc($result);

    // Check if the driver was found
    if ($labData) {
      $labName = $labData['lab_name'];
      $labemail = $labData['lab_email'];
      $labPhoneNo = $labData['lab_mo'];

    }
  }
}
?>


<div class="page-banner overlay-dark bg-image" style="background-image: url(assets/img/bg_image_1.jpg);">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <h1 class="font-weight-normal">Book Lab Appointment</h1>
    </div>
  </div>
</div>
<div class="page-section">
  <div class="container">

    <p class="text-start text-capitalize text-success">
      <a href="testLab.php" class="text-decoration-none">Test Lab</a> >>
      <?= $labName; ?>
    </p>

    <hr>
    <form class="contact-form mt-5" method="post">
      <div class="row mb-3">
        <div class="col-sm-6 py-2 wow fadeInLeft">
          <label for="fullName">Name</label>
          <input type="text" name="fullName" class="form-control" placeholder="Full name.." required>
        </div>
        <!-- <div class="col-sm-6 py-2 wow fadeInRight">
          <label for="emailAddress">Email</label>
          <input type="email" name="emailAddress" class="form-control" placeholder="Email address.." required>
        </div> -->
        <div class="col-sm-12 py-2 wow fadeInRight">
          <label for="phoneNo">Phone No</label>
          <input type="number" name="phoneNo" class="form-control" placeholder="Phone No.." required>
        </div>
        <div class="col-sm-12 py-2 wow fadeInRight">
          <label for="Address">Address</label>
          <input type="text" name="Address" class="form-control" placeholder="Enter Address.." required>
        </div>
        <div class="col-sm-6 py-2 wow fadeInRight">
          <label for="AppointmentDate">Date</label>
          <input type="date" name="AppointmentDate" class="form-control" required>
        </div>
        <div class="col-sm-6 py-2 wow fadeInRight">
          <label for="AppointmentTime">Time</label>
          <input type="time" name="AppointmentTime" class="form-control" required>
        </div>
      </div>
      <button type="submit" name="submit" class="btn btn-primary wow zoomIn">Book Now</button>
    </form>
  </div>
</div>


</body>

</html>
<?php
include 'connection/connection.php';  // Include your database connection file

// Include PHPMailer autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {

  // Get values from the form
  $fullName = $_POST['fullName'];
  $emailAddress = $_POST['emailAddress'];
  $phoneNo = $_POST['phoneNo'];
  $Address = $_POST['Address'];
  $AppointmentDate = $_POST['AppointmentDate'];
  $AppointmentTime = $_POST['AppointmentTime'];

  // Assuming you have a 'user_email' cookie
  $useremail = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '';
  // Check if a booking already exists for the specified driver and user
  $checkBookingQuery = "SELECT * FROM labdetails WHERE user_email= '$useremail' and lab_email = '$labemail'";
  $checkBookingResult = mysqli_query($con, $checkBookingQuery); // Assign the query result to $checkBookingResult

  if (mysqli_num_rows($checkBookingResult) > 0) { // Use $checkBookingResult instead of $checkBookingQuery
    // Alert for already booked driver
    echo "<script>alert('This lab is already booked by you.');</script>";
  } else {
    // Insert data into the database
    $insertQuery = "INSERT INTO labdetails (fullName, user_email, phoneNo, lab_email, address, appointmentdate, appointmenttime) 
                    VALUES ('$fullName', '$useremail', '$phoneNo', '$labemail', '$Address', '$AppointmentDate', '$AppointmentTime')";

    $result = mysqli_query($con, $insertQuery);

    if ($result) {
      // Send an email to the user using PHPMailer
      $mail = new PHPMailer(true);  // Passing true enables exceptions

      try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aadiipatil10z@gmail.com';  // Replace with your Gmail email address
        $mail->Password = 'bbnl lppt pnvj ahdg';   // Replace with your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('aadiipatil10z@gmail.com', 'Tech Care');  // Replace with your Gmail email address and name
        $mail->addAddress($useremail);  // Add recipient email

        $mail->isHTML(true);
        $mail->Subject = "Lab Booking Confirmation";
        $mail->Body = "
    <html>
    <head>
        <style>
            /* Add your custom styles here */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #007BFF;
            }
            /* Add more styles as needed */
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Your Lab Booking Details</h2>
            <p>Dear User,</p>
            <p>Your lab has been booked with the following details:</p>
            <ul>
                <li><strong>User Name:</strong> $fullName</li>
                <li><strong>Date and Time:</strong> $AppointmentDate <span>$AppointmentTime</span></li>
                <li><strong>User Phone Number:</strong> $phoneNo</li>
                <li><strong> Address:</strong> $Address</li>
            </ul>
            <p>Thank you for choosing our lab service!</p>
        </div>
    </body>
    </html>
";

        $mail->send();

        // Show popup message and redirect to the previous page
        echo "<script>
              alert('Driver has been booked. Check your email for more details.');
              window.location.href = 'testlab.php';
            </script>";
      } catch (Exception $e) {
        echo "Error sending email: " . $mail->ErrorInfo;
      }
    } else {
      echo "Error: " . mysqli_error($con);
    }
  }
}
?>