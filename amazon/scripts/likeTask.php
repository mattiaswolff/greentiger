<?php
/*------------------------------------------------------------------------------
** File:        polyExample.php
** Description: Demo's the capability of the polygon class. 
** Version:     1.6
** Author:      Brenor Brophy
** Email:       brenor dot brophy at gmail dot com
** Homepage:    www.brenorbrophy.com 

$results = $task -> getTask("test");

foreach($results as $result)
{
    echo sprintf("Fruit: %s, Type: %s%s", $result['type'], $result['allan'], PHP_EOL);
}

echo $task -> user;
echo $task -> type;
echo "hello world";


*/
require '../classes/task.php';
session_start();
task::likeTask($_GET['id'], $_SESSION['email']);
header ('location: ../inbox.php');
?>
