<?php
session_start();
include('dbconn.php');

$total_price=0;
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

// Handle adding items to the cart
if (isset($_POST['add_to_cart'])) {
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id] += $quantity;
    } else {
        $_SESSION['cart'][$item_id] = $quantity;
    }
}

// Handle increasing or decreasing item quantity
if (isset($_POST['increase_quantity'])) {
    $item_id = $_POST['item_id'];
    $_SESSION['cart'][$item_id]++;
}

if (isset($_POST['decrease_quantity'])) {
    $item_id = $_POST['item_id'];
    if ($_SESSION['cart'][$item_id] > 1) {
        $_SESSION['cart'][$item_id]--;
    } else {
        unset($_SESSION['cart'][$item_id]);
    }
}

// Handle removing items from the cart
if (isset($_POST['remove_item'])) {
    $item_id = $_POST['item_id'];
    unset($_SESSION['cart'][$item_id]);
}

// Fetch items from the database
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $item_ids = implode(",", array_keys($_SESSION['cart']));
    $query = "SELECT * FROM menu WHERE id IN ($item_ids)";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $cart_items[] = $row;
    }
}

// Handle checkout and storing the order in the database
if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];
    $order_total = 0;

    foreach ($cart_items as $item) {
        $item_total = $item['price'] * $item['quantity'];
        $order_total += $item_total;

        // Store each item in the orders table
        $stmt = $conn->prepare("INSERT INTO orders (user_id, item_id, quantity, total_price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiid', $user_id, $item['id'], $item['quantity'], $item_total);
        $stmt->execute();
    }

    // Clear the cart after checkout
    $_SESSION['cart'] = [];
    header('Location: order_confirmation.php');
    exit();
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
</head>

<style>
.cart-container {
    display: flex;
    max-width: 1200px;
    margin: 20px auto;
    margin-top: 100px;
    background-color: #1e1e1e; 
    border-radius: 12px; 
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); 
}

table {
    width: 70%;
    background-color: #222; 
    border-collapse: collapse;
    border-radius: 8px; 
    overflow: hidden; 
}

table th, table td {
    padding: 15px;
    text-align: center;
    
}

table th {
    font-size: 16px;
    font-weight: bold;
    background-color: #333; 
}

table tr a{
    color: #c5671b;;
}
table img {
    max-width: 80px;
    border-radius: 8px;
}

.cart-item-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.quantity-control {
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-control input {
    width: 40px;
    text-align: center;
    padding: 8px;
    margin: 0 5px;
    border: 1px solid #444; 
    border-radius: 5px;
    background-color: #333; 
    color: #fff; 
}

.quantity-control button {
    background-color: #555; 
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.quantity-control button:hover {
    background-color: #777; 
}

.cart-total {
    text-align: right;
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 20px;
}

.order-summary {
    width: 25%;
    background-color: #2a2a2a; 
    padding: 20px;
    border-radius: 12px; 
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); 
}

.order-summary h3 {
    font-size: 20px;
    margin-bottom: 20px;
    border-bottom: 2px solid #444; 
    padding-bottom: 10px; 
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.summary-item span {
    color: #ffffff;
}

.btn-checkout {
    background-color: #4CAF50; 
    color: #fff; 
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    width: 100%;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
    transition: background-color 0.3s; 
}

.btn-checkout:hover {
    background-color: #45a049; 
}

.remove-item {
    background-color: #e74c3c; 
    color: #fff; 
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}
.remove-item:hover {
    background-color: #c0392b; 
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

    <section id="cart">
        <div class="cart-container">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cart_items)): ?>
                        <?php
                        $total_price = 0;
                        foreach ($cart_items as $item):
                            $item_total = $item['price'] * $item['quantity'];
                            $total_price += $item_total;
                        ?>
                        <tr>
                            <td>
                                <div class="cart-item-info">
                                    <img src="<?php echo './admin/uploads/' . $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                    <span><?php echo $item['name']; ?></span>
                                </div>
                            </td>
                            <td>
                                <form method="POST" action="cart.php" class="quantity-control">
                                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="decrease_quantity" class="btn btn-secondary">-</button>
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                    <button type="submit" name="increase_quantity" class="btn btn-primary">+</button>
                                </form>
                            </td>
                            <td>LKR <?php echo number_format($item_total, 2); ?></td>
                            <td>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="remove_item" class="remove-item">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Your cart is empty. <a href="menu.php">Go back to the menu</a> to add items.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="order-summary">
                <h3>Order Summary</h3>
                <div class="summary-item">
                    <span>Sub Total</span>
                    <span>LKR <?php echo number_format($total_price, 2); ?></span>
                </div>
                <div class="summary-item">
                    <span>Discount</span>
                    <span>LKR 0.00</span>
                </div>
                <div class="summary-item">
                    <span>Total</span>
                    <span>LKR <?php echo number_format($total_price, 2); ?></span>
                </div>
                <button onclick="location.href='checkout.php'" class="btn btn-checkout">Proceed to Checkout</button>

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
</body>
</html>
