<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_product'])) {
        $name = htmlspecialchars($_POST['name']);
        $price = htmlspecialchars($_POST['price']);
        $stocks = htmlspecialchars($_POST['stocks']);

        $stmt = $conn->prepare("INSERT INTO products (name, price, stocks) VALUES (:name, :price, :stocks)");
        $stmt->execute(['name' => $name, 'price' => $price, 'stocks' => $stocks]);
    } elseif (isset($_POST['update_product'])) {
        $id = htmlspecialchars($_POST['id']);
        $name = htmlspecialchars($_POST['name']);
        $price = htmlspecialchars($_POST['price']);
        $stocks = htmlspecialchars($_POST['stocks']);

        $stmt = $conn->prepare("UPDATE products SET name = :name, price = :price, stocks = :stocks WHERE id = :id");
        $stmt->execute(['id' => $id, 'name' => $name, 'price' => $price, 'stocks' => $stocks]);
    } elseif (isset($_POST['delete_product'])) {
        $id = htmlspecialchars($_POST['id']);

        $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}

$products = $conn->query("SELECT * FROM products")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS | Items</title>
    <style>
        body {
        font-family: sans-serif;
        color: #a3865a;
        overflow: hidden;
        }

        .container {
        position: fixed;
        z-index: 1;
        margin-left: 1000px;
        width: 904px;
        height: 850px;
        background-color: #a3865a;
        }

        table {
        position: absolute;
        width: 1000px;
        border: none;
        margin-left: 50px;
        padding-bottom: 100px;
        }

        th {
        background-color: transparent;
        position: inherit;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        justify-content: justify;
        color: #a3865a;
        border: 4px solid #edd2a8;
        border-radius: 8px;
        width: 150px;
        height: 28px;
        font-family: sans-serif;
        margin-top: 30px;
        margin-right: 10px;
        margin-bottom: 5px;
        padding-top: 28px;
        font-size: 19px;
        }

        td {
        background-color: transparent;
        position: inherit;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        justify-content: justify;
        color: #edd2a8;
        border: 4px solid #a3865a;
        border-radius: 8px;
        width: 150px;
        height: 6px;
        font-family: sans-serif;
        margin-top: 15px;
        margin-right: 10px;
        margin-bottom: -10px;
        padding-bottom: 20px;
        font-size: 18px;
        }

        .form-group {
        margin-bottom: 1em;
        }

        .form-group label {
        position: absolute;
        margin-bottom: 0.5em;
        }

        .form-group input {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        width: 350px;
        height: 24px;
        padding: 0.5em;
        background-color: #edd2a8;
        color: #333333;
        border: none;
        border-bottom: 2px solid #a3865a;

        }

        .form-group button {
        padding: 0.5em 1em;
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

        .navbar .active3{
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

                    .prods {
                    overflow: scroll;
                    position: absolute;
                    width: 1000px;
                    height: 780px;
                    background-color: #333333;
                    color: #ededed;
                    padding-bottom: 150px;
                    }

        .prodbtn {
        color: #333333;
        background-color: #edd2a8;
        border: 2px solid #a3865a;
        width: 65px;
        height: 28px;
        border-radius: 5px 5px;
        }

        .prodbtn:hover {
        background-color: #ededed;
        transition: 0.15s;
        }

        .admin {
        margin-left: 250px;
        margin-top: 50px;
        }

        .edit {
        margin-left: 250px;
        margin-top: 80px;
        }

        .adminbtn {
        color: #333333;
        background-color: #edd2a8;
        border: 2px solid #333333;
        width: 180px;
        height: 40px;
        border-radius: 5px 5px;
        }

        .adminbtn:hover {
        background-color: #ededed;
        transition: 0.15s;
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

    <div class="container">
    <div class="admin">
        <h2 style="color: #333333;">Add Product</h2>
        <form method="post" action="admin.php">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" step="0.01" name="price" id="price" required>
            </div>
            <div class="form-group">
                <label for="stocks">Stocks Left</label>
                <input type="number" name="stocks" id="stocks" required>
            </div>
            <button class="adminbtn" type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    <div class="edit">
        <h2 style="color: #333333;">Edit Product</h2>
        <form method="post" action="admin.php" id="editForm">
            <input type="hidden" name="id" id="edit_id">
            <div class="form-group">
                <label for="edit_name">Product Name</label>
                <input type="text" name="name" id="edit_name" required>
            </div>
            <div class="form-group">
                <label for="edit_price">Product Price</label>
                <input type="number" step="0.01" name="price" id="edit_price" required>
            </div>
            <div class="form-group">
                <label for="edit_stocks">Stocks Left</label>
                <input type="number" name="stocks" id="edit_stocks" required>
            </div>
            <button class="adminbtn" type="submit" name="update_product">Update Product</button>
        </form>
    </div>
</div>

<div class="prods">
    <h1 style="border: 2px solid #edd3a8; width: 400px; height: 50px; text-align: center; margin-left: 280px;">Products</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stocks</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product) { ?>
            <tr class="<?= $product['stocks'] < 10 ? 'low-stock' : '' ?>">
                <td><?= $product['id'] ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td><?= htmlspecialchars($product['stocks']) ?></td>
                <td>
                    <button class="prodbtn" type="button" onclick="populateEditForm(<?= $product['id'] ?>, '<?= htmlspecialchars($product['name']) ?>', <?= $product['price'] ?>, <?= $product['stocks'] ?>)">Edit</button>
                    <form method="post" action="admin.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        <button class="prodbtn" type="submit" name="delete_product">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>
function populateEditForm(id, name, price, stocks) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_price').value = price;
    document.getElementById('edit_stocks').value = stocks;
}
</script>
</body>
</html>