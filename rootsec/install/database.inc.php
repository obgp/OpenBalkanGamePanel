<?php
class Database
{
    // connection parameters
    private $host = "";
    private $port = "";
    private $db_driver = "";
    private $database = "";
    private $user = "";
    private $password = "";
    
    private $error = "";
    
    private $affectedRows = "0";
    
    // database connection handler 
    private $dbh = NULL;
    
    // database statament handler 
    private $sth = NULL;
    
    // static data members	
    private static $objInstance;
    
    
    //==========================================================================
    // Class Constructor
    //==========================================================================
    function __construct($database_host, $database_name, $database_username, $database_password, $db_driver = "")
    {
        $this->host = $database_host;
        $this->port = "";
        
        $host_parts = explode(":", $database_host);
        if (isset($host_parts[1]) && is_numeric($host_parts[1])) {
            $this->host = $host_parts[0];
            $this->port = $host_parts[1];
        }
        
        $this->database       = $database_name;
        $this->user           = $database_username;
        $this->password       = $database_password;
        $this->db_driver      = strtolower($db_driver);
    }
    
    //==========================================================================
    // Class Destructor
    //==========================================================================
    function __destruct()
    {
        // echo 'this object has been destroyed';
    }
    
    /**
     *	Create database
     */
    public function Create()
    {
        $this->dbh = new PDO($this->db_driver . ":host=" . $this->host, $this->user, $this->password);
        $this->dbh->exec("CREATE DATABASE IF NOT EXISTS `" . $this->database . "`;");
        if ($this->dbh->errorCode() != "00000") {
            $err         = $this->dbh->errorInfo();
            $this->error = $err[2];
            return false;
        }
        return true;
    }
    
    /**
     *	Checks and opens connection with database
     */
    public function Open()
    {
        
        $port = (!empty($this->port)) ? ";port=" . $this->port : "";
        
        try {
            switch ($this->db_driver) {
                case "mysql":
                default:
                    $this->dbh = new PDO($this->db_driver . ":host=" . $this->host . $port . ";dbname=" . $this->database, $this->user, $this->password);
                    break;
            }
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (empty($this->dbh)) {
                return false;
            }
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
        
        return true;
    }
    
    /**
     *	Close connection 
     */
    public function Close()
    {
        $this->sth = null;
        $this->dbh = null;
    }
    
    /**
     *	Returns database engine version
     */
    public function GetVersion()
    {
        // clean version number from alphabetic characters
        $version = $this->dbh->getAttribute(PDO::ATTR_SERVER_VERSION);
        return preg_replace("/[^0-9,.]/", "", $version);
    }
    
    /**
     *	Get DB driver
     */
    public function GetDbDriver()
    {
        return $this->db_driver;
    }
    
    /**
     *	Runs query
     *		@param $query
     */
    public function Query($query = '')
    {
        try {
            $this->sth = $this->dbh->query($query);
            if ($this->sth !== FALSE)
                return true;
            else
                return false;
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
    
    /**
     *	Exacutes query
     *		@param $query
     */
    public function Exec($query = '')
    {
        $this->affectedRows = $this->dbh->exec($query);
    }
    
    /**
     *	Returns affected rows after exec()
     */
    public function AffectedRows()
    {
        return $this->affectedRows;
    }
    
    /**
     *	Returns rows count for query()
     */
    public function RowCount()
    {
        return $this->stm->rowCount();
    }
    
    /**
     *	Returns last insert ID
     */
    public function InsertID()
    {
        return $this->dbh->lastInsertId();
    }
    
    /**
     *	Returns error 
     */
    public function Error()
    {
        return $this->error;
    }
    
    /**
     *	Returns error code
     */
    public function ErrorCode()
    {
        return $this->dbh->errorCode();
    }
    
    /**
     *	Returns error code
     */
    public function ErrorInfo()
    {
        return $this->sth->errorInfo();
    }
    
    
    //==========================================================================
    // Returns DB instance or create initial connection 
    // 		@param $database_host
    // 		@param $database_name
    // 		@param $database_username
    // 		@param $database_password
    // 		@param $db_driver
    //==========================================================================
    public static function GetInstance($database_host, $database_name, $database_username, $database_password, $db_driver = "")
    {
        if (!self::$objInstance) {
            self::$objInstance = new Database($database_host, $database_name, $database_username, $database_password, $db_driver);
        }
        return self::$objInstance;
    }
    
}
?>