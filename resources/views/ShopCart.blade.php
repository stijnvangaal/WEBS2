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
                            <td class='singlecarspecs'>Aantal: </td>
                            <td class='singlecarvalue'>{{$Car->Amount}}</td>
                        </tr>
                        <tr>

                            <td class='singlecarspecs'>Prijs</td>
                            <td class='singlecarvalue'>{{$Car->Prijs}}</td>
                            <form method="POST" action="{{action('UserController@ChangeCartAmount')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="ID" value="{{$Car->ID}}">
                                <td class='singlecarspecs'><select name="Amount">
                                        @for($i = 1; $i <=9; $i++)
                                            @if($Car->Amount == $i)
                                                <option value="{{$i}}" selected="selected">{{$i}}</option>
                                            @else
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor
                                    </select></td>
                                <td class='singlecarvalue'><input type="submit" value="verander"></td>
                            </form>
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