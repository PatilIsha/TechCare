<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>

<div class="page-banner overlay-dark bg-image" style="background-image: url(assets/img/bg_image_1.jpg);">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <h1 class="font-weight-normal">Available Doctors</h1>

      <div class="SearchDoctor">
        <form action="doctors.php" method="get">
          <select name="specilization" id="" class="">
            <option value="">Choose specilization..</option>
            <option value="Skin & Hair">Skin & Hair</option>
            <option value="Child Specialist">Child Specialist</option>
            <option value="General Physician">General Physician</option>
            <option value="Dental Care">Dental Care</option>
            <option value="Ear Nose Throat">Ear Nose Throat</option>
            <option value="Homoeopathy">Homoeopathy</option>
            <option value="Bone and joints">Bone and joints</option>
          </select>
          <button type="submit" name="SearchDoctor">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="team page-section">
  <div class="container">
    <div class="row">
      <?php
      include 'connection/connection.php';
      if (isset($_GET['SearchDoctor'])) {
        $specialization = $_GET['specilization'];

        if ($specialization != "") {
          $query = "SELECT * FROM doctor WHERE role = '$specialization'";
          $result = mysqli_query($con, $query);

          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <div class="col-md-4 col-sm-6">
                <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                  <img src="assets/img/doctors/doctor_2.jpg" class="img-responsive" alt="">
                  <div class="team-info">
                    <h3>
                      <?= $row['docname']; ?>
                    </h3>
                    <p>
                      <?= $row['role']; ?>
                    </p>
                    <div class="d-flex justify-content-between">
                      <div class="">
                        <p class="my-1"><i class="fa fa-phone"></i>
                          <?= $row['mno']; ?>
                        </p>
                        <p class="my-1"><i class="fa fa-envelope"></i> <a href="mailto:<?= $row['email']; ?>"
                            class="text-decoration-none">
                            <?= $row['email']; ?>
                          </a></p>
                      </div>
                      <div>
                        <p class="my-1">Fees:
                          <!-- <?= $row['fees']; ?> -->100 Rs
                        </p>
                        <p class="my-1">Exp:
                          <?= $row['experience']; ?> years
                        </p>
                      </div>
                    </div>
                    <div class="team-contact-info my-0">
                      <a href="bookAppointment.php?id=<?= $row['did']; ?>" class="text-decoration-none">Get Appointment <i
                          class="fa fa-arrow-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            echo "<span class='text-uppercase p-4'>Query Error</span>";
          }
        } else {
          echo "<span class='text-uppercase p-4'>Not Found..</span>";
        }
      } else {
        echo '<script>window.location.href=doctors.php</script>';
      }

      ?>
    </div>
  </div>
</div>


<?php

if (isset($_GET['GetAppointment'])) {
  echo '
         <div class="page-section">
    <div class="container">
       <p class="text-start text-capitalize text-success">
         <a href="doctors.php" class="text-decoration-none">Doctors</a> >> Doctor Name
       </p>
      <hr>
      <form class="contact-form mt-5">
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Name</label>
            <input type="text" id="fullName" class="form-control" placeholder="Full name..">
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">Email</label>
            <input type="email" id="emailAddress" class="form-control" placeholder="Email address..">
          </div>
             <div class="col-sm-12 py-2 wow fadeInRight">
            <label for="phoneNo">Phone No</label>
            <input type="number" id="phoneNo" class="form-control" placeholder="Phone No..">
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="AppointmentDate">Date</label>
            <input type="date" id="AppointmentDate" class="form-control">
          </div>
           <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="AppointmentTime">Time</label>
            <input type="time" id="AppointmentTime" class="form-control">
          </div>
          <div class="col-sm-12 py-2 wow fadeInRight">
            <label for="Address">Address</label>
            <input type="text" id="Address" class="form-control" placeholder="Enter Address..">
          </div>

          <div class="col-12 py-2 wow fadeInUp">
            <label for="illness">illness</label>
            <select name="illness" id="illness" class="form-control">
              <option value="">Choose Your illness</option>
              <option value="Colds and Flu">Colds and Flu</option>
              <option value="Allergies">Allergies</option>
              <option value="Stomach Aches">Stomach Aches.</option>
              <option value="Diarrhea">Diarrhea</option>
              <option value="Headaches">Headaches</option>
              <option value="other">Other</option>
            </select>
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="message">More</label>
            <textarea id="message" class="form-control" rows="8" placeholder="More About Your illness.."></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Book Now</button>
      </form>
    </div>
  </div>
      ';
} else {
  echo '<script>window.location.href=doctors.php</script>';
}
?>



<!-- <?php
include "includes/footer.php";
?> -->