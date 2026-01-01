<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&family=Poppins:wght@500&display=swap');
    </style>
    <title>About me - Otium</title>
</head>
<body>
    <header class="header Poppins" id="header-about">
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
            <h2 class="about-us-text">ABOUT US</h2>
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
        

<!-- Login forma -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeLoginForm()">&times;</span>
        
        <form id="loginForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
                <div id="usernameError" class="Error2"></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
                <div id="passwordError" class="Error2"></div>
            </div>
            <button type="button" id="loginButton" onclick="validateLoginForm()" class="login-button">Login</button>            
            <p class="register-link" onclick="showRegisterForm()">Don't have an account? Register here.</p>
        </form>

        <!-- Register forma (fillimisht jasht pamjes) -->
        <form id="registerForm" style="display: none;">
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter your first name">
                <div id="nameError" class="Error2"></div>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter your last name">
                <div id="lastnameError" class="Error2"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
                <div id="emailError" class="Error2"></div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="registerPassword" name="registerPassword" placeholder="Enter your password">
                <div id="passwordError" class="Error2"></div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                <div id="confirmpasswordError" class="Error2"></div>
            </div>
            <button type="button" onclick="performRegister()" class="register-button" >Register</button>
            <p class="login-link" onclick="closeRegisterForm()">Already have an account? Log in here.</p>
        </form>
    </div>
</div>
 </header>
    <main class="content-below-header">
        <!-- <p style="height: 35vh;"></p> -->

        <section class="Our_Decor">
            <div class="Decor_left">
                <div>
                    <img id="slideshow" class="slideshow_content" src="" alt="slideshow content">
                </div>
            </div>
            <div class="Decor_right">
                <div class="Decor_bundle">
                    <p style="font-size: 1em; color: #9a6e41;" class="Poppins">OUR DECOR</p>
                    <h2 class="Decor_title Poppins">Rustic Style</h2>
                    <p class="Decor_description DMsans">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis labore accusantium aliquid quas deleniti, excepturi inventore distinctio dolores, consequuntur repellat, amet officia facere temporibus ad iure cumque asperiores at error.</p>
                    <ul class="Decor-list DMsans">
                        <li class="Decor-item">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorp.</li>
                        <li class="Decor-item">Curabitur interdum nunc sit amet ornare aliqhum.</li>
                        <li class="Decor-item">Consectetur adipiscing elit. Ut elit lorem ipsuet tellus, luctus nec ullamcorp.</li>
                    </ul>
                </div>
            </div>
        </section>
    
        <section class="Quality_Products">
            <div class="Quality_left">
                <div class="Quality_bundle">
                    <h2 class="Quality_title Poppins">Quality Products</h2>
                    <p class="Quality_description DMsans">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis labore accusantium aliquid quas deleniti, excepturi inventore distinctio dolores, consequuntur repellat, amet officia facere temporibus ad iure cumque asperiores at error.</p>
                </div>
            </div>
            <div class="Quality_right">
                <div class="Quality-wrapper" id="Quality">
                    <div class="Quality-slide">
                        <img src="img/Fancy_Drinks.png" alt="Fancy Drinks">
                    </div>
                    <div class="Quality-slide">
                        <img src="img/Wine_little.jpg" alt="Wine a little">
                    </div>
                    <div class="Quality-slide">
                        <img src="img/Made_from_nature.jpg" alt="Made form nature">
                    </div>
                </div>
            </div>
        </section>

        <div class="Our-Team">
            <h2 class="Our-Team-Title Poppins">OUR TEAM</h2>
            <section class="container" id="cardContainer">
                <div class="card">
                    <div class="image">
                        <img src="img/Victor Mitchell.jpg" alt="1">
                    </div>
                    <h2 class="Poppins">Victor Mitchell</h2>
                    <p class="title Poppins">Owner</p>
                    <p class="DMsans">Victor Mitchell, the visionary owner, brings a wealth of industry expertise and a passion for hospitality, shaping our establishment into a haven for culinary and beverage excellence.</p>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="img/Isabella Reynolds.jpg" alt="2">
                    </div>
                    <h2 class="Poppins">Isabella Reynolds</h2>
                    <p class="title Poppins">Co-owner</p>
                    <p class="DMsans">Isabella Reynolds, the co-owner, adds a touch of creativity and a commitment to exceptional service, ensuring our venue is not just a place to dine and drink but an experience to remember.</p>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="img/Olivia Sterling.jpg" alt="5">
                    </div>
                    <h2 class="Poppins">Olivia Sterling</h2>
                    <p class="title Poppins">Cocktail Maestro</p>
                    <p class="DMsans">Our Cocktail Maestro, combines flair and finesse to craft liquid masterpieces that tantalize the senses and redefine the art of mixology.</p>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="img/Emma Sanchez.jpg" alt="3">
                    </div>
                    <h2 class="Poppins">Emma Sanchez</h2>
                    <p class="title Poppins">Espresso Maestro</p>
                    <p class="DMsans">Our Espresso Maestro, crafts coffee masterpieces with precision and passion, turning every cup into a moment of caffeinated delight.</p>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="img/Liam Harper.jpg" alt="4">
                    </div>
                    <h2 class="Poppins">Liam Harper</h2>
                    <p class="title Poppins">Brew Maestro</p>
                    <p class="DMsans">Our Brew Maestro, transforms coffee into an art form, expertly balancing flavors to create the perfect brew for every palate.</p>
                </div>
                <div class="card">
                    <div class="image">
                        <img src="img/Alejandro Rodriguez.jpg" alt="6">
                    </div>
                    <h2 class="Poppins">Alejandro Rodriguez</h2>
                    <p class="title Poppins">Culinary Maestro</p>
                    <p class="DMsans">Our Culinary Maestro, orchestrates a symphony of flavors, creating culinary masterpieces that elevate dining experiences to new heights.</p>
                </div>
            </section>
        </div>

        <div class="Book_Table_Section">
            <img src="img/about_us_footer.jpeg" alt="foto" class="about_us_footer">
            <div class="Book_Table">
                <div><h2 class = "Book_Table_title">Book a table</h2></div>
                <div class="contact_us_button"><a href="reservation.php">CONTACT US</a></div>
            </div>
        </div>
    </main>
  
    <footer class="footer">
        <div class="container_top">
            <div class="column-left ">
                <h2 class="Poppins">Opening Hours</h2>
                <ul class="footer_hours DMsans">
                    <li><span class="span-left">MONDAY</span> <div class="horizontal horizontal_1"></div> <span class="span-right" style="color: #61CE70;">CLOSED</span></li>
                    <li><span class="span-left">TUESDAY</span> <div class="horizontal horizontal_2"></div> <span class="span-right">09:00 - 22:00</span></li>
                    <li><span class="span-left">WEDNESDAY</span> <div class="horizontal horizontal_3"></div> <span class="span-right">09:00 - 22:00</span></li>
                    <li><span class="span-left">THURSDAY</span> <div class="horizontal horizontal_4"></div><span class="span-right">09:00 - 22:00</span></li>
                    <li><span class="span-left">FRIDAY *</span> <div class="horizontal horizontal_5"></div> <span class="span-right">09:00 - 01:00</span></li>
                    <li><span class="span-left">SATURDAY *</span>  <div class="horizontal horizontal_6"></div><span class="span-right">09:00 - 01:00</span></li>
                    <li><span class="span-left">SUNDAY</span> <div class="horizontal horizontal_7"></div><span class="span-right">09:00 - 22:00</span></li>
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