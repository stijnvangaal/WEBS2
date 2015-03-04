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
				<table id='SaleContainer'>
				<tr>
				<td id='SaleImage'><img src='Images/$URL' ></td>";
		
			echo "<td id='saletitle'><span>Sale!</span></td>";
		
			$id			= $first['ID'];
			$name 		= $first['Naam'];
			$snelheid 	= $first['Topsnelheid'];
			$prijs 		= $first['Prijs'];
		
			echo "<td id='salespecsbox'><ul id='SaleSpecs'>
					<li><b>$name</b></li>
					<li>$snelheid km/h</li>
					<li><u>€$prijs</u></li>
					<ul></td>";
			
			echo "</tr>
			<tr>
				<td></td>
				<td align='center'><form  id='saleselect' action='product.php' method='GET'>
				<input type='hidden' name='id' value='$id'>
				<input type='submit' value='bekijk'>
				</form></td>
			</tr>
			</table>";
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
				
				<table cellspacing='0'>
					<tr>
						<td rowspan='3'><img src='Images/$imageUrl' class='SingleCarImage'></td>
						<td class='singlecarspecs'>Naam:</td>
						<td class='singlecarvalue'>$naam</td>
					</tr>
					<tr>
						
						<td class='singlecarspecs'>Prijs</td>
						<td class='singlecarvalue'>$prijs</td>
						<td class='singlecarselect'><form action='product.php' method='GET'>
						<input type='hidden' name='id' value='$id'>
						<input type='submit' value='Select'>
						</form></td>
					</tr>
					<tr>
						
						<td class='singlecarspecs'>Bouwjaar</td>
						<td class='singlecarvalue'>$bouwjaar</td>
					</tr>
						
					</table>
				</div></li>";
			}
		}
	?>
	</div>
</div>

<?php include_once "Footer.php" ?>
