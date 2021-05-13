<?php

include("database/db.php");


$data = ['admin' => 1];

update('tblUser', $_POST['promote'], $data);

header('location: admin.php');