<html>
	<head>
	<link rel="stylesheet" content="text/css" href="CSS/BasicStyle.css">
		<title>
			Auto website
		</title>
	</head>
	
	<body>
	<?php include_once "Header.php" ?>
		
	<div id="SaleBack"></div>
	<div id="SaleContainer">
		<?php			
			include "config.inc.php";
			$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
			or die ("Can't connect to MySQL Server!");
			$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
			
			$query = "SELECT * FROM auto LIMIT 1";
			$result = mysqli_query($link, $query);
			
			$first = mysqli_fetch_array($result);
			
			$URL = $first['ImageUrl'];
			
			echo "<img id='SaleImage' src='$URL' >";
			
			echo "<span id='SaleTitle'>Sale!</span>";
			
			$name = $first['Naam'];
			$snelheid = $first['Topsnelheid'];
			$prijs = $first['Prijs'];
			
			echo "<ul id='SaleSpecs'>
					<li>Naam: $name</li>
					<li>$snelheid km/h</li>
					<li>€$prijs</li>
				<ul>";
		?>
		
		
		
		
	</div>
	
	<div id="ContentContainer">
	
	
	</div>

	<?php include_once "Footer.php" ?>
	</body>
</html>