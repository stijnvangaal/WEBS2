@include('Header')

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
                                    <td class='singlecarselect'> <a href="{{URL::to("car/$Car->ID")}}">bekijk</a></td>
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