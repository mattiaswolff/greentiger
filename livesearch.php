<?php
require ($_SERVER["DOCUMENT_ROOT"]."/scripts/connectMongoDb.php");
$x = $db->tasks->find(array("definition" => new MongoId($_GET["definitionId"])));
//get the q parameter from URL
$q = $_GET["q"];
//lookup all links from the xml file if length of q>0
if (strlen($q)>0){
	$hint="";
	foreach($x as $value) {
		foreach($value['keywords'] as $value1) {
			if (stristr($value1,$q)){
				if ($hint==""){
					$hint= "<p>" . $value1. "</p>";
				}
				else{
					$hint=$hint . "<p>" . $value1. "</p>";
				}
			}
		}
	}
}
// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint==""){
	$response="no suggestion";
	}
else{
  $response=$hint;
  }
//output the response
echo $response;
?>
