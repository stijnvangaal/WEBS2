@include('Header')

<div class="DetailsContainer">
    <div class="DetailsImageDiv">
        <img class="DetailsImage" src='/laravel/public/Images/{{$Car->ImageUrl}}'>
    </div>
    <div class="DetailsSpecs">
        <h3>{{$Car->Naam or 'Geen naam gegeven'}}</h3>
        <p>Beschrijving:    {{$Car->Beschrijving or ''}}</p>
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