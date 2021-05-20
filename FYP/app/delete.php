<?php


include("database/db.php");



if (isset($_POST['delete'])) {
    $table = 'tblUser';
    $delete = $_POST['delete'];

    $sql = "SELECT * FROM tblPosts WHERE user_id= '$delete'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            delete('tblPosts', $row['id']);
        }
    }
    $cSql = "SELECT * FROM tblComments WHERE user_id= '$delete'";
    $cResult = $connect->query($cSql);
    if ($cResult->num_rows > 0) {
        while($cRow = $cResult->fetch_assoc()) {
            delete('tblComments', $cRow['id']);
        }
    }
    $cSql = "SELECT * FROM tblMessages WHERE sender_id= '$delete'";
    $cResult = $connect->query($cSql);
    if ($cResult->num_rows > 0) {
        while($cRow = $cResult->fetch_assoc()) {
            delete('tblMessages', $cRow['id']);
        }
    }

    $cSql = "SELECT * FROM tblMessages WHERE receiver_id= '$delete'";
    $cResult = $connect->query($cSql);
    if ($cResult->num_rows > 0) {
        while($cRow = $cResult->fetch_assoc()) {
            delete('tblMessages', $cRow['id']);
        }
    }

    $cSql = "SELECT * FROM tblFollowers WHERE user_id= '$delete'";
    $cResult = $connect->query($cSql);
    if ($cResult->num_rows > 0) {
        while($cRow = $cResult->fetch_assoc()) {
            delete('tblFollowers', $cRow['id']);
        }
    }

    $cSql = "SELECT * FROM tblFollowers WHERE follower_id= '$delete'";
    $cResult = $connect->query($cSql);
    if ($cResult->num_rows > 0) {
        while($cRow = $cResult->fetch_assoc()) {
            delete('tblFollowers', $cRow['id']);
        }
    }

    unset($_POST['delete']);

} elseif (isset($_POST['deletePost'])) {
    $table = 'tblPosts';
    $delete = $_POST['deletePost'];
    $cSql = "SELECT * FROM tblComments WHERE post_id= '$delete' ORDER BY comment_date DESC";
    $cResult = $connect->query($cSql);
    if ($cResult->num_rows > 0) {
        while($cRow = $cResult->fetch_assoc()) {
            delete('tblComments', $cRow['id']);
        }
    }
    unset($_POST['deletePost']);
}



delete($table, $delete);

$sql = "SELECT * FROM tblUsers WHERE id= '{$_SESSION['id']}'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        header('location: mainPage.php');
        exit();
    }
}

header('location: login.php');