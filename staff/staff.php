


<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'sdashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - The Gallery Cafe</title>
    <link rel="stylesheet" href="../admin/adminstyles.css">
</head>
<body>

<div class="admin-container">
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>THE GALLERY CAFE</h2>
        </div>
        <ul class="sidebar-links">
            <li class="<?= ($page == 'sdashboard') ? 'active' : '' ?>"><a href="staff.php?page=sdashboard">Dashboard</a></li>
            <li class="<?= ($page == 'sorders') ? 'active' : '' ?>"><a href="staff.php?page=sorders">Orders</a></li>
            <li class="<?= ($page == 'sreservations') ? 'active' : '' ?>"><a href="staff.php?page=sreservations">Reservations</a></li>
            <li class="<?= ($page == 'spromotions') ? 'active' : '' ?>"><a href="staff.php?page=spromotions">Promotions</a></li>
            <li class="<?= ($page == 'sevents') ? 'active' : '' ?>"><a href="staff.php?page=sevents">Events</a></li>
            <li><a href="slogout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <?php
        if (file_exists($page . '.php')) {
            include($page . '.php');
        } else {
            include('sdashboard.php');
        }
        ?>
    </div>
</div>

</body>
</html>
