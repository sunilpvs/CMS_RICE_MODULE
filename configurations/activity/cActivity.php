<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] ."/includes/DBController.php");
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
            $gen = new Generic();
            $result = $gen->getActivityLog();
            require_once "../../configurations/activity/vActivity.php";
            break;
    }
?>