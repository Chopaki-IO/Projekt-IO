
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




 foreach ($files_list as $fk=>$filek) {
$array = explode("\n", file_get_contents($filek));


//Znajdywanie funckji w pliku
foreach ($array as $key=>$line) {

	$pos=strpos($line, $expect);

	if($pos!==false){
		$found=strtok(substr($line, $pos+8), '{');
		array_push($lista[$fk], $found);
    array_push($functions, $found);



		}

 	}
 	
 }








//Szukanie użytych funkcji w funkcji
 foreach ($lista as $fk=>$filek) {

if(count($filek)>1)
{


//Pobranie treści pliku
   $string = file_get_contents($filek[0]);
//Szukam w
  $backlog.= "<br>Szukam w pliku: " .$filek[0].'<br>';
$i=1;
  //Functions defined
  for($i; $i<count($filek);$i++)
  {

        


  $content=htmlspecialchars($string);

  $lookfor= getBetween($content,'function'.$filek[$i],'}');
 $backlog.="<br>".'Szukam w funkcji :<b>'.$filek[$i]."</b><br>";


array_push($function_list,array(trim($filek[$i], " ;,")));

foreach ($functions as $f) {
 $szukana= preg_replace('/\s+/', '', $f).';';
 $wystapien=substr_count($lookfor,$szukana);
  $backlog.= 'Funkcja: '. $szukana.' Wystąpiła: '. $wystapien.'<br>';

for($x=0;$x<$wystapien;$x++)
{

array_push($function_list[$element],trim($szukana, " ;,"));

}

}

 $element++;

  }
   $backlog.= "<br>";
 
}



  
 }



echo '<button>Backlog</button><br><p>'.$backlog.'</p>'.'
  <form action="index.php"><input type="submit" value="Historyjka1" /></form>
  <form action="index2.php"><input type="submit" value="Historyjka2" /></form>
  <form action="index3.php"><input type="submit" value="Historyjka3" /></form>
';


//END OF PROGRAM
?>


<!doctype html>
<html>
<head>
  <title>Network</title>
  <script type="text/javascript" src="js/vis-network.min.js"></script> 
  <script src="js/jquery.min.js"></script>

</head>
<body>
<div id="mynetwork"></div>
<script type="text/javascript" src="js/backlog.js"></script> 
<script type="text/javascript">


//Handling files list
var files = <?php echo json_encode($function_list); ?>;
var nodes = [];
var edys =	[];



//Processing Files list
 	$.each(files, function(index, value) {

//Creating Files on diagram
nodes.push({
        id: files[index][0].replace(/(\r\n|\n|\r)/gm, ""), label: 'Funkcja '+files[index][0].replace(/(\r\n|\n|\r)/gm, "")
    });


//Handling relations
$.each(files[index], function(index1, value1) {
	
	if(index1>0){
    
		edys.push({
      from:files[index][0].replace(/(\r\n|\n|\r)/gm, ""), label: '3', arrows:"to", width:3, to:   files[index][index1]
   			 });

		}
	
	})
})



function countConnections(elements)
{


var sorted =[];
elements.sort();

var current = null;
var count = 0;

for(var i = 0; i < elements.length; i++)
{
    if(JSON.stringify(elements[i]) != JSON.stringify(current))
  {
    if(count > 0)
    {
       
        current["label"]='Wywołań: '+count;
      sorted.push(current);

    }
    current = elements[i];
    count = 1;
  }
  else
  {
    count++;
  }
}

if(count > 0)
{
           current["label"]='Wywołań: '+count;
      sorted.push(current);
  }

  return sorted;

}




var edges=countConnections(edys);


/*

Tworzenie Grafu
*/



var dataSet = new vis.DataSet(nodes);
  // create an array with edges
  var edges = new vis.DataSet(edges);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes,
    edges: edges
  };
var options = {
  physics: {
    stabilization: false,
    barnesHut: {
      springLength: 500
    }

  },




};

  var network2 = new vis.Network(container, data, options);


</script> 


<link rel="stylesheet" href="style.css">
</body>
</html>
