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
    session_start();
    require_once('dbconn.php');

    $total_qty = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $qty) {
            $total_qty += $qty;
        }
    }
    
    echo $total_qty;
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $email = $conn->real_escape_string($_POST['email']);
        $message = $conn->real_escape_string($_POST['message']);

        $sql = "INSERT INTO contact (fullname, email, message) VALUES ('$fullname', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            $message_status = "<p style='color:#39d353;'>Message sent successfully!</p>";
        } else {
            $message_status = "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
    $current_page = basename(path: $_SERVER['PHP_SELF']);
    $conn->close();
    
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

    <section id="contact">
        <div class="contact-bg">
            <h1>CONTACT US</h1>
        </div>
        <div id="contact-info" class="container">
            <div class="contact-info">
                <div class="box">
                    <div class="icon"><i class="fas fa-location-dot"></i></div>
                    <div class="text">
                        <p>The Gallery Cafe Pvt Ltd,<br>
                            No.260/1/1,<br>
                            Temple road,<br>
                            Nugegoda
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fas fa-phone"></i></div>
                    <div class="text">
                        <p>+94 11 778 4005<br>
                            +94 11 778 4006<br>
                            +94 77 475 8979<br>
                        </p>
                    </div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fas fa-envelope"></i></div>
                    <div class="text">
                        <p>info@gallerycafe.com</p>
                    </div>
                </div>
            </div>
            
            <form action="contact.php" method="POST" class="contact-form">
                <h2>Send Message</h2>
                
                <?php
                if(isset($message_status)){
                    echo $message_status;
                }
                ?>
                
                <div class="input-box">
                    <input type="text" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="E-mail Address" required>
                </div>
                <div class="input-box">
                    <textarea name="message" placeholder="Your Message" required></textarea>
                </div>
                <div class="input-box">
                    <input type="submit" value="Send">
                </div>
            </form>
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
