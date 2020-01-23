
<?php
/**
*
*   Historyjka 1
*
*   Jako programista, chcę zobaczyć graf 
*   pokazujący połączenia pomiędzy plikami 
*   z kodem źródłowym w moim projekcie
*
*
*   @author     Cezary Wenta <author@example.com>
*/



//require autoloader for classes
require_once('classes/autoloader.php');



//define vars
$init = new Init();
$files_list=$init->getFiles();
$files = new FilesList($files_list);
$backlog='';





//Get filesize
$lista=array();
foreach ($files_list as $key => $file) {
	
		
    array_push($lista,array(basename($file)));
    array_push($lista[$key],filesize($file).' b ');
	 
}





//Excpected strings 
$lang_expect=array("require","require_once","include");

 foreach ($files_list as $fk=>$filek) {
$array = explode("\n", file_get_contents($filek));

foreach ($lang_expect as $expect) {
	# code...

foreach ($array as $key=>$line) {

	$pos=strpos($line, $expect);

	if($pos!==false){
		$found=strtok(substr($line, $pos+8), "'");
		array_push($lista[$fk], $found);
		



		}

 	}
 	}
 }


//END OF PROGRAM
 echo '
  <form action="index.php"><input type="submit" value="Historyjka1" /></form> <form action="index2.php"><input type="submit" value="Historyjka2" /></form><form action="index3.php"><input type="submit" value="Historyjka3" /></form>
';
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
<script type="text/javascript">



//Handling files list
var files = <?php echo json_encode($lista); ?>;
var nodes = [];
var edys =	[];



//Processing Files list
 	$.each(files, function(index, value) {

//Creating Files on diagram
nodes.push({
        id: files[index][0], label: 'Plik '+files[index][0]+'\n'+files[index][1]
    });


//Handling relations
$.each(files[index], function(index1, value1) {
	
	if(index1>1){
		edys.push({
      from: files[index][0], label: '3', arrows:"to", width:3, to:   files[index][index1]
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
       
        current["label"]='Odwołań: '+count;
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
           current["label"]='Odwołań: '+count;
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

  

  var network1 = new vis.Network(container, data, options);


</script> 
<script type="text/javascript" src="js/backlog.js"></script> 
<link rel="stylesheet" href="style.css">
</body>
</html>