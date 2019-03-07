<?php

include("head.txt");

$raw_data = file_get_contents("wiki-raw.txt");
$creole_data = $raw_data;
if(isset($_GET['p'])){
	$raw_data = $_GET['p'];
	$creole_data = htmlentities($raw_data);
	file_put_contents("wiki-raw.txt",$creole_data);
	$cmd_output = shell_exec("cat wiki-raw.txt|./creoledump --naked");
	file_put_contents("wiki-html.txt",$cmd_output);
}
$creole_data = file_get_contents("wiki-raw.txt");
$wikified = file_get_contents("wiki-html.txt");
echo html_entity_decode($wikified);
?>
<form action="wiki.php" method="get">
	<textarea style="width: 98%" name="p" rows="40"><?php echo $creole_data; ?></textarea>
	<br/>
	<input type="submit" value="Submit"></input>
</form>
<?php

include("foot.txt");

?>
