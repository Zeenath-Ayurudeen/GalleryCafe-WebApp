<?php
include('../dbconn.php');

// Initialize the message variable
$message = "";

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM events WHERE id = $delete_id";

    if (mysqli_query($conn, $delete_sql)) {
        $message = "Event deleted successfully!";
    } else {
        $message = "Error deleting event: " . mysqli_error($conn);
    }
    header("Location: staff.php?page=sevents");
    exit();
}

// Fetch all events from the database
$result = mysqli_query($conn, "SELECT * FROM events");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add and View Events</title>
</head>
<body>

  <h2>View Events</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Time</th>
      <th>Date</th>
      <th>Description</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><img src="../admin/uploads/<?php echo $row['image']; ?>" width="100"></td>
        <td>
          <a href="sevents.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>

</body>
</html>
