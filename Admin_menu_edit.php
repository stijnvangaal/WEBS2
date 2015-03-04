<?php
	// Turn off all error reporting
	error_reporting(0);
?>

<?php
	if($_POST && $_POST['submittype'] == "Save")
	{
		//include database connection
		include "config.inc.php";
	
		try
		{
			$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
			or die ("Can't connect to MySQL Server!");
			$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
			
			$i = $_POST['ID'];
			$p = $_POST['Priority'];
			$n = $_POST['Name'];
			$u = $_POST['Url'];
			
			$query = "UPDATE menu SET Priority = $p, Url = '$u', Name = '$n' WHERE ID=$i;";
			
			if(mysqli_query($link, $query))
			{
				echo "Record was edited.";
				header("Location: Admin_menu.php");
			}
			else
			{
				die('Unable to edit record.' . $query );
			}
		}
		catch(PDOException $exception)
		{
			echo "Error: " . $exception->getMessage();
		}
	}
?>
	
<?php include_once "Header.php" ?>
	
	<div id="ContentContainer">
		 
		<h1>Menu item aanpassen</h1>
		 
		<form action='#' method='post' border='0'>
			<table>
			
				<?php
					include "config.inc.php";
					$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
					or die ("Can't connect to MySQL Server!");
					$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
						
					$ID = $_POST['ID'];
					
					$query = "SELECT * FROM menu WHERE ID=$ID";
					
					$result = mysqli_query($link, $query);
					
					if($row = mysqli_fetch_assoc($result))
					{
						$url = $row["Url"];
						$name = $row["Name"];
						$priority = $row["Priority"];
					
						echo "<tr><td>Priority</td><td><input type='text' name='Priority' value='$priority' required /></td></tr>";
						echo "<tr><td>Name</td><td><input type='text' name='Name' value='$name' required /></td></tr>";
						echo "<tr><td>URL</td><td><input type='text' name='Url' value='$url' required /></td></tr>";
						echo "<input type='hidden' name='ID', value='$ID'>";
					}
				?>
				
				<td></td>
					<td>
						<input type='submit' name='submittype' value='Save' />
		  
						<a href='Admin_menu.php'>Back</a>
					</td>
			</table>
		</form>
		
	</div>
	
<?php include_once "Footer.php" ?>