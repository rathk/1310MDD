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
/* -- End view, header and database connection code --*/

/* -- Display login form if no Session information is present --*/
if ($_SESSION['start'] == NULL) {
	$views->getView('views/login.inc');
}else{
	$views->getView('views/search.inc');
}
/* -- End login form display code -- */

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
            $error="Please enter a valid username";
            echo $error;
        }
    }
    //Check to see if the password has been set and that it is not empty.
    if(isset($_POST['password']) && ($_POST['password'] !="")){
        //Calls sanitation functio before setting to variable.
        $user_pass = $users->val_criteria($_POST['password']);
        if($users->val_pass($user_pass)){
            $error = "Please enter a valid password.";
            echo $error;
        }
    }
}
/* -- End Login Form handling -- */
$views->getView('views/footer.inc');
?>