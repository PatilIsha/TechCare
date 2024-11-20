<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>

<div class="page-banner overlay-dark bg-image" style="background-image: url(assets/img/bg_image_1.jpg);">
  <div class="banner-section">
    <div class="container text-center wow fadeInUp">
      <h1 class="font-weight-normal">Book Ambulance</h1>
    </div>
  </div>
</div>


<?php
// Assuming you have a database connection established
include 'connection/connection.php';

$query = "SELECT * FROM labs";
$result = mysqli_query($con, $query);

// Check and display data
if ($result) {
  echo '<div class="team">';
  echo '<div class="container">';
  echo '<div class="row">';

  while ($row = mysqli_fetch_assoc($result)) {
    echo '
        <div class="col-md-4 col-sm-6">
            <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                <img src="assets/img/lab.png" class="img-responsive" alt="">
                <div class="team-info">
                <h3 class="my-0"> ' . $row['lab_name'] . '</h3>
                <div class="">
                  <p class="my-1"><i class="fa fa-phone"></i> ' . $row['lab_mo'] . '</p>
                  <p class="my-1"><i class="fa fa-envelope"></i> <a href="#" class="text-decoration-none">' . $row['lab_email'] . '</a></p>
                </div>
                <div class="team-contact-info my-0">
                    <a href="booktestLab.php?id=' . $row['lab_id'] . '" class="text-decoration-none">Book Now <i class="fa fa-arrow-right"></i></a>
                </div>
                
           </div>
            </div>
        </div>';
  }

  echo '</div>';
  echo '</div>';
  echo '</div>';
} else {
  echo "Error in the query: " . mysqli_error($con);
}

?>
<?php
include "includes/footer.php";
?>