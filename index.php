<?php
session_start();

require "config/database.php";

$route = null;

if(isset($_GET["route"]))
{
    $route = $_GET["route"];
}

require "layout.phtml";