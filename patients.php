<?php
include "includes/header.php";
include "includes/navbar.php";
?>
<div class="page-banner overlay-dark bg-image" style="background-image: url(assets/img/bg_image_1.jpg);">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <h1 class="font-weight-normal">Your Patients </h1>
    </div>
  </div>
</div>

<div class="page-section">
  <?php
  include 'connection/connection.php';
    //get '$doctor_email'  from cokkie
    $doctor_email = $_COOKIE['doc_email'];
   
    if ($doctor_email != "") {
      // Query to retrieve user appointments
      $query = "SELECT * FROM user_request WHERE doc_email = '$doctor_email' AND status='Accepted'";
      $result = mysqli_query($con, $query);
      
      if ($result) {
      if (mysqli_num_rows($result) > 0) {
        echo '
            <div class="card appointment h-100">
                <div class="card-header py-3">
                    <a class="ms-auto text-decoration-none text-dark">Your Patients</a>
                </div>
                <div class="card-body p-2 mt-2 text-capitalize">
                    <div class="table-responsive position-relative">
                        <table class="table table-bordered border" id=""  cellspacing="1">
                            <thead>
                                <tr class="bg-light">
                                    <th>No</th>
                                    <th>Appointment Id</th>
                                    <th>Patient email</th>
                                    <th>illness Details</th>
                                    <th>Date</th>
                                    <th>Actions </th>
                                </tr>
                            </thead>
                            <tbody>';

        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
                <tr>
                    <td>' . $counter . '</td>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['user_email'] . '</td>
                    <td>' . $row['detail'] . '</td>
                    <td>
                        <span>' . $row['rdate'] . '</span>
                        <span>' . $row['rtime'] . '</span>
                    </td>
                    <td>
                    <span class="btn btn-danger"><a class="btn" href="reject_user.php?aid='. $row['id'] .'">Delete</a></span>
                    </td>
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
        echo "<span class='text-uppercase p-4'>No Patients Found.</span>";
      }
    }
    } else {
      echo "<span class='text-uppercase p-4'>Doctor Not Found..</span>";
    }

?>
</div>


<!-- <?php
include "includes/footer.php";
?> -->