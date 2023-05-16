<?php 
	//Important Stuff: Global variables, DB info, Functions, Session
	include_once('includes/important.php');
	
	//Default behavior
	$displayPageContent .= getProductsList($conn, $displayPageContent);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GHOST KILLERS - Products</title>
		<?php echo getCSS(); ?>
		<script defer src="js/script.js"></script>
	</head>
	<body>
		<?php 			
			echo '<div class="main">';

				echo pageHeader($logo, $pageTitle);
					echo '<div class="content">';
						echo $displayPageContent;
						echo $displayError;
					echo '</div>';
					
			echo '</div>';
		?>
		
	</body>
</html>