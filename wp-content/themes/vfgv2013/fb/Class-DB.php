<?php

require_once 'config.php';

class DB extends PDO {
	
	
	public $table = 'fb_comments';
	public $fields;
	public $values;
	public $where;
	public $like;
	public $limit;
	public $asc;
	public $desc;
	public $date;
	
	private $connect = DB_HOST;
	private $root = DB_USER;
	private $pass = DB_PASSWORD;
	private static $conn;
	private static $error;
	
	function __construct($connect, $root = '', $pass = '', $options = array()) {		
		if (PDO_DEBUG){$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);}
		//inspect(self::$conn);
		if(NULL == self::$conn){
			parent::__construct($connect, $root, $pass, $options);
		}
	}

	public static function getDB() {
		if (!isset(self::$conn)) {
			try {	
				if (PDO_DEBUG){$PDO_options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);} else {$PDO_options = array();}
				self::$conn = new DB("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD, $PDO_options);
			} catch (PDOException $e) {
				throw new Exception("Error to Connect: " . $e->getMessage() . " Code: " . $e->getCode());
			}
		}

		//inspect(self::$conn);
		return self::$conn;
	}
	
	public static function PDO($sql) {
		if (PDO_DEBUG) {inspect($sql);}
		try {
			self::$conn = DB::getDB();
			$stm = self::$conn->prepare($sql);
			$stm->execute();
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);
               if (PDO_DEBUG) {inspect($result);}
               
			if (!empty($result)) {
				return $result;
			} else {
				return array();
			}
		} catch (PDOException $e) {
			self::$error = $e;
			echo '<span>'.self::$error->getMessage() . " # " . self::$error->getCode() . '</span>';
		}
		
	}
	
//	
//	public function setId($id) {
//		$this->id = $id;
//	}
//
//	public function getId() {
//		return $this->id;
//	}

	public function getError() {
		if (is_a(self::$error, 'PDOException')) {
			return self::$error->getCode();
		} else {
			return new PDOException();
		}
		
	}

	public function select() {
		$date = (!empty($this->data) ? ", DATE_FORMAT({$this->data}, '%d/%m/%Y') AS data" : "");
		$padrao = (!empty($this->desc) ? "{$this->desc} DESC" : "{$this->asc} ASC");
		$where = (!empty($this->where) ? "WHERE {$this->where}" : "" );
		$limit = (!empty($this->limit) ? "LIMIT {$this->limit}" : "" );
		$like = (!empty($this->like) ? "LIKE '%{$this->like}%'" : "" );

		if ((!empty($this->table1)) and (!empty($this->table2) and (!empty($this->field)))) {
			$sql = "SELECT {$this->fields} {$date} FROM {$this->table1} INNER JOIN {$this->table2} ON {$this->field} {$where} {$limit};";
		} else {
			$sql = "SELECT {$this->fields} {$date} FROM {$this->table}  {$where} {$like} ORDER BY {$padrao} {$limit};";
		}
		//inspect($sql);
		
		return self::PDO($sql);
	}

	public function insert() {
		$sql = "INSERT INTO {$this->table} ({$this->fields}) VALUES ({$this->values});";
		return self::PDO($sql);
	}

	public function update() {
		$sql = "UPDATE {$this->table} SET {$this->fields} WHERE {$this->where};";
		return self::PDO($sql);
	}

	public function delete() {
		$sql = "DELETE FROM {$this->table} WHERE {$this->where};";
		return self::PDO($sql);
	}

	public function total() {
		$sql = "SELECT COUNT(*) AS total FROM {$this->table};";
		return self::PDO($sql);
	}
	
	public function showTables() {
		$sql = "SHOW TABLES";
		return self::PDO($sql);
	}
	
	
}

?>
