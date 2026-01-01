<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            if(isset($_SESSION['error']))
            {
                echo "<div class='error'>" . e($_SESSION['error']) . "</div>";
                unset($_SESSION['error']);
            }
        ?>

        <?php

            if (!isset($_GET['id'])) {
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit();
            }

            $id = validateId($_GET['id']);
            if ($id === false) {
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit();
            }

            // Use prepared statement
            $stmt = mysqli_prepare($conn, "SELECT * FROM tbl_category WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                mysqli_stmt_close($stmt);
                $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                exit();
            }
            mysqli_stmt_close($stmt);

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <?php echo csrfTokenField(); ?>

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo e($title); ?>" required>
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>img/category/<?php echo e($current_image); ?>" width="100px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" accept="image/*">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo e($current_image); ?>">
                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                // Validate CSRF token
                if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
                    $_SESSION['error'] = "Invalid request. Please try again.";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    exit();
                }

                $id = validateId($_POST['id']);
                if ($id === false) {
                    $_SESSION['error'] = "Invalid category ID.";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                    exit();
                }

                $title = sanitizeInput($_POST['title']);
                $current_image = basename(sanitizeInput($_POST['current_image']));
                $featured = isset($_POST['featured']) && $_POST['featured'] === 'Yes' ? 'Yes' : 'No';
                $active = isset($_POST['active']) && $_POST['active'] === 'Yes' ? 'Yes' : 'No';

                $image_name = $current_image;
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
                {
                    // Validate image upload
                    $validation = validateImageUpload($_FILES['image']);
                    if (!$validation['success']) {
                        $_SESSION['error'] = $validation['error'];
                        header('location:' . SITEURL . 'admin/update-category.php?id=' . $id);
                        exit();
                    }

                    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $image_name = generateSafeFilename("Food_Category", $ext);

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../img/category/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        exit();
                    }

                    // Remove old image if exists
                    if($current_image != "")
                    {
                        $remove_path = "../img/category/" . $current_image;
                        if (file_exists($remove_path)) {
                            unlink($remove_path);
                        }
                    }
                }

                // Use prepared statement for update
                $stmt = mysqli_prepare($conn, "UPDATE tbl_category SET title = ?, image_name = ?, featured = ?, active = ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "ssssi", $title, $image_name, $featured, $active, $id);
                $res2 = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if($res2 === true)
                {
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                }
                exit();
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
