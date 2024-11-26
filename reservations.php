<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./styles.css" />
    <link rel="./responsive.css">
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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $date = $conn->real_escape_string($_POST['date']);  
    $time = $conn->real_escape_string($_POST['time']);
    $table_selection = $conn->real_escape_string($_POST['table_selection']);
    $people = $conn->real_escape_string($_POST['people']);
    $special_requests = $conn->real_escape_string($_POST['special_requests']);
    $parking = isset($_POST['parking']) ? 1 : 0;  

    $sql = "INSERT INTO reservations (fullname, email, contact, date, time, table_selection, people, special_requests, parking)
            VALUES ('$fullname', '$email', '$contact', '$date', '$time', '$table_selection', '$people', '$special_requests', '$parking')";

    if ($conn->query($sql) === TRUE) {
        $message_status = "<p style='color:green;'>Reservation successfully submitted!</p>";
    } else {
        $message_status = "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

}

$current_page = basename($_SERVER['PHP_SELF']);
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

<section id="reservation">
    <div class="reservation-container">
        <h2>Make a Reservation</h2>

        <?php
                if(isset($message_status)){
                    echo $message_status;
                }
        ?>

        <form action="reservations.php" method="POST" class="reservation-form">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="contact">Contact No.</label>
            <input type="tel" id="contact" name="contact" required>

            <div class="form-row">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required />
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <select id="time" name="time" required>
                        <option value="" disabled selected></option>
                        <option value="11:00">11:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="15:00">15:00 PM</option>
                        <option value="19:00">19:00 PM</option>
                        <option value="20:00">20:00 PM</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="table_selection">Table Selection</label>
                    <select id="table_selection" name="table_selection" required>
                        <option value="disabled selected"></option>
                        <option value="window">Window</option>
                        <option value="outdoor">Outdoor</option>
                        <option value="private">Private Dining</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="people">No. of People</label>
                    <select id="people" name="people" required>
                        <option value="" disabled selected></option>
                        <option value="2">02 and above</option>
                        <option value="3">03 and above</option>
                        <option value="05">05 and above</option>
                    </select>
                </div>
            </div>
            
            <label for="special_requests">Special Requests</label>
            <textarea id="special_requests" name="special_requests" rows="4" placeholder="Add any special requests here..."></textarea>

            <div class="parking-section"> 
                <label for="parking">Parking</label>
                <input type="checkbox" id="parking" name="parking"> 
            </div>
            <p>(Click here if you need parking)</p>

            <button type="submit" class="submit-btn">Submit</button>
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
