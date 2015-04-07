<?php

namespace Common\Authentication;
use PDO;

	class UserFromMySQL implements IAuthentication
	{
		
		private $db;
		protected $username;
	    protected $password;
	
	    public function __construct($posting)
	    {
	        $this->username = $posting->username;
	        $this->password = $posting->password;
	    }

		public function authenticate()
		{
		
		try
			{
				$this->db = new PDO('mysql:host=localhost;dbname=pdo_ret;charset=utf8', 'root', '');
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
        $query = "select username, password from users";
        $results = $this->db->query($query);
        while($row = $results->fetch(PDO::FETCH_ASSOC))
        {
            if($row["username"]=== $this->username && $row["password"] === $this->password)
            {
                $results->closeCursor();
                return true;
            }
        }
        $results->closeCursor();
        return false;
		}
	}
