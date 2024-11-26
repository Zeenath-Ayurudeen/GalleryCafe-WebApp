<?php
include('../dbconn.php');

$message = "";


// Delete Promotion 
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM promotions WHERE id='$delete_id'";

    if (mysqli_query($conn, $delete_query)) {
        $message = "Promotion deleted successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
    header("Location: staff.php?page=spromotions");
    exit();
}

// Retrieve all promotions from the database
$promotions = mysqli_query($conn, "SELECT * FROM promotions");

?>

<body>

<h2>Current Promotions</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Discount</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($promotions)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['discount']; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['end_date']; ?></td>
                <td>
                    <a href="spromotions.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this promotion?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
