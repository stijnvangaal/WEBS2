@include('Admin.Header')

<h1>Edit car</h1>

<?php
	use App\Type;
	use App\auto;
	$TypeList = Type::all();
	$Car = auto::find($carID);
?>

<form method="POST" action="{{action('AdminCarsController@update')}}" enctype="multipart/form-data"  >

    <p style="color:red;">
        @if($errors->any())
            {{$errors->first()}}
        @endif
    </p>
    <p>
        <label>Naam</label>
        <input type="text" name="Naam" value={{ $Car->Naam }}>
    </p>

    <p>
        <label>Korte beschrijving</label>
        <textarea type="text" name="BeschrijvingKort">{{ $Car->BeschrijvingKort }}</textarea>
    </p>
    <p>
        <label>Lange beschrijving</label>
        <textarea type="text" name="BeschrijvingLang">{{ $Car->BeschrijvingLang }}</textarea>
    </p>
    <p>
        <label>Prijs</label>
        <input type="text" name="Prijs" value={{ $Car->Prijs }}>
    </p>
    <p>
        <label>Topsnelheid</label>
        <input type="text" name="Topsnelheid" value={{ $Car->Topsnelheid }}>
    </p>
    <p>
        <label>Kleur</label>
        <input type="text" name="Kleur" value={{ $Car->Kleur }}>
    </p>
    <p>
        <label>Merk</label>
        <input type="text" name="Merk"value={{ $Car->Merk }}>
    </p>
    <p>
        <label>Bouwjaar</label>
        <input type="text" name="Bouwjaar" value={{ $Car->Bouwjaar }}>
    </p>
    <p>
        <label>Kilometerstand</label>
        <input type="text" name="Kilometerstand" value={{ $Car->Kilometerstand }}>
    </p>
    <p>
    <select name="Types_ID">
    		@foreach($TypeList as $type)
    			@if($type['ParentId'] != NULL)
    				@if($type['ID'] == $Car->Types_ID)
    					<option value={{ $type['ID'] }} selected>{{ $type['Naam'] }}</option>
    				@else
    					<option value={{ $type['ID'] }}>{{ $type['Naam'] }}</option>
    				@endif
    			@endif
    		@endforeach
    	
    </select>
    </p>
    <p>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </p>

    <input type="hidden" name="ID" value={{ $Car->ID }}>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <p><input type="submit" value="Aanpassen"></p>
</form>

@include('Admin.Footer')