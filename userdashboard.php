<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>


  <div class="page-hero bg-image overlay-dark" style="background-image: url(assets/img/bg_image_1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">Let's make your life Joyfull</span>
        <h1 class="display-4">Doctor's-Appointement</h1>
        <a href="doctors.php" class="btn btn-primary">Get's Appointment</a>
      </div>
    </div>
  </div>

  <div class="feedback" id="FeedBackSection">
        <div class="container">
              <div class="row">
                  <div class="col-md-6 col-sm-6 position-relative">
                        <img src="assets/img/appointment-image.jpg" class="img-responsive" alt="">
                  </div>
                  <div class="col-md-6 col-sm-6">
                        <form id="feedback-form" role="form" method="post" >
                            <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                  <h2 class="my-2 mb-4">Feedback</h2>
                            </div>
                            <hr>

                            <div class="wow fadeInUp" data-wow-delay="0.8s">
                                  <div class="col-md-12 col-sm-6">
                                      <label for="name">Name</label>
                                      <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                                  </div>

                                  <div class="col-md-12 col-sm-6">
                                      <label for="email">Email</label>
                                      <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                  </div>

                                    <div class="col-md-12 col-sm-6">
                                      <label for="phone">Phone No</label>
                                      <input type="number" class="form-control" id="phone" name="phone" placeholder="Your Phone No">
                                  </div>

                                  <div class="col-md-12 col-sm-12">
                                      <label for="Message">Feedback</label>
                                      <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
                                      <button type="submit" class="form-control" id="cf-submit" name="submit">Submit</button>
                                  </div>
                            </div>
                      </form>
                  </div>

              </div>
        </div>
  </div>
<?php

 include 'connection/connection.php';
 $userEmail = $_COOKIE['user_email'];

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
 $email = $_POST['email'];
 $phone = $_POST['phone'];
 $message = $_POST['message'];

 $updateQuery = "UPDATE user SET feedback = '$message' WHERE email = '$userEmail'";

    if (mysqli_query($con, $updateQuery)) {
        // Feedback updated successfully
        echo "<script>alert('Feedback updated successfully.')</script>";
    } else {
        // Error updating feedback
        echo "Error updating feedback: " . mysqli_error($con);
    }

    // Close database connection
    mysqli_close($con);
} else {
    // Handle the case where the form is not submitted properly
    echo "<script>alert('Form submission error.')</script>";
}
?>


<?php
  include "includes/footer.php";
?>