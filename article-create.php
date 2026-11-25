<?php 
include 'connection.php';

if(isset($_POST['articleCreate'])) {
    $title = $_POST['title'];
    $body = addslashes($_POST['body']);
    $image = $_FILES['image'];
    $error = [];

    empty(trim($title)) ? $error[] = "Title is required" : "";
    empty(trim($body)) ? $error[] = "Body is required" : "";

    $path = "images/". $image["name"];
    move_uploaded_file($image["tmp_name"], $path);

    if(!count($error)) {
        $result = mysqli_query($connection, "INSERT INTO articles (title, body, image) VALUES ('$title', '$body', '$path')");
        if($result) {
            header("location:index.php");
        } else {
            echo mysqli_connect_error();
        }
    }
}

?>


<?php include 'layout/header.php' ?>

<h1>Create Article</h1>
<form action="" method="post" enctype="multipart/form-data">
    <?php include 'layout/error.php'; ?>
    <div class="form-group my-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" placeholder="Enter Title" name="title">
    </div>
    <div class="form-group my-3">
        <label for="body" class="form-label">Body:</label>
        <textarea name="body" id="body" cols="30" rows="5" class="form-control"></textarea>
    </div>
    <div class="form-group my-3">
        <label for="image" class="form-label">Image File:</label>
        <input type="file" name="image" class="form-control">
    </div>
    <div class="form-group my-3">
        <input type="submit" name="articleCreate" value="Submit" class="btn btn-primary">
    </div>
</form>

<?php include 'layout/footer.php' ?>