<?php

include("database/db.php");
extract($_POST);
if (isset($_POST['messageBtn'])) {
    $errors = array();
    if (empty($_POST['userMessage'])) {
        array_push($errors,  'Empty message, please enter something');
        $_SESSION['error'] = $_SESSION['error'] . ' Empty message, please enter something ';
    }
    if (count($errors) === 0) {
        unset($_POST['messageBtn']);
        $messCont = trim($_POST['userMessage']);
        $mData = ['sender_id' => $_SESSION['id'], 'receiver_id' => $_SESSION['receive'], 'message_content' => $messCont, 'sender_name' => $_SESSION['username'], 'message_seen' => 0];
        insert('tblMessages', $mData);
        header('location: messageList.php');
        exit();
    }
    header('location: messageList.php');
}

