<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor | Sign Up</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: inline-block;
      width: 150px;
      /* Adjust the width based on your design preference */
    }

    .input {
      width: 200px;
      /* Adjust the width of the input field */
    }
  </style>

</head>

<body>
  <div class="content">
    <div class="SignUp-Container">
      <p class="title">Register For New Doctor</p>
      <form class="form" method="POST">

        

        <div class="form-group">
          <label for="docname">Doctor's Name:</label>
          <div class="form-items">
            <input type="text" class="input" name="docname" id="docname" placeholder="Enter Your Name.." 
              required>
          </div>
        </div>

        <div class="form-group">
          <label for="mno">Mobile Number:</label>
          <div class="form-items">
            <input type="number" class="input" name="mno" id="mno" placeholder="Enter Your Mobile No.." 
              required>
          </div>
        </div>
        <div class="form-group">
          <label for="hname">Gender:</label>
          <select name="hname"  class="form-items" required>
            <option value="">Choose Gender..</option>
            <option value="Male">Male</option>
            <option value="FeMale">Female</option>
          </select>
        </div>
        <div class="form-group">
          <label for="specilization">Doctor's Specialization:</label>
          <select name="role"  class="form-items" required>
            <option value="">Choose specilization..</option>
            <option value="Skin & Hair">Skin & Hair</option>
            <option value="Child Specialist">Child Specialist</option>
            <option value="General Physician">General Physician</option>
            <option value="Dental Care">Dental Care</option>
            <option value="Ear Nose Throat">Ear Nose Throat</option>
            <option value="Homoeopathy">Homoeopathy</option>
            <option value="Bone and joints">Bone and joints</option>
          </select>
        </div>

        <div class="form-group">
          <label for="experience">Years of Experience:</label>
          <div class="form-items">
            <input type="number" class="input" name="experience" id="experience"
              placeholder="Enter your Experience in years" required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items">
            <input type="email" class="input" name="email" placeholder="Enter Your Email.." 
              required>
          </div>
        </div>

        <div class="form-group">
          <div class="form-items position-relative">
            <input type="password" class="input" name="password" placeholder="Enter Password.."  required>
            <span class="passEye"><i class="fa-solid fa-eye"></i></span>
          </div>
          <div class="form-items">
            <input type="password" class="input" name="rpassword" placeholder="Re-Enter Password.." 
              required>
          </div>
        </div>

        <input class="form-btn" type="submit" name="submit" value="Sign Up" />
      </form>

      <div class="SignUpText">
        <a href="doctorsignIn.php" class="sign-up-label">If You Already Have A Account !<span class="sign-up-link">Sign
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

if (isset($_POST['submit'])) {
  $hname = $_POST['hname'];
  $docname = $_POST['docname'];
  $mno = $_POST['mno'];
  $experience = $_POST['experience'];
  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rpassword = $_POST['rpassword'];

  if ($password == $rpassword) {
    // Check if the email already existsfdsa
    $emailCheckQuery = "SELECT * FROM doctor WHERE email = '$email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);

    if (mysqli_num_rows($emailCheckResult) > 0) {
      // Email already exists, show alert
      echo '<script>alert("Email already exists. Please use a different email.");</script>';
    } else {
      // Email is unique, proceed with insertion
      $doctorEntry = "INSERT INTO doctor(hname, docname, mno, role, experience, email, pass) VALUES ('$hname', '$docname', '$mno', '$role', '$experience', '$email', '$password')";
      $result = mysqli_query($con, $doctorEntry);

      if ($result) {
        ?>
        <script>
          alert('Doctor registered successfully');
          // redirect to sign in page
          window.location.href = 'doctorsignIn.php';
        </script>
      <?php
      } else {
        echo '<script>alert("Something went wrong. Please try Again");</script>';
      }
    }
  } else {
    echo '<script>alert("Password Not Matched");</script>';
  }
}
?>


