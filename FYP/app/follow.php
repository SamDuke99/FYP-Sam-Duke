<?php

include("database/db.php");


$data = ['user_id' => $_POST['follow'], 'follower_id' => $_SESSION['id'], 'follow_seen' => 0, 'follower_name' => $_SESSION['username']];

insert('tblFollowers', $data);

header('location: mainPage.php');
