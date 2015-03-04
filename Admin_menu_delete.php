<?php include_once "Header.php" ?>
	
	<?php
		if($_POST)
		{
			include "config.inc.php";
			
			try
			{
				$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
				or die ("Can't connect to MySQL Server!");
				$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
				
				$ID = $_POST['ID'];
				
				$query = "DELETE FROM menu WHERE ID=$ID";
				
				if(mysqli_query($link, $query))
				{
					echo "Record was deleted.";
					header("Location: Admin_menu.php");
				}
				else
				{
					die('Unable to delete record.' . $query );
				}
			}
			catch(PDOException $exception)
			{
				echo "Error: " . $exception->getMessage();
			}	
		}
	?>
		
	<?php include_once "Footer.php" ?>