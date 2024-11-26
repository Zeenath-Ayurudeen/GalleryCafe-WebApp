<?php
include('../dbconn.php');

// Initialize the message variable
$message = "";

// Handle form submission for adding an event
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $time = $_POST['time'];
    $date = $_POST['date'];
    $description = $_POST['description'];
  
    // Handle image upload
    $target_dir = "uploads/";
    $image = $_FILES['image']['name'];
    $target_file = $target_dir . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // Insert event into the database
        $sql = "INSERT INTO events (name, time, date, description, image) VALUES ('$name', '$time', '$date', '$description', '$image')";
        
        if (mysqli_query($conn, $sql)) {
            $message = "Event added successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Error uploading image.";
    }
    header("Location: admin.php?page=aevents");
    exit();
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM events WHERE id = $delete_id";

    if (mysqli_query($conn, $delete_sql)) {
        $message = "Event deleted successfully!";
    } else {
        $message = "Error deleting event: " . mysqli_error($conn);
    }
    header("Location: admin.php?page=aevents");
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

  <h2>Add New Event</h2>

  <!-- Display the message -->
  <?php if ($message != "") { ?>
      <p style="color: green;"><?php echo $message; ?></p>
  <?php } ?>

  <form action="aevents.php" method="POST" enctype="multipart/form-data">
    <label for="name">Event Name:</label>
    <input type="text" name="name" required><br><br>
    
    <label for="time">Time:</label>
    <input type="time" name="time" required><br><br>

    <label for="date">Date:</label>
    <input type="date" name="date" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br><br>

    <label for="image">Image:</label>
    <input type="file" name="image" required><br><br>

    <input type="submit" value="Add Event">
  </form>

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
        <td><img src="uploads/<?php echo $row['image']; ?>" width="100"></td>
        <td>
          <a href="aevents.php?delete_id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>

</body>
</html>
