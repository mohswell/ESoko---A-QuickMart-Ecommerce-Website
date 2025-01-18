<?php
// Start the session
session_start();
// Include PHPMailer autoloader
require '../vendor/autoload.php';

// Create a PHPMailer instance
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "swiss_collection";

// Create connection to loginsystem database
$loginsystem_connection = new mysqli($servername, $username, $password, "loginsystem");

// Check connection
if ($loginsystem_connection->connect_error) {
    die("Connection to loginsystem database failed: " . $loginsystem_connection->connect_error);
}

// Get user details from session
$user_id = $_SESSION['user_id'];

// Fetch first and last name from users table in loginsystem database
$query = "SELECT first_name, last_name FROM users WHERE user_id = ?";
$stmt = $loginsystem_connection->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($first_name, $last_name);
$stmt->fetch();
$stmt->close();

// Close connection to loginsystem database
$loginsystem_connection->close();

// Check if email is provided
if (isset($_POST['email'])) {
    // Sanitize and validate the email address
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    // Check if email is valid
    if ($email) {

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();                                      // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                 // SMTP server
            $mail->SMTPAuth   = true;                             // Enable SMTP authentication
            $mail->Username   = 'mohslaw10@gmail.com';            // SMTP username
            $mail->Password   = 'nopassword';               // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                              // TCP port to connect to

            // Recipients
            $mail->setFrom('mohslaw10@gmail.com', 'Muhammad Said');
            $mail->addAddress($email, $first_name . ' ' . $last_name);  // Add a recipient


            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Welcome to ESoko!';
            $mail->Body    = 'Dear ' . $first_name . ',
            Quickmart LTD
            Discover Freshness: Your Personalized Agricultural Experience Awaits 🌾

            Welcome to ESoko, where every harvest is tailored to your needs! Dive into an agricultural experience crafted just for you. 
            
            From organic produce to farming essentials, explore a world of freshness personalized to your requirements.

            Unlock exclusive deals just for you! 🎁 Don\'t miss out on this week\'s bountiful offers. Experience agricultural convenience on the go! 
            
            Our mobile-friendly interface ensures you access the freshest produce and essential farming tools wherever you are.

            Embark on an agricultural journey like no other. With personalized recommendations, unbeatable deals, and a community of farming enthusiasts, your agricultural adventure starts here at ESoko. 
            
            Happy harvesting! 🌱';

            // Send email
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Create connection to swiss_collection database
        $swiss_collection_connection = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($swiss_collection_connection->connect_error) {
            die("Connection to swiss_collection database failed: " . $swiss_collection_connection->connect_error);
        }

        // Insert user details into mailing list
        $sql = "INSERT INTO mailing_list (user_id, first_name, last_name, email) VALUES (?, ?, ?, ?)";
        $stmt = $swiss_collection_connection->prepare($sql);
        $stmt->bind_param("isss", $user_id, $first_name, $last_name, $email);

        if ($stmt->execute()) {
            // Redirect back to the page with a success message
            header("Refresh: 0.5; URL=http://localhost/Esoko/MyProject/index.php?subscribe=success");
            exit();
        } else {
            // Error handling if insertion fails
            echo "Error: " . $sql . "<br>" . $swiss_collection_connection->error;
        }

        // Close connection to swiss_collection database
        $swiss_collection_connection->close();
    } else {
        // Handle invalid email
        echo "Invalid email address!";
    }
} else {
    // Redirect back if the form is not submitted
    header("Location: index.php");
    exit();
}
?>
