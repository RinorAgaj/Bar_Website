<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['error']))
            {
                echo "<div class='error'>" . e($_SESSION['error']) . "</div>";
                unset($_SESSION['error']);
            }
        ?>

        <br><br>

        <?php
            if (!isset($_GET['id'])) {
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit();
            }

            $id = validateId($_GET['id']);
            if ($id === false) {
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit();
            }

            // Use prepared statement
            $stmt = mysqli_prepare($conn, "SELECT full_name, user_name FROM tbl_admin WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['user_name']; // Fixed: was 'username', should be 'user_name'
            } else {
                mysqli_stmt_close($stmt);
                header('location:' . SITEURL . 'admin/manage-admin.php');
                exit();
            }
            mysqli_stmt_close($stmt);
        ?>

        <form action="" method="POST">
            <?php echo csrfTokenField(); ?>
            <table class="tbl-30">

                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo e($full_name);?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo e($username);?>" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name='id' value="<?php echo e($id);?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
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

    $full_name = sanitizeInput($_POST['full_name']);
    $username = sanitizeInput($_POST['username']);

    if (empty($full_name) || empty($username)) {
        $_SESSION['error'] = "All fields are required.";
        header('location:' . SITEURL . 'admin/update-admin.php?id=' . $id);
        exit();
    }

    // Check if username is taken by another admin
    $stmt_check = mysqli_prepare($conn, "SELECT id FROM tbl_admin WHERE user_name = ? AND id != ?");
    mysqli_stmt_bind_param($stmt_check, "si", $username, $id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        mysqli_stmt_close($stmt_check);
        $_SESSION['error'] = "Username already exists.";
        header('location:' . SITEURL . 'admin/update-admin.php?id=' . $id);
        exit();
    }
    mysqli_stmt_close($stmt_check);

    // Use prepared statement for update - Fixed column name: user_name instead of username
    $stmt = mysqli_prepare($conn, "UPDATE tbl_admin SET full_name = ?, user_name = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssi", $full_name, $username, $id);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($res === true)
    {
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    exit();
}

?>


<?php include('partials/footer.php'); ?>
