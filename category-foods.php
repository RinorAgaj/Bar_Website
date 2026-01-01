<?php
include('config/constant.php');

if (isset($_GET['category_id'])) {
    $category_id = validateId($_GET['category_id']);
    if ($category_id === false) {
        header('location:' . SITEURL);
        exit();
    }

    // Use prepared statement
    $stmt = mysqli_prepare($conn, "SELECT title FROM tbl_category WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $category_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    } else {
        mysqli_stmt_close($stmt);
        header('location:' . SITEURL);
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    header('location:' . SITEURL);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/style2.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&family=Poppins:wght@500&display=swap');
        </style>
        <title>Shop - Otium</title>
    </head>
    <body>
        <header class="header Poppins" id="header-reservation">
            <div class="header-left">
                <h1 class="header-text">
                    OTIUM
                </h1>
                <img src="img/otium-logo.svg" alt="Otium Logo" class="header-logo">
            </div>
            <div class="header-middle">
                <ul class="header-list">
                    <li class="header-item"><a href="home.php" class="header-link">HOME</a></li>
                    <li class="header-item"><a href="about.php" class="header-link">ABOUT</a></li>
                    <li class="header-item"><a href="menu.php" class="header-link">MENU</a></li>
                    <li class="header-item"><a href="shop.php" class="header-link">SHOP</a></li>
                    <li class="header-item"><a href="reservation.php" class="header-link">RESERVATION</a></li>
                </ul>
                <h2 class="reservation-text">SHOP</h2>
            </div>
            <div class="header-right">
                <ul class="header-logo">
                    <li class="header-logo-list" id="account-button" onclick="openLoginForm()"><img src="img/person.svg" alt="Account"></li>
                    <li class="header-logo-list" id="search-button"> <img src="img/search.svg" alt="Search"> </li>
                    <li class="header-logo-list" id="more-button"> <img src="img/three-dots.svg" alt="More"> </li>
                </ul>

            </div>
            <div class="sliding-panel" id="more-panel">
                <button id="close-button">&times;</button>
                <div class="panel-content">
                    <div class="bar-info">
                        <img src="img/otium-logo.svg" alt="Otium Logo">
                        <h2>OTIUM</h2>
                    </div>
                    <div class="panel-text" style="font-size: 14px;">
                        <p>Eat. Drink. Be Happy.</p>
                        <p>The tenets of the Original Gastrobar. 
                            Great drinks, chef-inspired food, and awesome service in a 
                            comfortable atmosphere where you are encouraged to relax
                            and hang out. With OTIUM, no two bars are going to 
                            be exactly the same. We listen to our neighborhoods​ 
                            and let them shape us, not the other way around. 
                            That’s what makes OTIUM special. No corners cut​. 
                            No excuses. It’s not always the easiest way to do things, 
                            but it’s the right way. Because if you’re not going to give 
                            people something special, why bother at all? So whether 
                            you’re looking for good food, a refreshing cocktail, 
                            or just conversation, OTIUM has you covered.</p>
                    </div>
                    <div class="social-icons">
                        <a href="https://www.facebook.com"><img src="img/facebook.svg" alt="Facebook Logo"></a>
                        <a href="https://www.instagram.com"><img src="img/instagram.svg" alt="Instagram Logo"></a>
                        <a href="https://www.twitter.com"><img src="img/twitter.svg" alt="Twitter Logo" style="width: 24px; height: 24px;"></a>
                    </div>
                </div>
            </div>
        </header>

        <main class="content-below-header" id="main-container">
            <section class="food-search text-center">
                <div class="container1">
                    
                    <h2>Foods on <a href="#" class="text-white">"<?php echo e($category_title); ?>"</a></h2>

                </div>
            </section>
            <section class="food-menu">
                <div class="container1">
                    <h2 class="text-center">Food Menu</h2>

                    <?php
                        // Use prepared statement
                        $stmt2 = mysqli_prepare($conn, "SELECT * FROM tbl_food WHERE category_id = ?");
                        mysqli_stmt_bind_param($stmt2, "i", $category_id);
                        mysqli_stmt_execute($stmt2);
                        $res2 = mysqli_stmt_get_result($stmt2);

                        $count2 = mysqli_num_rows($res2);

                        if($count2 > 0)
                        {
                            while($row2 = mysqli_fetch_assoc($res2))
                            {
                                $id = $row2['id'];
                                $title = $row2['title'];
                                $price = $row2['price'];
                                $description = $row2['description'];
                                $image_name = $row2['image_name'];
                                ?>

                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            if($image_name == "")
                                            {
                                                echo "<div class='error'>Image not Available.</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL; ?>img/food/<?php echo e($image_name); ?>" alt="<?php echo e($title); ?>" class="img-responsive img-curve">
                                                <?php
                                            }
                                        ?>

                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo e($title); ?></h4>
                                        <p class="food-price">$<?php echo e($price); ?></p>
                                        <p class="food-detail">
                                            <?php echo e($description); ?>
                                        </p>
                                        <br>

                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo e($id); ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='error'>Food not Available.</div>";
                        }
                        mysqli_stmt_close($stmt2);
                    ?>

                    

                    <div class="clearfix"></div>

                    

                </div>

            </section>
        </main>

    
    <footer class="footer">
            <div class="container_top">
                <div class="column-left ">
                    <h2 class="Poppins">Opening Hours</h2>
                    <ul class="footer_hours DMsans">
                        <li><span class="span-left">MONDAY</span> <div class="horizontal"></div> <span class="span-right" style="color: #61CE70;">CLOSED</span></li>
                        <li><span class="span-left">TUESDAY</span> <div class="horizontal"></div> <span class="span-right">09:00 - 22:00</span></li>
                        <li><span class="span-left">WEDNESDAY</span> <div class="horizontal"></div> <span class="span-right">09:00 - 22:00</span></li>
                        <li><span class="span-left">THURSDAY</span> <div class="horizontal"></div><span class="span-right">09:00 - 22:00</span></li>
                        <li><span class="span-left">FRIDAY *</span> <div class="horizontal"></div> <span class="span-right">09:00 - 01:00</span></li>
                        <li><span class="span-left">SATURDAY *</span>  <div class="horizontal"></div><span class="span-right">09:00 - 01:00</span></li>
                        <li><span class="span-left">SUNDAY</span> <div class="horizontal"></div><span class="span-right">09:00 - 22:00</span></li>
                    </ul>
                </div>

                <div class="vertical vertical-right"></div>
                
                <div class="column-middle DMsans">
                    <h2 class="Poppins">Contact us</h2>
                    <p>Email: <a href="mailto:otium@gmail.com" style="color: #61CE70; text-decoration: none;">otium@gmail.com</a></p>
                    <p>Phone: 049 444 444</p>
                    <p>Address: Prishtina, Aktash</p>
                    <div class="subscription-form">
                        <h2 class="Poppins">Subscribe to Us</h2>
                        <div id="message"></div>
                        <form id="subscriptionForm">
                            <input type="email" id="email" placeholder="Your E-Mail" required >
                            <button type="button" onclick="subscribe()" class="button_footer"><img src="img/arrow.svg" alt="arrow button" style="height: 30px; "></button>
                        </form>
                    </div>
                </div>

                <div class = "vertical vertical-left"></div>
                
                <div class="column-right">        
                    <h2 class="Poppins">Other location</h2>
                    <div class="OtherLocation DMsans">  
                        <div class="OtherLocation_top">                    
                            <p><strong>Otium Caffe Shop</strong></p>
                            <p>Ahmet Krasniqi, Artis Complex Llamella C 1-1, Cima</p>
                        </div>
                        <div class="OtherLocation_bottom">            
                            <p><strong>Otium Caffe</strong></p>
                            <p>Arberi/Dragodan, 10000 Pristina</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container_bottom Poppins">
                <div class="footer_left">
                    <a href="index.php" style="text-decoration: none; color: gray;">
                        © OTIUM</a>
                </div>
                <div class="footer_middle">
                    <a href="https://www.facebook.com"><img src="img/facebook.svg" alt="Facebook Logo"></a>
                    <a href="https://www.instagram.com"><img src="img/instagram.svg" alt="Instagram Logo"></a>
                    <a href="https://www.twitter.com"><img src="img/twitter.svg" alt="Twitter Logo" style="width: 24px; height: 24px;"></a>
                </div>
                <div class="footer_right">2023 All Rights Reserved</div>
            </div>

        </footer>
        <script src="js/main.js"></script>
        
        
    </body>
</html>