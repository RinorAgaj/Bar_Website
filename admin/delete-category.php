<?php
include('../config/constant.php');

// Require admin login
requireAdmin();

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = validateId($_GET['id']);
    if ($id === false) {
        $_SESSION['delete'] = "<div class='error'>Invalid category ID.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
        exit();
    }

    $image_name = basename(sanitizeInput($_GET['image_name'])); // basename prevents directory traversal

    if ($image_name != "") {
        $path = "../img/category/" . $image_name;
        if (file_exists($path)) {
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit();
            }
        }
    }

    // Use prepared statement for deletion
    $stmt = mysqli_prepare($conn, "DELETE FROM tbl_category WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($res === true) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
    }
    header('location:' . SITEURL . 'admin/manage-category.php');
    exit();
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
    exit();
}
?>