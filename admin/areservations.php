<?php
session_start();
include('../dbconn.php');

$reservations_query = "SELECT * FROM reservations";
$reservations_result = mysqli_query($conn, $reservations_query);

// Handle reservation approval
if (isset($_GET['approve'])) {
    $res_id = $_GET['approve'];
    $query = "UPDATE reservations SET status = 'Approved' WHERE res_id = '$res_id'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Reservation ID $res_id has been approved.";
    } else {
        $_SESSION['error'] = "Failed to approve reservation ID $res_id.";
    }
    header('Location: admin.php?page=areservations');
    exit();
}

// Handle reservation cancellation
if (isset($_GET['cancel'])) {
    $res_id = $_GET['cancel'];
    $query = "UPDATE reservations SET status = 'Canceled' WHERE res_id = '$res_id'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Reservation ID $res_id has been canceled.";
    } else {
        $_SESSION['error'] = "Failed to cancel reservation ID $res_id.";
    }
    header('Location: admin.php?page=areservations');
    exit(); 
}
?>

<h2>Reservations</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div style="color: green; ">
        <?= $_SESSION['message']; ?>
        <?php unset($_SESSION['message']);?>
    </div>
<?php elseif (isset($_SESSION['error'])): ?>
    <div style="color: red; ">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<table>
    <tr>
        <th>Res_ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Date</th>
        <th>Time</th>
        <th>Table</th>
        <th>People</th>
        <th>Special Requests</th>
        <th>Parking</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    
    <?php while ($reservation = mysqli_fetch_assoc($reservations_result)): ?>
    <tr>
        <td data-label="Reservation ID"><?= $reservation['res_id']; ?></td>
        <td data-label="Full Name"><?= $reservation['fullname']; ?></td>
        <td data-label="Email"><?= $reservation['email']; ?></td>
        <td data-label="Contact"><?= $reservation['contact']; ?></td>
        <td data-label="Date"><?= $reservation['date']; ?></td>
        <td data-label="Time"><?= $reservation['time']; ?></td>
        <td data-label="Table Selection"><?= $reservation['table_selection']; ?></td>
        <td data-label="People"><?= $reservation['people']; ?></td>
        <td data-label="Special Requests"><?= $reservation['special_requests']; ?></td>
        <td data-label="Parking"><?= $reservation['parking'] ? 'Yes' : 'No'; ?></td>
        <td data-label="Status"><?= $reservation['status']; ?></td>    
        <td data-label="Action">
            <?php if (strtolower($reservation['status']) == 'pending'): ?>
                <a class="approve-btn" href="admin.php?page=areservations&approve=<?= $reservation['res_id']; ?>">Approve</a>
                <a class="cancel-btn" href="admin.php?page=areservations&cancel=<?= $reservation['res_id']; ?>">Cancel</a>
            <?php else: ?>
                <span><?= ucfirst($reservation['status']); ?></span>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
