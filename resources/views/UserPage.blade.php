@include('Header')

<div class="ContentContainer">
    <div class="UserPerson"><img src="/laravel/public/images/user.png"><p><b>
                {{$User['Naam']}}
            </b></p></div>

        @if(count($Buys) > 0)
        <div class="UserBuys">
            <p>Aankopen</p>
            <ul id="longCarList">
                @foreach($Buys as $Car)
                    <li><div class='SingleCarDiv'>

                            <table cellspacing='0'>
                                <tr>
                                    <td rowspan='3'><img src='Images/{{$Car->Car->ImageUrl}}' class='SingleCarImage'></td>
                                    <td class='singlecarspecs'>Naam:</td>
                                    <td class='singlecarvalue'>{{$Car->Car->Naam}}</td>
                                </tr>
                                <tr>

                                    <td class='singlecarspecs'>Prijs</td>
                                    <td class='singlecarvalue'>{{$Car->Car->Prijs}}</td>
                                    <td class='SingleCarDate'>{{date("d/m/Y",strtotime($Car->Datum))}}</td>
                                </tr>
                                <tr>

                                    <td class='singlecarspecs'>Bouwjaar</td>
                                    <td class='singlecarvalue'>{{$Car->Car->Bouwjaar}}</td>
                                </tr>
                            </table>
                        </div></li>
                @endforeach
            </ul>
        </div>
        @else
            <div class="UserEmptyBuys">
                Geen aankopen
            </div>
        @endif
</div>

@include('Footer')