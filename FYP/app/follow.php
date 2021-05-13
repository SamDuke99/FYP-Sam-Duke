<?php

include("database/db.php");


$data = ['user_id' => $_POST['follow'], 'follower_id' => $_SESSION['id']];

insert('tblFollowers', $data);

header('location: mainPage.php');
