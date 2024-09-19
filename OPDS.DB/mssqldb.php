<?php
	class db{
	    private $_connection;
	    private $_dbselect;
	    private $_result;
	 
	    public function  __construct()
	    {
	        //require_once('db.inc.php');
	    }
	 
	    public function connect()
	    {
        	/* Connect to a MSSQL database using driver invocation */
			$dsn = 'sqlsrv:server='.DB_HOST.'; Database='.DB_NAME;
			$user = DB_USER;
			$password = DB_PASS;

			try {
			    $this->_connection = new PDO($dsn, $user, $password);
			   	$this->_connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			} catch (PDOException $e) {
			    echo 'Connection failed: ' . $e->getMessage();
			}
	    }
	 
	    public function query($sql, $params = NULL)
	    {
	        try {
	        	if (isset($params))
	        	{
	        		$this->_result = $this->_connection->prepare($sql)->execute($params);
	        	}
	        	else
	        	{
	        		$this->_result = $this->_connection->query($sql);	
	        	}
	        	return $this->_result;
	        } catch (PDOException $e) {
			    echo 'Query failed: ' . $e->getMessage();
			}
	    }

	    public function execute($sql, $params = NULL, &$errorInfo = NULL)
	    {
	    	$stmt = $this->_connection->prepare($sql);
	       	if (isset($params))
	       	{
	       		$result = $stmt->execute($params);
	       	}
	       	else
	       	{
       			$result = $stmt->execute();	
	       	}
	       	if (!$result) {
				$errorInfo = $this->_connection->errorInfo();
				exit();
			}
	       	$this->_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	       	return $this->_result;
	    }
	 
	    public function free()
	    {
	        //mssql_free_result($this->_result);
	        sqlsrv_free_stmt($this->_result);
	    }
	 
	    public function disconnect()
	    {
	        //mssql_close($this->_connection);
	        sqlsrv_close($this->_connection);
	    }
	}
?>