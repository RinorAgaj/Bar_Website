<?php include('partials/header.php'); ?>

<?php
    if (!isset($_GET['id'])) {
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }

    $id = validateId($_GET['id']);
    if ($id === false) {
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }

    // Use prepared statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM tbl_food WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res2 = mysqli_stmt_get_result($stmt);
    $row2 = mysqli_fetch_assoc($res2);

    if (!$row2) {
        mysqli_stmt_close($stmt);
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
    mysqli_stmt_close($stmt);
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['error']))
            {
                echo "<div class='error'>" . e($_SESSION['error']) . "</div>";
                unset($_SESSION['error']);
            }
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
                <td>Description: </td>
                <td>
                    <textarea name="description" cols="30" rows="5" required><?php echo e($description); ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price" step="0.01" min="0" value="<?php echo e($price); ?>" required>
                </td>
            </tr>

            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                        if($current_image == "")
                        {
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>img/food/<?php echo e($current_image); ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Select New Image: </td>
                <td>
                    <input type="file" name="image" accept="image/*">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category" required>

                        <?php
                            $sql = "SELECT id, title FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo e($category_id); ?>"><?php echo e($category_title); ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<option value=''>Category Not Available.</option>";
                            }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo e($id); ?>">
                    <input type="hidden" name="current_image" value="<?php echo e($current_image); ?>">

                    <input type="submit" name="submit" value="Update Food" class="btn-secondary">
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
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    exit();
                }

                $id = validateId($_POST['id']);
                if ($id === false) {
                    $_SESSION['error'] = "Invalid food ID.";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                    exit();
                }

                $title = sanitizeInput($_POST['title']);
                $description = sanitizeInput($_POST['description']);
                $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
                $current_image = basename(sanitizeInput($_POST['current_image']));
                $category = validateId($_POST['category']);

                if ($price === false || $price < 0) {
                    $_SESSION['error'] = "Invalid price.";
                    header('location:' . SITEURL . 'admin/update-food.php?id=' . $id);
                    exit();
                }

                if ($category === false) {
                    $_SESSION['error'] = "Invalid category.";
                    header('location:' . SITEURL . 'admin/update-food.php?id=' . $id);
                    exit();
                }

                $featured = isset($_POST['featured']) && $_POST['featured'] === 'Yes' ? 'Yes' : 'No';
                $active = isset($_POST['active']) && $_POST['active'] === 'Yes' ? 'Yes' : 'No';


                $image_name = $current_image;
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
                {
                    // Validate image upload
                    $validation = validateImageUpload($_FILES['image']);
                    if (!$validation['success']) {
                        $_SESSION['error'] = $validation['error'];
                        header('location:' . SITEURL . 'admin/update-food.php?id=' . $id);
                        exit();
                    }

                    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $image_name = generateSafeFilename("Food-Name", $ext);

                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../img/food/" . $image_name;

                    $upload = move_uploaded_file($src_path, $dest_path);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                        header('location:' . SITEURL . 'admin/manage-food.php');
                        exit();
                    }

                    // Remove old image if exists
                    if($current_image != "")
                    {
                        $remove_path = "../img/food/" . $current_image;
                        if (file_exists($remove_path)) {
                            unlink($remove_path);
                        }
                    }
                }

                // Use prepared statement for update
                $stmt = mysqli_prepare($conn, "UPDATE tbl_food SET title = ?, description = ?, price = ?, image_name = ?, category_id = ?, featured = ?, active = ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "ssdsissi", $title, $description, $price, $image_name, $category, $featured, $active, $id);
                $res3 = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if($res3 === true)
                {
                    $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
                exit();
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
