<?php
include('../dbconn.php');

$query_users = "SELECT COUNT(*) AS total_users FROM user";
$result_users = mysqli_query($conn, $query_users);
$row_users = mysqli_fetch_assoc($result_users);

$query_admins = "SELECT COUNT(*) AS total_admins FROM admin";
$result_admins = mysqli_query($conn, $query_admins);
$row_admins = mysqli_fetch_assoc($result_admins);

$query_staff = "SELECT COUNT(*) AS total_staff FROM staff";
$result_staff = mysqli_query($conn, $query_staff);
$row_staff = mysqli_fetch_assoc($result_staff);

$query_reservations = "SELECT COUNT(*) AS total_reservations FROM reservations";
$result_reservations = mysqli_query($conn, $query_reservations);
$row_reservations = mysqli_fetch_assoc($result_reservations);

$query_menu = "SELECT COUNT(*) AS total_menu_items FROM menu";
$result_menu = mysqli_query($conn, $query_menu);
$row_menu = mysqli_fetch_assoc($result_menu);

$query_orders = "SELECT COUNT(*) AS total_orders FROM orders";
$result_orders = mysqli_query($conn, $query_orders);
$row_orders = mysqli_fetch_assoc($result_orders);

$query_events = "SELECT COUNT(*) AS total_events FROM events";
$result_events = mysqli_query($conn, $query_events);
$row_events = mysqli_fetch_assoc($result_events);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - The Gallery Cafe</title>
    <link rel="stylesheet" href="adminstyles.css">
</head>

<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}
.dashboard-summary {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 30px;
    gap: 20px;
}
.dashboard-container h1{
    font-size: 50px;
    color:  #c5671b;
}
.summary-item {
    background-color: #fff;
    padding: 25px;
    width: 30%;  
    border-radius: 12px;
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
}
.summary-item h3 {
    font-size: 1.2rem;
    color: #333;
    margin-bottom: 10px;
}
.summary-item p {
    font-size: 2.5rem;
    font-weight: bold;
    color:  #c5671b;
    margin: 0;
}

.summary-item:hover {
    transform: translateY(-10px);
    box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
}

@media (max-width: 768px) {
    .summary-item {
        width: 45%; 
    }
}

@media (max-width: 480px) {
    .summary-item {
        width: 100%;
    }
}
</style>

<body>

<div class="dashboard-container">
    <h1>Welcome to The Gallery Cafe Admin Dashboard.</h1>
    
    <div class="dashboard-summary">
        <div class="summary-item">
            <h3>Total Users</h3>
            <p><?= $row_users['total_users']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Admins</h3>
            <p><?= $row_admins['total_admins']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Staff</h3>
            <p><?= $row_staff['total_staff']; ?></p>
        </div>
        
        <div class="summary-item">
            <h3>Total Reservations</h3>
            <p><?= $row_reservations['total_reservations']; ?></p>
        </div>
        
        <div class="summary-item">
            <h3>Total Menu Items</h3>
            <p><?= $row_menu['total_menu_items']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Orders</h3>
            <p><?= $row_orders['total_orders']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Events</h3>
            <p><?= $row_events['total_events']; ?></p>
        </div>
    </div>

</div>

</body>
</html>