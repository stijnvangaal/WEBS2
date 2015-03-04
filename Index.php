<html>
	<head>
	<link rel="stylesheet" content="text/css" href="CSS/BasicStyle.css">
		<title>
			Auto website
		</title>
	</head>
	
	<body>
	<?php include_once "Header.php" ?>
		<?php			
			include "config.inc.php";
			$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
			or die ("Can't connect to MySQL Server!");
			$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
			
			$query = "SELECT * FROM auto LIMIT 1";
			$result = mysqli_query($link, $query);
			
			$first = mysqli_fetch_array($result);
			
			if($first != NULL){
				$URL = $first['ImageUrl'];
			
				echo "<div id='SaleBack'></div>
					<div id='SaleContainer'>
					<img id='SaleImage' src='$URL' >";
			
				echo "<span id='SaleTitle'>Sale!</span>";
			
				$name = $first['Naam'];
				$snelheid = $first['Topsnelheid'];
				$prijs = $first['Prijs'];
			
				echo "<ul id='SaleSpecs'>
						<li>Naam: $name</li>
						<li>$snelheid km/h</li>
						<li>€$prijs</li>
						<ul>";
				
				echo "</div>";
			}
		?>
	
	<div id="ContentContainer">
		<div id='carList'>
		<?php
			$query = "SELECT * FROM auto";
			$result = mysqli_query($link, $query);
		
			if($result->num_rows == 0){
				echo "no content to show";
			}
			else{
				echo "<ul id='longCarList'>";
				while($row = mysqli_fetch_assoc($result)){
				$id = $row['ID'];
				$naam = $row['Naam'];
				$prijs = $row['Prijs'];
				$bouwjaar = $row['Bouwjaar'];
				$imageUrl = $row['ImageUrl'];
					echo "<li><div class='SingleCarDiv'>
					
					<table>
						<tr>
							<td rowspan='3'><img src='$imageUrl' class='SingleCarImage'></td>
							<td class='singlecarspecs'>Naam:</td>
							<td>$naam</td>
						</tr>
						<tr>
							
							<td class='singlecarspecs'>Prijs</td>
							<td>$prijs</td>
							<td><form action='product.php' method='GET'>
							<input type='hidden' name='id' value='$id'>
							<input type='submit' value='Select'>
							</form></td>
						</tr>
						<tr>
							
							<td class='singlecarspecs'>Bouwjaar</td>
							<td>$bouwjaar</td>
						</tr>
							
						</table>
					</div></li>";
				}
			}
		?>
		</div>
	</div>

	<?php include_once "Footer.php" ?>
	</body>
</html>