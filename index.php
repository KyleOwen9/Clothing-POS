<?php
 session_start();
    if(!(isset($_SESSION['ID'])))
    echo "<script>location.replace('index.php')</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 4 || Clothing PoS</title>
</head>
<style>
    body{
        background-image: url('https://urbanmatter.com/wp-content/uploads/2023/02/alyssa-strohmann-TS-uNw-JqE-unsplash.jpg.webp');
        background-size: cover;
    }

    form{
        width: 500px;
        height: 320px;
        border: 4px solid black;
        border-radius: 8px 8px;
        margin-top: 6%;
        margin-left: 36.5%;
        background-color: #edd2a8;
        opacity: 80%;
        box-shadow: 3px 4px 8px #edd2a8;
    }

    h1{
        text-align: center;
        color: black;
    }

    p{
        text-align: center;
        color: black;
    }

    input{
        align-items: center;
        width: 60%;
        height: 20px;
        margin-left: 20%;
        border: none;
        border-bottom: 1px solid black;
        background-color: transparent;
        outline: none;
        font-size: 20px;
    }

    button{
        margin-left: 42%;
        margin-top: 10px;
        padding: 7px 20px 7px 20px;
        background-color: #d1ac73;
        border-radius: 5px 5px;
    }

    button:hover{
        background-color: #ededed;
        transition: 0.4s;
    }
</style>
<body>
    <form action="login_process.php" method="post">
        <h1>USER LOG-IN:</h1><br>
        <p>Enter User:</p> <!--default usernames: cashier and owner-->
        <input type="text" name="username"><br>
        <p>Password:</p> <!-- default passwords: 1000 and 9999-->
        <input type="password" name="password"><br>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>