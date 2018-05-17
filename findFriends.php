<?php
	require_once "pdo.php";
	if(isset($_GET['email'])){
		$sql = "SELECT firstname ,lastname ,email FROM users";
		$stmt = $pdo->query($sql);
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		echo '<table border="1">'."\n";
		foreach ($rows as $row) {
			if($row['email']==$_GET['email'])continue ;
			echo "<tr><td>";
			echo ($row['firstname']);
			echo ("</td<td>  ");
			echo ($row['lastname']);
			echo ("</td><td>");
			echo ("<form method='post'>
						<input type='hidden' name='friendEmail' value ='$row[email]' />
						<input type='submit' name='addReq' value='Add Friend'/>
					</form>
				");
			echo("</td><tr>\n");
		}


	}

	if(isset($_POST['friendEmail']) ) {
		echo("Request sent");
		$sql_addreq = "SELECT user_id FROM users WHERE email IN (:first, :second) ORDER BY FIELD(email ,:first,:second)" ;

		$stmt = $pdo->prepare($sql_addreq);
		$stmt->execute(array(
			':first'=>$_GET['email'],
			':second'=>$_POST['friendEmail']
		));
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if($row)
		{
			$sql_addreq_insert = "INSERT INTO addreq (user_id,friend_id) VALUES (:id1,:id2)";
			$stmt = $pdo->prepare($sql_addreq_insert);
		    $stmt->execute(array(
			':id1'=>$row[0]['user_id'],
			':id2'=>$row[1]['user_id']
		));
		}

		
		//echo $_GET['email'].'<br>';
		//var_dump($_POST);echo"\n";
		//print_r ($_POST) ;echo'<br/>';
		//echo ':'.$_POST['friendEmail'].':<br />';
	
	}
		

?>


<html>
<head>
	<title>
		
	</title>
</head>
<body>

</body>
</html>