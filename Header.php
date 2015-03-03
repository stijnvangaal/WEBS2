<div id="TopRow"></div>
<div id="ScreenContainer">
<!-- Header -->

<!-- logo + site name -->
	<div id="TopMenuContainer">
		<img id="TopMenuLogoImg" src="Images/ferrari.png">
		
		<div id="TopMenuCompanyText">
			<span>Snelle auto's</span>
		</div>
		
		<div id="TopMenuMenuBar">
			<?php
				include "config.inc.php";
				$link = mysqli_connect("$DB_LOCATION", "$DB_USERNAME", "$DB_PASSWORD")
				or die ("Can't connect to MySQL Server!");
				$db = mysqli_select_db($link, "webs2autodb") or die("Kan database niet selecteren!");
				
				$query = "SELECT * FROM menu ORDER BY priority ASC";
				
				$isFirst = true;
				
				if ($result = mysqli_query($link, $query))
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$url = $row["url"];
						$name = $row["name"];
						
						if($isFirst)
						{
							echo "<a href='$url' class='TopMenuMenuLink' id='TopMenuMenuLinkFirst'><div class='TopMenuMenuItem'>$name</div></a>";
							$isFirst = false;
						}
						else
						{
							echo "<a href='$url' class='TopMenuMenuLink'><div class='TopMenuMenuItem'>$name</div></a>";
						}
					}
				}
				
				
			?>
		</div>
		<!--
		
		<div id="TopMenuMenuBar">
			<a href="index.php" class="TopMenuMenuLink" id="TopMenuMenuLinkFirst"><div class="TopMenuMenuItem">Home</div></a>
			<a href="about.php" class="TopMenuMenuLink"><div class="TopMenuMenuItem">About</div></a>
			<a href="product.php" class="TopMenuMenuLink"><div class="TopMenuMenuItem">Products</div></a>
		</div>
		
		-->
	</div>
	
		
<!-- menu bar -->