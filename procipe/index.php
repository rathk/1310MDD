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
        //If the $u_name does not contain all of the valid characters and length; display an error message.
        if($users->val_user($user_name)){
            $error="Please enter a valid username or password";
        }
    }

    //Check to see if the password has been set and that it is not empty.
    if(isset($_POST['password']) && ($_POST['password'] !="")){
        //Calls sanitation functio before setting to variable.
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