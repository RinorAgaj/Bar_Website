<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:opsz@9..40&family=Poppins:wght@500&display=swap');
    </style>
    <title>Menu - Otium</title>
</head>
<body>
    <header class="header Poppins" id="header-menu">
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
            <h2 class="menu-text">MENU</h2>
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
                    <a href="https://wwww.twitter.com"><img src="img/twitter.svg" alt="Twitter Logo" style="width: 24px; height: 24px;"></a>
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


        <div class="What_We_Offer_title Poppins">
            <p style="font-size: 1em; color: #9a6e41;" class="Poppins">WHAT WE OFFERR</p>
            <h2 class="Offer_h2">Drinks & Bites</h2>
            <p class="Offer_p DMsans">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Atque placeat iste dolorem minima, nobis aut sequi, repellat ad suscipit excepturi accusamus odit omnis ducimus laudantium? Magnam quaerat iste doloribus impedit.</p>
        </div>
        <section class="What_We_Offer_Section">
            <div class="Offer_left">
                <a href="#section1" class="animated1-fade" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(img/Cocktail\ Offer.jpg); height: 300px; width:400px; background-repeat:  no-repeat; background-size: cover; background-position: center;">
                    <div class="foto_Offer_left"></div>
                    <div id="Offer_left">
                        <h4 class="Offer_left_title Poppins">Cocktail</h4>
                    </div>
                </a>
            </div>
            <div class="Offer_middle">
                <a href="#section2" class="animated1-fade" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(img/Wine\ Offer.jpeg); height: 300px; width:400px; background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <div class="foto_Offer_right"></div>
                    <div id="Offer_right">
                        <h4 class="Offer_right_title Poppins">Wine</h4>
                    </div>
                </a>
            </div>
            <div class="Offer_right">
                <a href="#section3" class="animated1-fade" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(img/Bites\ Offer.jpg); height: 300px; width:400px; background-repeat: no-repeat; background-size: cover; background-position: center;">
                    <div class="foto_Offer_right"></div>
                    <div id="Offer_right">
                        <h4 class="Offer_right_title Poppins">Bites</h4>
                    </div>
                </a>
            </div>
        </section>


        <section id = "section1"class="Cocktail_Section Poppins">
            <div class="Cocktail_title Poppins">
                <p style="font-size: 1em; color: #9a6e41;" class="Poppins">FRUITY OR SOUR</p>
                <h2 class="Offer_h2">Fresh Cocktails</h2>
            </div>

            <div class="Cocktail_lista">
                <ul class="Cocktail_list">
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Classic Margarita</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$20</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">A variety of jams, preserves, mustards, dips and bread</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Gin and Juice</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$22</b></div>
                    </li>
                        <div class="Cocktail_description"style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Croque monsieur with soft sourdough, gruyère, smoked ham and creamy mustard mayo.</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Bloody Mary</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$22</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Moscow Mule</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$22</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Jack and Cola</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$20</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                
                </ul>
                <ul class="Cocktail_list">
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Jack and Cola</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$20</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">A variety of jams, preserves, mustards, dips and bread</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Moscow Mule</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$22</b></div>
                    </li>
                        <div class="Cocktail_description"style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Croque monsieur with soft sourdough, gruyère, smoked ham and creamy mustard mayo.</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Classic Margarita</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$20</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Gin and Juice</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$22</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                    <li class="Cocktail_list_item">
                        <div class="Cocktail_title Poppins"><b>Bloody Mary</b></div>
                        <div class="horizontal"></div>
                        <div class="Cocktail_price Poppins"><b>$22</b></div>
                    </li>
                        <div class="Cocktail_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                
                </ul>
            </div>
        </section>

        <section id = "section2" class="Wine_Section">
            <div class="Wine_title Poppins">
                <p style="font-size: 1em; color: #9a6e41;" class="Poppins">BOTTLES</p>
                <h2 style="font-size: 3em; margin: 0;">Wine list</h2>
            </div>

            <div class="Wine_lista">
                <ul class="Wine_list">
                    <li class="Wine_list_item">
                        <div class="Wine_title Poppins"><b>French red wine</b></div>
                        <div class="horizontal"></div>
                        <div class="Wine_price Poppins"><b>$89</b></div>
                    </li>
                        <div class="Wine_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">A variety of jams, preserves, mustards, dips and bread</div>
                    <li class="Wine_list_item">
                        <div class="Wine_title Poppins"><b>Italian red wine</b></div>
                        <div class="horizontal"></div>
                        <div class="Wine_price Poppins"><b>$120</b></div>
                    </li>
                        <div class="Wine_description"style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Croque monsieur with soft sourdough, gruyère, smoked ham and creamy mustard mayo.</div>
                    <li class="Wine_list_item">
                        <div class="Wine_title Poppins"><b>Spanish red wine</b></div>
                        <div class="horizontal"></div>
                        <div class="Wine_price Poppins"><b>$220</b></div>
                    </li>
                        <div class="Wine_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                </ul>
                <ul class="Wine_list">
                    <li class="Wine_list_item">
                        <div class="Wine_title Poppins"><b>Spanish red wine</b></div>
                        <div class="horizontal"></div>
                        <div class="Wine_price Poppins"><b>$220</b></div>
                    </li>
                        <div class="Wine_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">A variety of jams, preserves, mustards, dips and bread</div>
                    <li class="Wine_list_item">
                        <div class="Wine_title Poppins"><b>French red wine</b></div>
                        <div class="horizontal"></div>
                        <div class="Wine_price Poppins"><b>$89</b></div>
                    </li>
                        <div class="Wine_description"style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Croque monsieur with soft sourdough, gruyère, smoked ham and creamy mustard mayo.</div>
                    <li class="Wine_list_item">
                        <div class="Wine_title Poppins"><b>Italian red wine</b></div>
                        <div class="horizontal"></div>
                        <div class="Wine_price Poppins"><b>$120</b></div>
                    </li>
                        <div class="Wine_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
                </ul>
            </div>
        </section>

        <section id = "section3" class="Snacks_Section">
            <div class="Snacks_title Poppins">
                <p style="font-size: 1em; color: #9a6e41;" class="Poppins">SNACKS</p>
                <h2 style="font-size: 3em; margin: 0;">Bites</h2>
            </div>
            <ul class="Snacks_list">
                <li class="Snacks_list_item">
                    <div class="Snacks_name Poppins"><b>Charcuterie board to share</b></div>
                    <div class="horizontal"></div>
                    <div class="Snacks_price Poppins"><b>$50</b></div>
                </li>
                    <div class="Snacks_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">A variety of jams, preserves, mustards, dips and bread</div>
                <li class="Snacks_list_item">
                    <div class="Snacks_name Poppins"><b>Croque monsieur</b></div>
                    <div class="horizontal"></div>
                    <div class="Snacks_price Poppins"><b>$19</b></div>
                </li>
                    <div class="Snacks_description"style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Croque monsieur with soft sourdough, gruyère, smoked ham and creamy mustard mayo.</div>
                <li class="Snacks_list_item">
                    <div class="Snacks_name Poppins"><b>Salmon Salad</b></div>
                    <div class="horizontal"></div>
                    <div class="Snacks_price Poppins"><b>$22</b></div>
                </li>
                    <div class="Snacks_description" style="margin-bottom: 20px; font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">Salad with salmon, cucumber, red bell peppers, red onions, avocado and lettuce.</div>
            </ul>
        </section>
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
                <a href="https://wwww.twitter.com"><img src="img/twitter.svg" alt="Twitter Logo" style="width: 24px; height: 24px;"></a>
            </div>
            <div class="footer_right">2023 All Rights Reserved</div>
        </div>

    </footer>


    <script src="js/main.js"></script>
</body>
</html>