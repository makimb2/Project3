<?php
echo __FILE__.PHP_EOL;

	class PostThang
	{
		private $username;
		private $password;
		private $authSelect;
		
		public function __construct($posty)
		{
			if(!isset($posty['username'])) {
				throw new InvalidArgumentException(__METHOD__.'('.__LINE__.'): ERROR: there is no username');
			}
			
			if(!isset($posty['password'])) {
				throw new InvalidArgumentException(__METHOD__.'('.__LINE__.'): ERROR: there is no password');
			}

			$this->username = $posty['username'];
			$this->password = $posty['password'];
			$this->authSelect = $posty['authSelect'];
			
		
		}
		
		public function getUsername()
		{
			return $this->username;
		}
		
		public function getPassword()
		{
			return $this->password;
		}
		
		public function getCredauthSelect()
		{
			return $this->authSelect;
		}
		
	}
