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
$message = ""; 

$total_qty = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $total_qty += $qty;
    }
}

echo $total_qty;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm-password']);

    if ($password !== $confirm_password) {
        $message = "<p style='color:red;'>Passwords do not match. Please try again.</p>";
    } else {

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO user (username, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $message = "<p style='color:#39d353;'>Sign up successful! You can now <a href='login.php' style='color:green'>Log in</a>.</p>";
        } else {
            $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    }
}
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


    <section id="login">
        <div class="login-container">
            <h2>Sign Up</h2>

            <?php
            if (!empty($message)) {
                echo $message;
            }
            ?>
            
            <form class="login-form" method="POST" action="signup.php">
                <div class="input-box">
                    <label for="name">Full Name</label>
                    <input type="name" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="input-box">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <input type="submit" value="Sign Up" class="submit-btn">
                <p>Already have an account? <a href="login.php" class="signup-link">Login</a></p>
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
                <li><a href="reservations.php">Reservations</a></li>
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