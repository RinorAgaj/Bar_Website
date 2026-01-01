<?php
include('../config/constant.php');

// Require admin login
requireAdmin();

// Validate ID parameter
if (!isset($_GET['id'])) {
    $_SESSION['delete'] = "<div class='error'>Invalid request.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
    exit();
}

$id = validateId($_GET['id']);
if ($id === false) {
    $_SESSION['delete'] = "<div class='error'>Invalid admin ID.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
    exit();
}

// Prevent deleting yourself
if ($id == $_SESSION['id']) {
    $_SESSION['delete'] = "<div class='error'>You cannot delete your own account.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
    exit();
}

// Use prepared statement for deletion
$stmt = mysqli_prepare($conn, "DELETE FROM tbl_admin WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
$res = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($res === true) {
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully!</div>";
} else {
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again later!</div>";
}

header('location:' . SITEURL . 'admin/manage-admin.php');
exit();
?>