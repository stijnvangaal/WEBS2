@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>
<div cladd="ContentContainer">
    <p>Ingelogd als {{$User['Naam']}}</p>
    <table id="OrderTable">
        <?php $counter = 1;?>
        <thead>
        <tr>
            <th>Nr.</th>
            <th>Naam</th>
            <th>Prijs p.s.</th>
            <th>Aantal</th>
            <th>Prijs</th>
        </tr>
        </thead>
        @foreach($AllCars as $car)
            <tr>
                <td>{{$counter}}.</td>
                <td width="100px">{{$car['Naam']}}</td>
                <td width="100px">€{{$car['Prijs']}}</td>
                <td width="100px">{{$car->Aantal}}</td>
                <td width="100px">€<?php echo $car['Prijs'] * $car->Aantal;?></td>
            </tr>
            <?php $counter++?>
        @endforeach
        <tr id="OrderTotal">
            <td colspan="4">Totaal</td>
            <td colspan="1">€{{$TotalPrice}}</td>
        </tr>
    </table>

    <a href={{URL::to('DoCheckOut')}}>Afrekenen</a>
</div>
@include('Footer')