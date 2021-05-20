<?php

include("database/db.php");

extract($_POST);

if (isset($_POST['commentBtn'])) {

    $errors = array();
    header('location: mainPage.php');

    if (count($errors) === 0) {
        $id = $_POST['commentBtn'];
        unset($_POST['commentBtn']);

        $commentCont = trim($_POST['userComment']);

        $cData = ['user_id' => $_SESSION['id'], 'post_id' => $id,'comment_contents' => $commentCont, 'user_name' => $_SESSION['username']];

        insert('tblComments', $cData);

        header('location: mainPage.php');
        exit();

    }

}

