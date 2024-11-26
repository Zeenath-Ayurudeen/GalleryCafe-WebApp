<?php
session_start();

$total_qty = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $total_qty += $qty;
    }
}

echo $total_qty;

if(isset($_SESSION['userId'])){
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
}
else{
    //header("Location:../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>The Gallery Cafe</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./styles.css" />
        <link rel="stylesheet" href="./responsive.css">
        <link rel="stylesheet" href="./script.js">
    </head>

<body>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav>
    <div class="logo">
        <h2 class="logo-heading">The Gallery Cafe</h2>
    </div>
    <ul class="nav-list">
        <li><a href="hero.php" class="<?php echo $current_page == 'hero.php' ? 'active' : ''; ?>">Home</a></li>
        <li><a href="menu.php" class="<?php echo $current_page == 'menu.php' ? 'active' : ''; ?>">Menu</a></li>
        <li><a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">About</a></li>
        <li><a href="hero.php#promotions" class="<?php echo $current_page == 'hero.php#promotions' ? 'active' : ''; ?>">Promotions</a></li>
        <li><a href="events.php" class="<?php echo $current_page == 'events.php' ? 'active' : ''; ?>">Events</a></li>
        <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
        
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="reservations.php" class="<?php echo $current_page == 'reservations.php' ? 'active' : ''; ?>">Reservations</a></li>
            <li><a href="cart.php" class="<?php echo $current_page == 'cart.php' ? 'active' : ''; ?>">
                <i class="fas fa-shopping-cart"></i>
                <span id="cart-badge" class="cart-badge"><?php echo $total_qty; ?></span></a></li>
            <li>
                <button class="btn btn-secondary" onclick="location.href='logout.php'">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </li>
        <?php else: ?>
            <li>
                <button class="btn btn-secondary" onclick="location.href='login.php'">
                    <i class="fas fa-user"></i>
                </button>
            </li>
        <?php endif; ?>
    </ul>
    <div class="hamburger" id="hamburger">
        <i class="fas fa-bars hamburger-icon"></i>
        <i class="fas fa-times cross-icon"></i>
    </div>
</nav>

<section id="about">
    <div class="container">
        <div class="about">
            <h1 class="about-heading">ABOUT US</h1>
        </div>
    </div>  
</section>


<section id="about-us">
    <div class="container">
        <div class="about-content">
            <h2>Welcome to <br>The Gallery Cafe!</h2>
            <p>Nestled in the heart of Colombo, The Gallery Cafe is a unique dining 
                experience where art meets culinary excellence. Established in 2001, we 
                have become a favorite destination for food lovers and art enthusiasts alike. 
                Our restaurant is housed in a historic building that once served as the office of 
                renowned architect Geoffrey Bawa, adding a touch of Sri Lanka’s rich heritage to
                your dining experience.
            </p>
            <button class="btn btn-primary" onclick="location.href='contact.php'">Contact Us</button>
        </div>
            <div class="about-img">
                <img src="./img/about1.jpg" alt="">
            </div>              
    </div>
</section>  

<section id="our-mission">
    <div class="container">
        <div class="mission">
            <h1>Our Mission</h1>
            <p>At The Gallery Cafe, we offer more than just dining we 
                create unforgettable experiences. Our diverse menu features
                 the best of Sri Lankan, Chinese, Indian and Italian cuisines, 
                 all in an art-inspired ambiance.
            </p>
        </div>
    </div>
</section>


<section id="facilities">
    <div class="title">
        <h1>Our Facilities</h1>
    </div>

    <div class="grid-wrapper">
        <div class="grid-box">
            <div class="facility-title">
                <h2>Outdoor Seating</h2>
            </div>
            <p>Enjoy your meals in our serene, open-air garden area, surrounded by lush greenery.</p>
        </div>
        <div class="grid-box">
            <div class="facility-title">
                <h2>Private Dining</h2>
            </div>
            <p>Our private dining rooms offer the perfect setting family gatherings, business meetings, and special events.</p>                
        </div>
            
        <div class="grid-box">
            <div class="facility-title">
                <h2>Event Hosting</h2>
            </div>
            <p>Whether it's a corporate event, an intimate wedding, or a private party, our venue offers custom event packages to suit your needs.</p>
        </div>
            
        <div class="grid-box">
            <div class="facility-title">
                <h2>Wi-Fi Access</h2>
            </div>
            <p>Stay connected while you dine with our complimentary high-speed Wi-Fi service.</p>
        </div>

        <div class="grid-box">
            <div class="facility-title">
                <h2>Parking Facilities</h2>
            </div>
            <p> We offer secure, on-site parking to ensure your visit is hassle-free.</p> 
        </div>

        <div class="grid-box">
            <div class="facility-title">
                <h2>Table Reservations</h2>
            </div>
            <p>Book your table in advance through our website for a seamless dining experience.</p>
        </div>       
    </div>
</section>

<section id="footer">
    <div class="footer-container">
        <div class="footer-content">
            <h2 class="logo-heading">The Gallery Cafe</h2>
            <p>The Gallery Cafe offers a unique dining experience where art meets culinary excellence.</p>
        </div>
        <div class="footer-content">
            <h3>Quick Links</h3>
            <ul class="footer-links">
                <li><a href="hero.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="hero.php#promotions">Promotions</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="footer-content">
            <h3>Follow Us</h3>
            <ul class="social-links">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 The Gallery Cafe. All rights reserved.</p>
    </div>
</section>


<script src=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity=
"sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="script.js"></script>

        
</body>
</html>