<?php
class FilesList {



 	
	public function getFiles($files_list)
	{
		$lista=array();
	

	foreach ($files_list as $key => $file) {
	
		
    array_push($lista,array(basename($file)));
    array_push($lista[$key],filesize($file).' b ');
	 
	}

	}	


	
	}
 	
 

?>