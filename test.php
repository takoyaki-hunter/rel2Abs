<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>
<body>
<?php

require_once 'rel2Abs.php';
$rel = new rel2Abs();
//echo $rel->html('https://github.com/');
echo $rel->url('http://1/2/3/','../test.txt');
echo $rel->url('http://1/2/3/','../../test.txt');
echo $rel->url('http://1/2/3/','./test.txt');
echo $rel->url('http://1/2/3/','/test.txt');
echo $rel->url('http://1/2/3/','test.txt');
echo $rel->url('http://1/2/3/','//test.txt');

?>
</body>
</html>
