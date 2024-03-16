<?php
require_once('../tcpdf/tcpdf.php'); // Include TCPDF library

// Retrieve order details from the database based on the order_id in the URL parameter
$order_id = $_GET['order_id']; // Sanitize this input before using it in a SQL query

// Include database connection script
include '../db_connection.php';

// Perform a SQL query to retrieve order details with product names
$order_details_query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$order_details_result = $conn->query($order_details_query);
if ($order_details_result->num_rows > 0) {
    $order_details_row = $order_details_result->fetch_assoc();
}

// Perform a SQL query to retrieve order items with product names
$order_items_query = "SELECT od.quantity, od.price, p.product_name 
                      FROM order_details od 
                      INNER JOIN product p ON od.product_id = p.product_id 
                      WHERE od.order_id = '$order_id'";
$order_items_result = $conn->query($order_items_query);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Invoice');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice, Order');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(10, 10, 10);

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Output order details in PDF
$html = '<style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
            }
            .container {
                margin: 50px auto;
                max-width: 800px;
            }
            .invoice {
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 30px;
            }
            .invoice h1 {
                color: #333;
                font-size: 20px; /* Adjusted font size for the title */
                margin-bottom: 20px;
                text-align: center;
            }
            .invoice-details p {
                margin-bottom: 5px;
                color: #555;
                font-size: 11px; /* Adjusted font size for order details */
            }
            .invoice-table {
                margin-top: 20px;
            }
            .invoice-table table {
                width: 100%;
                border-collapse: collapse;
            }
            .invoice-table th, .invoice-table td {
                padding: 8px;
                text-align: left;
                border: 1px solid #ddd;
            }
            .invoice-table th {
                background-color: #f8f9fa;
            }
            .total-section {
                margin-top: 20px;
                text-align: right;
            }
        </style>';

$html .= '<div class="container">';
$html .= '<div class="invoice">';
$html .= '<h1>Invoice</h1>';
$html .= '<div class="invoice-details">';
$html .= '<p><strong>Order ID:</strong> ' . $order_details_row['order_id'] . '</p>';
$html .= '<p><strong>Delivered To:</strong> ' . $order_details_row['delivered_to'] . '</p>';
$html .= '<p><strong>Phone:</strong> ' . $order_details_row['phone_no'] . '</p>';
$html .= '<p><strong>Delivery Address:</strong> ' . $order_details_row['delivery_address'] . '</p>';
$html .= '<p><strong>Payment Method:</strong> ' . $order_details_row['payment_method'] . '</p>';
$html .= '<p><strong>Order Notes:</strong> ' . $order_details_row['order_notes'] . '</p>';
$html .= '</div>';
$html .= '<div class="invoice-table">';
$html .= '<h4>Order Items</h4>';
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th style="background-color:#f8f9fa;">Product</th>';
$html .= '<th style="background-color:#f8f9fa;">Price</th>';
$html .= '<th style="background-color:#f8f9fa;">Quantity</th>';
$html .= '<th style="background-color:#f8f9fa;">Total</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
while ($order_item_row = $order_items_result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $order_item_row['product_name'] . '</td>';
    $html .= '<td>$' . number_format($order_item_row['price'], 2) . '</td>';
    $html .= '<td>' . $order_item_row['quantity'] . '</td>';
    $html .= '<td>$' . number_format($order_item_row['price'] * $order_item_row['quantity'], 2) . '</td>';
    $html .= '</tr>';
}
$html .= '</tbody>';
$html .= '</table>';
$html .= '<div class="total-section">';
$html .= '<p><strong>Total:</strong> $' . number_format($order_details_row['total'], 2) . '</p>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$html .= '</div>';

// Output HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('invoice.pdf', 'D');