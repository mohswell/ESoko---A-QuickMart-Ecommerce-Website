<?php
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
    $password = $_POST['password'];
    $ship_different_address = isset($_POST['ship_different_address']) ? 1 : 0;
    $order_notes = $_POST['order_notes'];
    $payment_method = $_POST['selected_payment_method'];
    $total = $_POST['total'];

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
    $sql = "INSERT INTO orders (delivered_to, phone_no, delivery_address, payment_method, order_notes, total, delivery_apartment)
            VALUES ('$first_name $last_name', '$phone', '$address $apartment, $city', '$payment_method', '$order_notes', '$total', '$apartment')";

    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id; // Get the ID of the inserted order

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

        echo "Order placed successfully!";
    } else {
        echo "Error inserting into orders: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Form not submitted.";
}
?>
