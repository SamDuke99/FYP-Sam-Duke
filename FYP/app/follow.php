<?php

include("database/db.php");


$data = ['user_id' => $_SESSION['followRequest'], 'follower_id' => $_SESSION['id']];

insert('tblFollowers', $data);

header('location: mainPage.php');
