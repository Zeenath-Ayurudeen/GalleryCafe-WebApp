<?php
include('../dbconn.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $discount = $_POST['discount'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $query = "INSERT INTO promotions (title, description, discount, start_date, end_date) 
              VALUES ('$title', '$description', '$discount', '$start_date', '$end_date')";


    if (mysqli_query($conn, $query)) {
        $message = "New promotion added successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Delete Promotion 
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM promotions WHERE id='$delete_id'";

    if (mysqli_query($conn, $delete_query)) {
        $message = "Promotion deleted successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
    header("Location: admin.php?page=promotions");
    exit();
}

// Retrieve all promotions from the database
$promotions = mysqli_query($conn, "SELECT * FROM promotions");

?>

<body>

<h2>Add New Promotion</h2>

<!-- Display success/error message -->
<?php if (!empty($message)): ?>
    <p class="message <?php echo strpos($message, 'Error') === false ? 'success' : 'error'; ?>">
        <?php echo $message; ?>
    </p>
<?php endif; ?>

<!-- Promotion Form -->
<form method="POST" action="">
    <label for="title">Title:</label>
    <input type="text" name="title" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="discount">Discount:</label>
    <input type="text" name="discount" required>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" required>

    <input type="submit" value="Add Promotion">
</form>

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
                    <a href="promotions.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this promotion?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
