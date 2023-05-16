<?php 
	$pageName =  basename($_SERVER['PHP_SELF']);
	//Make it dynamic:
	$dir = scandir(".");
	//Build array
	$fileNames = array("about.php", "catalog.php", "cart.php", "create-account.php", "index.php", "logout.php");

		echo '<nav><ul>';
		foreach ($fileNames as $fileName)
		{
				//Load always
				if ($pageName === $fileName) $class=' class="active"'; else $class='';
				if ($pageName === $fileName) 
				{
					$pageTitle = $fileName;
					$pageTitle = substr($pageTitle, 0, -4);
					if ($pageTitle == "create-account") $pageTitle = "create account";
					if ($pageTitle == "log-in") $pageTitle = "log in";
					if ($pageTitle == "index") $pageTitle = "welcome";
					if ($pageTitle == "catalog") $pageTitle = "products";
					if ($pageTitle == "cart") $pageTitle = "shopping cart";
				}
				if ($fileName === "catalog.php" || $fileName === "about.php") 
				{
					if ($fileName === "catalog.php") $navText = "PRODUCTS";
					if ($fileName === "about.php") $navText = "ABOUT";
					echo '<li><a '.$class.' href="'.$fileName.'">'.$navText.'</a></li>';
				}
				
				//Load isGranted()
				if (isGranted())
				{
					if ($fileName === "logout.php" || $fileName === "cart.php") 
					{
						if ($fileName === "logout.php") $navText = "LOG OUT";
						if ($fileName === "cart.php") $navText = "CART";
						echo '<li><a '.$class.' href="'.$fileName.'">'.$navText.'</a></li>';
					}
				}
				//Load !isGranted()
				if (!isGranted())
				{
					if ($fileName === "index.php" || $fileName === "create-account.php") 
					{
						if ($fileName === "index.php") $navText = "LOG IN";
						if ($fileName === "create-account.php") $navText = "CREATE ACCOUNT";
						echo '<li><a '.$class.' href="'.$fileName.'">'.$navText.'</a></li>';
					}
				}
		}
	echo '</nav></ul>';
?>