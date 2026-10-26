<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {


if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {
        include "add_db.php";

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: change_pw.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: change_pw.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: change_pw.php?error=The confirmation password  does not match");
	  exit();
    }else {
    	// hashing the password
   
        $id = $_SESSION['id'];

        $sql = "SELECT `password`
                FROM user WHERE 
                id='$id' AND `password`='$op'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE user
        	          SET `password`='$np'
        	          WHERE id='$id'";
        	mysqli_query($conn, $sql_2);
            echo "<script>alert('PASSWORD CHANGED SUCCESFULLY');location.replace('site.php?page=home')</script>";

	        exit();

        }
        else {
            echo "<script>alert('ERROR');location.replace('change_pw.php')</script>";
	        exit();
        }

    }

    
}else{
	header("Location: change_pw.php");
	exit();
}

}else{
     header("Location: index.php");
     exit();
}