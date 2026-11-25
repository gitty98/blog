<?php 
    include 'connection.php';

    if(isset($_POST['register_form'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $confirm_password = md5($_POST['confirm_password']);
        $error = [];

        empty(trim($name)) ? $error[] = "Name is required" : "";
        empty(trim($email)) ? $error[] = "Email is required" : "";
        empty(trim($password)) ? $error[] = "Password is required" : "";
        empty(trim($confirm_password)) ? $error[] = "Confirm Password is required" : "";
        if(trim($password) !== trim($confirm_password)) $error[] = "Password do not match";

        if(!count($error)) {
            $checkEmail = mysqli_query($connection, "SELECT * FROM users WHERE email='$email'");
            if(mysqli_num_rows($checkEmail) > 0) {
                $error[] = "Email is already taken.";
            } else {
                $result = mysqli_query($connection, "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
                if($result) {
                    header("location: index.php");
                } else {
                    echo mysqli_connect_error();
                }
            }
        }        
    }
?>



<?php include 'layout/header.php'; ?>

<h1>Register</h1>
<form action="" method="post">

    <?php include 'layout/error.php'; ?>

    <div class="form-group my-3">
        <label for="name" class="form-label">Name:</label>
        <input 
        type="text" 
        name="name" 
        placeholder="Enter Your Name" 
        class="form-control" 
        value="<?php echo isset($_POST['name']) ? $_POST['name'] : ""; ?>">
    </div>
    <div class="form-group my-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" placeholder="Enter Your Email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""; ?>">
    </div>
    <div class="form-group my-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" placeholder="Enter Your Password" class="form-control">
    </div>
    <div class="form-group my-3">
        <label for="confirm_password" class="form-label">Confirm Password:</label>
        <input type="password" name="confirm_password" placeholder="Enter Your confirm Password" class="form-control">
    </div>
    <div class="form-group my-3">
        <input type="submit" name="register_form" value="Submit" class="btn btn-primary">
    </div>
</form>

<?php include 'layout/footer.php'; ?>