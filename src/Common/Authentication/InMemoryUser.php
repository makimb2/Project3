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


	    public function authenticate()
	    {
	        if ($this->username !== 'CHADLYMEM') {
	            return false;
	        }
	        if ($this->password !== '123POP') {
	            return false;
	        }
	        return true;
		}

	}
