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
    

<section id="main">
    <div class="container">
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

        <div class="main-content">
            <h1 class="intro-heading">Experience the Best Dining in Colombo</h1>   
            <p>The Gallery Cafe invites you to experience Colombo's diverse culinary scene, where traditional Sri Lankan flavors and international
                influences blend to create a unique and memorable dining experience.</p>    
        </div>
        <div class="intro-buttons">
            <button class="btn btn-primary" onclick="location.href='menu.php'">Order Now</button>
            <button class="btn btn-primary" onclick="location.href='reservations.php'">Make a Reservation</button>
            
        </div>
        </div>
</section>

<section id="cuisines">
    <div class="container">
        <div class="section-title">
            <h2>Types of Meals and Cuisines</h2>
        </div>
        <div class="cards">
            <div class="card">
                <img src="./img/Sri Lankan Cuisine.jpg" alt="Sri Lanka">
                <h3>Sri Lankan Cuisine</h3>
                <p>Richly flavored, authentic Sri Lankan dishes that capture 
                    the essence of the island's culinary heritage</p>
            </div>

            <div class="card">
                <img src="./img/Chinese Cuisine.jpg" alt="Chinese">
                <h3>Chinese Cuisine</h3>
                <p>Authentic Chinese cuisine with a harmonious balance of flavors 
                    and diverse regional specialties.</p>
            </div>

            <div class="card">
             <img src="./img/Indian Cuisine.jpg" alt="Indian">
                <h3>Indian Cuisine</h3>
                <p>Indian cuisine offering a symphony of bold spices, aromatic 
                    flavors, and traditional dishes from across the subcontinent.</p>
            </div>

            <div class="card">
                <img src="./img/Italian Cuisine.jpg" alt="Italian">
                <h3>Italian Cuisine</h3>
                <p>Delicious Italian cuisine that combines fresh, simple ingredients with bold, 
                comforting flavors and traditional cooking techniques.</p>
            </div>
        </div>
    </div>
</section>

<section id="special-foods">
    <div class="container">
        <div class="section-title">
            <h2>Special Foods and Beverages</h2>
        </div>
        <div class="cards">
            <div class="card">
                <img src="./img/foods.jpg" alt="Featured Dishes">
                <h3>Featured Dishes</h3>
                <p>Richly flavored, authentic Sri Lankan dishes that capture 
                    the essence of the island's culinary heritage</p>
            </div>

            <div class="card">
                <img src="./img/beverages.jpg" alt="Special Beverages">
                <h3>Special Beverages</h3>
                <p>Authentic Chinese cuisine with a harmonious balance of flavors 
                    and diverse regional specialties.</p>
            </div>

            <div class="card">
                <img src="./img/desserts.jpg" alt="Dessert Specials">
                <h3>Dessert Specials</h3>
                <p>Indian cuisine offering a symphony of bold spices, aromatic 
                    flavors, and traditional dishes from across the subcontinent.</p>
            </div>
        </div>
    </div>
</section>


<?php
include('./dbconn.php');
$promotions = mysqli_query($conn, "SELECT * FROM promotions");
?>

<section id="promotions">
    <div class="section-title">
        <h2>Current Promotions</h2>
    </div>
    <div class="promo-container">
        <?php if(mysqli_num_rows($promotions) > 0): ?>
            <?php while($promo = mysqli_fetch_assoc($promotions)): ?>
                <div class="promo-card">
                    <h3><?php echo $promo['title']; ?></h3>
                    <p><?php echo $promo['description']; ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No promotions available at the moment.</p>
        <?php endif; ?>
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
