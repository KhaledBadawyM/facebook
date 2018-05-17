<?php 
	require_once "pdo.php";
	if(isset($_GET['email']))
	{
		$sql1 = "SELECT user_id FROM users WHERE email='$_GET[email]'";
		$stmt1 = $pdo->query($sql1);
		$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		$usr_id = $row1[0]['user_id'] ;

		$sql2 = "SELECT sender_id,m_body FROM massage WHERE reciver_id = $usr_id ";
		$stmt2 = $pdo->query($sql2);
		$rv = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		
		
		

		echo '<table border ="1">'."\n" ;
		//$j=0; 
		foreach ($rv as $row) {
			//$friend_id = $friend_id_array[$j]; 
			$sql_get_id = "SELECT firstname , lastname FROM users WHERE user_id =$row[sender_id] ";
			$stmt = $pdo->query($sql_get_id);
			$FLname = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//print_r($FLname);
			echo "<tr><td>";
			echo ($FLname[0]['firstname']." ".$FLname[0]['lastname']);
			echo ("</td><td>");
			echo ($row['m_body']);
			echo("</td><tr>\n");
		
		}
		echo '</table>';




	}

 ?>