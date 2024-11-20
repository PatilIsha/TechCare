<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>

<style>
.card-img{
    height:150px;
    width:150px;
    opacity:0.6;
}
.card-img:hover{
    opacity:1;
}

</style>
<div class="d-flex justify-content-center align-items-center" style="min-height:100vh">
<?php
if (isset($_COOKIE['user_email'])) {?>
    <div class="ambulance mx-2">
        <a href="ambulance.php" class="text-decoration-none">
            <div class="card p-2 text-center">
                 <img src="assets/img/ambulance.png" class="card-img" alt="">
                 <h2>Ambulance</h2>
            </div>
        </a>
    </div>
     <div class="Lab mx-2">
        <a href="testLab.php" class="text-decoration-none">
            <div class="card p-2 text-center">
                 <img src="assets/img/lab.png" class="card-img" alt="">
                 <h2>Test Lab</h2>
            </div>
        </a>
    </div>
    <?php
    } else{ echo "<a href='index.php'><h1>Login To Continue</h1></a>";}?>
       
</div>


<?php
   include "includes/footer.php";
?>