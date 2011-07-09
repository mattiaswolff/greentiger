<?php
/*------------------------------------------------------------------------------
** File:        commentTaskScript.php
** Description: Demo's the capability of the polygon class. 
** Version:     1.6
** Author:      Brenor Brophy
** Email:       brenor dot brophy at gmail dot com
** Homepage:    www.brenorbrophy.com 
*/
require '../classes/task.php';
session_start();
task::commentTask($_GET['id'], $_SESSION['email'], "Blogpost");
header ('location: ../inbox.php');
?>
