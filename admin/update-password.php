<?php include("partials/header.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>

        <?php
            if(isset($_SESSION['error']))
            {
                echo "<div class='error'>" . e($_SESSION['error']) . "</div>";
                unset($_SESSION['error']);
            }

            if (!isset($_GET['id'])) {
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit();
            }

            $id = validateId($_GET['id']);
            if ($id === false) {
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit();
            }
        ?>


        <form action="" method="POST">
            <?php echo csrfTokenField(); ?>
            <table class="tbl-30">

                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Old Password" required>
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" minlength="8" required>
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" minlength="8" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo e($id);?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error'] = "Invalid request. Please try again.";
        header('location:' . SITEURL . 'admin/manage-admin.php');
        exit();
    }

    $id = validateId($_POST['id']);
    if ($id === false) {
        $_SESSION['error'] = "Invalid admin ID.";
        header('location:' . SITEURL . 'admin/manage-admin.php');
        exit();
    }

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header('location:' . SITEURL . 'admin/update-password.php?id=' . $id);
        exit();
    }

    if (strlen($new_password) < 8) {
        $_SESSION['error'] = "New password must be at least 8 characters.";
        header('location:' . SITEURL . 'admin/update-password.php?id=' . $id);
        exit();
    }

    if ($new_password !== $confirm_password) {
        $_SESSION['pwd-not-match'] = "<div class='error'>New passwords do not match.</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
        exit();
    }

    // Get current password hash using prepared statement
    $stmt = mysqli_prepare($conn, "SELECT password FROM tbl_admin WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $stored_hash = $row['password'];
        mysqli_stmt_close($stmt);

        // Verify current password
        if (verifyPassword($current_password, $stored_hash)) {
            // Hash new password securely
            $new_hash = hashPassword($new_password);

            // Update password using prepared statement - FIXED: was using $sql instead of $sql2
            $stmt2 = mysqli_prepare($conn, "UPDATE tbl_admin SET password = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt2, "si", $new_hash, $id);
            $res2 = mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

            if ($res2 === true) {
                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            } else {
                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            $_SESSION['error'] = "Current password is incorrect.";
            header('location:' . SITEURL . 'admin/update-password.php?id=' . $id);
        }
    } else {
        mysqli_stmt_close($stmt);
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    exit();
}

?>

<?php include("partials/footer.php");?>