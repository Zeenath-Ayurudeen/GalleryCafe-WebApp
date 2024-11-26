<?php
include('../dbconn.php');

$query = "SELECT orders.id, user.username, menu.name, orders.quantity, orders.total_price
          FROM orders
          JOIN user ON orders.user_id = user.user_id  
          JOIN menu ON orders.item_id = menu.id";

$result = $conn->query($query);
?>

<body>
        <h2>Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Items</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>LKR <?php echo number_format($row['total_price'], 2); ?></td>
                    <td data-label="Action">
                            <a class="approve-btn" href="staff.php?page=sreservations&approve=<?= $reservation['res_id']; ?>">Approve</a>
                            <a class="cancel-btn" href="staff.php?page=sreservations&cancel=<?= $reservation['res_id']; ?>">Cancel</a>

        </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>


</body>
