<?php

$a = ['name'=>'tom'];
//$jsoncallback = $_GET['jsoncallback'];

$json = json_encode($a);
//echo $jsoncallback."($json)";
echo $json;
