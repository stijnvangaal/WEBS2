<?php
//model
include "model/Database.php";
$saleCar = get_sale_car();
$result = get_all_cars();








//controller





//view

include_once "Header.php";
if($saleCar != NULL){
	$saleCarUrl		= $saleCar['ImageUrl'];
	$saleCarId		= $saleCar['ID'];
	$saleCarName	= $saleCar['Naam'];
	$saleCarspeed 	= $saleCar['Topsnelheid'];
	$saleCarprijs 	= $saleCar['Prijs'];
	
	echo "
	<div id='SaleBack'></div>
	<table id='SaleContainer'>
		<tr>
			<td id='SaleImage'><img src='Images/$saleCarUrl' ></td>
			<td id='saletitle'><span>Sale!</span></td>
			<td id='salespecsbox'><ul id='SaleSpecs'>
				<li><b>$saleCarName</b></li>
				<li>$saleCarspeed km/h</li>
				<li><u>€$saleCarprijs</u></li>
				<ul>
			</td>
		</tr>
		<tr>
			<td></td>
			<td align='center'><form  id='saleselect' action='product.php' method='GET'>
			<input type='hidden' name='id' value='$saleCarId'>
			<input type='submit' value='bekijk'>
			</form>
			</td>
		</tr>
	</table>";
}


echo "<div id='ContentContainer'>";
echo "<div id='carList'>";
	

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
