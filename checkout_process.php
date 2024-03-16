<?php
// Start session
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload.php
require './vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $apartment = $_POST['apartment'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $create_account = isset($_POST['create_account']) ? 1 : 0;
    $ship_different_address = isset($_POST['ship_different_address']) ? 1 : 0;
    $order_notes = $_POST['order_notes'];
    $payment_method = $_POST['selected_payment_method'];
    $total = $_POST['total'];

    // Set the total value from the form data FOR MPESA FUNCTIONALITY
    //$_SESSION['mpesaTotal'] = $total;

    $login_conn = new mysqli('localhost', 'root', '', 'loginsystem');
    // Fetch user ID from the database based on email
    $user_id = null;
    $user_query = "SELECT user_id FROM users WHERE email = '$email'";
    $user_result = $login_conn->query($user_query);
    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['user_id'];
    }

    // Retrieve cart items from the form
    $cart_items = json_decode($_POST['cartItems'], true);

    // Perform database insertions
    // Connect to your database (replace 'localhost', 'username', 'password', 'database' with your actual values)
    $conn = new mysqli('localhost', 'root', '', 'swiss_collection');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into orders table
    $sql = "INSERT INTO orders (user_id, delivered_to, phone_no, delivery_address, payment_method, order_notes, total, delivery_apartment)
            VALUES ('$user_id', '$first_name $last_name', '$phone', '$address $apartment, $city', '$payment_method', '$order_notes', '$total', '$apartment')";

    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id; // Get the ID of the inserted order

        // Update pay_status in orders table if payment method is mpesa
        if ($payment_method === 'MPesa') {
            $updatePayStatusSql = "UPDATE orders SET pay_status = 1 WHERE order_id = '$order_id'";
            if ($conn->query($updatePayStatusSql) !== TRUE) {
                echo "Error updating pay_status: " . $conn->error;
                exit; // Stop execution
            }
            echo "Pay status updated successfully";
        }

        // Construct SQL query for order_details insertion
        $order_details_sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ";
        foreach ($cart_items as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $order_details_sql .= "('$order_id', '$product_id', '$quantity', '$price'),";
        }
        // Remove the trailing comma from the SQL query
        $order_details_sql = rtrim($order_details_sql, ',');

        // Execute the SQL query for order_details insertion
        if ($conn->query($order_details_sql) !== TRUE) {
            echo "Error inserting into order_details: " . $conn->error;
            // Rollback the order insertion if there's an error
            $conn->query("DELETE FROM orders WHERE order_id = '$order_id'");
            exit; // Stop execution
        }

        //This is the part of updating quantity table based on order_details
        // Update the quantity in stock based on orders
        $updateQuantitySql = "UPDATE quantity q
            JOIN order_details od ON q.product_id = od.product_id
            SET q.quantity_in_stock = q.quantity_in_stock - od.quantity
            WHERE od.order_id = '$order_id'";

        if ($conn->query($updateQuantitySql) !== TRUE) {
            echo "Error updating quantity in stock: " . $conn->error;
            exit; // Stop execution
        }

        // Calculate total
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();                                      // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                 // SMTP server
            $mail->SMTPAuth   = true;                             // Enable SMTP authentication
            $mail->Username   = 'mohslaw10@gmail.com';            // SMTP username
            $mail->Password   = 'ckybzutjdcsgazli';               // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                              // TCP Port to connect to  

            // Recipients
            $mail->setFrom('mohslaw10@gmail.com', 'Quickmart Admin LTD');
            $mail->addAddress($email, $first_name . ' ' . $last_name); // Add a recipient
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Order Confirmation';

            // Build email body with order details in a table format
            $body = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">';
            $body .= '<div style="background-color: #f4f4f4; padding: 20px; text-align: center;">';
            $body .= '<h2 style="color: #333333;">Thank you for your order!</h2>';
            $body .= '</div>';
            $body .= '<div style="padding: 20px;">';
            $body .= '<table style="width: 100%; border-collapse: collapse;">';
            $body .= '<thead>';
            $body .= '<tr>';
            $body .= '<th style="border-bottom: 1px solid #dddddd; padding: 10px 0; text-align: left;">Product</th>';
            $body .= '<th style="border-bottom: 1px solid #dddddd; padding: 10px 0; text-align: left;">Price</th>';
            $body .= '<th style="border-bottom: 1px solid #dddddd; padding: 10px 0; text-align: left;">Quantity</th>';
            $body .= '<th style="border-bottom: 1px solid #dddddd; padding: 10px 0; text-align: left;">Total</th>';
            $body .= '</tr>';
            $body .= '</thead>';
            $body .= '<tbody>';
            foreach ($cart_items as $item) {
                $body .= '<tr>';
                $body .= '<td style="border-bottom: 1px solid #dddddd; padding: 10px 0;">' . $item['name'] . '</td>';
                $body .= '<td style="border-bottom: 1px solid #dddddd; padding: 10px 0;">' . $item['price'] . '</td>';
                $body .= '<td style="border-bottom: 1px solid #dddddd; padding: 10px 0;">' . $item['quantity'] . '</td>';
                $body .= '<td style="border-bottom: 1px solid #dddddd; padding: 10px 0;">' . ($item['price'] * $item['quantity']) . '</td>';
                $body .= '</tr>';
            }
            $body .= '</tbody>';
            $body .= '</table>';
            $body .= '<div style="text-align: right; margin-top: 20px;">';
            $body .= '<p style="font-size: 18px; font-weight: bold;">Total: Ksh' . number_format($total, 2) . '</p>';
            $body .= '</div>';
            $body .= '</div>';
            $body .= '</div>';

            $mail->Body = $body;


            $mail->send();
            // Redirect to the invoice page
            header("Location: invoice.php?order_id=$order_id");

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error inserting into orders: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Form not submitted.";
}
?>