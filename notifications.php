<?php 
	require_once "pdo.php";
	if(isset($_GET['email']))
	{
		$sql_get_id = "SELECT user_id FROM users WHERE email='$_GET[email]' " ;
		$stmt = $pdo->query($sql_get_id);
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$num_id = $row[0]['user_id'] ;
		
		$sql_get_req = "SELECT user_id , req_id FROM addreq WHERE friend_id = $num_id " ;
		$stmt_req = $pdo->query($sql_get_req);
		$row_req = $stmt_req->fetchAll(PDO::FETCH_ASSOC);

		$arr = array();
		foreach ($row_req as $id) {
			//print_r($id);
			$sql_get_id = "SELECT firstname , lastname FROM users WHERE user_id =$id[user_id] ";
			$stmt = $pdo->query($sql_get_id);
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

			//print_r($row);echo "<br>";
			array_push($arr,$row[0]['firstname']." ".$row[0]['lastname'] );
			//echo "<br>";
			//print_r($arr);echo "<br>";
		}
		
		//echo($arr[1]);
		//print_r($row_req);echo"<br>";
		echo '<table border ="1">'."\n" ;
		$i=0; 
		foreach ($arr as $req) {
			$val =$row_req[$i]['req_id'];
			echo "<tr><td>";
			echo ($req);
			echo ("</td><td>");
			echo ("<form method='post'>
						<input type='hidden' name='addaccept' value = $val>
						<input type='submit' name='submitaccept' value='Confirm'/>
					</form>
				");
			echo("</td><tr>\n");
			$i++;
		}
		echo '</table>';

	}

	if(isset($_POST['submitaccept']))
	{
		$sql_select_fried = "SELECT user_id,friend_id FROM addreq WHERE req_id = $_POST[addaccept]";
		$stmt = $pdo->query($sql_select_fried);
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		var_dump($row);
		//echo ("<br>");
		$usr1 = $row[0]['user_id'];
		$usr2 = $row[0]['friend_id'];
		
		//$row_friends = 
		$sql_insert_frind = "INSERT INTO friendship (user_id,friend_id) VALUES($usr1,$usr2)";
		$stmt_friend = $pdo->query($sql_insert_frind);
		//$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//replace the add request to friendship table 
		//and delete it from req table and deactivate the cinfirm button  
	}

 ?>

<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>