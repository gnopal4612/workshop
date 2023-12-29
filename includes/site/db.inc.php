<?php
// echo 'db.inc.php <br />';
/* Connect to a MySQL database using driver invocation */

$host = '127.0.0.1';
$db   = 'workshop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// $dsn = 'mysql:dbname=inventory;host=127.0.0.1';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try
{
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}


class Cosmos
{
    private $query;
    private $args;

    private $fields = ['*'];
    private $table = '';
    private $where = '';

    private $request;
    private $errors = [];

    // auto called when object is created
    function __construct($request)
    {
		if (isset($request['query']) && !empty($request['query']))
		{
			$this->query = $request['query'];
		}

        if (isset($request['args']) && !empty($request['args']))
		{
			$this->args = $request['args'];            
		}
	}

	function fetch()
	{
	    global $pdo;

	    try
	    {
	        if (!$sth = $pdo->prepare($this->query))
	        {
	            // TODO: custom message
	            $this->errors[] = 'prepare fail - (' . $this->query . ')';
	        }
	        elseif (!$sth->execute($this->args))
	        {
	            // TODO: custom message
	            $this->errors[] = 'args fail - [' . implode(',' , $this->args) . '] ';
	        }

	        $data = $sth->fetch(PDO::FETCH_ASSOC);

	        return $data;
	    }
	    catch (PDOException $e)
	    {
	        $this->errors[] = $e->getMessage();
	    }
	}

	function fetchAll()
    {
        global $pdo;
        
        try
        {
            if (!$sth = $pdo->prepare($this->query))
            {
                // TODO: custom message
                $this->errors[] = 'prepare fail - (' . $this->query . ')';
            }
            elseif (!$sth->execute($this->args))
            {
                // TODO: custom message
                $this->errors[] = 'args fail - [' . implode(',' , $this->args) . '] ';
            }

            $data = $sth->fetchALL(PDO::FETCH_ASSOC);

            return $data;
        }
        catch (PDOException $e)
        {
            $this->errors[] = $e->getMessage();
        }

        // reveal([$pdo, $sth]);
    }

	function execute()
	{
        global $pdo;

        try
        {
            if (!$sth = $pdo->prepare($this->query))
            {
                // TODO: custom message
                $this->errors[] = 'prepare fail - (' . $this->query . ')';
            }
            elseif (!$sth->execute($this->args))
            {
                // TODO: custom message
                $this->errors[] = 'args fail - [' . implode(',' , $this->args) . '] ';
            }
        }
        catch (PDOException $e)
        {
            $this->errors[] = $e->getMessage();
        }
	}

    function getErrors()
    {
        return $this->errors;
    }

    function getQuery()
    {
        return [
            'query' => $this->query,
            'args' => $this->args, 
        ];
    }

}


