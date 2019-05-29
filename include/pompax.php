<?php
	include('bdd.php');
	
	if($_GET['pompaxcode'] == $pompaxEmail.'-'.$pompaxMdp){
?>
<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - Antivol pompax</title>
		<meta charset = "utf-8">
		<link rel = "stylesheet" href = "design.css">
		<script type = "text/javascript" src = "../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
	</head>
	<body>
		test
	</body>
</html> 
<?php
	}
	else{
		header('location:'.$domain);
	}
?>
