<?php $user = $_SESSION['CurrentUser'];?>
<html>
<head>
    <link rel="stylesheet" content="text/css" href="/Laravel/public/basicstyle.css">
    <title>
        Auto website
    </title>
</head>

<body>
<div id="TopRow"></div>
<div id="ScreenContainer">
    <!-- Header -->

    <!-- logo + site name -->
    <div id="TopMenuContainer">
        <a href={{URL::to("/")}}><img id="TopMenuLogoImg" src="/Laravel/public/Images/ferrari.png"></a>

		<div id="TopMenuCompanyText">
			<span>Snelle autos</span>
		</div>

		<div id="TopMenuMenuBar">
			<?php
                $link = mysqli_connect("databases.aii.avans.nl", "sjjgaal", "Ab12345")
				or die ("Can't connect to MySQL Server!");
				$db = mysqli_select_db($link, "sjjgaal_db") or die("Kan database niet selecteren!");

				$query = "SELECT * FROM menus ORDER BY priority ASC";

				$isFirst = true;

				if ($result = mysqli_query($link, $query))
				{
					while($row = mysqli_fetch_assoc($result))
					{
						$url = $row["Url"];
						$name = $row["Name"];

						if($isFirst)
						{
							?><a href={{URL::to($url)}} class='TopMenuMenuLink' id='TopMenuMenuLinkFirst'><div class='TopMenuMenuItem'>{{$name}}</div></a><?php
							$isFirst = false;
						}
						else
						{
							?><a href={{URL::to($url)}} class='TopMenuMenuLink'><div class='TopMenuMenuItem'>{{$name}}</div></a><?php
						}

					}
				}


			?>
            <a href={{URL::to("Cart")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Winkelwagen</div></a>

                @if($user != NULL)
                    <a href={{URL::to("User")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">{{$user['Naam']}}</div></a>
                    <a href={{URL::to("Logout")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Uitloggen</div></a>
                    @else
                    <a href={{URL::to("Login")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Inloggen</div></a>
                @endif


		</div>
	</div>


<!-- menu bar -->