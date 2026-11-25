<?php
include 'connection.php';

$id = $_GET['id'];
$result = mysqli_query($connection, "SELECT * FROM articles WHERE id='$id'");
$data = mysqli_fetch_assoc($result);

if(isset($_POST['articleUpdate'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $image = $_FILES['image'];
    $error = [];

    empty($title) ? $error[] = "Title is required" : '';
    empty($body) ? $error[] = "Body is required" : '';
    if(is_uploaded_file($image['tmp_name'])) {
        $path = 'images/'. $image['name'];
        move_uploaded_file($image['tmp_name'], $path);
    } else {
        $path = $data['image'];
    }

    if(!count($error)) {
        $result = mysqli_query($connection, "UPDATE articles set title='$title', body='$body', image='$path' WHERE id='$id'");
        if($result) {
            header("location:index.php");
        } else {
            echo 'error';
        }
    }
}

?>

<?php include 'layout/header.php' ?>

<h1>Update Article</h1>
<form action="" method="post" enctype="multipart/form-data">
    <?php include 'layout/error.php'; ?>
    <div class="form-group my-3">
        <label for="title" class="form-label">Title:</label>
        <input type="text" class="form-control" placeholder="Enter Title" name="title" value="<?= $data['title']; ?>">
    </div>
    <div class="form-group my-3">
        <label for="body" class="form-label">Body:</label>
        <textarea name="body" id="body" cols="30" rows="5" class="form-control"><?= $data['body']; ?></textarea>
    </div>
    <div class="form-group my-3">
        <label for="image" class="form-label">Image File:</label>
        <input type="file" name="image" class="form-control">
        <img src="<?= $data['image']; ?>" alt="image" width="300" height="300" style="object-fit:cover;">
    </div>
    <div class="form-group my-3">
        <input type="submit" name="articleUpdate" value="Submit" class="btn btn-primary">
    </div>
</form>

<?php include 'layout/footer.php' ?>