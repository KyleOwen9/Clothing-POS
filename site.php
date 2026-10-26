<?php
include 'db.php';
    session_start();
    if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

        if(!(isset($_SESSION['id'])))
        echo "<script>location.replace('index.php')</script>";


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pos_system";
        
$subt = 0;
$cash_tendered = 0;
$change = 0;
$products = [];

try {
    $stmt = $conn->prepare("SELECT id, name, price FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Handle form submission to process the order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $selected_products = isset($_POST['products']) ? $_POST['products'] : [];
    $quantities = isset($_POST['quantities']) ? $_POST['quantities'] : [];

    // Calculate subtotal
    $subtotal = 0;
    foreach ($selected_products as $product_id => $quantity) {
        foreach ($products as $product) {
            if ($product['id'] == $product_id) {
                $subtotal += $product['price'] * $quantity;
                break;
            }
        }
    }

    // Store order details in session or database as needed
    // Here, we store in session for simplicity
    $_SESSION['order_subtotal'] = $subtotal;
    $_SESSION['selected_products'] = $selected_products;
    $_SESSION['quantities'] = $quantities;

    // Redirect to show receipt
    header("Location: site.php?page=receipt");
    exit();
}





        function site_view($page) {
            if($page == "home"){

                echo"<style>
                    body {
                    overflow: hidden;
                    }

                    .navbar .active1 {
                    background-color: #edd2a8;
                    color: #333333;
                    }

                    .selections {
                    overflow: auto;
                    background-color: #333333;
                    color: #ededed;
                    width: 99.9%;
                    height: 862px;
                    }

                    .selections th {
                    background-color: transparent;
                    position: inherit;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    justify-content: justify;
                    color: #a3865a;
                    border: 4px solid #edd2a8;
                    border-radius: 8px;
                    width: 300px;
                    height: 28px;
                    font-family: sans-serif;
                    margin-top: 30px;
                    margin-right: 10px;
                    margin-bottom: 5px;
                    padding-top: 28px;
                    font-size: 19px;
                    }

                    .selections td {
                    background-color: transparent;
                    position: inherit;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    justify-content: justify;
                    color: #edd2a8;
                    border: 4px solid #a3865a;
                    border-radius: 8px;
                    width: 300px;
                    height: 5px;
                    font-family: sans-serif;
                    margin-top: 15px;
                    margin-right: 10px;
                    margin-bottom: -10px;
                    padding-bottom: 20px;
                    font-size: 18px;
                    }

                    .selections .container input {
                    text-decoration: none;
                    background: transparent;
                    border: none;
                    border-bottom: 1px solid #edd2a8;
                    text-align: center;
                    font-family: sans-serif;
                    color: #edd2a8;
                    font-size: 18px;
                    margin-top: -40px;
                    }
                    
                    .selections .container .int:hover {
                    color: #edd2a8;
                    border-color: #ededed;
                    transition: 0.25s;
                    }

                    .selections .container .placebtn {
                    position: relative;
                    color: #333333;
                    background-color: #edd2a8;
                    border: 5px solid #a3865a;
                    border-radius: 4px 4px;
                    font-family: sans-serif;
                    width: 400px;
                    height: 60px;
                    margin-top: -40px;
                    margin-bottom: 70px;
                    margin-left: 700px;
                    font-size: 20px;
                    z-index: 1;
                    }

                    .selections .container .placebtn:hover {
                    background-color: #ededed;
                    transition: 0.2s;
                    }

                    .selections .container .placebtn:active {
                    background-color: #a3865a;
                    transition: 0.2s;
                    }


            .charge {
            position: relative;

            width: 40%;
            color: #edd2a8;
            margin-left: 27%;
            margin-top: -862px;
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



                </style>
                ";

                echo "<div id='home'>
                <div class='selections'>
                <div class='container'>
                <h1 style='font-family: serif; color: #edd2a8; border-top: 2px solid #ededed; border-bottom: 2px solid #ededed; font-size: 25px; margin-left: 660px; margin-right: 753px;'>
            Hello ". $_SESSION['name']. "! Welcome to Clothing POS!</h1>
                    <form method='post' action='process_order.php'>
                        <table style='border: none; margin-bottom: 100px;'>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            ";
                            $stmt = $GLOBALS['conn']->prepare('SELECT * FROM products');
                            $stmt->execute();
                            $products = $stmt->fetchAll();
                            foreach ($products as $product) {
                            echo "
                                <tr>
                                        <td>{$product['name']}</td>
                                        <td>{$product['price']}</td>
                                        <td class='int'><input type='number' name='quantity[{$product['id']}]' min='0' max='99' value='0'></td>
                                </tr>
                                ";
                            }
                                echo "  
                        </table>
                        <button class='placebtn' type='submit'><strong>Place Order</strong></button>
                    </form>
                </div>
                </div>
                <div class='items'>
                </div>
                </div>
                ";
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS | Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; margin-left: 25em;}
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .cart { margin-top: 20px; }
        .cart table { width: 100%; }


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


    </style>
</head>
<body>

<div class="navbar">
<br><a href="site.php?page=home" class="active1">DASHBOARD</a>
        <a href="orders.php" class="active2">CASH-DRAWER</a>
        <a href="admin.php" class="active3">ITEMS</a>
        <a href="change_pw.php" class="active4">CHANGE-PASSWORD</a>
        <a href="change_un.php" class="active4">CHANGE-USERNAME</a>

        <a href="logout.php" class="active5">LOG-OUT</a>
    </div>

    <?php
    if(isset($_GET['page'])) {
        site_view($_GET['page']);
    }
    else {
        site_view('home');
    }
    ?>
</body>
</html>
<?php }else{
     header("Location: index.php");
     exit();
}
 ?> 
