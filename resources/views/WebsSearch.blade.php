@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>
<div id="contentcontainer">

    <form method="POST" action="{{action('UserController@WebShopDoSearch')}}">
        <label><b>Zoeken</b></label><br/>
        <input type="text" name="SearchCrit" value="{{$Search}}">
        <input name="_token" type="hidden" value="{{ csrf_token() }}">
        <input type="submit" value="zoeken">
    </form>

    <div id='ShopCarList'>
        @if (Count($AllCars) >= 1)
            <ul id='longCarList'>
                @foreach($AllCars as $Car)
                    <li><div class='SingleCarDiv'>
                            <table cellspacing='0'>
                                <tr>
                                    <td rowspan='3'><img src='/laravel/public/Images/{{$Car->ImageUrl}}' class='searchCarImage'></td>
                                    <td class='searchcarspecs'>Naam:</td>
                                    <td class='searchcarvalue'>{{$Car->Naam}}</td>
                                    <td class='searchcarspecs'>Korte Beschijving:</td>
                                    <td class='searchcarspecs'>Type:</td>
                                    <td class='searchcarvalue'>{{$Car->Type}}</td>

                                </tr>
                                <tr>

                                    <td class='searchcarspecs'>Prijs</td>
                                    <td class='searchcarvalue'>{{$Car->Prijs}}</td>
                                    <td class='searchcarvalue' id="Beschrijving" rowspan="2">{{$Car->BeschrijvingKort}}</td>

                                    <td class='searchcarselect' colspan="2"> <a href="{{URL::to("car/$Car->ID")}}">bekijk</a></td>
                                </tr>
                                <tr>

                                    <td class='searchcarspecs'>Bouwjaar</td>
                                    <td class='searchcarvalue'>{{$Car->Bouwjaar}}</td>
                                </tr>

                            </table>
                        </div></li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@include('Footer')