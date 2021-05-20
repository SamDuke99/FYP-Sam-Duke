<?php



include("database/db.php");

extract($_POST);

$errors = array();

if (isset($_POST['postBtn'])) {

    if (empty($_POST['userTitle'])) {
        array_push($errors,  'Please enter a title');
        $_SESSION['error'] = $_SESSION['error'] . ' Please enter a title';
    }

    if (empty($_POST['userPost'])) {
        array_push($errors,  'Please enter something to post');
        $_SESSION['error'] = $_SESSION['error'] . ' Please enter something to post ';
    }

    if (count($errors) === 0) {
        unset($_POST['postBtn']);

        $postCont = trim($_POST['userPost']);

        $data = ['user_id' => $_SESSION['id'], 'post_contents' => $postCont, 'user_name' => $_SESSION['username'], 'post_subject' => $_POST['subject'], 'post_title' => $_POST['userTitle']];
        insert('tblPosts', $data);
        header('location: mainPage.php');
        exit();
    }
    header('location: mainPage.php');
}