<?php
// Include your database connection file if needed
include 'connection/connection.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['bid'])) {
    $BookingID = $_GET['bid'];

    // Update the status of the user request to "accepted" in the database
    // Example SQL query (replace with your actual query):
    $query = "DELETE FROM bookingdetails WHERE BookingID = $BookingID";
    $result = mysqli_query($con, $query);
    if ($result) {
        // Redirect back to the patient_request page
        ?><script>alert('Booking has been Deleted');</script>"<?php
        header("Location: ambulance_booking.php");
        exit();
    } else {
        echo "Status not updated";
    }
} else {
    // Handle case where ID parameter is not set
    // Redirect back to the patient_request page or show an error message
    header("Location:error.php");
}
