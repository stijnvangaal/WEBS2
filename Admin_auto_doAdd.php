<html>
	<head>
	<link rel="stylesheet" content="text/css" href="CSS/BasicStyle.css">
		<title>
			Auto website
		</title>
	</head>
	
	<body>
	<?php include_once "Header.php" ?>
		<div id="container_auto_add">
			<?php
				
				$Naam = $_POST['AutoNaam'];
				$Beschrijving = $_POST['AutoBeschrijving'];
				$prijs = $_POST['AutoPrijs'];
				$topsnelheid = $_POST['AutoTopsnelheid'];
				$kleur = $_POST['AutoKleur'];
				$merk = $_POST['AutoMerk'];
				$bouwjaar = $_POST['AutoBouwjaar'];
				$kilometerstand = $_POST['AutoKilometerstand'];
				$Type_idType = $_POST['AutoType'];
				$ImageUrl = $_POST['AutoUrl'];
				
				include "config.inc.php";
				$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
				or die ("Can't connect to MySQL Server!");
				$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
				
				$query = "INSERT INTO auto SET Naam = '$Naam', Beschrijving = '$Beschrijving', Bouwjaar = '$bouwjaar', ImageUrl = '$ImageUrl',  KilometerStand = '$kilometerstand', Kleur = '$kleur', Merk=  '$merk', Prijs = '$prijs', Topsnelheid = '$topsnelheid', Type_idType = 1;";
				
				if($query = mysqli_query($link, $query)){
					echo "Nailed it";
				}
			?>
		</div>
	<?php include_once "Footer.php" ?>
	</body>
</html>