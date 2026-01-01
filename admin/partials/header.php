<?php include("../config/constant.php");?>
<?php
// Require admin login for all admin pages
requireAdmin();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bar Website - Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>

        <div class="menu">
            <div class="wrapper">
                <ul>
                    <li><a href="../home.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
        </div>