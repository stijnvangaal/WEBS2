@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>
<div id="contentcontainer">

    {{--Create type tree hierarchy with link--}}
    <?php
        $smalltypes = explode('_',$Types);
        foreach($smalltypes as $type){
            if($type != "<div id='ShopTypeTree'><ul>" && $type != "</ul></div>" && $type != "</ul></li>"){
            $name = substr($type, 0, strpos($type, '<'));
            $rest = substr($type,strpos($type, '<'));?>
            <a href="{{URL::to("Webshop/$name")}}"><?php echo $rest; ?></a>

     <?php   }
        else if($type == "<div id='ShopTypeTree'><ul>"){
            echo $type;?>
            <h2>Filter</h2>
            <a href="{{URL::to("Webshop")}}"><li>Alles</li></a>
        <?php }
            else{
                echo $type;
            }
        }
    ?>

        <div id='ShopCarList'>
            @if (Count($AllCars) >= 1)
                <ul id='longCarList'>
                    @foreach($AllCars as $Car)
                        <li><div class='SingleCarDiv'>

                                <table cellspacing='0'>
                                    <tr>
                                        <td rowspan='3'><img src='/laravel/public/Images/{{$Car->ImageUrl}}' class='SingleCarImage'></td>
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