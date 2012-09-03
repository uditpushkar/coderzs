<?php
$sortby = $_SERVER['QUERY_STRING'];

$set = '';
if ($sortby == '') {
	$header = 'First Name';
	$sortby = 'firstname';
	$set = 'y';
}
if ($sortby == 'surname') {
	$header = 'Surname';
	$set = 'y';
}
if ($sortby == 'city') {
	$header = 'City';
	$set = 'y';
}
if ($sortby == 'points') {
	$header = 'Points';
	$set = 'y';
}
if ($sortby == 'car') {
	$header = 'Car';
	$set = 'y';
}
if ($sortby == 'colour') {
	$header = 'Colour';
	$set = 'y';
}
if ($sortby == 'age') {
	$header = 'Age';
	$set = 'y';
}
if ($set == '') {
	echo 'The variable at the end of the web address did not match one required by the code. Please check the web address for errors.';
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<title>Flat File Database Demo 2</title>

<style type="text/css">
<!--
body, th, td, p, small {
	font-family:'Times New Roman',Times,serif;
	font-size:100%;
	color:#444;
}
small {font-size:90%;}
table {
	border:1px solid #ccf;
	padding:3px;
}
td, th {
	background-color:#def;
	padding:7px 20px 7px 20px;
}
th {background-color:#dee; color:#677;}

h1 {font-size:120%; color:#558;}
h1 .sortby {color:#855;}
-->
</style>

</head>

<body>

<?php
echo '<h1>Flat File Database Sorted By <span class="sortby">'.$header.'</span></h1>

<p>To sort the columns click on the headers.</p>

<p>View the <a href="test.txt">database</a> or the <a href="test.txt">PHP code</a> used.
<br />&nbsp;</p>

<table summary="List of demo fields">
<tr>
<th><a href="?">First Name</a></th>
<th><a href="?surname">Surname</a></th>
<th><a href="?city">City</a></th>
<th><a href="?points">Points</a></th>
<th><a href="?car">Car</a></th>
<th><a href="?colour">Colour</a></th>
<th><a href="?age">Age</a></th>
</tr>';

$fp = fopen('test.txt','r');
if (!$fp) {echo 'ERROR: Unable to open file.</table></body></html>'; exit;}

$row = 0;

while (!feof($fp)) {
	$row++;
	$line = fgets($fp,1024); //use 2048 if very long lines
	$field[$row] = explode('|', $line);
	if ($sortby == 'firstname') {$sortkey = strtolower($field[$row][0]);} //firstname
	if ($sortby == 'surname') {$sortkey = strtolower($field[$row][1]);} //surname
	if ($sortby == 'city') {$sortkey = strtolower($field[$row][2]);} //city
	if ($sortby == 'points') {$sortkey = $field[$row][3];} //points
	if ($sortby == 'car') {$sortkey = strtolower($field[$row][4]);} //car
	if ($sortby == 'colour') {$sortkey = strtolower($field[$row][5]);} //colour
	if ($sortby == 'age') {$sortkey = $field[$row][6];} //age
	array_unshift($field[$row], $sortkey); //add sortkey to start of array
}

fclose($fp);

sort($field);
reset($field);

$arrays = count($field) - 1;

$loop = -1;
while ($loop < $arrays) {
	$loop++;
	echo '
<tr>
<td>'.$field[$loop][1].'</td>
<td>'.$field[$loop][2].'</td>
<td>'.$field[$loop][3].'</td>
<td>'.$field[$loop][4].'</td>
<td>'.$field[$loop][5].'</td>
<td>'.$field[$loop][6].'</td>
<td>'.$field[$loop][7].'</td>
</tr>';
}

echo '
</table>

<p><small>1 December 2004 &middot; Last updated: '.date('j F Y', getlastmod()); ?> &middot; A <a href="http://www.designdetector.com">Design Detector</a> production &middot; <a href="http://www.designdetector.com/archives/04/12/FlatFileDatabaseDemo2.php">About The Demo</a> &middot; <a href="http://www.designdetector.com/archives/04/12/FlatFileDatabaseDemo2.php#comments">Comments</a></small></p>

</body>
</html>
