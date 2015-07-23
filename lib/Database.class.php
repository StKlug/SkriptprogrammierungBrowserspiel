<?php
	
	class Database
	{
		private static $instance;
		private static $con = 'mysql:dbname=viergewinnt;host=localhost';
		private static $usr = 'viergewinnt';
		private static $pw = 'skriptprog1234';
	
		static function getInstance()
		{
			if(Database::$instance){
				return Database::$instance; 
			}
			else {
				Database::$instance = new PDO(Database::$con,Database::$usr,Database::$pw);
				return Database::$instance;
			}
		}	

	}

?>