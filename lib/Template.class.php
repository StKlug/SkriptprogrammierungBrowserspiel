<?php
	session_start();
	class Template
	{
		private static $masterPath ='templates/_master.tpl';
		private $parameter;
		
		public function __construct()
		{
			$this->parameter = array('title' => 'Default title','body'=>'Default body' );
		}
		
		public function assign($key,$value)
		{
			$this->parameter[$key] = $value;
		}
		
		public function display($templatePath){
			$template = file_get_contents($templatePath);
			
			foreach ($this->parameter as $key => $value) {
				$template = str_replace('{$'.$key.'}', $value, $template);
			}
			$master = file_get_contents(Template::$masterPath);
			
			//Navbar bauen
			
			//TODO besser logged in Checks
			if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'])
			{
				$navbar = '<li data-target="home">Home</li> ';
				$navbar .='<li data-target="game">Spiel</li> ';
				$navbar .='<li data-target="profile">Profil bearbeiten</li>';
				$navbar .='<li data-target="messages">Nachrichten</li> ';
				$navbar .='<li data-target="logout">Logout</li> ';
			}
			else {
				$navbar = '<li data-target="register">Registrierung</li> ';
			}
			
			$master = str_replace('{$_masterNavbar}', $navbar, $master);
			$master = str_replace('{$_masterContent}', $template, $master);
			echo $master;
		}
	}
?>