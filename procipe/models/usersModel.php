<?php
/**
* This class is used for working with the database that stores user information such as login and favorites information.
*/
class usersModel
{
	// -- Make initial connection to the database -- //
	public function __construct($dsn, $user, $pass)
	{
		try{
			$this->db = new \PDO($dsn, $user, $pass);
		}
		catch(\PDOException $e){
			echo "Cannot connect to database...";
			var_dump($e);
		}
	}// -- End construct function -- //

	// -- Session Handling Database Calls -- //
	public function getUser($user_name){
		$statement = $this->db->prepare("SELECT id AS id FROM users WHERE user_name = '$user_name'");
		if($statement->execute()){
			$rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
			foreach($rows as $row){
				return $row['id'];
			}
		}else{
			return 'unknown';
		}
	}
	// -- End Session Handling --//

	// -- Sanitize username & password to guard against SQL injection -- //
	public function val_criteria($string){
		if(get_magic_quotes_gpc()){
            $string=stripslashes($string);
            return htmlentities($string);
        }else{
            $string = str_replace(array("'","/","\""),"", $string);
            strip_tags($string);
            stripslashes($string);
            return htmlentities($string);
        }
	}// -- End Sanitize function -- //

	// -- Validate username to length & allowable character requirements -- //
	public function val_user($user_name){
		if (strlen($user_name) < 5){
			return true;
		}else if (preg_match("/[^a-zA-Z0-9_@.]/", $user_name)){
			return true;
		}else{
			return false;
		}
	}// -- End username validation -- //

	// -- Check new username to see if one already exists in the database -- //
	public function check_user($new_user){
		$statement = $this->db->prepare("SELECT user_name FROM users WHERE (user_name = '$new_user')");
		if($statement->execute()){
			$euser = $statement->rowCount();
			echo $euser;
			if($euser > 0){
				return true;
			}else{
				return false;
			}
		}
	}
	// -- End check new username -- //

	// -- Validate password to length & allowable character requirements -- //
	public function val_pass($user_pass){
		if(strlen($user_pass)<6){
            return true;
        }else if (!preg_match("/[a-z]/",$user_pass) || !preg_match("/[A-Z]/", $user_pass) || !preg_match("/[0-9]/", $user_pass) || !preg_match("/[!@#$%^&*()_+]/", $user_pass)){
            return true;
        }else{
            return false;
        }
	}// -- End password validation -- //

	// -- Take validated user input for new user account, salt and add to database. -- //
	public function make_user($new_user, $new_pass, $new_first, $new_last, $valid_email){

		//Create random salt with a length of 10.
		$new_usodium = substr(str_shuffle(MD5(microtime())), 0, 10);
		$statement = $this->db->prepare("INSERT INTO users (user_name, user_salt, user_pass, first_name, last_name, email) VALUES ('$new_user', '$new_usodium', MD5(CONCAT('$new_usodium', '$new_pass')), '$new_first', '$new_last', '$valid_email')");
		if($statement->execute()){
			return "Your user account has been successfully created.";
		}else{
			return "Error creating user account.  Please try again.";
		}
	}
	// -- End add new user account to database. -- //

	// -- Authorize validated username and password -- //
	public function authorize_user($user_name, $user_pass){
		$statement = $this->db->prepare("SELECT user_salt AS val, user_pass AS id FROM users WHERE (user_name = '$user_name')");
		if($statement->execute()){
			$rows = $statement->fetchAll(\PDO::FETCH_ASSOC);
			foreach($rows as $row){
				if(MD5($row['val'] . $user_pass) == $row['id']){
					return true;
				}
			}
		}
		return false;
	}
}
?>