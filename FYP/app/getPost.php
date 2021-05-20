<?php

include("database/db.php");
include("includes/header.php");

$posts = selectAll('tblPosts');

//displayData(count($posts));

$_SESSION['id'] = ['108'];

for ($i = 0; $i < count($posts); $i++) {

    $conditions = [];
    $posterID = selectOne('tblPosts', ['user_id']);
    displayData($posterID['user_id']);
    selectAll('tblFollowers', ['']);

};
