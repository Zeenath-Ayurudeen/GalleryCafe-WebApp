<?php
include('dbconn.php');

session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user is an admin
    $admin_query = "SELECT * FROM admin WHERE email='$email'";
    $admin_result = mysqli_query($conn, $admin_query);
    $admin = mysqli_fetch_assoc($admin_result);

    // Check if the user is a staff
    $staff_query = "SELECT * FROM staff WHERE email='$email'";
    $staff_result = mysqli_query($conn, $staff_query);
    $staff = mysqli_fetch_assoc($staff_result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['user_type'] = 'admin';
        $_SESSION['user_id'] = $admin['id'];
        $_SESSION['username'] = $admin['username'];
        header('Location: ./admin/admin.php');
    } elseif ($staff && password_verify($password, $staff['password'])) {
        $_SESSION['user_type'] = 'staff';
        $_SESSION['user_id'] = $staff['id'];
        $_SESSION['username'] = $staff['username'];
        header('Location: ./staff/staff.php');
    } else {
        $error_message = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>The Gallery Cafe</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./styles.css" />
        <link rel="stylesheet" href="./responsive.css">
        <link rel="stylesheet" href="./script.js">
    </head>
    
<style>
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    max-width: 500px;
    width: 90%;
    background-color: #2121213f;
    border-radius: 10px;
    padding: 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.login-container h2 {
    text-align: center;
    color: #c5671b;
    font-size: 35px;
    margin-bottom: 20px;
    font-family: "Forum", sans-serif;
}

.login-container form {
    display: flex;
    flex-direction: column;
}

.login-container input {
    padding: 10px;
    margin-bottom: 15px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s;
}

.login-container input:focus {
    border-color: #333;
}

.login-container button {
    background-color: #c5671b;
    color: #fff;
    border: none;
    padding: 10px 25px;
    cursor: pointer;
    width: 100%;
    border-radius: 5px;
}

.login-container button:hover {
    background-color: #b45f19;
}

.login-container p {
    margin-top: 10px;
    font-size: 14px;
    color: red;
}

/* Mobile responsive */
@media (max-width: 500px) {
    .login-container {
        padding: 15px;
    }

    .login-container h2 {
        font-size: 20px;
    }

    .login-container input, .login-container button {
        font-size: 14px;
    }
}

</style>

<body>
<nav>
    <div class="logo">
        <h2 class="logo-heading">The Gallery Cafe</h2>
     </div>
</nav>
<body>
    <div class="login-container">
        <h2>Admin/Staff Login</h2>
        <?php if (isset($error_message)) { echo '<p style="color:red;">' . $error_message . '</p>'; } ?>
        <form action="userlogin.php" method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
            <label for="email">Password</label>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
