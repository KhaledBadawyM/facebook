<?php 
	require_once "pdo.php";
	if(isset($_POST['fideFriends']))
	{
		header("Location:findFriends.php?email=".urlencode($_GET['email']));
	}
	
 ?>

<html>
<head>
	<title>Home</title>
</head>
<body>
	<p>welcom</p>
	<form method="post">
		<input type="submit" name="fideFriends" value="Find Friends">
	</form>
	
</body>
</html>