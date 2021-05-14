<?php


include("database/db.php");

//echo "{$_POST['deleteId']}";

delete('tblUser', $_POST['delete']);

header('location: admin.php');