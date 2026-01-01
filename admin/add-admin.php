<?php include("partials/header.php");?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

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

        <form action="" method="POST">
            <?php echo csrfTokenField(); ?>

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Your Username" required></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Your Password" minlength="8" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include("partials/footer.php");?>


<?php

if(isset($_POST['submit']))
{
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error'] = "Invalid request. Please try again.";
        header('location:' . SITEURL . 'admin/add-admin.php');
        exit();
    }

    $full_name = sanitizeInput($_POST['full_name']);
    $username = sanitizeInput($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($full_name) || empty($username) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header('location:' . SITEURL . 'admin/add-admin.php');
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters.";
        header('location:' . SITEURL . 'admin/add-admin.php');
        exit();
    }

    // Check if username already exists
    $stmt_check = mysqli_prepare($conn, "SELECT id FROM tbl_admin WHERE user_name = ?");
    mysqli_stmt_bind_param($stmt_check, "s", $username);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        mysqli_stmt_close($stmt_check);
        $_SESSION['error'] = "Username already exists.";
        header('location:' . SITEURL . 'admin/add-admin.php');
        exit();
    }
    mysqli_stmt_close($stmt_check);

    // Hash password securely
    $hashed_password = hashPassword($password);

    // Use prepared statement for insertion
    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_admin (full_name, user_name, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $full_name, $username, $hashed_password);
    $res = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($res === true)
    {
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    exit();
}

?>