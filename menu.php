<?php
include('dbconn.php');
session_start();

$total_qty = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $qty) {
        $total_qty += $qty;
    }
}

echo $total_qty;

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle Add to Cart
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    // Add item to cart or increment the quantity if it already exists
    $_SESSION['cart'][$item_id] = isset($_SESSION['cart'][$item_id]) ? $_SESSION['cart'][$item_id] + 1 : 1;

    // Set flash message
    $_SESSION['flash_message'] = "Item added to cart!";
    
    // Redirect to the same page to prevent form re-submission
    header('Location: menu.php');
    exit();
}

// Handle search
$category_filter = '';
if (isset($_GET['category'])) {
    $category_filter = $_GET['category'];
    $query = "SELECT * FROM menu WHERE category LIKE '%$category_filter%'";
} else {
    $query = "SELECT * FROM menu";
}

$result = $conn->query($query);
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
</head>

<style>
    .flash-message {
    position: fixed;
    top: 80px; 
    left: 50%;
    transform: translateX(-50%);
    background-color: #28a745;
    color: #fff; 
    padding: 15px 30px;
    border-radius: 5px;
    text-align: center;
    font-size: 1.2rem;
    z-index: 1000; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    animation: fadeout 4s ease-out forwards; 
}

@keyframes fadeout {
    0% {
        opacity: 1;
    }
    90% {
        opacity: 0.1;
    }
    100% {
        display: none;
    }
}
.menu-search-container {
    display: flex;
    justify-content: flex-end; 
    margin-bottom: 20px;
}

.search-bar-form {
    display: flex;
    gap: 10px;
}

.search-bar-form input[type="text"] {
    padding: 5px 10px; 
    font-size: 0.9rem; 
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 180px; 
}

.search-bar-form .btn-search {
    padding: 5px 15px; 
    font-size: 0.9rem; 
    background-color: #333;;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

.search-bar-form .btn-search:hover {
    background-color: #1f1f1f;
}

</style>

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


<section id="menu">
    <div class="menu-search-container">
        <form method="GET" action="menu.php" class="search-bar-form">
            <input type="text" name="category" placeholder="Search by category..." value="<?php echo htmlspecialchars($category_filter); ?>" />
            <button type="submit" class="btn btn-search">Search</button>
        </form>
    </div>

    <div class="menu-container">
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="flash-message">
                <?php
                echo $_SESSION['flash_message'];
                unset($_SESSION['flash_message']);
                ?>
            </div>
        <?php endif; ?>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='menu-card'>";
                echo "<img src='./admin/uploads/{$row['image']}' alt='{$row['name']}'>";
        
                echo "<div class='menu-card-content'>";
                echo "<h3>{$row['name']}</h3>";
                echo "<p>LKR " . number_format($row['price'], 2) . "</p>";
                echo "<span>Category: {$row['category']}</span>";
                
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='item_id' value='{$row['id']}'>"; 
                echo "<button type='submit' name='add_to_cart' class='btn btn-primary'>Add to Cart</button>";
                echo "</form>";

                echo "</div>"; 
                echo "</div>"; 
            }
        } else {
            echo "<p>No menu items found.</p>";
        }
        ?>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"
        integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</script>
<script src="script.js"></script>


</body>
</html>
