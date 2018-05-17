<?php 
	require_once "pdo.php";
	if(isset($_POST['submitmassage']))
	{
		$sql1 = "SELECT user_id FROM users WHERE email='$_GET[email]'";
		$stmt1 = $pdo->query($sql1);
		$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		$usr_id = $row1[0]['user_id'] ;
		//echo $usr_id;
		$sql = "INSERT INTO massage (sender_id,reciver_id,m_body) VALUES ($usr_id,$_GET[friend_id],'$_POST[mg]')";
		$stmt = $pdo->query($sql);
		echo"Massage send";
	}


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	<form method="POST">
 		<textarea name="mg" rows="7" cols="100"></textarea><br>
 		<input type="submit" name="submitmassage" value="Send">
 	</form>
 </body>
 </html>