<?php  
    include 'connection.php';
    $result = mysqli_query($connection, "SELECT * FROM articles");
?> 
<?php include 'layout/header.php'; ?>

<?php foreach($result as $article): ?>
    <div class="card my-3">
        <img src="<?= $article['image'] ?>" alt="" class="card-img-top" style="width: 100%; height: 15rem; object-fit:cover;">
        <div class="card-body">
            <div class="card-title">
                <?= $article['title']; ?>
            </div>
            <div class="card-text">
                <?= $article['body']; ?>
            </div>
        </div>
        <div class="card-footer">
            <a href="article-edit.php?id=<?php echo $article['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="article-delete.php?id=<?php echo $article['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>