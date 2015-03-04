<?php include_once "Header.php" ?>

	<div id="container_auto_add">
	<form action="Admin_auto_doAdd.php" method="POST">
		<table id="table_auto_add">
			<thead>
				<tr>
					<th colspan="2">Auto toevoegen</th>
				</tr>
			</thead>
			<tr>
				<td>Naam</td>
				<td><input type="text" Name="AutoNaam"></td>
			</tr>
			<tr>
				<td>Beschrijving</td>
				<td><input type="text" Name="AutoBeschrijving"></td>
			</tr>
			<tr>
				<td>Bouwjaar</td>
				<td><input type="text" Name="AutoBouwjaar"></td>
			</tr>
			<tr>
				<td>Kilometer stand</td>
				<td><input type="text" Name="AutoKilometerstand"></td>
			</tr>
			<tr>
				<td>Kleur</td>
				<td><input type="text" Name="AutoKleur"></td>
			</tr>
			<tr>
				<td>Merk</td>
				<td><input type="text" Name="AutoMerk"></td>
			</tr>
			<tr>
				<td>Prijs</td>
				<td><input type="text" Name="AutoPrijs"></td>
			</tr>
			<tr>
				<td>Top snelheid</td>
				<td><input type="text" Name="AutoTopsnelheid"></td>
			</tr>
			<tr>
				<td>Type</td>
				<td><input type="text" Name="AutoType"></td>
			</tr>
			<tr>
				<td>Afbeelding Url</td>
				<td><input type="text" Name="AutoUrl"></td>
			</tr>
			<tr>
				<td></td>
				<td ><input type="submit"></td>
			</tr>
		</table>
	</form>
	</div>

<?php include_once "Footer.php" ?>