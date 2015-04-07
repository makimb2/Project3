<?php

namespace Common\Authentication;



	class UserStoredInMemory implements IAuthentication
	{
	    protected $username;
	    protected $password;

	    public function __construct($posting)
	    {
	        $this->username = $posting->username;
	        $this->password = $posting->password;
	    }


	    public function authenticate($username, $password)
    {
        if($username === "CHADLYMEM" && $password === "123P")
        {
            echo 'You have been authenticated '. $username;
            return;
        }
        echo 'Access Denied';
    }

	}
