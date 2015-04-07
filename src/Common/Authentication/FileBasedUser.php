<?php

namespace Common\Authentication;

	class UserThatsFileLoaded implements IAuthentication
	{
	    protected $username;
	    protected $password;

	    public function __construct($posting)
	    {
	        $this->username = $posting->username;
	        $this->password = $posting->password;
	    }


		// send the info from txt so it can be put into an array
		private function checkFileVerification($inputFile)
		{
				//return it as string
			 $theFile = file_get_contents($inputFile);
             $returnArr = explode(",",$theFile);
			 return $returnArr;//Returns an array of strings, split up by delimiter.
		}

		public function authenticate()
		{
			$inFile='FromFile.txt';
			$FileLoadArr=$this->checkFileVerification($inFile);//retrieve the info from txt and then stuff it into our array
			$inputusername = $FileLoadArr[0] ;//load array
			$inputpassword = $FileLoadArr[1];

			if($this->username === $inputusername and $this->password === $inputpassword)
			{
				return TRUE;
			}
			return FALSE;
		}
	}