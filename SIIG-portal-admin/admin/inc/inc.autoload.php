<?php
function __autoload($class_name) 
{
    require_once '../inc/class.'.$class_name.'.php';
}
?>