<?php

	//Important Stuff: Global variables, DB info, Functions, Session
	include_once('includes/important.php');
	//Create account redirect
	if (isset($_POST['create'])) {$_POST = array(); header('location: create-account.php');}
	//Logout redirect
	if (isset($_POST['logout'])) {$_POST = array(); header('location: logout.php');}
	//Data persistence and password instruction
	if (!isset($_POST['user'])) {$userError = "Username"; $userErrorFocus = "";} else {$userError = $_POST['user']; $userErrorFocus = $_POST['user'];}
	if (!isset($_POST['pass'])) $passError = "Password"; else $passError = "Retype Password";		
	//Code to run after user logs in.
	if (isset($_POST['submit']))
	{
		$userLogin = $_POST['user'];
		$userPass = $_POST['pass'];
		$userPass = sickHashBro($userLogin, $userPass);
		$results = mysqli_query($conn, $sql);
		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
		{
			if ($userLogin === $row['username'] && $userPass === $row['password'])
			{
				$_SESSION['granted'] = true;
				$_SESSION['name'] = $row['username'];
			}
			if(!isGranted()) $displayError = '<br><h3 class="warning">Invalid Login. Please try again.</h3>';
			if(!isGranted()) $displayError .= '<script>setFieldText();</script>';
		}
	}
	
	//Default behavior
	$displayPageContent = '<div class="center">';
	$displayPageContent .= '<form method="post" action=".">';
	$displayPageContent .= '<p class="desc-center">Please login to access the store</p>';
	$displayPageContent .= '<p><input type="text" name="user" id="user" onfocus="this.value=';
	$displayPageContent .= "'".$userErrorFocus."'\"";
	$displayPageContent .= ' value="'.$userError.'"></p>';
	$displayPageContent .= '<p><input type="text" name="pass" id="pass" onfocus="setFieldPass();this.value=';
	$displayPageContent .= "''\"";
	$displayPageContent .= ' value="'.$passError.'"></p>';
	$displayPageContent .= "<p><input type=\"submit\" name=\"submit\" value=\"LOG IN\"></p>";
	$displayPageContent .= "<p><input type=\"reset\" name=\"reset\" value=\"RESET\" onclick=\"setFieldText()\"></p>";
	$displayPageContent .= "<p class='desc-center'>DON'T HAVE AN ACCOUNT?</p>";
	$displayPageContent .= "<p><input type=\"submit\" name=\"create\" class=\"create\" value=\"CREATE ACCOUNT\"></p>";
	$displayPageContent .= '</form><BR>';
	$displayPageContent .= '</div>';
	
	//Logged in
	if(isGranted())
		{
			$loginMsg = '<p class="desc-center">Welcome back '.$_SESSION['name'].'! </p><p class="desc-center">Feel free to have a look around.</p>';
			$displayPageContent = '';
			$displayError = '<p><h3 class="granted">Access granted</h3></p>';
		}
		
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GHOST KILLERS - Log In</title>
		<?php echo getCSS(); ?>
		<script defer src="js/script.js"></script>
	</head>
	<body>
		<?php 
			echo '<div class="main">';

				echo pageHeader($logo, $pageTitle);
					echo '<div class="content">';
						echo '<div class="center">';
							echo $displayError;
						echo '</div>';
						echo getWelcome($loginMsg);
						echo '<div class="center">';
							echo $displayPageContent;
						echo '</div>';
					echo '</div>';

					
			echo '</div>';
		?>
		
	</body>
</html>