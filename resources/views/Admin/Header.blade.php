<?php
$user = NULL;
if(array_key_exists('CurrentUser',$_SESSION)){
    $user = $_SESSION['CurrentUser'];
}?>
<html>
<head>
    <link rel="stylesheet" content="text/css" href="/Laravel/public/BasicStyle.css">

    <title>
        Auto website Admin
    </title>
</head>

<body>
<div id="TopRow"></div>
<div id="ScreenContainer">
    <!-- Header -->

    <!-- logo + site name -->
    <div id="TopMenuContainer">
        <a href={{URL::to("Admin/")}}><img id="TopMenuLogoImg" src="/Laravel/public/Images/chrysler.png"></a>

        <div id="TopMenuCompanyText">
            <span>Snelle autos Admin</span>
        </div>

        <div id="TopMenuMenuBar">

            <a href={{URL::to("Admin/")}}       class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Home</div></a>
            <a href={{URL::to("Admin/Cars")}}   class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Auto's</div></a>
            <a href={{URL::to("Admin/Types")}}  class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Types</div></a>
            <a href={{URL::to("Admin/About")}}  class="TopMenuMenuLink"> <div class="TopMenuMenuItem">About</div></a>
            <a href={{URL::to("/")}}            class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Public</div></a>
            <a href={{URL::to("Logout")}}       class="TopMenuMenuLink"> <div class="TopMenuMenuItem">Uitloggen</div></a>

        </div>
    </div>


    <!-- menu bar -->