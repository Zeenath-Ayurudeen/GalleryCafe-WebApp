<?php
include('../dbconn.php');


$query_reservations = "SELECT COUNT(*) AS total_reservations FROM reservations";
$result_reservations = mysqli_query($conn, $query_reservations);
$row_reservations = mysqli_fetch_assoc($result_reservations);

$query_orders = "SELECT COUNT(*) AS total_orders FROM orders";
$result_orders = mysqli_query($conn, $query_orders);
$row_orders = mysqli_fetch_assoc($result_orders);

$query_promotions = "SELECT COUNT(*) AS total_promotions FROM promotions";
$result_promotions = mysqli_query($conn, $query_promotions);
$row_promotions = mysqli_fetch_assoc($result_promotions);

$query_events = "SELECT COUNT(*) AS total_events FROM events";
$result_events = mysqli_query($conn, $query_events);
$row_events = mysqli_fetch_assoc($result_events);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - The Gallery Cafe</title>
    <link rel="stylesheet" href="../admin/adminstyles.css">
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
    <h1>Welcome to The Gallery Cafe Staff Dashboard.</h1>
    
    <div class="dashboard-summary">
        <div class="summary-item">
            <h3>Total Orders</h3>
            <p><?= $row_orders['total_orders']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Reservations</h3>
            <p><?= $row_reservations['total_reservations']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Promotions</h3>
            <p><?= $row_promotions['total_promotions']; ?></p>
        </div>

        <div class="summary-item">
            <h3>Total Events</h3>
            <p><?= $row_events['total_events']; ?></p>
        </div>
    </div>

</div>

</body>
</html>