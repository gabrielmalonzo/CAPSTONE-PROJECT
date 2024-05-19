<?php
require './includes/config.php';

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT * FROM tb_user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check if the user exists
    if ($row) {
        // Verify the password
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["Userid"] = $row["id"];
            if($row["Admin"] == 1){
                header("Location: Pending.php");
            }else{
                header("Location: homepage.php");
            }
            exit(); // Make sure to exit after header redirection
        } else {
            echo "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo "<script>alert('User not registered');</script>";
    }

    // Close the statement
    $stmt->close();
}
?>

<?php include './includes/header.php'; ?>

<div class="wrapper">
    <form method="post">
        <h1>Login</h1>
        <div class="input-box">
            <input type="text" name="email" placeholder="Email" required>
            <i class='bx bxs-user'></i>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt' ></i>
        </div>

        <div class="remember-forgot">
            <label><input type="checkbox"> Remember me</label>
            <a href="#">Forgot password</a>
        </div>   

        <button type="submit" name="submit" class="btn">Login</button>

        <div class="register-link">
            <p>Don't have an account? <a href="Register.php">Register</a></p>
        </div>
    </form>
</div>

<script src="./Assets/script.js"></script>
</body>
</html>
