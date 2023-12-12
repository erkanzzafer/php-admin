<?php
session_start();
ob_start();
//db class
include_once("data/class.php");
$adminclass=new AdminClass;