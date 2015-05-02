# rel2Abs
A simple php library which convert relative url paths to absolute paths written in url and as part of html.

# Usage

Import the library and declaire class.

require_once 'rel2Abs.php';
$rel = new rel2Abs();

This library has two methods, url() and html(). Each method receives two variables. Baseurl, relative path and baseurl, useragent(option).

$rel->url($baseurl, $relative_path);
$rel->html($baseurl, $user_agent(option));

#Example
echo $rel->url('http://1/2/3/','../test.txt');
echo $rel->html('https://github.com/');

#Test
echo $rel->url('http://1/2/3/','../test.txt');
echo $rel->url('http://1/2/3/','./test.txt');
echo $rel->url('http://1/2/3/','/test.txt');
echo $rel->url('http://1/2/3/','test.txt');
echo $rel->url('http://1/2/3/','//test.txt');

=>result
"http://1/2/test.txt"
"http://1/2/3/test.txt"
"http://1/2/3/test.txt"
"http://1/2/3/test.txt"
"http://test.txt"
