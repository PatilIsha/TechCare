<?php
// Include your database connection file if needed
include 'connection/connection.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];

    // Update the status of the user request to "accepted" in the database
    // Example SQL query (replace with your actual query):
    $query = "DELETE FROM user_request WHERE id = $aid";
    $result = mysqli_query($con, $query);
    if ($result) {
        // Redirect back to the patient_request page

        header("Location: patient_request.php");
        exit();
    } else {
        echo "Status not updated";
    }
} else {
    // Handle case where ID parameter is not set
    // Redirect back to the patient_request page or show an error message
    header("Location:error.php");
}
