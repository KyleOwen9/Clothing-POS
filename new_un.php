<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {


if (isset($_POST['pass'])&& isset($_POST['un'])) {
        include "add_db.php";

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$on = validate($_POST['on']);
	$un = validate($_POST['un']);
	$pass = validate($_POST['pass']);
	
    
    if(empty($on)){
      header("Location: change_un.php?error=Username is ");
	  exit();
    }
    else if(empty($un)){
        header("Location: change_un.php?error= New name is required");
        exit();
      }
    else if(empty($pass)){
      header("Location: change_un.php?error= Password is required");
	  exit();
    }else {
    	// hashing the password
   
        $id = $_SESSION['id'];

        $sql = "SELECT `user_name`
                FROM user WHERE 
                id='$id' AND `user_name`='$on'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE user
        	          SET `user_name`='$un'
        	          WHERE id='$id'";
        	mysqli_query($conn, $sql_2);
            echo "<script>alert('USERNAME CHANGED SUCCESFULLY');location.replace('site.php?page=home')</script>";

	        exit();

        }
        else {
            echo "<script>alert('ERROR');location.replace('change_un.php')</script>";
	        exit();
        }

    }

    
}else{
	header("Location: change_un.php");
	exit();
}

}else{
     header("Location: index.php");
     exit();
}