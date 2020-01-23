<?php
/**
*
*  Historyjka 2
*    
* 
*   Jako programista chcę zobaczyć graf relacji 
*   między funkcjami/metodami w podanym kodzie źródłowym,
*   w celu analizy zależności w kodzie źródłowym.
*
*
*   @author    Michal Wykret  <wykret.m0212@gmail.com>
*   @author    Szymon Socha   <szysocha1995@gmail.com>
*/




//require autoloader for classes
require_once('classes/autoloader.php');



//Define vars
$functions=array();
$expect="function";
$function_list=array();
$pliki = array ();
$lista=array();
$backlog='';
$element=0;
$init = new Init();
$files_list=$init->getFiles();
$files = new FilesList($files_list);



foreach ($files_list as $key => $file) {
	
	
    array_push($lista,array(realpath($file)));

	 
}


function getBetween($content,$start,$end){
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}




?>