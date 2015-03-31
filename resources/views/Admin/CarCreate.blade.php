@include('Admin.Header')

<h1>Create car</h1>

<?php
	use App\Type;
	$TypeList = Type::all();
?>

<form method="POST" action="{{action('AdminCarsController@store')}}" enctype="multipart/form-data"  >

    <p style="color:red;">

        @if($errors->any())
            {{$errors->first()}}
        @endif
    </p>
    <p>
        <label>Naam</label>
        <input type="text" name="Naam">
    </p>

    <p>
        <label>Korte beschrijving</label>
        <textarea type="text" name="BeschrijvingKort"></textarea>
    </p>
    <p>
        <label>Lange beschrijving</label>
        <textarea type="text" name="BeschrijvingLang"></textarea>
    </p>
    <p>
        <label>Prijs</label>
        <input type="text" name="Prijs">
    </p>
    <p>
        <label>Topsnelheid</label>
        <input type="text" name="Topsnelheid">
    </p>
    <p>
        <label>Kleur</label>
        <input type="text" name="Kleur">
    </p>
    <p>
        <label>Merk</label>
        <input type="text" name="Merk">
    </p>
    <p>
        <label>Bouwjaar</label>
        <input type="text" name="Bouwjaar">
    </p>
    <p>
        <label>Kilometerstand</label>
        <input type="text" name="Kilometerstand">
    </p>
    <p>
    <select name="Types_ID">
    		@foreach($TypeList as $type)

    			<option value={{ $type['ID'] }}>{{ $type['Naam'] }}</option>

    		@endforeach
    	
    </select>
    </p>
    <p>
        <input type="file" name="fileToUpload" id="fileToUpload">
    </p>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <p><input type="submit" value="Create"></p>
</form>

@include('Admin.Footer')