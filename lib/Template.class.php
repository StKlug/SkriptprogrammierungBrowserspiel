<?php

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
			
			//TODO hier was tun, wenn im Master was geändert werden soll
			
			$master = str_replace('{$_masterContent}', $template, $master);
			echo $master;
		}
	}
	

?>