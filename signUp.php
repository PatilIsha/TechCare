<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor's-Appointement | Sign Up</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="content" >
    <div class="SignUp-Container">
      <p class="title">Register For New User</p>
      <form class="form" method="POST">

        <div class="form-group">
          <div class="form-items">
            <input type="text" class="input" name="hname" placeholder="Enter Your Hospital Name.."  required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items">
            <input type="text" class="input" name="ownerName" placeholder="Enter Your Owner Name.." required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items">
            <input type="date" class="input" name="dob" required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items">
            <input type="email" class="input" name="email" placeholder="Enter Your Email.." required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items">
            <input type="number" class="input" name="mno" placeholder="Enter Your Mobile No.." required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items">
            <input type="text" class="input" name="address" placeholder="Enter Your Address.." required>
          </div>
          <div class="form-items">
            <input type="text" class="input" name="address" placeholder="Enter Your Address.." value="Dhule" disabled>
          </div>
        </div>



        <div class="form-group">
          <div class="form-items position-relative">
            <input type="password" class="input" name="password" placeholder="Enter Password.." required>
            <span class="passEye"><i class="fa-solid fa-eye"></i></span>
          </div>
          <div class="form-items">
            <input type="password" class="input" name="rpassword" placeholder="Re-Enter Password.." required>
          </div>
        </div>

        <input class="form-btn" type="submit" name="submit" value="Sign Up" />
      </form>

      <div class="SignUpText">
        <a href="signIn.php" class="sign-up-label">If You Already Have A Account !<span class="sign-up-link">Sign
            In</span></a>
      </div>

    </div>
  </div>


  <script>
    passwordeyebtn = document.querySelector(".SignUp-Container .form-items .passEye i");
    const passtext = document.querySelector(".form-group .form-items input[type='password']");

    passwordeyebtn.onclick = () => {
      if (passtext.type == 'password') {
        passtext.type = 'text';
      } else {
        passtext.type = 'password';
      }
    }
  </script>
</body>

</html>

<?php
include 'connection/connection.php';
if(isset($_POST['submit']))
{
    $hname=$_POST['hname'];
    $ownerName=$_POST['ownerName'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $mno=$_POST['mno'];
    $address=$_POST['address'];
    $password=$_POST['password'];
    $rpassword=$_POST['rpassword'];
    if($password==$rpassword)
    {
        $userEntry="insert into user(hospital_name, user_name, dob, mno, email, addr, pass) values ('$hname','$ownerName','$dob','$mno','$email','$address','$password')";
        $result=mysqli_query($con,$userEntry);
        if($result)
        {
            ?><script>
            alert('User registered successfully');
            // redirect to sign in page
            window.location.href = 'signIn.php';
        </script>
            <?php
           // redirect to sign in page
            // header('location:signIn.php');
        }
        else
        {
            ?>
            <script>alert('Data Not Inserted');</script>
            <?php
        }
    }
    else
    {
        ?><script>alert('Password Not Matched');</script>
        <?php
    }
}
?>