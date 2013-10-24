<?php
/* -- All required and include files go here -- */
require_once 'models/database.php';
require_once 'models/usersModel.php';
include 'models/viewModel.php';
/* -- End required and includes -- */

$page_title = "Procipe Recipe Search";

/* -- Initiate views, header & database connection-- */
$views = new viewModel();
$users = new usersModel(MY_DSN, MY_USER, MY_PASS);
$views->getView('views/header.inc');
$access = $_GET['auth'];
$results = $_GET['details'];
$recipeID = $_GET['recipeID'];
$newPage = $_GET['nextlist'];
$searchterm=$_GET['searched'];
/* -- End view, header and database connection code --*/

/* -- Account Management -- */
$new_user_success = $_GET['na'];
$quit = $_GET['rq'];
$error_array = array();
/* -- End Account Management -- */

/* -- Logout Processes -- */
if($quit == 'lo'){
    unset($_SESSION['user'], $_SESSION['user_id']);
    session_destroy();
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
    exit;
}
/* -- End Logout Processes -- */

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
            $error_array[0]="Please enter a valid username or password";
        }
    }

    //Check to see if the password has been set and that it is not empty.
    if(isset($_POST['password']) && ($_POST['password'] !="")){
        //Calls sanitation function before setting to variable.
        $user_pass = $users->val_criteria($_POST['password']);
        if($users->val_pass($user_pass)){
            $error_array[0]= "Please enter a valid username or password.";
        }
    }

    //Check to make sure no error is present before submitting to database.
    if($error == ""  && $_SESSION['user'] == NULL){
        $authorized = $users->authorize_user($user_name, $user_pass);
        if($authorized){
            $ses_id = session_id();
            if(empty($ses_id)){
                session_start();
            $_SESSION['user'] = $users->getName($user_name);
            $_SESSION['user_id'] = $users->getUser($user_name);
            $_SESSION['id'] = $ses_id;
            }
            $views->getView('views/search.inc');
        }else{
            $error_array[0] = 'Please enter a valid username or password';
        }
    }else{
        $error_array[0] = 'Please enter a valid username or password';
    }
}
/* -- End Login Form handling -- */

/* -- New User Registration Form handling -- */
if(isset($_POST['submit_new'])){
    //Set error message to empty string.
    $error_new_user = "";
    $error_new_pass = "";
    $error_email = "";
    //Check to see if the new username has been set and that it is not empty.
    if(isset($_POST['new_username']) && ($_POST['new_username'] !="")){
        //Calls sanitation function before setting to variable.
        $new_user = $users->val_criteria($_POST['new_username']);
        //If the $new_user does not contain all of the valid characters and length; display an error message.
        if($users->val_user($new_user)){
            $error_new_user = "Please enter a valid username.";
        }
        if($users->check_user($new_user)){
            $error_new_user = "Please choose another username, the one you chose is already taken.";
        }
    }else if($_POST['new_username'] == ""){
        $error_new_user = 'Please enter a valid username it is empty.';
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
        }else{
            $error_email = "Please enter a valid email address.";
        }
    }
    //Check for and notify user of errors in form data.
    if($error_new_user !="" || $error_new_pass !="" || $error_email !=""){
        if($error_new_user !=""){
            $error_array[0] = $error_new_user;
        }
        if($error_new_pass !=""){
            $error_array[1] = $error_new_pass;
        }
        if($error_email !=""){
            $error_array[2] = $error_email;
        }
    //Send information to database if no errors exist.
    }else if($error_new_user == "" && $error_new_pass == "" && $error_email == ""){
        $create_user = $users->make_user($new_user, $new_pass, $new_first, $new_last, $valid_email);
        if($create_user == "Your user account has been successfully created."){
            $success_message[0]=$create_user;
            $views->getView('views/added.inc', $success_message);
        }
        if($create_user == "Error creating user account.  Please try again."){
            $error_array[3] = $create_user;
        }
    }
}
/* -- End New User Registration Form handling -- */

/* -- Recipe Search Functionality -- */
if (isset($_POST['submit_recipe_search'])) {
    $searchterm = $_POST['recipe_search'];
    $takeout = array(" ", "and", "&");
    $searchterm = str_replace($takeout, "%20", $searchterm);
    $url = 'http://api.yummly.com/v1/api/recipes?_app_id=aca40fa4&_app_key=8f690f6e964ea735eff7544215ab9585&q='.$searchterm;
    $response = file_get_contents($url);
    $output = json_decode($response);
    $views->getView('views/search.inc', $output);
}
/* -- End Recipe Search Functionality -- */

/* -- Pagination for recipe search results -- */
if($newPage>0){
    $url = 'http://api.yummly.com/v1/api/recipes?_app_id=aca40fa4&_app_key=8f690f6e964ea735eff7544215ab9585&q='.$searchterm.'&start='.$newPage;
    $response = file_get_contents($url);
    $output = json_decode($response);
    $views->getView('views/search.inc', $output);
}
/* -- End Pagination for recipe search results -- */

/* -- Specific Recipe Pull from API -- */
if($results == 'true'){
    $url = 'http://api.yummly.com/v1/api/recipe/'.$recipeID.'?_app_id=aca40fa4&_app_key=8f690f6e964ea735eff7544215ab9585';
    $response = file_get_contents($url);
    $output = json_decode($response);
    $views->getView('views/results.inc', $output);
}
/* -- End specific recipe pull from API -- */

/* -- Display login form if no Session information is present --*/
if ($_SESSION['user'] == NULL && $new_user_success !='new' && $access != 'affirm' && $results != 'true' && $newPage == NULL){
	$views->getView('views/login.inc', $error_array);
}
/* -- End login form display code -- */

/* -- New User Handling -- */
if($new_user_success == 'new' && $success_message[0] == ""){
    $views->getView('views/newAccount.inc', $error_array);
}
/* -- End New User Hanlding -- */
$views->getView('views/footer.inc');
?>