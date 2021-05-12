<?php

include("database/db.php");

$errors = array();
$username = '';
$email = '';
$password = '';
$pwdConf = '';

if (isset($_POST['regBtn'])) {
//TODO PASSWORD VALIDATION
    if (empty($_POST['username'])) {
        array_push($errors,  'Username is required');
    }
    if (empty($_POST['email'])) {
        array_push($errors,  'email is required');
    }
    if (empty($_POST['password'])) {
        array_push($errors,  'password is required');
    }
    if (empty($_POST['pwdConf'])) {
        array_push($errors,  'password confirmation is required');
    }
    if (($_POST['password']) != ($_POST['pwdConf'])) {
        array_push($errors,  'passwords must match');
    }
    $emailExist = selectOne('tblUser', ['email' => $_POST['email']]);
    if (isset($emailExist)) {
        array_push($errors,  'Email already exists');
    }
    $userExist = selectOne('tblUser', ['username' => $_POST['username']]);
    if (isset($userExist)) {
        array_push($errors,  'Username already exists');
    }


    if (count($errors) === 0){
        unset($_POST['regBtn'], $_POST['pwdConf']);

        $_POST['admin'] = 0;

        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);



        $user_id = insert('tblUser', $_POST);
        $user = selectOne('tblUser',['id'=> $user_id]);

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['message'] = 'Success! You are now logged in!';

        $errors = array();
        header('location: mainPage.php');

        exit();

    }


} else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pwdConf = $_POST['pwdConf'];


}


if (isset($_POST['logInBtn'])){

    if (empty($_POST['username'])) {
        array_push($errors,  'Username is required');
    }

    if (empty($_POST['pwd'])) {
        array_push($errors,  'password is required');
    }

    if (count($errors) === 0) {
        $user = selectOne('tblUser', ['username' => $_POST['username']]);

        if ($user && password_verify($_POST['pwd'], $user['password'])) {

            unset($_POST['logInBtn']);
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['message'] = 'Success! You are now logged in!';

            header('location: mainPage.php');
            exit();
        } else {
            array_push($errors, 'Incorrect information');
            header('location: login.php');
        }

    }

}
