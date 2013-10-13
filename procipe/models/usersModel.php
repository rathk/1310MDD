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