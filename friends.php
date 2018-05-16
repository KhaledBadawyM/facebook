<<?php 
	require_once "pdo.php";
	if(isset($_GET['email']))
	{
		$sql = "SELECT user_id FROM users WHERE email = $_GET[email] ";
		$stmt = $pdo->query($sql);
		$row_get_id = $stmt->fetch(PDO::FETCH_ASSOC);

		var_dump($row_get_id);

	}
 ?>

<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>