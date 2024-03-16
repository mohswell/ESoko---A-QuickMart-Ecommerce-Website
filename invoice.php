<?php
include 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .invoice {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 800px;
            padding: 30px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }
        .invoice-details p {
            margin-bottom: 5px;
            color: #555;
            font-size: 16px;
        }
        .invoice-table {
            margin-top: 20px;
        }
        .invoice-table table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-table th, .invoice-table td {
            padding: 12px 15px;
            text-align: left;
        }
        .invoice-table th {
            background-color: #f8f9fa;
            color: #555;
            font-weight: normal;
        }
        .invoice-table td {
            border-top: 1px solid #ddd;
            color: #333;
        }
        .total-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice">
            <div class="invoice-header">
                <h1>Invoice</h1>
            </div>
            <div class="invoice-details">
                <!-- PHP code to retrieve and display order details -->
                <?php
                // Retrieve order details from the database based on the order_id in the URL parameter
                $order_id = $_GET['order_id']; // Sanitize this input before using it in a SQL query
                // Perform a SQL query to retrieve order details with product names
                $order_details_query = "SELECT * FROM orders WHERE order_id = '$order_id'";
                $order_details_result = $conn->query($order_details_query);
                if ($order_details_result->num_rows > 0) {
                    $order_details_row = $order_details_result->fetch_assoc();
                    // Output order details in HTML
                    echo "<p><strong>Order ID:</strong> " . $order_details_row['order_id'] . "</p>";
                    echo "<p><strong>Delivered To:</strong> " . $order_details_row['delivered_to'] . "</p>";
                    echo "<p><strong>Phone:</strong> " . $order_details_row['phone_no'] . "</p>";
                    echo "<p><strong>Delivery Address:</strong> " . $order_details_row['delivery_address'] . "</p>";
                    echo "<p><strong>Payment Method:</strong> " . $order_details_row['payment_method'] . "</p>";
                    echo "<p><strong>Order Notes:</strong> " . $order_details_row['order_notes'] . "</p>";
                }
                ?>
            </div>
            <div class="invoice-table">
                <h4>Order Items</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP code to retrieve and display order items -->
                        <?php
                        // Perform a SQL query to retrieve order items with product names
                        $order_items_query = "SELECT od.quantity, od.price, p.product_name 
                                              FROM order_details od 
                                              INNER JOIN product p ON od.product_id = p.product_id 
                                              WHERE od.order_id = '$order_id'";
                        $order_items_result = $conn->query($order_items_query);
                        if ($order_items_result->num_rows > 0) {
                            while ($order_item_row = $order_items_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $order_item_row['product_name'] . "</td>";
                                echo "<td>$" . number_format($order_item_row['price'], 2) . "</td>";
                                echo "<td>" . $order_item_row['quantity'] . "</td>";
                                echo "<td>$" . number_format($order_item_row['price'] * $order_item_row['quantity'], 2) . "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>    
            </div>
            <div class="total-section text-right">
                <?php if(isset($order_details_row)): ?>
                    <p><strong>Total:</strong> $<?php echo number_format($order_details_row['total'], 2); ?></p>
                <?php else: ?>
                    <p><strong>Total:</strong> $0.00</p> <!-- Or any default value you prefer -->
                <?php endif; ?>
            </div>
            <div class="download-btn text-center">
                <a href="controller/generate_invoice.php?order_id=<?php echo $order_id; ?>" class="btn btn-primary">Download Invoice</a>
                <!-- Add link back to index.php with clear_cart parameter -->
                <a href="index.php?clear_cart=true" class="btn btn-secondary d-inline-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 1 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>
                    Back to Homepage
                </a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>