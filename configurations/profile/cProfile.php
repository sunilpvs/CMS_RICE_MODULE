<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/Generic.php");

if (! empty($_GET["action"])) 
{
    $action = $_GET["action"];
}
else
{
    $action = "default";
}
switch ($action) 
{        
    default:
    $pro = new Generic();
    $result = $pro->getUserProfile();
    require_once "../../configurations/profile/vProfile.php";
    break;
}
?>