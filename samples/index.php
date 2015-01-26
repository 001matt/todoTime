<?php
  $id = $_GET['id'];
?>
<!DOCTYPE html>  
<html lang="fr">  
	<head>  
    <meta charset="utf-8">
	  <title>Un compte à rebours entièrement en jQuery</title> 
	  
	  <!-- include -->
		<link rel="stylesheet" href="../style.css" />	
		<link rel="icon" href="favicon.ico">
				
		<!-- Our CSS stylesheet file -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
    <link rel="stylesheet" href="assets/countdown/jquery.countdown.css" />
    
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	</head> 
	 
	<body>  
		<div class="logo">
			<a href="http://samples.blog-nouvelles-technologies.fr/">
				<img class="logo-image" alt="logo" src="http://www.blog-nouvelles-technologies.fr/wp-content/themes/Design-folio/images/logo.png" original="http://www.blog-nouvelles-technologies.fr/wp-content/themes/Design-folio/images/logo.png">
			</a>
			<div class="slogan">
				Démos & téléchargements - PHP, JavaScript, HTML5, AJAX, CSS, ... 
			</div>
		</div>
		
		<div class="exhead">
			<div class="center">
				<strong>Exemple pour :</strong> 
				<a href="http://www.blog-nouvelles-technologies.fr/archives/10704/un-compte-a-rebours-entierement-en-jquery/">
					Un compte à rebours entièrement en jQuery
				</a>.
				<a href="../">Cliquez ici</a> pour voir d'autres démos!
			</div>
		</div>				
		
		<div class="center">
		
		  <h1 style="margin-top: 20px;">Un compte à rebours entièrement en jQuery</h1>
		
		  <p class="intro" id="note"></p>
		 	
		 	<div id="countdown"></div>
		 			 	
		 	<!-- JavaScript includes -->
			<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
			<script src="assets/countdown/jquery.countdown.js"></script>
			<script src="assets/js/script.js"></script>
	  </div>	
	  <?php include("../footer_demos.php"); ?>
  </body>  
</html>  