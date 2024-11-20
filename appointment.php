<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>
<div class="page-banner overlay-dark bg-image" style="background-image: url(assets/img/bg_image_1.jpg);">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <h1 class="font-weight-normal">Check Your Appointment</h1>

      <div class="SearchDoctor">
        <form action="appointment.php" method="get">
          <input type="text" name="email" id="" placeholder="Enter Doctors Email">
          <button type="submit" name="SearchAppointment">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="page-section">
  <?php
  include 'connection/connection.php';
  if (isset($_GET['SearchAppointment'])) {
    $Email = $_GET['email'];
    //get '$user_email'  from cokkie
    $user_email = $_COOKIE['user_email'];
   
    if ($Email != "") {
      // Query to retrieve user appointments
      $query = "SELECT * FROM user_request WHERE doc_email = '$Email' AND user_email = '$user_email'";
      $result = mysqli_query($con, $query);
      
      if ($result) {
      if (mysqli_num_rows($result) > 0) {
        echo '
            <div class="card appointment h-100">
                <div class="card-header py-3">
                    <a class="ms-auto text-decoration-none text-dark">Your Appointments</a>
                </div>
                <div class="card-body p-2 mt-2 text-capitalize">
                    <div class="table-responsive position-relative">
                        <table class="table table-bordered border" id="" width="100%" cellspacing="1">
                            <thead>
                                <tr class="bg-light">
                                    <th>No</th>
                                    <th>Appointment Id</th>
                                    <th>Doctor Name</th>
                                    <th>Specialist</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>';

        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
                <tr>
                    <td>' . $counter . '</td>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['doc_name'] . '</td>
                    <td>' . $row['doc_role'] . '</td>
                    <td>
                        <span>' . $row['rdate'] . '</span><br>
                        <span>' . $row['rtime'] . '</span>
                    </td>
                    <td>' . $row['status'] . '</td>
                </tr>';
          $counter++;
        }

        echo '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>';
      } else {
        echo "<span class='text-uppercase p-4'>No Appointments Found.</span>";
      }
    }
    } else {
      echo "<span class='text-uppercase p-4'>Not Found..</span>";
    }
  } else {
    echo '<script>window.location.href=appointment.php</script>';
  }
  ?>

</div>


<!-- <?php
include "includes/footer.php";
?> -->