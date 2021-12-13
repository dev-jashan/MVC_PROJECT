<?php
namespace application\core;
use mysqli;

require_once 'Config.php';

class DatabaseFactory
{
    private static?DatabaseFactory $factory=null;
    protected mysqli $connection;
    protected $query;
    protected bool $show_errors=TRUE;
    protected bool $query_closed=TRUE;
    public int $query_count=0;
  
    public function __construct()
    {
       
        $this->connection=new mysqli(Config::get('DB_HOST'), Config::get('DB_USER'), Config::get('DB_PASS'), Config::get('DB_NAME'));
        if($this->connection->connect_error){
            $this->error('failed to load mysql connection'.$this->connection->connect_error );
        }
        $this->connection->set_charset(Config::get('DB_CHARSET'));
        self::$factory = $this;
    }

    public static function getFactory():DatabaseFactory
    {
        if (!self::$factory) {
            self::$factory = new DatabaseFactory();
        }
        return self::$factory;
    }

    /* function to get connection to database */

    public function getConnection() {
        $db_name=Config::get('DB_NAME');
        $server_name=Config::get('SERVER_NAME');
        $db_user=Config::get('DB_USER');
        $db_pass=Config::get('DB_PASS');

        $conn = new mysqli($server_name, $db_user, $db_pass,$db_name);
        return $this->$conn;
    }

    /* function to create a query and execute it  */

    public function query($query) {
        if (!$this->query_closed) {
            $this->query->close();
        }
		if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
				$types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
					if (is_array($args[$k])) {
						foreach ($args[$k] as $j => &$a) {
							$types .= $this->_gettype($args[$k][$j]);
							$args_ref[] = &$a;
						}
					} else {
	                	$types .= $this->_gettype($args[$k]);
	                    $args_ref[] = &$arg;
					}
                }
				array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
           	if ($this->query->errno) {
				$this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
           	}
            $this->query_closed = FALSE;
			$this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }
		return $this;
    }
    
   
    private function _gettype($var) {
	    if (is_string($var)) return 's';
	    if (is_float($var)) return 'd';
	    if (is_int($var)) return 'i';
	    return 'b';
	}
    /* function to fetch all the data returned after executing the query */

    public function fetchAll($callback = null):array {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}
    /* function to  create and return array */

    public function fetchArray():array {
	    $params = array();
        $row = array();
	    $meta = $this->query->result_metadata();
	    while ($field = $meta->fetch_field()) {
	        $params[] = &$row[$field->name];
	    }
	    call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
		while ($this->query->fetch()) {
			foreach ($row as $key => $val) {
				$result[$key] = $val;
			}
		}
        $this->query->close();
        $this->query_closed = TRUE;
		return $result;
	}
    /* function to close the  db connection */

    public function close() {
		return $this->connection->close();
	}
    
    /* function to get number of rows in the database */
    public function numRows() {
		$this->query->store_result();
		return $this->query->num_rows;
	}

	public function affectedRows() {
		return $this->query->affected_rows;
	}

    public function lastInsertID() {
    	return $this->connection->insert_id;
    }
    /* function to show errors occured while executing the query */

    public function error($error) {
        if ($this->show_errors) {
            exit($error);
        }
    }
    
    public function checkUser($query){
        if (!$this->query_closed) {
            $this->query->close();
        }
        $this->connection->prepare($query);
        $this->query->execute();
        $user=$this->query->fetch();
        if ($user) {
            return 'username exists'.$user;
        } else {
            return 'not exists';
        } 
    }
   

}
