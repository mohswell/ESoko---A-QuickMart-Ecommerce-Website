<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate form data (optional)
    if (empty($name) || empty($email) || empty($message)) {
        // Handle validation errors
        echo "Please fill in all fields.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email
        echo "Please enter a valid email address.";
        exit;
    }

    // Connect to MySQL database (replace 'localhost', 'username', 'password', 'database' with your actual values)
    $conn = new mysqli('localhost', 'root', '', 'swiss_collection');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert message into messages table
    $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Message stored successfully
        echo "Message sent successfully.";
        // Redirect after a delay using JavaScript
        echo "<script>
                setTimeout(function() {
                    window.location.href = '../contact.html';
                }, 50); // 50 milliseconds delay (0.05 seconds)
            </script>";
    } else {
        // Error occurred while storing message
        echo "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted via POST method, redirect or handle as needed
    echo "Form not submitted.";
}
?>
