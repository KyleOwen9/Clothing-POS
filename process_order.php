<?php
include 'db.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>location.replace('index.php')</script>";
    exit(); // Ensure script stops if user is not authenticated
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantities = $_POST['quantity'];
    $total = 0.00;

    // Start a transaction for atomicity
    $conn->beginTransaction();

    try {
        // Insert order into orders table
        $stmt = $conn->prepare('INSERT INTO orders (total) VALUES (?)');
        $stmt->execute([$total]);

        // Get the last inserted order ID
        $order_id = $conn->lastInsertId();

        // Flag to track if there is insufficient stock
        $insufficientStock = false;

        // Loop through products and insert into order_items
        foreach ($quantities as $product_id => $quantity) {
            if ($quantity > 0) {
                // Fetch product price and stock from database
                $stmt = $conn->prepare('SELECT price, stocks FROM products WHERE id = ?');
                $stmt->execute([$product_id]);
                $product = $stmt->fetch();

                // Check if there is enough stock
                if ($product['stocks'] >= $quantity) {
                    // Calculate subtotal for this product
                    $subtotal = $product['price'] * $quantity;

                    // Insert into order_items
                    $stmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
                    $stmt->execute([$order_id, $product_id, $quantity, $subtotal]);

                    // Reduce stock
                    $new_stock = $product['stocks'] - $quantity;
                    $stmt = $conn->prepare('UPDATE products SET stocks = ? WHERE id = ?');
                    $stmt->execute([$new_stock, $product_id]);

                    // Add to total
                    $total += $subtotal;
                } else {
                    // Set flag for insufficient stock
                    $insufficientStock = true;
                    break; // Exit the loop early
                }
            }
        }

        // If there was insufficient stock, display an alert and redirect back to ordering page
        if ($insufficientStock) {
            echo "<script>alert('Insufficient stock for one or more products.');</script>";
            echo "<script>location.replace('site.php?page=home')</script>";
            exit();
        }

        // Update total in orders table
        $stmt = $conn->prepare('UPDATE orders SET total = ? WHERE id = ?');
        $stmt->execute([$total, $order_id]);

        // Commit transaction
        $conn->commit();

        // Redirect back to site.php or wherever appropriate
        header('Location: site.php?page=home');
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        
        // Display an alert message in JavaScript
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        
        // You can also redirect if needed
        // header('Location: site.php?page=home');
        // exit();
    }
} else {
    // Redirect to homepage or handle error
    header('Location: index.php');
    exit();
}
?>

