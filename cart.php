<?php 
	//Important Stuff: Global variables, DB info, Functions, Session
	include_once('includes/important.php');
	$total = 0;
	$numProducts = 0;
	
	//If post set for updating cart
	if (isset($_POST['update']))
	{
		/*
		Since unset is changing the sizeof value and $i could skip past a product id that should be removed
		each time the loop iterates, we can use the total number of products for the iteration count.
		This allows the function to remain dynamic.
		*/
		$numProducts = getNumProducts($conn, $numProducts);
		echo '<h1>'.$numProducts.'</h1>';
		for ($i = 0; $i < $numProducts; $i++)
		{
			if(isset($_SESSION['product-qty'][$i]))
			{
				$qtyID = 'qty-' .$i;
				$_SESSION['product-qty'][$i] = $_POST[$qtyID];
				if ($_SESSION['product-qty'][$i] == 0)
				{
					unset($_SESSION['product-id'][$i]);
					unset($_SESSION['product-name'][$i]);
					unset($_SESSION['product-qty'][$i]);
					unset($_SESSION['product-price'][$i]);
				}
			}
		}
		//Reset the array key indexes if items have been removed from cart
			$_SESSION['product-id'] = array_merge($_SESSION['product-id']);
			$_SESSION['product-name'] = array_merge($_SESSION['product-name']);
			$_SESSION['product-qty'] = array_merge($_SESSION['product-qty']);
			$_SESSION['product-price'] = array_merge($_SESSION['product-price']);
	}
	
	//Default behavior
	if(isGranted())
	{
		//If cart not empty
		if (isset($_SESSION['product-id']) && !empty($_SESSION['product-id']))
			{
				//Print cart
				$displayPageContent = '<form method="post" class="buy-form">';
				$displayPageContent .= '<p class="dude-header">Current Order List</p>';
				for ($i = 0; $i < sizeof($_SESSION['product-id']); $i++)
				{

					$pname = $_SESSION['product-name'][$i];
					$pprice = $_SESSION['product-price'][$i];
					$pqty = $_SESSION['product-qty'][$i];
					$cost = ($pprice * $pqty);
					$displayPageContent .= '<div class="product-cart">';
					
						$displayPageContent .= '<div class="product-buy-cart">';
							$displayPageContent .= '<p class="p-desc">Name:  '.$pname.' </p>';
						$displayPageContent.= '</div>';
					
						$displayPageContent.= '<div class="product-image-cart">';
							$displayPageContent .= '<p class="p-desc">Price:  $'.$pprice;
							$displayPageContent .= '<p class="p-desc">Qty:  ';
							$displayPageContent .= '<select id="qtySelect-'.$i.'" name="qty-'.$i.'" required class="select-cart">';
							$displayPageContent .= '<option value="0">0</option>';
							$displayPageContent .= '<option value="1">1</option>';
							$displayPageContent .= '<option value="2">2</option>';
							$displayPageContent .= '<option value="3">3</option>';
							$displayPageContent .= '<option value="4">4</option>';
							$displayPageContent .= '<option value="5">5</option>';
							$displayPageContent .= '<option value="6">6</option>';
							$displayPageContent .= '<option value="7">7</option>';
							$displayPageContent .= '<option value="8">8</option>';
							$displayPageContent .= '<script>document.getElementById("qtySelect-'.$i.'").selectedIndex='.$pqty.';</script>';
							$displayPageContent .= '</select></p>';
							$displayPageContent .= '<p class="p-desc-red">Total:  $'.$cost;
							$displayPageContent .= '</p>';
						$displayPageContent .= '</div>';
				$displayPageContent .= '</div>';
					$total += ($cost);
				}
				$displayPageContent.= '<div class="product-cart">';
					$displayPageContent.= '<div class="product-buy-cart">';
						$displayPageContent .= '<p class="p-price-total">GRAND TOTAL: $'.$total.'</p>';
						$displayPageContent .= '<input type="submit" class="buy-btn-cart" name="update" value="Update Cart">';
						$displayPageContent .= '<input type="submit" class="buy-btn-cart" name="order" value="Place Order">';
						$displayPageContent .= '</form>';
					$displayPageContent .= '</div>';
				$displayPageContent .= '</div>';
			}
			
		//If cart not set or empty
		else if (!isset($_SESSION['product-id']) || empty($_SESSION['product-id']))
		{
			$displayPageContent .= '<h3 class="warning">Your cart is empty!</h3>';
		}
	}
	
	//If order placed
	if (isset($_POST['order']))
	{
				$displayPageContent = '<div class="receipt">';
					$displayPageContent.= '<p class="p-desc">Thank you for your order!</p><BR>';
					$displayPageContent.= '<p class="p-desc">RECEIPT</p>';
					$randMin = 100000;
					$randMax = 900000;
					$randNum = rand($randMin, $randMax);
					$displayPageContent.= '<p class="p-receipt">Name: '.$_SESSION['name'].'</p>';	
					$displayPageContent.= '<p class="p-receipt">Order Number: '.$randNum.'</p><br>';
					for ($i = 0; $i < sizeof($_SESSION['product-id']); $i++)
					{

						$pname = $_SESSION['product-name'][$i];
						$pprice = $_SESSION['product-price'][$i];
						$pqty = $_SESSION['product-qty'][$i];
						$cost = ($pprice * $pqty);
						
						$displayPageContent.= '<p class="p-receipt-i">ITEM:  '.$pname.'</p>';	
						$displayPageContent.= '<p class="p-receipt-i">PRICE:  $'.$pprice;	
						$displayPageContent.= '  ('.$pqty.')';	
						$displayPageContent.= '<p class="p-receipt-t">TOTAL:  $'.$cost.'</p></p><br>';				
				}
				$displayPageContent.= '<p class="p-desc-red">Subtotal: $'.$total.'</p>';
				$randMin = 9;
				$randMax = 49;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">Shipping: $'.$fee.'.95</p>';
				$total += $fee;
				$randMin = 49;
				$randMax = 99;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">Expedited Holiday Shipping: $'.$fee.'.95</p>';
				$total += $fee;
				$randMin = 9;
				$randMax = 29;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">Processing Fee: $'.$fee.'.95</p>';
				$total += $fee;
				$randMin = 4;
				$randMax = 9;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">Packing Fee: $'.$fee.'.95</p>';
				$total += $fee;
				$randMin = 9;
				$randMax = 14;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">After-hours Fee: $'.$fee.'.95</p>';
				$total += $fee;
				$randMin = 4;
				$randMax = 9;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">"Fee" Fee: $'.$fee.'.95</p>';
				$total += $fee;
				$randMin = 19;
				$randMax = 19;
				$fee = rand($randMin, $randMax);
				$displayPageContent.= '<p class="p-receipt-t">Recurring Pizza Bros Subscription: $'.$fee.'.95</p><br>';
				$total += $fee;
				$displayPageContent .= '<p class="p-price">TOTAL BILLED:  $'.$total.'</p>';
				$displayPageContent .= '<p class="p-desc">Thank you for your business.</p>';
				$displayPageContent .= '<p class="p-desc">Have a nice day!</p>';
				$numProducts = getNumProducts($conn, $numProducts);
				for ($i = 0; $i < $numProducts; $i++)
				{
					unset($_SESSION['product-id'][$i]);
					unset($_SESSION['product-name'][$i]);
					unset($_SESSION['product-qty'][$i]);
					unset($_SESSION['product-price'][$i]);
				}		
	}
	//Not logged in
	else if(!isGranted()) header('location: logout.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GHOST KILLERS - Shopping Cart</title>
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