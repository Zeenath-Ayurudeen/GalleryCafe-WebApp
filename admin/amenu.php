<?php
session_start();
include('../dbconn.php');

// Handle Add Menu Item
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    // Image upload
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $query = "INSERT INTO menu (name, price, category, image) VALUES ('$name', '$price', '$category', '$image')";
        if ($conn->query($query) === TRUE) {
            $_SESSION['message'] = "New menu item added successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Error: " . $conn->error;
            $_SESSION['msg_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Failed to upload image.";
        $_SESSION['msg_type'] = "error";
    }

    header("Location: admin.php?page=amenu");
    exit();
}

// Handle Update Menu Item
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Update the database
    $query = "UPDATE menu SET name='$name', price='$price', category='$category' WHERE id='$id'";

    if ($conn->query($query) === TRUE) {
        $_SESSION['message'] = "Menu item updated successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
        $_SESSION['msg_type'] = "error";
    }
    header("Location: admin.php?page=amenu");
    exit();
}

// Handle Delete Menu Item
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM menu WHERE id = $delete_id";

    if (mysqli_query($conn, $delete_sql)) {
        $_SESSION['message'] = "Menu deleted successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error deleting menu: " . mysqli_error($conn);
        $_SESSION['msg_type'] = "error";
    }
    header("Location: admin.php?page=amenu");
    exit();
}

// Fetch all menu items from the database
$result = mysqli_query($conn, "SELECT * FROM menu");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Management</title>
</head>
<body>

<h2>Add New Menu Item</h2>

<?php
// Display success or error message
if (isset($_SESSION['message'])): ?>
    <div class="message <?= $_SESSION['msg_type'] ?>">
        <?= $_SESSION['message'] ?>
    </div>
<?php 
    unset($_SESSION['message']);
    unset($_SESSION['msg_type']);
endif;
?>

<form action="amenu.php" method="post" enctype="multipart/form-data">
    <label for="name">Item Name:</label>
    <input type="text" name="name" id="name" required><br>

    <label for="price">Price:</label>
    <input type="number" step="0.01" name="price" id="price" required><br>

    <label for="category">Category:</label>
    <select name="category" id="category" required>
        <option value="Sri Lankan">Sri Lankan</option>
        <option value="Italian">Italian</option>
        <option value="Chinese">Chinese</option>
        <option value="Indian">Indian</option>
        <option value="Beverages">Beverages</option> 
        <option value="Desserts">Desserts</option>   
    </select> <br>

    <label for="image">Image:</label>
    <input type="file" name="image" id="image" required><br>
    
    <input type="submit" name="submit" value="Add Item">
</form>

<h2>Existing Menu Items</h2>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><img src='uploads/{$row['image']}' width='100' height='100'></td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>LKR " . number_format($row['price'], 2) . "</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td>
                <button onclick=\"document.getElementById('edit-form-{$row['id']}').style.display='block'\">Edit</button> 
                <a href='amenu.php?delete_id={$row['id']}' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this menu item?');\">Delete</a>
            </td>";
            echo "</tr>";
            ?>
            
            <tr id="edit-form-<?= $row['id'] ?>" class="edit-form" style="display:none;">
                <td colspan="5">
                    <form action="amenu.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">

                        <label for="name">Item Name:</label>
                        <input type="text" name="name" value="<?= $row['name'] ?>" required><br>

                        <label for="price">Price:</label>
                        <input type="number" step="0.01" name="price" value="<?= $row['price'] ?>" required><br>

                        <label for="category">Category:</label>
                        <select name="category" required>
                            <option value="Sri Lankan" <?= $row['category'] == 'Sri Lankan' ? 'selected' : '' ?>>Sri Lankan</option>
                            <option value="Italian" <?= $row['category'] == 'Italian' ? 'selected' : '' ?>>Italian</option>
                            <option value="Chinese" <?= $row['category'] == 'Chinese' ? 'selected' : '' ?>>Chinese</option>
                            <option value="Indian" <?= $row['category'] == 'Indian' ? 'selected' : '' ?>>Indian</option>
                            <option value="Beverages" <?= $row['category'] == 'Beverages' ? 'selected' : '' ?>>Beverages</option> 
                            <option value="Desserts" <?= $row['category'] == 'Desserts' ? 'selected' : '' ?>>Desserts</option>   
                        </select> <br>

                        <input type="submit" name="update" value="Update Item">
                        <button type="button" onclick="document.getElementById('edit-form-<?= $row['id'] ?>').style.display='none'">Cancel</button>
                    </form>
                </td>
            </tr>

            <?php
        }
    } else {
        echo "<tr><td colspan='5'>No menu items found.</td></tr>";
    }
    ?>
</table>

</body>
</html>
