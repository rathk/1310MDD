<?php
/* -- All required and include files go here -- */
require_once 'models/database.php';
require_once 'models/usersModel.php';
include 'models/viewModel.php';
/* -- End required and includes -- */

/* -- Initiate views, header & database connection-- */
$views = new viewModel();
$users = new usersModel(MY_DSN, MY_USER, MY_PASS);
$views->getView('views/header.inc');
$access = $_GET['auth'];
/* -- End view, header and database connection code --*/

/* -- Account Management -- */
$new_user = $_GET['na'];
$quit = $_GET['rq'];
/* -- End Account Management -- */

if($quit == 'lo'){
    unset($_SESSION['start'], $_SESSION['user_id']);
    session_destroy();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
    exit;
}

/* -- Login Form handling -- */
if(isset($_POST['submit'])){
    //Set error message to empty string.
    $error = "";
    //Check to see if the username has been set and that it is not empty.
    if(isset($_POST['username']) && ($_POST['username'] != "")){
        //Calls sanitation function before setting to variable.
        $user_name = $users->val_criteria($_POST['username']);
        //If the $user_name does not contain all of the valid characters and length; display an error message.
        if($users->val_user($user_name)){
            $error="Please enter a valid username or password";
        }
    }

    //Check to see if the password has been set and that it is not empty.
    if(isset($_POST['password']) && ($_POST['password'] !="")){
        //Calls sanitation function before setting to variable.
        $user_pass = $users->val_criteria($_POST['password']);
        if($users->val_pass($user_pass)){
            $error = "Please enter a valid username or password.";
        }
    }

    //Check to make sure no error is present before submitting to database.
    if($error == ""){
        $authorized = $users->authorize_user($user_name, $user_pass);
        if($authorized){
            session_start();
            $_SESSION['start'] = $user_name;
            $_SESSION['user_id'] = $users->getUser($user_name);
            $views->getView('views/search.inc');
            //exit;
        }else{
            $error = 'Please enter a valid username or password';
            echo $error;
        }
    }else{
        $error = 'Please enter a valid username or password';
        echo $error;
    }
}
/* -- End Login Form handling -- */

/* -- New User Registration Form handling -- */
if(isset($_POST['submit_new'])){
    //Set error message to empty string.
    $error_new_user = "";
    $error_new_pass = "";
    //Check to see if the new username has been set and that it is not empty.
    if(isset($_POST['new_username']) && ($_POST['new_username'] !="")){
        //Calls sanitation function before setting to variable.
        $new_user = $users->val_critera($_POST['new_username']);
        //If the $new_user does not contain all of the valid characters and length; display an error message.
        if($users->val_user($new_user)){
            $error_new_user = "Please enter a valid username.";
        }
    }
    //Check to see if the new password has been set and that it is not empty.
    if(isset($_POST['new_password']) && ($_POST['new_password'] !="")){
        //Calls sanitation function before setting to variable.
        $new_pass = $users->val_criteria($_POST['new_password']);
        if($users->val_pass($new_pass)){
            $error_new_pass = "Please enter a valid password.";
        }
    }
    //Check to see if the user's first name has been set and that it is not empty.
    if(isset($_POST['first_name']) && ($_POST['first_name'] !="")){
        //Calls sanitation function before setting to variable.
        $new_first = $users->val_criteria($_POST['first_name']);
    }
    //Check to see if the users's last name has been set and that it is not empty.
    if(isset($_POST['last_name']) && ($_POST['last_name'] !="")){
        //Calls sanitation function before setting to variable.
        $new_last = $users->val_criteria($_POST['last_name']);
    }
    //Check to see if the users's email address has been set, that it it not empty and in proper format.
    if(isset($_POST['email']) && ($_POST['email'] !="")){
        //Calls sanitation function before setting to variable.
        $valid_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if($valid_email){
            $new_email = $_POST['email'];
        }
    }
}
/* -- End New User Registration Form handling -- */

/* -- Display login form if no Session information is present --*/
if ($_SESSION['start'] == NULL && $new_user !='new'){
	$views->getView('views/login.inc');
}
/* -- End login form display code -- */

/* -- New User Handling -- */
if($new_user == 'new'){
    $views->getView('views/newAccount.inc');
}
/* -- End New User Hanlding -- */
$views->getView('views/footer.inc');
?>