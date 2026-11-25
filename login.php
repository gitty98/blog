<?php include 'layout/header.php'; ?>

<?php

include 'connection.php';

if(isset($_POST['login_form'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = [];
    
    empty(trim($email)) ? $error[] = "Email is required" : "";
    empty(trim($password)) ? $error[] = "Password is required" : "";
    $password = md5($password);

    if(!count($error)) {
        $result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email' and password= '$password'");
        if(mysqli_num_rows($result)>0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["auth"] = true;
            header("location: index.php");
        } else {
            $error[] = "login failed. Please Check your Email and Password";
        }
    }
}
?>


<h1>Login Form</h1>
<form action="" method="post">

    <?php include 'layout/error.php' ?>

    <div class="form-group my-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ""; ?>">
    </div>
    <div class="form-group my-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Enter Your Password" value="<?= isset($_POST["password"]) ? $_POST["password"] : ""; ?>"> 
    </div>
    <div class="form-group my-3">
        <input type="submit" class="btn btn-info" value="Login" name="login_form">
    </div>
</form>

<?php include 'layout/footer.php'; ?>