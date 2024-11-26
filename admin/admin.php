


<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'adashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - The Gallery Cafe</title>
    <link rel="stylesheet" href="adminstyles.css">
</head>
<body>

<div class="admin-container">
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>THE GALLERY CAFE</h2>
        </div>
        <ul class="sidebar-links">
            <li class="<?= ($page == 'adashboard') ? 'active' : '' ?>"><a href="admin.php?page=adashboard">Dashboard</a></li>
            <li class="<?= ($page == 'user_accounts') ? 'active' : '' ?>"><a href="admin.php?page=user_accounts">User Accounts</a></li>
            <li class="<?= ($page == 'amenu') ? 'active' : '' ?>"><a href="admin.php?page=amenu">Menu</a></li>
            <li class="<?= ($page == 'aorders') ? 'active' : '' ?>"><a href="admin.php?page=aorders">Orders</a></li>
            <li class="<?= ($page == 'areservations') ? 'active' : '' ?>"><a href="admin.php?page=areservations">Reservations</a></li>
            <li class="<?= ($page == 'promotions') ? 'active' : '' ?>"><a href="admin.php?page=promotions">Promotions</a></li>
            <li class="<?= ($page == 'aevents') ? 'active' : '' ?>"><a href="admin.php?page=aevents">Events</a></li>
            <li><a href="alogout.php">Logout</a></li>

        </ul>
    </div>

    <div class="main-content">
        <?php
        if (file_exists($page . '.php')) {
            include($page . '.php');
        } else {
            include('adashboard.php');
        }
        ?>
    </div>
</div>

</body>
</html>
