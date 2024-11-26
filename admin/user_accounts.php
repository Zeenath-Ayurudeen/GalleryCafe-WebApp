<?php
session_start(); // Start the session
include('../dbconn.php');

$admins_query = "SELECT * FROM admin";
$admins_result = mysqli_query($conn, $admins_query);

$staff_query = "SELECT * FROM staff";
$staff_result = mysqli_query($conn, $staff_query);

// Handle form submission for adding admins or staff
if (isset($_POST['add_admin'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $query);

    $_SESSION['success'] = "Admin added successfully!";
    header('Location: admin.php?page=user_accounts');
    exit;
}

if (isset($_POST['add_staff'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "INSERT INTO staff (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $query);

    $_SESSION['success'] = "Staff added successfully!";
    header('Location: admin.php?page=user_accounts');
    exit;
}

// Handle deletion
if (isset($_GET['delete_admin'])) {
    $id = $_GET['delete_admin'];
    $query = "DELETE FROM admin WHERE id='$id'";
    mysqli_query($conn, $query);
    header('Location: admin.php?page=user_accounts');
}

if (isset($_GET['delete_staff'])) {
    $id = $_GET['delete_staff'];
    $query = "DELETE FROM staff WHERE id='$id'";
    mysqli_query($conn, $query);
    header('Location: admin.php?page=user_accounts');
}
?>

<h2>User Accounts</h2>

<?php
// Display the success message if set
if (isset($_SESSION['success'])) {
    echo "<div class='success-message'>{$_SESSION['success']}</div>";
    unset($_SESSION['success']); // Unset the message after displaying it
}
?>

<h3>Admins List</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Created_At</th>
        <th>Action</th>
    </tr>
    <?php while ($admin = mysqli_fetch_assoc($admins_result)): ?>
    <tr>
        <td data-label="ID"><?= $admin['id']; ?></td>
        <td data-label="Username"><?= $admin['username']; ?></td>
        <td data-label="Email"><?= $admin['email']; ?></td>
        <td data-label="Created_At"><?= $admin['created_at'];?></td>
        <td data-label="Action"><a class="delete-btn" href="admin.php?page=user_accounts&delete_admin=<?= $admin['id']; ?>">Delete</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>Staff List</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Created_At</th>
        <th>Action</th>
    </tr>
    <?php while ($staff = mysqli_fetch_assoc($staff_result)): ?>
    <tr>
        <td data-label="ID"><?= $staff['id']; ?></td>
        <td data-label="Username"><?= $staff['username']; ?></td>
        <td data-label="Email"><?= $staff['email']; ?></td>
        <td data-label="Created_At"><?= $staff['created_at'];?></td>
        <td data-label="Action"><a class="delete-btn" href="admin.php?page=user_accounts&delete_staff=<?= $staff['id']; ?>">Delete</a></td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>Add Admin</h3>
<form action="admin.php?page=user_accounts" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="add_admin">Add Admin</button>
</form>

<h3>Add Staff</h3>
<form action="admin.php?page=user_accounts" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="add_staff">Add Staff</button>
</form>

<style>
    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 10px;
        border: 1px solid #c3e6cb;
        margin-bottom: 15px;
        border-radius: 5px;
    }
</style>
