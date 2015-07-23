<?php
	
	class Database
	{
		private static $instance;
		private static $con = 'mysql:dbname=viergewinnt;host=lexlix.de';
		private static $usr = 'viergewinnt';
		private static $pw = 'skriptprog1234';
	
		static function getInstance()
		{
			if(Database::$instance){
				return Database::$instance; 
			}
			else {
				try
				{
				Database::$instance = new PDO(Database::$con,Database::$usr,Database::$pw);
				}
				catch (PDOException $e)
				{
					header('Location index.php');
				}
				return Database::$instance;
			}
		}	

	}

?>