<?php
include "includes/header.php";
if (isset($_COOKIE['user_email'])) {
  // Redirect to user dashboard
  header('Location: userdashboard.php');
  exit();
}

// Check for the "doc_email" cookie
if (isset($_COOKIE['doc_email'])) {
  // Redirect to doctor dashboard
  header('Location:dashboard.php');
  exit();
if($_GET(userlogout)){
  unset($_COOKIE['user_email']);
  header('Location: index.php'); 
  exit();
}
if($_GET(doctorlogout)){
  unset($_COOKIE['doc_email']);
  header('Location: index.php'); 
  exit();
}
}
?>



<header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">Tech</span>Care</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#AboutusSection">About Us</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="signUp.php">User Logins</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="doctorsignup.php">Doctor Logins</a>
            </li>
          </ul>
        </div> 
      </div> 
    </nav>
  </header>
  <div class="page-hero bg-image overlay-dark" style="background-image: url(assets/img/bg_image_1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">Let's make your life happier</span>
        <h1 class="display-4">Welcome to <strong>Tech</strong>Care</h1>
        <a href="signUp.php" class="btn btn-primary">Get's Appointment</a>
      </div>
    </div>
  </div>

   <div class="page-section" id="AboutusSection">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 wow fadeInUp">
          <h1 class="text-center mb-3">Welcome to Your Health Center</h1>
          <div class="text-lg">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt neque sit, explicabo vero nulla animi nemo quae cumque, eaque pariatur eum ut maxime! Tenetur aperiam maxime iure explicabo aut consequuntur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt neque sit, explicabo vero nulla animi nemo quae cumque, eaque pariatur eum ut maxime! Tenetur aperiam maxime iure explicabo aut consequuntur.</p>
            <p>Expedita iusto sunt beatae esse id nihil voluptates magni, excepturi distinctio impedit illo, incidunt iure facilis atque, inventore reprehenderit quidem aliquid recusandae. Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium quod ad sequi atque accusamus deleniti placeat dignissimos illum nulla voluptatibus vel optio, molestiae dolore velit iste maxime, nobis odio molestias!</p>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="about">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Your <i class="fa fa-h-square"></i><span class="text-uppercase text-danger">ospital Name</span></h2>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                               <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptate ad sed iste unde, expedita voluptatibus ipsum dolorum odit mollitia accusamus aspernatur quas reiciendis tempore tenetur recusandae distinctio eveniet eius ut pariatur quaerat ipsam! Obcaecati illo maxime, quod non culpa voluptatem tempore ad nihil, reprehenderit ipsa repudiandae officia accusantium. Illum, placeat.</p>
                              </div>
                         </div>
                    </div>
                    
               </div>
          </div>
  </div>


  <!-- tstimonial corosel -->
  <div id="testimonial-carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="testimonial text-center">
            <p class="mb-4">"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante."</p>
            <p class="text-muted">- John Doe</p>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="testimonial text-center">
            <p class="mb-4">"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas."</p>
            <p class="text-muted">- Jane Doe</p>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="testimonial text-center">
            <p class="mb-4">"Nulla vitae elit libero, a pharetra augue. Donec ullamcorper nulla non metus auctor fringilla."</p>
            <p class="text-muted">- Jessica Smith</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#testimonial-carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#testimonial-carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<?php
  include "includes/footer.php";
?>