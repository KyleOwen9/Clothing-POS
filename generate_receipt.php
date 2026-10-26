<?php
include 'db.php'; // Ensure db.php has your database connection setup

// Check if transaction_id is set in the URL
if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];
    
    // Query database to fetch transaction details
    $stmt = $conn->prepare("SELECT o.id, o.total, o.created_at, oi.product_id, oi.quantity, p.name as product_name
                           FROM orders o
                           JOIN order_items oi ON o.id = oi.order_id
                           JOIN products p ON oi.product_id = p.id
                           WHERE o.id = ?");
    $stmt->execute([$transaction_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    $tax = $order['total'] * 0.12;
    $vats = $order['total'] - $tax;


    if ($order) {
        // Begin outputting receipt content (HTML example)
        header('Content-Type: text/html; charset=utf-8');
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Receipt for Transaction #<?php echo $order['id']; ?></title>
            <style>
                /* Add your CSS styles for the receipt here */
                body {
                    font-family: Arial, sans-serif;
                }
                .receipt {
                    width: 300px;
                    margin: 0 auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                }
            </style>
        </head>
        <body>
            <div class="receipt">
                <h2>Receipt for Transaction #<?php echo $order['id']; ?></h2>
                <p>Date: <?php echo $order['created_at']; ?></p>
                <h3>Products Sold:</h3>
                <ul>
                    <li><?php echo $order['product_name']; ?> - Quantity: <?php echo $order['quantity']; ?></li>
                    <!-- Repeat for each product if multiple -->
                </ul>
                <p>--------------------------------------------------------</p>
                <p>Vatable Sales: <?php echo number_format($vats, 2); ?></p>
                <p>Tax: 12%</p>
                <p>VAT Amount: <?php echo number_format($tax, 2); ?></p>
                <p><strong>Total: ₱<?php echo number_format($order['total'], 2); ?></strong></p>
                
                <p>Thank you for your purchase!</p>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Transaction not found.";
    }
} else {
    echo "Transaction ID not provided.";
}
?>
