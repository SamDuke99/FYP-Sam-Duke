<?php

include("database/db.php");

$errors = array();
$username = '';
$email = '';
$password = '';
$pwdConf = '';

if (isset($_POST['regBtn'])) {
    if (empty($_POST['username'])) {
        array_push($errors,  'Username is required');
        $_SESSION['error'] = $_SESSION['error'] . ' Username is required ';
    }
    if (empty($_POST['email'])) {
        array_push($errors,  'email is required');
        $_SESSION['error'] = $_SESSION['error'] . ' email is required ';
    }
    if (empty($_POST['password'])) {
        array_push($errors,  'password is required');
        $_SESSION['error'] = $_SESSION['error'] . ' password is required ';
    }

    $password = ($_POST["password"]);

    if (strlen($_POST["password"]) <= '8') {
        array_push($errors,  'Your Password Must Contain At Least 8 Characters!');
        $_SESSION['error'] = $_SESSION['error'] . ' Your Password Must Contain At Least 8 Characters! ';
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        array_push($errors,  'Your Password Must Contain At Least 1 Number!');
        $_SESSION['error'] = $_SESSION['error'] . ' Your Password Must Contain At Least 1 Number!! ';
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        array_push($errors,  'Your Password Must Contain At Least 1 Capital Letter!');
        $_SESSION['error'] = $_SESSION['error'] . ' Your Password Must Contain At Least 1 Capital Letter! ';
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        array_push($errors,  'Your Password Must Contain At Least 1 Lowercase Letter!');
        $_SESSION['error'] = $_SESSION['error'] . ' Your Password Must Contain At Least 1 Lowercase Letter! ';
    }

    if (empty($_POST['pwdConf'])) {
        array_push($errors,  'password confirmation is required');
        $_SESSION['error'] = $_SESSION['error'] . ' password confirmation is required ';
    }
    if (($_POST['password']) != ($_POST['pwdConf'])) {
        array_push($errors,  'passwords must match');
        $_SESSION['error'] = $_SESSION['error'] . ' passwords must match ';
    }
    $emailExist = selectOne('tblUser', ['email' => $_POST['email']]);
    if (isset($emailExist)) {
        array_push($errors,  'Email already exists');
        $_SESSION['error'] = $_SESSION['error'] . ' Email already exists ';
    }
    $userExist = selectOne('tblUser', ['username' => $_POST['username']]);
    if (isset($userExist)) {
        array_push($errors,  'Username already exists');
        $_SESSION['error'] = $_SESSION['error'] . ' Username already exists ';
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
        $_SESSION['subjectView'] = 'all';

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
        $_SESSION['error'] = $_SESSION['error'] . ' Username is required ';
    }

    if (empty($_POST['pwd'])) {
        array_push($errors,  'password is required');
        $_SESSION['error'] = $_SESSION['error'] . ' password is required ';
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
            $_SESSION['subjectView'] = 'all';

            header('location: mainPage.php');
            exit();
        } else {
            array_push($errors, 'Incorrect information');
            $_SESSION['error'] = $_SESSION['error'] . ' Incorrect information ';
            header('location: login.php');
        }

    }
    header('location: login.php');
}
