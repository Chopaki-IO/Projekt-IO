<?php
class Init {

	public $dir;
	public $lang;

	function __construct()
	{
		$ini = parse_ini_file('./app.ini');


		$this->dir=$ini['path'];
		$this->lang=$ini['lang'];

	}
 	

 	public function getFiles()
	{


	$files=array();

	$it = new RecursiveDirectoryIterator($this->dir);
	$display = Array ( "$this->lang" );
	foreach(new RecursiveIteratorIterator($it) as $file)
	{
    if (in_array(strtolower(array_pop(explode('.', $file))), $display))
         array_push($files, $file );

	}
	return $files;
	}
 
}
?>