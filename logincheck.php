<?php session_start(); ?>
<?php
$_SESSION['loggedin'] = false;

include './classes/Validation.class.php';
include './classes/Database.class.php';
include './classes/Messages.class.php';
include './classes/Util.class.php';

$validate = new Validation();
$database = new Database();
$messages = new Messages();
$util = new Util();

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');


if ($util->isPost()) {

    if (!$validate->emailIsNotEmpty($email)) {
        $messages->addError('Email is a required field.');
    } else {

        if (!$validate->emailIsValid($email)) {
            $messages->addError('Email formatting is invalid.');
        }
    }

    if (!$validate->passwordIsNotEmpty($password)) {
        $messages->addError('Password is a required field.');
    } else {
    
            if (!$validate->passwordIsLongEnough($password)) {
            $messages->addError('Password must be eight characters or greater.');
        }
    }

    if ($messages->hasErrors()) {
        $messages->displayErrorMsgs();
        include './login.php';
        exit();
    }
}
/*
if ($database->checkUserLogin($email, $password)) {
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header('Location: admin.php');
} else {
    $_SESSION['loggedin'] = false;
    echo "Login Failed.";
}
 */
 
?>
</body>
</html>
