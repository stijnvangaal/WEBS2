<?php
$user = NULL;
if(array_key_exists('CurrentUser',$_SESSION)){
    $user = $_SESSION['CurrentUser'];
}?>
<html>
<head>
    <link rel="stylesheet" content="text/css" href="/Laravel/public/BasicStyle.css">

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



            <a href={{URL::to("/")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Home</div></a>
            <a href={{URL::to("Webshop")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Webshop</div></a>
            <a href={{URL::to("Cart")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Winkelwagen</div></a>
            <a href={{URL::to("About")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">About</div></a>
            @if($user != NULL)
                <a href={{URL::to("User")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">{{$user['Naam']}}</div></a>
                @if($user['Rol'] == 'Admin')
                    <a href={{URL::to("Admin/")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Admin</div></a>
                @endif

                <a href={{URL::to("Logout")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Uitloggen</div></a>
            @else
                <a href={{URL::to("Login")}} class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Inloggen</div></a>
            @endif


		</div>
	</div>


<!-- menu bar -->