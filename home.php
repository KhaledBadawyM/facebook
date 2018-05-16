<?php 
	require_once "pdo.php";
	if(isset($_POST['fideFriends']))
	{
		header("Location:findFriends.php?email=".urlencode($_GET['email']));
	}

	if(isset($_POST['notifications']))
	{
		header("Location:notifications.php?email=".urlencode($_GET['email']));

	}

	if(isset($_POST['friends']))
	{
		header("Location:friends.php?email=".urlencode($_GET['email']));
	}

	
 ?>

<html>
<head>
	<title>Home</title>
</head>
<body>
	<p>welcome</p>
	<form method="post">
		<input type="submit" name="fideFriends" value="Find Friends">
		<input type="submit" name="notifications" value="Notifications">
		<input type="submit" name="friends" value="Friends">
	</form>

	
</body>
</html>