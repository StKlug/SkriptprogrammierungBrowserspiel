<?php

	class Template
	{
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
			$file = fopen($templatePath, 'r');
			$template = fread($file, filesize($templatePath));
			fclose($file);
			foreach ($this->parameter as $key => $value) {
				$template = str_replace('{$'.$key.'}', $value, $template);
			}
			echo $template;
		}
	}
	

?>