<?php

require_once('utils.php');
require_once('config.php');
//require_once('Class-Connection.php');
require_once('Class-DB.php');


/**
 * Description of Class-User
 *
 * @author Samuel
 */
class User extends DB {
	
	private $id;
	private $fb_ID;
	private $fb_name;
	private $fb_comment;
	private $fb_date;
	private $post_ID;
	private $fb_flag;
	private $attr = array('id' => NULL, 'fb_ID' => NULL, 'fb_name' => NULL, 'fb_comment' => NULL, 'fb_date' => NULL, 'post_ID' => NULL, 'fb_flag' => NULL);

	function __construct($param = NULL) {		
		parent::__construct("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
		$this->put($param);
	}

	public function __set($name, $value) {
		$this->attr[$name] = $this->validate($name, $value);
	}

	public function __get($name) {
		//echo "Getting '$name'\n";
		if (array_key_exists($name, $this->attr)) {
			return $this->attr[$name];
		}

		$trace = debug_backtrace();
		trigger_error(
				'Undefined property via __get(): ' . $name .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'], E_USER_NOTICE);
		return null;
	}

	private function validate($name, $value) {
		//add validation based on $name
		switch ($name) {
				case 'fb_ID' :
				case 'post_ID' :
					//exception, data filter
					return assertNumeric($value);
					break;
			default:
				return mysql_escape_string($value);
		}
	}

	public function put($param = NULL) {
		//set a group of property based on an array input
		$semID = FALSE;
		//QUICK SKIP if ID is ommited
		if (count($param) == count($this->attr) - 1) {
			$semID = TRUE;
		}

		if (is_array($param)) {
			//if the array passes by objest by association or index
			if (isAssoc($param)) {
				foreach ($param as $key => $item) {
					//Preserve data integrity and filter out non-attributes
					if (key_exists($key, $this->attr)) {
						$this->attr[$key] = $this->validate($key, $item);
					}
				}
			} else {

				foreach ($this->attr as $key => $val) {
					if (($key == 'id') && ($semID)) {
						continue;
					}//skipping id update
					$this->attr[$key] = $this->validate($key, array_shift($param));
				}
			}
		}
	}

	/* This is used this to quicky compare if two arrays of User.Models are
	 * by using array_diff() to compare them as strings. Ideally json encode
	 * should produce unique strings with the obj variables
	 */

	public function __toString() {
		return json_encode(get_object_vars($this));
	}

	public function getByFBId($id) {	
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "fb_ID", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where']. " = $id";
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		//inspect($r);
		return formatArraySingle($r, 'User');
	}
	
/* ### ANTERIOR	
public function getWinner($post_ID) {	
		
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "fb_flag", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where']. " = 1 AND post_ID = $post_ID";
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		$u = $r;
		//inspect($u);
		if ($u) {
			$this->attr['id'] = $u[0]['id'];
			$this->attr['fb_ID'] = $u[0]['fb_ID'];
			$this->attr['fb_name'] = $u[0]['fb_name'];
			$this->attr['fb_comment'] = $u[0]['fb_comment'];
			$this->attr['fb_date'] = $u[0]['fb_date'];
			$this->attr['post_ID'] = $u[0]['post_ID'];
			$this->attr['fb_flag'] = $u[0]['fb_flag'];
			return TRUE;
		} else {
			return FALSE;
		}
	}*/
	
	public function getWinner($post_ID) {	
		
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "fb_flag", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where']. " = 1 AND post_ID = $post_ID";
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		$u = $r;
		//inspect($u);
		if ($u) {
/*			$this->attr['id'] = $u[1]['id'];
			$this->attr['fb_ID'] = $u[1]['fb_ID'];
			$this->attr['fb_name'] = $u[1]['fb_name'];
			$this->attr['fb_comment'] = $u[1]['fb_comment'];
			$this->attr['fb_date'] = $u[1]['fb_date'];
			$this->attr['post_ID'] = $u[1]['post_ID'];
			$this->attr['fb_flag'] = $u[1]['fb_flag'];*/
			return formatArraySingle($u, 'User');
			//return TRUE;
		} else {
			return FALSE;
		}
	}	

	public function getUserComment($fb_ID, $post_id) {
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "post_ID", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where']. " = $post_id AND fb_ID = $fb_ID";
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		//inspect($r);
		return formatArraySingle($r, 'User');
	}

	public function getOtherCommentsForPost($id, $omit_ID = '') {
			
		if ($omit_ID) {
			$omit = ' AND fb_ID <> '. (int)$omit_ID;
		}
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "post_ID", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where']. " = $id AND fb_flag = 0". $omit;
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		
		return formatArraySingle($r, 'User');
	}
	public function totalComments() {
			
		
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where'];
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		$r = formatArraySingle($r, 'User');
		if (is_array($r)) { return count($r); } else { return 1; }
	}

	public function getCommentsForPost($id) {
		$query = array('fields' => "*", 'asc' => "fb_date", 'where' => "post_ID", 'like' => "", 'limit' => "");
		
		$this->fields = $query['fields'];
		$this->asc = $query['asc'];
		$this->where = $query['where']. " = $id";
		$this->like = $query['like'];
		$this->limit = $query['limit'];
		
		//returning values as a single object or an array of those objects
		$r = $this->select();
		//inspect($r);
		return formatArraySingle($r, 'User');
		
	}

	public function actionInsert($facebookId, $name, $comment, $postID) {
		$date = date('Y-m-d H:i:s');
		if (!$facebookId) {$facebookId = $this->fb_ID;}
		if (!$name) {$name = $this->name;}
		if (!$comment) {$comment = $this->comment;}
		if (!$postID) {$postID = $this->post_ID;}		

		$this->fields = "fb_ID, fb_name, fb_comment, fb_date, post_ID";
		$this->values = "'" . $facebookId . 
						"','" . $name . 
						"','" . $comment . 
						"','" . $date . 
						"','" . $postID . "'";

		$t = $this->insert();
		//update with the retrived id
		$db = $this->getDB();
		$this->id = $db->lastInsertId();
		
	}
	
	public function actionUpdate($facebookId, $postID, $flag) {
		
		$this->fields = "fb_flag = $flag";
		$this->where =  "fb_ID = $facebookId AND post_ID = $postID";
		
		$this->update();
	}
	
	
	public function actionDelete($facebookId, $postID) {
		
		$this->where = "fb_ID = $facebookId AND post_ID = $postID";
		$this->delete();
	}
	
	public function actionList() {
		//$this->table = 'wp_users';
		$this->fields = "*";
		$this->asc = "fb_ID";
		$this->limit = '';

		//returning values as a single object or an array of those objects
		$r = $this->select();
		//$r = $this->showTables();
		return $r;//Utility::formatArraySingle($this->select(), 'User_Model');		
	}
	
	

}

?>