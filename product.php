<?php 
	//Important Stuff: Global variables, DB info, Functions, Session
	include_once('includes/important.php');
	
	
	//Default behavior
	$displayPageContent = '';
	if (isset($_GET['id']) && !empty($_GET['id']))
	{
		$id = $_GET['id'];
		$displayPageContent = getProduct($id, $conn, $displayPageContent);
	}
	
	if (!isset($_GET['id']) || empty($_GET['id'])) header('location: catalog.php');
	
	//Add to cart
	if (isset($_POST['add-to-cart']))
	{
		if(isGranted())
		{
			$id = $_POST['id'];
			//Get product info
			$price = getProductPrice($id, $conn, $price);
			$name = getProductName($id, $conn, $name);
			$img = getProductImage($id, $conn, $img);
			$desc = getProductDesc($id, $conn, $desc);
			//If cart not setup
			if (!isset($_SESSION['product-id']))
				{
					$_SESSION['product-id'] = array();
					$_SESSION['product-name'] = array();
					$_SESSION['product-qty'] = array();
					$_SESSION['product-price'] = array();
				}
			//Check if item already in cart
			$dupe = false;
			for ($i = 0; $i < sizeof($_SESSION['product-id']); $i++)
			{
				if ($_SESSION['product-id'][$i] == $id)
				{
					$dupe = true;
					$_SESSION['product-qty'][$i] = $_POST['qty'];
				}
			}
			//If item not already in cart
			if (!$dupe)
			{
				array_push($_SESSION['product-id'],$_POST['id']);
				array_push($_SESSION['product-name'],$name);
				array_push($_SESSION['product-qty'],$_POST['qty']);
				array_push($_SESSION['product-price'],$price);
			}
			$displayError .= '<h3 class="granted">Your shopping cart has been updated!</h3>';
		}
		else
		{
			$displayError = "<h3 class='warning'>Please <a href='.'>log in</a> to add items to your Shopping Cart</h3>";
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>TITLE GOES HERE</title>
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
							echo $displayPageContent;
						echo '</div>';
					echo '</div>';

					
			echo '</div>';
		?>
		
	</body>
</html>