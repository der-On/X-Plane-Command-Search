<?php
global $commands;
$commands = [];
/*global $types;
$types = [''];
global $writables;
$writables = [''];
global $units;
$units = [''];
global $version;
*/
global $time;

function parse()
{
	/*global $version;
	global $time;
	global $types;
	global $units;*/
	$t_start = microtime(true);
	$txt = file_get_contents('Commands.txt');
	$lines = explode("\n",$txt);
	//$v = preg_split("/\s+/",$lines[0]);
	//$version = 'Commands for X-Plane '.$v[1].', compiled '.$v[2].' '.$v[3].' '.$v[4].' '.$v[5].' '.$v[6];
	for($i=1; $i<count($lines);$i++) {
		parseLine($lines[$i]);
	}
	$time = round((microtime(true)-$t_start)*1000)/1000;
}
function parseLine($line)
{
	global $commands;
	/*global $types;
	global $writables;
	global $units;*/
	if($line!='') {
		$parts = preg_split("/\s+/",$line,2);
		for($i=0;$i<2;$i++) {
			if (!isset($parts[$i])) {
				$parts[] = '';
			} else $parts[$i] = trim($parts[$i]);
		}

		$command = ['name'=>$parts[0],'description'=>utf8_decode($parts[1])];

		if (checkMatch($command)) {
			$commands[] = $command;
		}

	}
}
function fillSelect($arr,$current = '')
{
	$o = '';
	foreach($arr as &$v) {
		if (!empty($current) && $current==$v) $selected = ' selected="selected"'; else $selected = '';
		$o.='<option value="'.$v.'"'.$selected.'>'.$v.'</option>';
	}
	return $o;
}
function fillTable()
{
	global $commands;
	$o = '';
	foreach($commands as $key=>&$d) {
		if ($key%2==1) $class = ' class="even"'; else $class = '';
		$o.='<tr'.($class).'><td class="copy"><input id="copy-'.$key.'" name="copy" type="radio" value="'.$d['name'].'"/></td><td class="name"><label for="copy-'.$key.'"><a href="javascript:void(0);">'.$d['name'].'</a></label></td><td class="description">'.$d['description'].'</td></tr>';
	}
	return $o;
}
function checkMatch(&$command)
{
	$name = (isset($_GET['name']))?strtolower(trim($_GET['name'])):NULL;
	$description = (isset($_GET['description']))?strtolower(trim($_GET['description'])):NULL;
	$match = true;

	if (!empty($name) && strpos(strtolower($command['name']),$name)===false) $match = false;
	if (!empty($description) && strpos(strtolower($command['description']),$description)===false) $match = false;
	return $match;
}
