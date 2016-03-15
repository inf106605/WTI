<?php
include ('include/class.www.php');


global $www;


$source = $www -> CheckWord("chuj");

$hand = fopen("source.html" ,'w');
fwrite($hand, $source);
fclose($hand);










?>