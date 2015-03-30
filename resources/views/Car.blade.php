@include('Header')

<div class="DetailsContainer">
    <div id="BreadCrumb">
        <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
        foreach($crumbs as $crumb){
            echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
        }?>
    </div>
    <div class="DetailsImageDiv">
        <form method="POST" action="{{action('HomeController@BigPicture')}}">
            <?php $CurrentUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="PrevUrl" value="{{$CurrentUrl}}">
                <input type="hidden" name="ImageUrl" value="{{$Car->ImageUrl}}">
                <input type="image" class="DetailsImage" src="/laravel/public/Images/{{$Car->ImageUrl}}" alt="Submit Form" />
        </form>
    </div>
    <div class="DetailsSpecs">
        <h3>{{$Car->Naam or 'Geen naam gegeven'}}</h3>
        <p>Korte beschrijving:    {{$Car->BeschrijvingKort or ''}}</p>
        <p>Lange beschrijving:    {{$Car->BeschrijvingLang or ''}}</p>
        <p>Prijs:           €{{$Car->Prijs or '-'}}</p>
        <p>Topsnelheid:     {{$Car->Topsnelheid or '-'}} km/h</p>
        <p>Kleur:           {{$Car->Kleur or ''}}</p>
        <p>Merk:            {{$Car->Merk or ''}}</p>
        <p>Bouwjaar:        {{$Car->Bouwjaar or ''}}</p>
        <p>Kilometerstand:  {{$Car->Kilometerstand or ''}}</p>
        <p>Type:            {{$Type->Naam or ''}}</p>
    </div>

    <a href={{URL::to("AddToCart/$Car->ID")}}> <div> Toevoegen aan winkelwagen</div></a>
</div>

@include('Footer')