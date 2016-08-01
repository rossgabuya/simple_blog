<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Code Igniter User Authentication Class
 * By Craig Rodway, craig.rodway@gmail.com
 */





// User types
define( 'ADMINISTRATOR', 1 ) ;




class Userauth{



	
	var $object;
	var $allowed_users = array();
	var $denied_users = array();
	var $allowed_set = false;
	var $denied_set = false;
	var $acl_denied = 'You are not permitted to view this page.';




	function Userauth(){
		$this->object =& get_instance();
		$this->object->load->database();
		log_message('debug','User Authentication Class Initialised via '.get_class($this->object));
	}




	/**
	 * Logout user and reset session data
	 */
	function logout(){
		log_message('debug','Userauth: Logout: '.$this->object->session->userdata('username'));
		$sessdata = array('username'=>'','email' => '', 'loggedin'=>'false');
		$this->object->session->set_userdata($sessdata);
		$this->object->session->destroy();
		#redirect('user/login','location');
	}

	function password_encrypt($password){
           
            $hash_format = "$2y$10$";
            $salt_length = 22;
            $salt = generate_salt($salt_length);
            $format_and_salt = $hash_format . $salt;
                                
            $hash = crypt($password,$format_and_salt);
            return $hash;             
        }
        
        function generate_salt($length){
            $unique_random_string = md5(uniqid(mt_rand(),true));
            
            $base64_string  = base64_encode($unique_random_string);
            
            $modified_base64_string = str_replace('+','.',$base64_string);
            
            $salt = substr($modified_base64_string,0,$length);
            
            return $salt;
        }
        

	function password_check($password,$existing_hash) {
            $hash = crypt($password,$existing_hash);
            if($hash === $existing_hash){
                return true;
            }else{
                return false;
            }
        }


	/**
	 * Try and validate a login and optionally set session data
	 *
	 * @param		string		$username					Username to login
	 * @param		string		$password					Password to match user
	 * @param		bool			$session (true)		Set session data here. False to set your own
	 */
	function trylogin($email, $password){
		if( $email != '' && $password != ''){
			// Only continue if user and pass are supplied
			
			
			$this->object->db->select('*');
			$this->object->db->from('admins');
			$this->object->db->where('email', $email);
			$this->object->db->limit(1);
			$query = $this->object->db->get();
			
			log_message('debug', 'Trylogin query: '.$this->object->db->last_query() );

			// If user/pass is OK then should return 1 row containing username,fullname
			$return = $query->num_rows();
			
			// Log message
			log_message('debug', "Userauth: Query result: '$return'");
			
			if($return == 1){
				// 1 row returned with matching user = validated!
				
				// Get row from query (fullname, email)
				$row = $query->row();
				if (password_check($password,$row["hashed_password"])) {
					
				
					// Update the DB with the last login time (now)..
					$timestamp = mdate("%Y-%m-%d %H:%i:%s");
					$sql =	"UPDATE admins ".
									"SET last_login='".$timestamp."' ".
									"WHERE id='".$row->id."'";
					$this->object->db->query($sql);
					
					// Log
					log_message('debug',"Last login by $username SQL: $sql");
					
					// Set session data array			
					$sessdata['user_id'] = $row->id;
					$sessdata['username'] = $row->username;
					$sessdata['email'] = $email;
					$sessdata['loggedin'] = 'true';
					// Hash is <login_date><email><username>
					$str = 'c0d31gn1t3r'.$timestamp.$email.$this->username;
					log_message('debug', 'Hash string: '.$str);
					$sessdata['hash'] = sha1($str);
					
					// param to set the session = true
					log_message('debug', "Userauth: trylogin: setting session data");
					log_message('debug', "Userauth: trylogin: Session: ".var_export($sessdata, true) );
					// Set the session
					$this->object->session->set_userdata($sessdata);
					return true;
				} else {
					// no rows with matching pass - ACCESS DENIED!!
					return false;
				}
			} else {
				// no rows with matching user - ACCESS DENIED!!
				return false;
			}
		} else {
			return false;
		}
	}






	
	/**
	 * Checks to see if the supplied user exists in the DB
	 *
	 * @param			string		$username		Username to look up
	 * @return		bool									True if user exists
	 */
	function user_exists( $username ){
		$sql = "SELECT id FROM admins WHERE username='$username'";
		$query = $this->object->db->query($sql);
		$c = $query->num_rows();
		$row = $query->row();
		return ($c == 1) ? true : false;
	}




	/**
	 * Add a user to the DB
	 *
	 * @param			array		$userarray		Array containing the user attributes
	 * @return		int										0:Not added,1:User added,2:Already exists
	 */
	function adduser( $userarray ){
		if( ! is_array( $userarray ) ){ return 0; }

		// Only add user if he doesn't already exist
		if( !$this->user_exists( $userarray['username'] ) ){
			// Get only fields we want from the array
			$data['email'] = $userarray['email'];
			$data['username'] = $userarray['username'];
			$data['password'] = password_encrypt($userarray['password']);

		
			$this->object->db->insert('admins', $data);

			return 1;		// User added
		} else {
			return 2;		// User already exists
		}
	}




	function edituser( $userid, $userarray ){
		if( !is_array( $userarray ) ){ return 0; }
		
		// Get only fields we want from the array
		$data['username'] = $userarray['username'];
		$data['password'] = password_encrypt($userarray['password']);
		$data['email'] = $userarray['email'];


		$this->object->db->where('id', $userid);
		$this->object->db->update('admins', $data);
		

	}




	/**
	 * Remove a user
	 *
	 * Note: function also removes the user from all groups they are a member of
	 *
	 * @param		string		$username		Username of the user to remove
	 * @return	bool
	 */
	function deleteuser( $username ){
		if( $username == $this->object->session->userdata('username') )
		{
			// Exit if delete object is same as session user (same person)
			log_message('info', 'User change: User '.$username.' tried to delete themself.');
			show_error('You can not delete yourself!');
			exit();
		}
		if( $this->user_exists( $username ) )
		{
			// User exists

			// Delete user
			$sql = 	"DELETE FROM admins WHERE username='$username' LIMIT 1";
			$del_ci_users = $this->object->db->query($sql);
			
			return true;
		} else {
			// User didn't exist in the first place!
			return false;
		}
	}




	




	function loggedin(){
		/* To check if user is logged in ...
			> Take the session userdata that will have been set at logon (including a hash)
			> Get required fields from database
			> Make the hash from the DB data and session the same way it was made at logon
			> Compare hash in session with the new one
			> If user is logged in, they will match
		*/
		
		$session_username = $this->object->session->userdata('username');
		$session_email = $this->object->session->userdata('email');
		$session_bool = $this->object->session->userdata('loggedin');
		$this->object->db->select('*');
		$this->object->db->from('admins');
		$this->object->db->where('username', $session_username);
		$this->object->db->where('email', $session_email);
		$this->object->db->limit(1);
		$query = $this->object->db->get();
		log_message('debug', 'loggedin() query: '.$this->object->db->last_query() );
		if( $query->num_rows() == 1){
			log_message('debug', 'loggedin() result: 1 row returned');
			$row = $query->row();
			$lastlogin = $row->lastlogin;
		} else {
			return false;
		}
		
		$str = 'c0d31gn1t3r'.$lastlogin.$session_username.$session_email;
		log_message('debug', 'loggedin() hash string: '.$str);
		$hash = sha1($str);
		log_message('debug', 'isloggedin() hash: '.$hash);

		if( $hash == $this->object->session->userdata('hash') ){
		/*if( ( isset($session_username) && $session_username != '') && ( isset($session_bool) && $session_bool == 'true' ) ){*/
			return true;
		} else {
			return false;
		}
	}




	function getuserid($username){
		$sql = "SELECT id FROM admins WHERE username='$username'";
		$query = $this->object->db->query($sql);
		$row = $query->row();
		return $row->userid;
	}
	
	
	
	
	function getusername($userid){
		$sql = "SELECT username FROM admins WHERE id='$userid'";
		$query = $this->object->db->query($sql);
		$row = $query->row();
		return $row->userid;
	}



	function GetLastLogin($schoolcode, $username){
		$this->object->db->select(
															'users.username,'
															.'users.lastlogin,'
															.'schools.school_id,'
															.'schools.code AS schoolcode,'
															);
		$this->object->db->from('admins');
		$this->object->db->where('username', $username);
		$this->object->db->limit(1);
		$query = $this->object->db->get();
		if( $query->num_rows() > 0){
			$row = $query->row();
			return $row->lastlogin;
		}
	}



}
