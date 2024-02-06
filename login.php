<?php 
session_start(); 
include "config/constant.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		$pass = md5($pass);
	
		$sql = "SELECT * FROM tbl_users WHERE user_name='$uname' AND password='$pass'";
		$result = mysqli_query($conn, $sql);
	
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['user_name'] === $uname && $row['password'] === $pass) {
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['id'];
				header("Location: home.php");
				exit();
			} else {
				header("Location: index.php?error=Incorrect User name or password");
				exit();
			}
		} else {
			// Admin authentication block
			$sql2 = "SELECT * FROM tbl_admin WHERE user_name='$uname' AND password='$pass'";
			$result2 = mysqli_query($conn, $sql2);
	
			if (mysqli_num_rows($result2) === 1) {
				$row2 = mysqli_fetch_assoc($result2);
				if ($row2['user_name'] === $uname && $row2['password'] === $pass) {
					$_SESSION['user_name'] = $row2['user_name'];
					$_SESSION['name'] = $row2['name'];
					$_SESSION['id'] = $row2['id'];
					header("Location: admin/manage-admin.php");
					exit();
				} else {
					header("Location: index.php?error=Incorrect User name or password");
					exit();
				}
			} else {
				header("Location: index.php?error=Incorrect User name or password");
				exit();
			}
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}