<?php
include "config/constant.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	$uname = sanitizeInput($_POST['uname']);
	$pass = $_POST['password']; // Don't sanitize password before verification

	if (empty($uname)) {
		header("Location: index.php?error=" . urlencode("User Name is required"));
		exit();
	} else if (empty($pass)) {
		header("Location: index.php?error=" . urlencode("Password is required"));
		exit();
	} else {
		// First try to find user in tbl_users using prepared statement
		$stmt = mysqli_prepare($conn, "SELECT id, user_name, password, name FROM tbl_users WHERE user_name = ?");
		mysqli_stmt_bind_param($stmt, "s", $uname);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			// Verify password using secure password_verify
			if (verifyPassword($pass, $row['password'])) {
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['id'] = $row['id'];
				$_SESSION['is_admin'] = false;
				header("Location: home.php");
				exit();
			}
		}
		mysqli_stmt_close($stmt);

		// If not found in users, try admin table
		$stmt2 = mysqli_prepare($conn, "SELECT id, user_name, password, full_name FROM tbl_admin WHERE user_name = ?");
		mysqli_stmt_bind_param($stmt2, "s", $uname);
		mysqli_stmt_execute($stmt2);
		$result2 = mysqli_stmt_get_result($stmt2);

		if (mysqli_num_rows($result2) === 1) {
			$row2 = mysqli_fetch_assoc($result2);
			// Verify password using secure password_verify
			if (verifyPassword($pass, $row2['password'])) {
				$_SESSION['user_name'] = $row2['user_name'];
				$_SESSION['name'] = $row2['full_name'];
				$_SESSION['id'] = $row2['id'];
				$_SESSION['is_admin'] = true;
				header("Location: admin/manage-admin.php");
				exit();
			}
		}
		mysqli_stmt_close($stmt2);

		// If we get here, authentication failed
		header("Location: index.php?error=" . urlencode("Incorrect User name or password"));
		exit();
	}
} else {
	header("Location: index.php");
	exit();
}