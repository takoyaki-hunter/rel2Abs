# rel2Abs
Php library convert relative url paths to absolute paths written as url and part of html.

# Usage

Import the library and declaire class.

    require_once 'rel2Abs.php';
    $rel = new rel2Abs();

This library has two methods, url() and html(). Each method receives two variables and returns strings.

    $rel->url($baseurl, $relative_path);
    $rel->html($baseurl, $user_agent(option));

#Example
Notice: method url() returns quote added strings. When echoed html strings method html() returned, the html page called and displayed.

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
