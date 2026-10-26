<?php
include 'db.php';

session_start();

// Initialize total expense if not already set
if (!isset($_SESSION['total_expense'])) {
    $_SESSION['total_expense'] = 0;
}

// Handle form submission to add new expense
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Add'])) {
    // Sanitize and validate input
    $new_expense = isset($_POST['exp']) ? (float)$_POST['exp'] : 0;
    if ($new_expense > 0) {
        $_SESSION['total_expense'] += $new_expense;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS | Cash Drawer</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        overflow: hidden;
        }

        .top {
        z-index: 1;
        position: fixed;
        width: 99.2%;
        }

        .navbar{
        position: relative;
        justify-content: justify;
        display: inline-block;
        width: 100%;
        height: 58px;
        background-color: #333333;
        color: aliceblue;
        border-top: 5px solid #edd2a8;
        border-bottom: 3px solid #edd2a8;
        }

        .navbar a{
        position: inherit;
        text-decoration: none;
        color: #ededed;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-size: 26px;
        padding: 10px 10px;
        padding-top: 10px;
        margin-left: 8px;
        }
    
        .navbar a:hover{
        background-color: #ededed;
        color: #333333;
        transition: 0.4s;
        }

        .navbar .active2{
        background-color: #edd2a8;
        color: #333333;
        }


        ::-webkit-scrollbar {
            width: 10px;
            }

            ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey; 
            border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
            background: #edd2a8; 
            border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
            background: #a3865a; 
            }

                    .trans {
                    margin-top: 3.4%;
                    position: absolute;
                    width: 1270px;
                    height: 780px;
                    overflow: scroll;
                    background-color: #333333;
                    color: #ededed;
                    padding-bottom: 80px;
                    }

                    .trans h1 {
                    background-color: transparent;
                    text-align: center;
                    color: #a3865a;
                    border: 4px solid #edd2a8;
                    border-radius: 8px;
                    width: 730px;
                    height: 28px;
                    font-family: sans-serif;
                    margin-top: 50px;
                    margin-left: 80px;
                    margin-bottom: 40px;
                    padding-top: 15px;
                    padding-bottom: 15px;
                    font-size: 30px;
                    }

                    .trans table {
                    margin-left: 50px;
                    }

                    .trans th {
                    background-color: transparent;
                    position: inherit;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    justify-content: justify;
                    color: #a3865a;
                    border: 4px solid #edd2a8;
                    border-radius: 8px;
                    width: 170px;
                    height: 28px;
                    font-family: sans-serif;
                    margin-top: 30px;
                    margin-right: 10px;
                    margin-bottom: 5px;
                    padding-top: 28px;
                    font-size: 19px;
                    }

                    .trans td {
                    background-color: transparent;
                    position: inherit;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    justify-content: justify;
                    color: #edd2a8;
                    border: 4px solid #a3865a;
                    border-radius: 8px;
                    width: 170px;
                    height: 5px;
                    font-family: sans-serif;
                    margin-top: 15px;
                    margin-right: 10px;
                    margin-bottom: -10px;
                    padding-bottom: 20px;
                    font-size: 18px;
                    }

                    .sales {
                    position: fixed;
                    z-index: 1;
                    margin-left: 1270px;
                    margin-top: 3.46%;
                    width: 635px;
                    height: 900px;
                    background-color: #a3865a;
                    }

                    .totalsales {
                    text-align: center;
                    position: absolute;
                    margin-top: 100px;
                    margin-left: 30px;
                    width: 550px;
                    height: 80px;
                    color: #a3865a;
                    background-color: #ededed;
                    border: 5px solid #edd2a8;
                    border-radius: 8px 8px;
                    box-shadow: 8px 8px 12px #5e5e5e;
                    font-family: sans-serif;
                    font-size: 30px;
                    font-weight: bold;
                    padding-top: 15px;
                    }

                    .totalcash {
                    text-align: center;
                    position: absolute;
                    margin-top: 300px;
                    margin-left: 30px;
                    width: 550px;
                    height: 80px;
                    color: #a3865a;
                    background-color: #ededed;
                    border: 5px solid #edd2a8;
                    border-radius: 8px 8px;
                    box-shadow: 8px 8px 12px #5e5e5e;
                    font-family: sans-serif;
                    font-size: 30px;
                    font-weight: bold;
                    padding-top: 15px;
                    }

                    .expense {
                    text-align: center;
                    position: absolute;
                    margin-top: 500px;
                    margin-left: 30px;
                    width: 550px;
                    height: 210px;
                    color: #a3865a;
                    background-color: #ededed;
                    border: 5px solid #edd2a8;
                    border-radius: 8px 8px;
                    box-shadow: 8px 8px 12px #5e5e5e;
                    font-family: sans-serif;
                    font-size: 30px;
                    font-weight: bold;
                    }

                    .expense .inp {
                    text-align: center;
                    width: 60%;
                    height: 20px;
                    border: none;
                    border-bottom: 1px solid #a3865a;
                    color: #a3865a;
                    background-color: transparent;
                    outline: none;
                    font-size: 20px;
                    }

                    .expense .addexp {
                    background-color: #edd2a8;
                    color: #5e5e5e;
                    border: 2px solid #a3865a;
                    width: 80px;
                    height: 30px;
                    font-family: sans-serif;
                    font-size: 15px;
                    font-weight: bold;
                    }

                    .expense .addexp:hover {
                    background-color: #ededed;
                    transition: 0.15s;
                    }

                    .receipt-button {
            background-color: #edd2a8;
            height: 10px;
            color: #333333;
            border: 1px solid #a3865a;
            padding: 7px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 0px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .receipt-button:hover {
            background-color: #ededed;
        }

    </style>
</head>
<body>
<div class="top">
    <div class="navbar">
        <br><a href="site.php?page=home" class="active1">DASHBOARD</a>
        <a href="orders.php" class="active2">CASH-DRAWER</a>
        <a href="admin.php" class="active3">ITEMS</a>
        <a href="change_pw.php" class="active4">CHANGE-PASSWORD</a>
        <a href="change_un.php" class="active4">CHANGE-USERNAME</a>
        <a href="logout.php" class="active5">LOG-OUT</a>
    </div>
</div>

<div class="trans">
    <h1>TRANSACTION HISTORY</h1>
    <table>
        <thead>
        <tr>
            <th>Transaction #</th>
            <th>Total</th>
            <th>Date</th>
            <th>Product Sold</th>
            <th>Quantity</th>
            <th>Action</th> <!-- New column for receipt button -->
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt = $conn->prepare("SELECT o.id, o.total, o.created_at, oi.product_id, oi.quantity, p.name as product_name
                                       FROM orders o
                                       JOIN order_items oi ON o.id = oi.order_id
                                       JOIN products p ON oi.product_id = p.id");
        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td># {$order['id']}</td>";
            echo "<td>{$order['total']}</td>";
            echo "<td>{$order['created_at']}</td>";
            echo "<td>{$order['product_name']}</td>";
            echo "<td>{$order['quantity']}</td>";
            echo "<td><a class='receipt-button' href='generate_receipt.php?transaction_id={$order['id']}'>Print Receipt</a></td>";
            echo "</tr>";
        }

        // Calculate total sales
        $stmt = $conn->prepare("SELECT SUM(total) AS total_sales FROM orders");
        $stmt->execute();
        $total_sales = $stmt->fetchColumn();

        ?>
        </tbody>
    </table>
</div>

<div class="sales">
    <span class="totalsales">Total Sales:<br>₱<?php echo number_format($total_sales, 2); ?></span>
    <?php
    // Calculate cash in drawer
    $cash_drawer = $total_sales - $_SESSION['total_expense'];
    ?>
    <span class="totalcash">Cash in Drawer:<br>₱<?php echo number_format($cash_drawer, 2); ?></span>

    <div class="expense">
        <form method="post" action="">
            <p class="totalexp">Total Expense:<br>₱<?php echo number_format($_SESSION['total_expense'], 2); ?><br></p>
            <label for="exp">Add Expense:<br></label>
            <input class="inp" type="number" step="1.00" name="exp" required>
            <input class="addexp" type="submit" value="Add" name="Add">
        </form>
    </div>
</div>
</body>
</html>