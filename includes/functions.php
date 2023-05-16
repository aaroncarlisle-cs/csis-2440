<?php
		//User logged in
		function isGranted()
		{
			if(isset($_SESSION['granted'])) return true;
			return false;
		}
		
		//Create account duplicate username checker
		function dupeChecker($conn, $e)
		{
			$duplicate = false;
			$sql = 'SELECT * FROM users;';
			$results = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
				{
					if ($_POST['user'] == $row['username']) $duplicate = true;
				}
			if (!$duplicate) 
			{
				$e = ''; 
				return $e; 
			}
			else 
			{
				$e = '<br><h3 class="warning">Username unavailable!</h3>';
				$e .= '<br><h3 class="warning">Pick a different username.</h3>';
				mysqli_close($conn);
				return $e;
			}
		}
		
		//Create account add new user
		function acceptUser($conn, $e)
		{
			//Hash password.
			$username = $_POST['user'];
			$password = $_POST['pass1'];
			//Hash password using $username and $password as parameters.
			$password = sickHashBro($username, $password);
			$sql = 'USE users;';
			mysqli_query($conn, $sql);
			//Escape characters for username string to prevent injection.
			$username = mysqli_real_escape_string($conn, $username);
			//Create account
			$ins = 'INSERT INTO users (username, password) VALUES ("'.$username.'", "'.$password.'");';
			mysqli_query($conn, $ins);
			$_POST['newUser'] = true;
			mysqli_close($conn);
			$e = '<br><h3 class="granted">User account has been created!</h3>';
			$e .= '<br><h3 class="granted">You may now Log In!</h3>';
			return $e;
		}
		
		function sickHashBro($user, $pass)
		{
			//DO NOT CHANGE THIS FUNCTION
			$su1 = 'asdflkjnasdfasdgahahasdhhsdaaasdfaoiasdsdafsdf';
			$su2 = 'lasikdfnobasdfasfddsafaskldfjaskldfjklinoizffe';
				
			$user = $su1.$user.$su2;
			$userDouble = $su1.$user.$user.$su2;
				
			$salt1 = hash('sha512', $user);
			$salt2 = hash('sha512', $userDouble);
				
			$pass = $salt1.$pass.$salt2;
			$pass = hash('sha512', $pass);
			return $pass;
		}
		
		//Populate products page from DB
		function getProductsList($conn, $m)
		{
			$sql = 'select * from product;';
			$results = mysqli_query($conn, $sql);
			$m.= '<p class="dude-header">Featured Products <br>used by the GHOST KILLERS team!</p>';
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$id = $rows['id'];
				$name = $rows['name'];
				$desc = $rows['description'];
				$img = $rows['image'];
				$price = $rows['price'];
				$randMin = 2000;
				$randMax = 25000;
				$randNum = rand($randMin, $randMax);
				$m .= '<div class="product">';
					$m .= '<div class="product-image">';
						$m .= '<img src="img/'.$img.'" class="thumbnail";>';
					$m .= '</div>';
					$m .= '<div class="product-desc">';
						$m .= '<p class="p-price">$'.$price.'</p>';
						$m .= '<p class="p-desc">'.$name.'</p>';
						$m .= '<img src="img/stars.png" class="p-stars">';
						$m .= '<p class="rand">('.$randNum.')</p>';
						$m .= "";//fake reviews
						$m .= '<p class="p-link"><a href="product.php?id='.$id.'" class="link">Details...</a></p>';
					$m .= '</div>';
				$m .= '</div>';
			}
			return $m;
		}
		
		//Get product info for product page based on GET id 
		function getProduct($id, $conn, $m)
		{
			$sql = 'select * from product where id ='.$id.';';
			$results = mysqli_query($conn, $sql);
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$id = $rows['id'];
				$name = $rows['name'];
				$desc = $rows['description'];
				$img = $rows['image'];
				$price = $rows['price'];
				$randMin = 2000;
				$randMax = 25000;
				$randNum = rand($randMin, $randMax);
				$m .= '<div class="product">';

					$m .= '<div class="product-image">';
						$m .= '<img src="img/'.$img.'" class="thumbnail";>';
					$m .= '</div>';
					$m .= '<div class="product-desc">';
						$m .= '<p class="p-price">$'.$price.'</p>';
						$m .= '<p class="p-desc">'.$name.'</p>';
						$m .= '<img src="img/stars.png" class="p-stars">';
						$m .= '<p class="rand">('.$randNum.')</p>';
						$m .= "";//fake reviews
						$m .= '<p class="i-desc">'.$desc.'</p>';
					$m .= '</div>';
					$m .= '<div class="product-buy">';
						$m .= '<form method="post" class="buy-form">';
						$m .= '<input type="hidden" name="id" value="'.$_GET["id"].'">';
						$m .= '<select name="qty" required>';
						$m .= '<option value="" disabled selected hidden>Qty</option>';
						$m .= '<option value="1">1</option>';
						$m .= '<option value="2">2</option>';
						$m .= '<option value="3">3</option>';
						$m .= '<option value="4">4</option>';
						$m .= '<option value="5">5</option>';
						$m .= '<option value="6">6</option>';
						$m .= '<option value="7">7</option>';
						$m .= '<option value="8">8</option>';
						$m .= '</select>';
						$m .= '<input type="submit" class="buy-btn" value="Add to Cart" name="add-to-cart">';
						$m .= '</form>';
					$m .= '</div>';
					
				$m .= '</div>';
			}
			return $m;
		}
		
		//Get product price so they can't tamper with the the cost
		function getProductPrice($id, $conn, $p)
		{
			$sql = 'select * from product where id ='.$id.' LIMIT 1;';
			$results = mysqli_query($conn, $sql);
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$p = $rows['price'];
			}
			return $p;
		}
		
		//Get product name
		function getProductName($id, $conn, $n)
		{
			$sql = 'select * from product where id ='.$id.' LIMIT 1;';
			$results = mysqli_query($conn, $sql);
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$n = $rows['name'];
			}
			return $n;
		}
		
		//Get product image
		function getProductImage($id, $conn, $n)
		{
			$sql = 'select * from product where id ='.$id.' LIMIT 1;';
			$results = mysqli_query($conn, $sql);
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$n = $rows['image'];
			}
			return $n;
		}
		
		function getProductDesc($id, $conn, $n)
		{
			$sql = 'select * from product where id ='.$id.' LIMIT 1;';
			$results = mysqli_query($conn, $sql);
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$n = $rows['description'];
			}
			return $n;
		}
		
		//Get number of products;
		function getNumProducts($conn, $n)
		{
			$sql = 'select * from product';
			$results = mysqli_query($conn, $sql);
			while ($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$n++;
			}
			return $n;
		}
		function buildLogo($l)
		{
			$l = '<span class="logo-1">GHOST</span>';
			$l .= '<span class="logo-2">KILLERS</span>';
			return $l;
		}
		function pageHeader($logo, $pageTitle)
		{
				echo '<div class="header-left">';
						echo buildLogo($logo);
					echo '</div>';
					echo '<div class="header-right">';
						include_once('includes/nav.php');
					echo '</div>';
					echo '<div class="banner">';
					echo '</div>';
					echo '<div class="title">';
					echo '<p class="page-title">'.$pageTitle.'</p>';
					echo '</div>';
		}
		function getCSS()
		{
			echo '<link type="text/css" rel="stylesheet" href="css/style.css">';
			echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
			echo '<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Indie+Flower&display=swap" rel="stylesheet">';
		}
		function getWelcome($loginMsg)
		{
			echo '<div class="center">';
			echo $loginMsg;
			echo '</div>';
			echo '<div class="left">';
				echo '<img src="img/group.jpg" class="group">';
				echo '<p class="desc">Welcome to the Official Ghost Killers website</p>';
				echo '<p class="desc">Here you can find 100% authentic ghost hunting gear, the very same used by the ghost killers team on their expeditions.</p>';
			echo '</div>';
			echo '<div class="right">';
				echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3002.327231905621!2d-104.35842368458025!3d41.1928388792825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x876f08bfd2b64afb%3A0x87180b07a9c2df63!2sE%201st%20St%2C%20Burns%2C%20WY%2082053!5e0!3m2!1sen!2sus!4v1615147699386!5m2!1sen!2sus" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				<p class="desc">LOCATION:</p>
				<p class="desc">E 1st St Burns, WY</p>
				<p class="desc">82053</p>';
			echo '</div>';
		}
?>