<html>
	<head>
	<link rel="stylesheet" content="text/css" href="CSS/BasicStyle.css">
		<title>
			Auto website
		</title>
	</head>
	
	<?php
		if($_POST){
		//include database connection
		include "config.inc.php";
		
		try{
	 
			//prepare query for excecution
			
			$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
			or die ("Can't connect to MySQL Server!");
			$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
			
			$p = $_POST['Priority'];
			$n = $_POST['Name'];
			$u = $_POST['Url'];
			
			
			
			$query = "INSERT INTO menu SET Priority = $p, Name = '$n', Url = '$u'";
			
			// Execute the query
			if(mysqli_query($link, $query)){
				echo "Record was saved.";
			}else{
				die('Unable to save record.' . $query );
			}
  
		}
		catch(PDOException $exception)
		{ //to handle error
			echo "Error: " . $exception->getMessage();
		}
}
	?>
	
	
	<body>
	<?php include_once "Header.php" ?>
		
		<div id="ContentContainer">
			
			<form action='#' method='post' border='0'>
				<table>
					<tr>
						<td>Priority</td>
						<td><input type='text' name='Priority' required /></td>
					</tr>
					<tr>
						<td>Name</td>
						<td><input type='text' name='Name' required /></td>
					</tr>
					<tr>
						<td>URL</td>
						<td><input type='text' name='Url' required /></td>
					</tr>
						<td></td>
						<td>
							<input type='submit' value='Save' />
			  
							<a href='Admin_menu.php'>Back</a>
						</td>
					</tr>
				</table>
			</form>

		</div>
		
	<?php include_once "Footer.php" ?>
	</body>
</html>