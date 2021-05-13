<?php

include("database/db.php");

extract($_POST);

if (isset($_POST['postBtn'])) {

    $errors = array();



    if (count($errors) === 0) {
        unset($_POST['postBtn']);

        $postCont = trim($_POST['userPost']);

        $data = ['user_id' => $_SESSION['id'], 'post_contents' => $postCont, 'user_name' => $_SESSION['username'], 'post_subject' => $_POST['subject']];

            insert('tblPosts', $data);


        header('location: mainPage.php');

        exit();

    }





}