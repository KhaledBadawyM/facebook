<?php 
	require_once "pdo.php";
	//echo ("you need to signup");
	if(isset($_POST['firstName'])
		&&isset($_POST['lastName'])
		&&isset($_POST['email'])
		&&isset($_POST['password'])
		&&isset($_POST['birthday'])

		)
	{
		$sql = "INSERT INTO users (firstname,lastname,birthday,password,email,gender) VALUES (:FN,:LN,:BD,:PW,:EM,:gd)";
		
		$stmt = $pdo->prepare($sql);
		
		$stmt->execute(array(
        ':FN' => $_POST['firstName'],
        ':LN' => $_POST['lastName'],
        ':BD' => $_POST['birthday'],
        ':PW' => $_POST['password'],
        ':EM' => $_POST['email'],
        ':gd' => $_POST['gender']
        ));	
        header("Location:home.php?email=".urlencode($_POST['login_email']));
	}

	elseif (isset($_POST['login_email'])&& isset($_POST['login_password'])) {
		$sql = "SELECT * FROM users where email = :em AND password = :pw ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
		':em' =>$_POST['login_email'],
		':pw' =>$_POST['login_password']
		));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($row === FALSE)
			echo("login incorrect");
		else
			header("Location:home.php?email=".urlencode($_POST['login_email']));

	}

	//else echo ("input is not correct");
?>

<html>
<head>
	<title>signup</title>
</head>
<body>
	<form method="post">
		<input type="email" name="login_email" placeholder="Email" required>
		<input type="password" name="login_password" placeholder="password" required>
		<input type="submit" value="Log In">
	</form>
	<p>Singn Up </p>
	<form method="post">
		<input type="text" name="firstName" size="40" placeholder="First name" required>
		<input type="text" name="lastName" size="40" placeholder="Last name" required><br>

		<input type="email" name="email" placeholder="Email" required><br>

		<input type="password" name="password" placeholder="New password" required><br>
 		<div>
			<input type="radio" name="gender" value="male" checked>Male<br>
			<input type="radio" name="gender" value="female" >Female<br>
		</div>
		<input type="date" name="birthday" placeholder="Birthday" required> <br>
		<input type="submit" value="Sign Up">
	</form>
</body>
</html>