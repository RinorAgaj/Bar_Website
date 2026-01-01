<?php
include('../config/constant.php');

// Require admin login
requireAdmin();

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = validateId($_GET['id']);
    if ($id === false) {
        $_SESSION['delete'] = "<div class='error'>Invalid food ID.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }

    $image_name = basename(sanitizeInput($_GET['image_name'])); // basename prevents directory traversal

    if ($image_name != "") {
        $path = "../img/food/" . $image_name;
        if (file_exists($path)) {
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }
        }
    }

    // Use prepared statement for deletion
    $stmt = mysqli_prepare($conn, "DELETE FROM tbl_food WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($res === true) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
    }
    header('location:' . SITEURL . 'admin/manage-food.php');
    exit();
} else {
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
    exit();
}
?>