<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change USERNAME</title>
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

    label{
        text-align: center;
        color: black;
    }

    input{
        align-items: center;
        width: 60%;
        height: 20px;
        margin-left: 10%;
        border: none;
        border-bottom: 1px solid black;
        background-color: transparent;
        outline: none;
        font-size: 20px;
    }

    button{
		
		margin-left: 200px;
        margin-top: 10px;
        padding: 7px 20px 7px 20px;
        background-color: #d1ac73;
        border-radius: 5px 5px;
    }
	a{ 
		margin-left: 50px;	
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
    <form action="new_un.php" method="post">
	<h1>USER LOG-IN:</h1><br>
    
    <label>OLD USERNAME</label><br>
     	<input type="text" name="on" ><br>

     	<label>NEW USERNAME</label><br>
     	<input type="text" name="un" ><br>

     	<label>New Password</label><br>
     	<input type="password" name="pass" ><br>

     	<button type="submit">CHANGE</button><br>
          <a href="site.php?page=home" >HOME</a>
     </form>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>