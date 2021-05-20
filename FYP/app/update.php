<?php

include("database/db.php");

$id = $_SESSION['id'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$data = ['email' => $_POST['email'], 'password' => $pass, 'dateOfBirth' => $_POST['dateOfBirth']];

update('tblUser', $id, $data);

header('location: myProfile.php');