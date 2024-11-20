<?php
// Include your database connection file if needed
include 'connection/connection.php';

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the ID parameter is set in the URL
if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];

    // Fetch user's email address from the database
    $getEmailQuery = "SELECT * FROM user_request WHERE id = $aid";
    $getEmailResult = mysqli_query($con, $getEmailQuery);

    if ($getEmailResult && mysqli_num_rows($getEmailResult) > 0) {
        $row = mysqli_fetch_assoc($getEmailResult);
        $user_email = $row['user_email'];
        $doc_name=$row['doc_name'];
        $rdate=$row['rdate'];
        $rtime=$row['rtime'];
        $doc_role=$row['doc_role'];
        $illness=$row['illness'];

        // Update the status of the user request to "accepted" in the database
        $updateQuery = "UPDATE user_request SET status = 'Accepted' WHERE id = $aid";
        $updateResult = mysqli_query($con, $updateQuery);

        if ($updateResult) {
            // Send email to the user using PHPMailer
            $mail = new PHPMailer(true); // Passing true enables exceptions

            try {
                $mail->isSMTP();
                // SMTP configuration
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'aadiipatil10z@gmail.com'; // Replace with your Gmail email address
                $mail->Password = 'bbnl lppt pnvj ahdg'; // Replace with your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Sender and recipient settings
                $mail->setFrom('aadiipatil10z@gmail.com', 'Tech Care'); // Replace with your Gmail email address and name
                $mail->addAddress($user_email); // Add recipient email

                // Email content
                $mail->isHTML(true);
                $mail->Subject = "Your request has been accepted";
                $mail->Body = "
    <html>
    <head>
        <style>
            /* Add your custom styles here */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                color: #333;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                color: #007BFF;
            }
            /* Add more styles as needed */
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Your Request Approvel Details</h2>
            <p>Dear User,</p>
            <p>Your request has been accepted with the following details:</p>
            <ul>
                <li><strong>Doctor Name:</strong> $doc_name </li>
                <li><strong>Date and Time:</strong> $rdate <span>$rtime</span></li>
                <li><strong>Doctor Speciality:</strong> $doc_role</li>
                <li><strong> Illiness:</strong> $illness</li>
            </ul>
            <p>Thank you for choosing our Doctor service!</p>
        </div>
    </body>
    </html>
";                // Send email
                $mail->send();
                
                // Redirect back to the patient_request page
                header("Location: patient_request.php");
                exit();
            } catch (Exception $e) {
                echo "Error sending email: " . $mail->ErrorInfo;
            }
        } else {
            echo "Status not updated";
        }
    } else {
        echo "User with the provided ID not found.";
    }
} else {
    // Handle case where ID parameter is not set
    // Redirect back to the patient_request page or show an error message
    header("Location: error.php");
}

