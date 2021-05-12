<?php

include("database/db.php");

extract($_POST);

if (isset($_POST['postBtn'])) {

    $errors = array();

//    if (empty($_POST['userPost'])) {
//        array_push($errors, 'Empty Post, please enter something');
//    }




    if (count($errors) === 0) {
        unset($_POST['postBtn']);

        $postCont = trim($_POST['userPost']);

        $time = new DateTime();
        $time->format('Y-m-d H:i:s');

        $data = ['user_id' => $_SESSION['id'], 'post_contents' => $postCont, 'user_name' => $_SESSION['username']];

            insert('tblPosts', $data);


        header('location: mainPage.php');
        exit();

    }





}