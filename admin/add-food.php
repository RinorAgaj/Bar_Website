<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
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
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food" required>
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food." required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" step="0.01" min="0" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" accept="image/*">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" required>

                            <?php
                                // Using prepared statement (no user input, but good practice)
                                $sql = "SELECT id, title FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $cat_id = $row['id'];
                                        $cat_title = $row['title'];
                                        ?>
                                        <option value="<?php echo e($cat_id); ?>"><?php echo e($cat_title); ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No" checked>No
                    </td>
                </tr>


                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked>Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
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
                    header('location:' . SITEURL . 'admin/add-food.php');
                    exit();
                }

                $title = sanitizeInput($_POST['title']);
                $description = sanitizeInput($_POST['description']);
                $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
                $category = validateId($_POST['category']);

                if ($price === false || $price < 0) {
                    $_SESSION['error'] = "Invalid price.";
                    header('location:' . SITEURL . 'admin/add-food.php');
                    exit();
                }

                if ($category === false) {
                    $_SESSION['error'] = "Invalid category.";
                    header('location:' . SITEURL . 'admin/add-food.php');
                    exit();
                }

                $featured = isset($_POST['featured']) && $_POST['featured'] === 'Yes' ? 'Yes' : 'No';
                $active = isset($_POST['active']) && $_POST['active'] === 'Yes' ? 'Yes' : 'No';

                $image_name = "";
                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != "")
                {
                    // Validate image upload
                    $validation = validateImageUpload($_FILES['image']);
                    if (!$validation['success']) {
                        $_SESSION['upload'] = "<div class='error'>" . e($validation['error']) . "</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        exit();
                    }

                    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $image_name = generateSafeFilename("Food-Name", $ext);
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../img/food/" . $image_name;

                    $upload = move_uploaded_file($src, $dst);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        exit();
                    }
                }

                // Use prepared statement for insertion
                $stmt = mysqli_prepare($conn, "INSERT INTO tbl_food (title, description, price, image_name, category_id, featured, active) VALUES (?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "ssdsisss", $title, $description, $price, $image_name, $category, $featured, $active);
                $res2 = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                if($res2 === true)
                {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:' . SITEURL . 'admin/manage-food.php');
                }
                exit();
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>