<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CURL</title>
</head>
<body>
	<form action="size.php" method="POST">
		<input type="text" name="url" id="">
	</form>
</body>
</html>
<?php //phpinfo() ?>
<?php 
if (isset($_POST["url"]) && !empty($_POST["url"])) {
	$infos = getimagesize($_POST["url"]);
	echo $infos[0]." ".$infos[1];
}

 ?>