<?php
include 'connection.php';
$id = $_GET['id'];

$result = mysqli_query($connection, "DELETE FROM articles WHERE id='$id' ");
if ($result) {
    header("location: index.php");
} else {
    echo 'error';
}