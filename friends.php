<?php 
	require_once "pdo.php";
	if(isset($_GET['email']))
	{
		$sql_get_id = "SELECT user_id FROM users WHERE email='$_GET[email]' " ;
		$stmt = $pdo->query($sql_get_id);
		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$user_id_req = $row[0]['user_id'];

		$sql_get_id1 = "SELECT user_id FROM friendship WHERE friend_id = $user_id_req " ;
		$sql_get_id2 = "SELECT friend_id FROM friendship WHERE user_id = $user_id_req " ;
		$stmt1 = $pdo->query($sql_get_id1);
		$stmt2 = $pdo->query($sql_get_id2);
		$row1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
		$row2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		
		//print_r($row1);echo"<br>";
		//print_r($row2);echo"<br>";

		$merged_array = array_merge($row1,$row2);

		//print_r($merged_array);
		$i=0 ;$arr = array();$friend_id_array=array() ; 
		while ($fruit_name = current($merged_array)) {
		    $keyname = key($merged_array[$i]).'<br />';
		    //echo $keyname."<br>";
		    $user_id_=$merged_array[$i][key($merged_array[$i])];
		    //echo $user_id_."<br>";
		    array_push($friend_id_array,$user_id_);

		    $sql_get_name = "SELECT firstname , lastname FROM users WHERE user_id =$user_id_";
			$stmt = $pdo->query($sql_get_name);
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			array_push($arr,$row[0]['firstname']." ".$row[0]['lastname'] );
//print_r($row);
		    $i++;
		    next($merged_array);

		   // echo $merged_array[2]['friend_id'];
		}

		//print_r ($user_id_arry);
		echo '<table border ="1">'."\n" ;
		$j=0; 
		foreach ($arr as $friend) {
			$friend_id = $friend_id_array[$j]; 
			echo "<tr><td>";
			echo ($friend);
			echo ("</td><td>");
			echo ("<form method='post'>
						<input type='hidden' name='massage' value ='$friend_id'>
						<input type='submit' name='submitaccept' value='Send Massage'/>
					</form>
				");
			echo("</td><tr>\n");
			$j++;
		}
		echo '</table>';



		//var_dump($row);
		//echo $user_id ;
	}

	if(isset($_POST['massage']))
	{
		$get_req = array(
			'email'=>$_GET['email'],
			'friend_id'=>$_POST['massage']
		);
		header("Location:massage.php?email=$_GET[email]&friend_id=$_POST[massage]");
		
	}
 ?>

<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>