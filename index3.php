
<?php
/**
*
*   Historyjka 3
*
*   Jako architekt oprogramowania chcę zobaczyć graf relacji
*   między modułami logicznymi* w podanym kodzie źródłowym,
*   w celu analizy zależności w programie.
*
*
*
*   @author     Bartłomiej weceklicki <author@example.com>
*/




//require autoloader for classes
require_once('classes/autoloader.php');


//define vars
$functions  =   array();
$lista      =   array();
$backlog    =   '';
$mod_func   =   array();
$init       =   new Init();
$files_list =   $init->getFiles();
$files      =   new FilesList($files_list);


  
  // Sciezka do pliku
  foreach ($files_list as $key => $file) {
  
  array_push($lista,array(realpath($file)));

   
    }

  //Funkcja do wyciagania stringu pomiedzy
  
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

  $pos=strpos($line, 'namespace');

  if($pos!==false){
    $found=strtok(substr($line, $pos+9), ';');
    array_push($lista[$fk], $found);
    array_push($functions, $found);



    }

  }
  
 }


// Funkcje pomiedzy tekstami
function getContents($str, $startDelimiter, $endDelimiter) {
  $contents = array();
  $startDelimiterLength = strlen($startDelimiter);
  $endDelimiterLength = strlen($endDelimiter);
  $startFrom = $contentStart = $contentEnd = 0;
  while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
    $contentStart += $startDelimiterLength;
    $contentEnd = strpos($str, $endDelimiter, $contentStart);
    if (false === $contentEnd) {
      break;
    }
    $contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
    $startFrom = $contentEnd + $endDelimiterLength;
  }

  return $contents;
}





//Szukanie użytych funkcji w metodzie
 foreach ($lista as $fk=>$filek) {

  if(count($filek)>1)
    {
    //open file
    $content= file_get_contents($filek[0]);

        for($l=1;$l<count($filek);$l++)
          {
        
          $get= getBetween($content,$filek[$l],'namespace').'<br>';
          $mod_func[$filek[$l]]=getContents($get, 'function ', ' {');



        }
     }
  }


echo '
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
var files = <?php echo json_encode($mod_func); ?>;
var nodes = [];
var edys =  [];
var keys=Object.keys(files);


//Processing Files list
  $.each(keys, function(index, value) {

nodes.push({
        id:'metoda'+index, label: 'Metoda '+keys[index]+'\n\n'
    });


  $.each(files[keys[index]], function(index2, value2) {

nodes.push({
        id: value2, label: 'Funkcja '+value2+'\n'
    });



edys.push({
      from: 'metoda'+index, label: '3', arrows:"from", width:3, to:   value2
         });
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


  var network3 = new vis.Network(container, data, options);


</script> 

<link rel="stylesheet" href="style.css">

</body>
</html>