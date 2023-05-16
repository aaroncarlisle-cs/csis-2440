<?php
//Important stuff
	//Database connection to localhost or server
	if($_SERVER['HTTP_HOST'] === "localhost")
	{
		define('HOST', 'localhost');
		define('USER', 'root');
		define('PASS', '1550');
		define('DB', 'CSIS2440');
	}
	else
	{
		define('HOST', 'localhost');
		define('USER', 'acarlis9_root');
		define('PASS', 'password55');
		define('DB', 'acarlis9_CSIS2440');
	}
	//GLOBAL VARIABLES AND SESSION START
		session_start();
		$displayPageContent = "";
		$displayError = "";
		$conn = mysqli_connect(HOST,USER,PASS,DB);
		$sql = 'SELECT * FROM users;';
		$error = false;
		$name = "";
		$price = "";
		$img = "";
		$desc = "";
		$footer = '<p class="footer">This is footer</p>';
		$logo = "";
		$pageTitle = "";
		$loginMsg = '<p class="desc-center-red">Log in below to access the store</p>';
		$randNum = 0;
		$randMin = 0;
		$randMax = 0;
		$fee1 = 0;
	//FUNCTIONS
		include_once('includes/functions.php');
?>