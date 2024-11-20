<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's-Appointement | Sign In</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="content">
        <div class="SignIn-container">

            <p class="title">Doctor Login</p>
            <form class="form" action="#" method="post">
                <div class="form-items">
                    <input type="email" class="input" name="username" placeholder="Enter Your Username..">
                </div>

                <div class="form-items">
                    <input type="password" class="input" name="password" placeholder="Enter Your Password..">
                    <span class="passEye"><i class="fa fa-eye"></i></span>
                </div>

                <a href="forgetPassword.php" class="page-link" style="border:none;background:none"><span
                        class="page-link-label">Forgot Password?</span></a>
                <input class="form-btn" type="submit" name="submit" value="Sign In" />
            </form>

            <div class="SignInText">
                <a href="doctorsignup.php" class="sign-up-label">
                    Don't have an account?<span class="sign-up-link">Sign up</span>
                </a>
            </div>

        </div>
    </div>


    <script>
        passwordeyebtn = document.querySelector(".form-items .passEye i");
        const passtext = document.querySelector(".SignIn-container .form-items input[type='password']");

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
    $username = $_POST['username'];
    $password = $_POST['password'];

    $findDoctor = "select * from doctor where email='$username' and pass='$password'";
    $result = mysqli_query($con, $findDoctor);
    $num = mysqli_num_rows($result);
    if ($num) {
        $doctoremail = $username;
        setcookie('doc_email', $doctoremail, time() + (86400 * 7), '/');
        //redirect to home page
        header('location:dashboard.php');
        exit();
    } else {
        ?>
        <script>alert('Incorrect Credentials');</script>
        <?php
    }
}

?>