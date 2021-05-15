<?php

include("database/db.php");

extract($_POST);


if (isset($_POST['messageBtn'])) {

    $errors = array();

    if (count($errors) === 0) {
        unset($_POST['messageBtn']);

        $messCont = trim($_POST['userMessage']);

        $mData = ['sender_id' => $_SESSION['id'], 'receiver_id' => $_SESSION['receive'], 'message_content' => $messCont, 'sender_name' => $_SESSION['username'], 'message_seen' => 0];



        insert('tblMessages', $mData);


        header('location: messageList.php');

        exit();

    }

}