<?php 
	//Important Stuff: Global variables, DB info, Functions, Session
	include_once('includes/important.php');
	
	//Default Behavior
	$displayPageContent = '<div class="center"><p class="dude-bro">Hey bro,</p><p class="dude"> Blake Chad here 
		(founder and CEO of GHOST KILLERS) and I just wanted to give you a huge shoutout for stopping by. Here at GHOST KILLERS we\'re 
		all about documenting the paranormal and bringing you the raddest of evidence around! Make sure to check out our web store
		where you can purchase official GHOST KILLERS merch!</p></div>';
	$displayPageContent .= '<div class="left"><p class="about-desc">It all started in 2006 when the FDA raided and shut down PIZZA BROS 
		- my killer pizza restaurant – on account of us selling what they said were “inedible and dangerous ingredients.” Yeesh! What do 
		they know? Anyhoo, I’m not lettin them stop me from living the dream so I asked my dad for another $200 to start a new business!
		What do you think he said?</p>';
	$displayPageContent .= '<p class="dude-red">Hell no! You need to get off the couch and get a job!</p>';
	$displayPageContent .= '<p class="dude-stuff">OKAY, NOT WHAT I HAD PLANNED FOR...</p><p class="about-desc"> Luckily, my nerdy kid 
		brother managed to save 50% of his Pizza Bro earnings and with his $37 investment, the GHOST KILLERS were born! We specialize in 
		cleansing evil and are staffed by an expert team of professional ghost killers. Whether it be witches, warlocks, demons, or yeti - no task is too small for the GHOST KILLERS!</p><p class="about-desc"><br>Interested in becoming a ghost killer? Our full featured web store has everything you need to get started! Your customer satisfaction is what keeps us around. That’s why we were nominated for “Most unique business idea – WYOMING” on 
		UrbanSpoon in April 2007!</p></div>';
	$displayPageContent .= '<div class="right"><img src="img/blakechad.jpeg" class="chad"></div>';
	$displayPageContent .= '<div class="left"><p class="dude-stuff">So go ahead and give us a try,<br>you won\'t be dissapointed!</p>';
	$displayPageContent .= '<p class="dude-stuff">-Blake Chad<br>CEO GHOST KILLERS</p></div>';
	
	

	
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>GHOST KILLERS - About</title>
		<?php echo getCSS(); ?>
		<script defer src="script.js"></script>
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