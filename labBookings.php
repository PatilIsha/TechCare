<?php
include "includes/header.php";
include "includes/navbar.php";
?>
<div class="page-banner overlay-dark bg-image" style="background-image: url(assets/img/bg_image_1.jpg);">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <h1 class="font-weight-normal">Check Lab Bookings</h1>
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
      $query = "SELECT * FROM labdetails";
      $result = mysqli_query($con, $query);
      
      if ($result) {
      if (mysqli_num_rows($result) > 0) {
        echo '
            <div class="card appointment h-100">
                <div class="card-header py-3">
                    <a class="ms-auto text-decoration-none text-dark">Ambulance bookings</a>
                </div>
                <div class="card-body p-2 mt-2 text-capitalize">
                    <div class="table-responsive position-relative">
                        <table class="table table-bordered border" id=""  cellspacing="1">
                            <thead>
                                <tr class="bg-light">
                                    <th>No</th>
                                    <th>Booking  Id</th>
                                    <th>User email</th>
                                    <th>User Name</th>
                                    <th>Lab Email</th>
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
                    <td>' . $row['fullName'] . '</td>
                    
                    <td>
                    ' . $row['lab_email'] . '
                    </td>
                    <td>
                    <span class="btn btn-danger"><a class="btn" href="delete_labbooking.php?bid='. $row['id'] .'">Delete</a></span>
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
        echo "<span class='text-uppercase p-4'>No Bookings are Found.</span>";
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