<?php
    require './includes/config.php';
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        
        // Check if email is already registered
        $stmt = $conn->prepare("SELECT * FROM tb_user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        if($result->num_rows > 0){
            echo "<script> alert('Email is already Registered'); </script>";
        }
        else{
            if($password == $confirmpassword){
                // Insert new user into database
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO tb_user (email, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $stmt->close();
                echo "<script> alert('Registration Successful'); </script>";
            }
            else{
                echo "<script> alert('Password Does Not Match'); </script>";
            }
        }
    }
?>

<?php
    include './includes/header.php';
?>

<link rel="stylesheet" href="./Assets/Register.css">

<div class="Container">
    <form action="" method="post" autocomplete="off">
        <h1>REGISTER</h1>
        <div class="input-box">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="sample_juan@gmail.com" value="" required>
            <i class='bx bxs-envelope'></i>
        </div>

        <div class="input-box">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" value="" required>
            <img src="./Image/unsee.png" onclick="togglePasswordVisibility('password')" class="pass-icon" id="pass-icon-password">
        </div>


        <div class="input-box">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" value="" required>
            <img src="./Image/unsee.png" onclick="togglePasswordVisibility('confirmpassword')" class="pass-icon" id="pass-icon-confirmpassword">
        </div>
        <button name="submit" type="submit" class="btn">Register</button>
    </form>
</div>

<script src="./Assets/script.js"></script>
</body>
</html>
