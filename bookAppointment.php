<?php
include "includes/header.php";
include "includes/usernavbar.php";
?>

<?php
include 'connection/connection.php';
$doctorName;
$doctorEmail;
$doctorSpecialization;
// Assuming you have a 'did' parameter in the URL
if (isset($_GET['id'])) {
    $doctorId = $_GET['id'];

    // Query to retrieve the doctor's information
    $doctorQuery = "SELECT * FROM doctor WHERE did = '$doctorId'";
    $doctorResult = mysqli_query($con, $doctorQuery);

    // Check if the query was successful
    if ($doctorResult) {
        // Fetch the doctor's information
        $doctorData = mysqli_fetch_assoc($doctorResult);
        
        // Check if the doctor was found
        if ($doctorData) {
            $doctorName = $doctorData['docname'];
            $doctorEmail = $doctorData['email'];
            $doctorSpecialization = $doctorData['role'];

        }
    }
}
?>


<div class=" bg-image"
    style="background-image: url(https://img.freepik.com/free-vector/flat-hand-drawn-hospital-reception-scene_52683-54613.jpg?w=1060&t=st=1706131078~exp=1706131678~hmac=19c02b6aaccbcf7cdd18977bd2c5585ff11a8128a57fd799ae25c428fd09919e;">
    <div class="page-section">
        <div class="container"
            style="background-color: #e1e0e0; border: 10%; padding-top: 30px; padding-left: 30px; padding-right: 30px; padding-bottom: 30px; backdrop-filter: blur(8px); border-radius: 15px;">
            <p class="text-start text-capitalize text-success">
                <a href="doctors.php" class="text-decoration-none">Doctors </a> Dr. 
                <?= $doctorName; ?> 

            </p>
            <hr>
            <form class="contact-form mt-5" method="post">
                <div class="row mb-3">
                    <div class="col-sm-6 py-2 wow fadeInRight">
                        <label for="AppointmentDate">Date</label>
                        <input type="date" name="AppointmentDate" class="form-control" required>
                    </div>
                    <div class="col-sm-6 py-2 wow fadeInRight">
                        <label for="AppointmentTime">Time</label>
                        <input type="time" name="AppointmentTime" class="form-control" required>
                    </div>
                    <div class="col-12 py-2 wow fadeInUp">
                        <label for="illness">illness</label>
                        <select name="illness" name="illness" class="form-control" required>
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
                        <textarea name="message" class="form-control" rows="8"
                            placeholder="More About Your illness.." required></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary wow zoomIn">Book Now</button>
            </form>
        </div>
    </div>
</div>

</body>

</html>

<?php

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get values from the form
    $userEmail = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '';  // Assuming you get this from local storage
    $docEmail = $doctorEmail;   // Assuming you get this from the previous query
    $docName = $doctorName;     // Assuming you get this from the previous query
    $docSpecialization = $doctorSpecialization;  // Assuming you get this from the previous query
    $rdate = $_POST['AppointmentDate'];
    $rtime = $_POST['AppointmentTime'];
    $illness = $_POST['illness'];
    $detail = $_POST['message'];

    // Check if the user has already booked an appointment
    $checkQuery = "SELECT * FROM user_request WHERE user_email = '$userEmail' AND doc_email = '$docEmail' ";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // User has already booked an appointment
        echo '<script>alert("You have already booked an appointment with this doctor.");</script>';
    } else {
        // Insert data into the user_request table
        $insertQuery = "INSERT INTO user_request (user_email, doc_email,doc_name,doc_role, rdate, rtime, illness, detail) 
                        VALUES ('$userEmail', '$docEmail','$docName','$docSpecialization', '$rdate', '$rtime', '$illness', '$detail')";

        $result = mysqli_query($con, $insertQuery);

        if ($result) {
            // Success: Redirect or show a success message
            echo '<script>alert("Appointment booked successfully.");</script>';
        } else {
            // Error: Show an error message
            echo '<script>alert("Error booking appointment. Please try again.");</script>';
        }
    }
}
?>
