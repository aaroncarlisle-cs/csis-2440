<?php 
	//Important Stuff: Global variables, DB info, Functions, Session
	include_once('includes/important.php');
	$notDupe = false;
	
	//Default behavior
	$displayPageContent = '<p><form method ="post" action="create-account.php" class="create">';
	$displayPageContent .= '<input id="username" name="user" placeholder="Username" value="" type ="text">';
	$displayPageContent .= '<input id="password" name="pass1" placeholder="Password" type ="password">';
	$displayPageContent .= '<input id="password2" name="pass2" placeholder="Retype Password" type ="password">';
	$displayPageContent .= '<input id="reset" type="reset">';
	$displayPageContent .= '<input id="submit" name="submit" type="submit" value="Create Account" disabled>';
	$displayPageContent .= '</form></p>';
	$displayPageContent .= '<p class="regex" id="userBlank"></p>';
	$displayPageContent .= '<p class="regex" id="pass8"></p>';
	$displayPageContent .= '<p class="regex" id="passNum"></p>';
	$displayPageContent .= '<p class="regex" id="passMatch"></p>';
	$displayPageContent .= '<script src="js/create-account.js"></script>';
	
	//Form submitted
	if (isset($_POST['submit']))
	{
		$displayError = dupeChecker($conn, $displayError);
		if(empty($displayError)) $displayError = acceptUser($conn, $displayError); 
	}
	
	//Create account success
	if (isset($_POST['newUser']) && $_POST['newUser'] == true)
	{
		$displayPageContent = '';
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GHOST KILLERS - Create Account</title>
		<?php echo getCSS(); ?>
		<script defer src="js/script.js"></script>
	</head>
	<body>
		<?php 			
			echo '<div class="main">';

				echo pageHeader($logo, $pageTitle);
					echo '<div class="content">';
						echo $displayError;
						echo $displayPageContent;
					echo '</div>';

					
			echo '</div>';
		?>
	</body>
</html>