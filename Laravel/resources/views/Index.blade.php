@include('Header')

@if (Count($SaleCar) === 1)
    <div id='SaleBack'></div>
    <table id='SaleContainer'>
        <tr>
            <td id='SaleImage'><img src='Images/{{$SaleCar->ImageUrl}}' ></td>
            <td id='saletitle'><span>Sale!</span></td>
            <td id='salespecsbox'><ul id='SaleSpecs'>
                    <li><b>{{ $SaleCar->Naam}}</b></li>
                    <li>{{$SaleCar->Topsnelheid}} km/h</li>
                    <li><u>€{{$SaleCar->Prijs}}</u></li>
                    </ul>
            </td>
        </tr>
        <tr>
            <td></td>
            <td align='center'><form  id='saleselect' action='product.php' method='GET'>
                    <input type='hidden' name='id' value='$saleCarId'>
                    <input type='submit' value='bekijk'>
                </form>
            </td>
        </tr>
    </table>
@endif

<div id='ContentContainer'>
    <div id='carList'>
        @if (Count($AllCars) >= 1)
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
                                    <td class='singlecarselect'><form action='product.php' method='GET'>
                                            <input type='hidden' name='id' value='{{$Car->ID}}'>
                                            <input type='submit' value='Select'>
                                        </form></td>
                                </tr>
                                <tr>

                                    <td class='singlecarspecs'>Bouwjaar</td>
                                    <td class='singlecarvalue'>{{$Car->Bouwjaar}}</td>
                                </tr>

                            </table>
                        </div></li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

@include('Footer')