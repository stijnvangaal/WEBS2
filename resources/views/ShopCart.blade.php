@include("Header")
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>

@if($AllCars != NULL)
    @if (count($AllCars) > 0)
        <div id='ContentContainer'>
            <a href={{URL::to('Order')}}>Kopen</a>
            <hr>
            <p>Totaal €{{$TotalPrice}}</p>
            <div id='carList'>
                <ul id='longCarList'>
        @foreach($AllCars as $Car)
            <li><div class='SingleCarDiv'>

                    <table cellspacing='0'>
                        <tr>
                            <td rowspan='3'><img src='Images/{{$Car->ImageUrl}}' class='SingleCarImage'></td>
                            <td class='singlecarspecs'>Naam:</td>
                            <td class='singlecarvalue'>{{$Car->Naam}}</td>
                        </tr>
                        <tr>

                            <td class='singlecarspecs'>Prijs</td>
                            <td class='singlecarvalue'>{{$Car->Prijs}}</td>
                            <td class='singlecarselect'> <a href="{{URL::to("DeleteFromCart/$Car->ID")}}">Verwijder</a></td>
                        </tr>
                        <tr>

                            <td class='singlecarspecs'>Bouwjaar</td>
                            <td class='singlecarvalue'>{{$Car->Bouwjaar}}</td>
                        </tr>

                    </table>
                </div></li>
        @endforeach
                </ul>
            </div>
        </div>
    @else
        <div class="ErrorMessage">
            <p>Geen Auto's in winkelwagen</p>
        </div>
    @endif
@else

    <div class="ErrorMessage">
        <p>Geen Auto's in winkelwagen</p>
    </div>
@endif

@include("Footer")