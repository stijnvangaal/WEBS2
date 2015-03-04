<?php include_once "Header.php" ?>
	
	<div id="ContentContainer">
	
		<table border=1 style="border-collapse: collapse">
	
			<?php
				include "config.inc.php";
				$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
				or die ("Can't connect to MySQL Server!");
				$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
				
				$query = "SELECT * FROM menu ORDER BY priority ASC";
				$result = mysqli_query($link, $query);
				
				echo "<tr> <td><b>Priority</b></td> <td><b>Name</b></td> <td><b>URL</b></td> <td><b>Action</b></td> </tr>";
				
				
				while($row = mysqli_fetch_assoc($result))
				{
					$url = $row["Url"];
					$name = $row["Name"];
					$priority = $row["Priority"];
					$id = $row["ID"];
				
					echo "<tr>";
					
					echo "<td>$priority</td>";
					echo "<td>$name</td>";
					echo "<td>$url</td>";
					echo "<td><form action='Admin_menu_edit.php' method='post'>";
					echo "<button type='submit' value='$id' name='ID'>edit</button></form>";
					echo "<form action='Admin_menu_delete.php' method='post'>";
					echo "<button type='submit' value='$id' name='ID'>delete</button></form></td>";
					
					echo "</tr>";
				}
			?>
				<tr border=0>
				<td border=0 colspan="4">
					<form method="get" action="Admin_menu_add.php">
						<button type="submit">Add new</button>
					</form>
				</td>
			</tr>
		</table>
		
	</div>
	
<?php include_once "Footer.php" ?>